<?php
/**
 * @package APICreate
 * 
 * APICreate Class helps simplify the REST API end-point creation process, 
 * such that boilerplate codes need not be repeated when creating REST APIs using 
 * vanilla/pure PHP without a framework.  
 * 
 * It is a lightweight object meant to help create GET, POST, PUT, DELETE and OPTIONS APIs.
 * 
 * GET calls are for reading data from the server
 * POST calls are for creating new data entries in the server or more secure communications with the server
 * PUT calls are for upadting an existing data entry in the server
 * DELETE calls are for deleting an existing entry from the server
 * OPTIONS calls are for previewing what are the allowable ways 
 *   to call the API, such as what of the above methods to use or whether JWT authentication is needed
 * 
 * @method __construct()
 *   @param string $type
 *   @param string $origin 
 *   @param int|null $timeout 
 *   @param array|null $headers_allowed
 * 
 *   @return APICreate
 * 
 * @method validate() 
 * 
 *   @return null 
 * 
 * @method getData() 
 * 
 *   @return array
 * 
 * @method getHeaders()
 *   @param array|null $headers
 * 
 *   @return array
 * 
 * @method JWTauthenticate()
 *   @todo 
 *   @param string|null $auth_method
 *   @param array|null $details
 * 
 *   @return bool 
 * 
 * @method respond()
 *   @param array $result
 *   @param int|null $status_code
 * 
 *   @return null
 * 
 * @method respondError() 
 *   @param array $error_message
 *   @param int|null $status_code
 * 
 *   @return null
 * 
 * @method respondFailedAuth() 
 *   @param array|null $error_message
 * 
 *   @return null 
 * 
 * * * * * * * * * * * * * * * * * * * * * * * *
 * 
 * ** Sample usage: **
 *   // Sample use case: 
 *   // This file, called pets.php, returns all pets owned by a owner
 *   // The file takes in the owner name and returns the pet names and breed as a result 
 *   // It is a GET request
 * 
 * $api = new APICreate("GET");
 * 
 * $GET_query_params = $api->getData();
 * 
 * if (!isset($GET_query_params["Owner_Name"])) {
 *     $api->respondMissingData();
 * } else {
 *     $owner_name = $GET_query_params["Owner_Name"];
 * }
 * 
 * // After retrieveing the data of dogs owned by this owner from the database
 * // and storing this data in $queried_data
 * 
 * $result_data = [];
 * foreach ($query_data as $query_data_row) {
 *     $result_data[] = $query_data_row;
 *     // $result_data has the format [ ["pet_name" => "A", "breed" => "Husky"], ["pet_name" => "B", "breed" => "Pug"], ... ]
 * }
 * 
 * $api->respond($result_data);
 * // The JSON body the user receives is { {pet_name: "A", breed: "Husky"}, {pet_name: "B", breed: "Pug"}, ... }
 * 
 * * * * * * * * * * * * * * * * * * * * * * * *
 * 
 */
class APICreate {
    /**
     * @property string $api_type
     * 
     * The HTTP method of the instantiated REST API
     */
    private $api_type;

    /**
     * @method __construct()
     *   @param string $type
     *   @param string $origin
     *   @param int|null $timeout
     *   @param array|null $headers_allowed
     * 
     *   @return APICreate
     * 
     * Instantiate the APICreate object to help with handling API Requests
     * 
     * Requires the desired HTTP method of the API to be made
     * $origin indicates URL(s) that can make requests to this API
     * $timeout indicate the maximum length of time to wait for a response
     * $headers_allowed indicates the response headers to include for this API anad take the form of an 
     *   indexed array with strings as keys and values
     * 
     * e.g. $api = new APICreate("GET", "https://www.google.com", 3600, ["X-PINGOTHER"]); 
     *      // Make new API; respond methods have to be called to complete the api
     */
    public function __construct($type, $origin = "*", $timeout = null, $headers_allowed = null) {
        if (!in_array($type, ["GET", "POST", "PUT", "DELETE"])) {
            throw new Exception("Method given does not exist.");
        }

        if (gettype($origin) !== "string") {
            throw new Exception("Origin, if specified, has to be a string");
        }

        if (gettype($timeout) !== "integer" && gettype($timeout) !== "NULL") {
            throw new Exception("Timeout, if specified, has to be an integer");
        }

        if (gettype($headers_allowed) !== "array" && gettype($headers_allowed) !== "NULL") {
            throw new Exception("The headers allowed, if specified, has to be in the form of an indexed array");
        }

        if ($headers_allowed === null) {
            $header_str = "Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, access";
        } else {
            $header_str = "";
            foreach ($headers_allowed as $header) {
                $header_str .= $header . ", ";
            }
            $header_str = trim($header_str, ", ");
        }

        switch (strtoupper($type)) {
            case "GET": 
                header("Access-Control-Allow-Origin: $origin");
                header("Content-Type: application/json; charset=UTF-8");
                header("Access-Control-Allow-Methods: " . strtoupper($type) . ", OPTIONS");
                header("Access-Control-Allow-Headers: " . $header_str);
                header("Access-Control-Allow-Credentials: true");
                break; 
            default:  
                header("Access-Control-Allow-Origin: $origin");
                header("Content-Type: application/json; charset=UTF-8");
                header("Access-Control-Allow-Methods: " . strtoupper($type) . ", OPTIONS");
                header("Access-Control-Allow-Headers: " . $header_str);
                $timeout_int = $timeout !== null ? $timeout : 3600;
                header("Access-Control-Max-Age: $timeout_int");
                break;
        }

        $this->api_type = $type; 
    }

    /**
     * @method validate() 
     * 
     *   @return null
     * 
     * Ensures that the API Request conform to the correct HTTP method
     * 
     * Returns the API call with error messages if the Request does not conform to the correct methods
     */
    public function validate() {
        $request_method = $_SERVER["REQUEST_METHOD"];

        if ($request_method === "OPTIONS") {
            http_response_code(204); // 204 No Content
            exit; 
        } elseif ($request_method !== $this->api_type) {
            http_response_code(403); // 403 Forbidden
            $response_body = [
                "message" => ("This API only allows the " . $this->api_type . " method, " . $request_method . " method was used.")
            ];
            echo json_encode($response_body);
            exit; 
        }
    }

    /**
     * @method getData() 
     * 
     *   @return array
     * 
     * Gets all the data either from URL params or from JSON Request body as an associative array
     * 
     * e.g. $data = $api->getData(); // Retrieve data of request
     */
    public function getData() {
        $result = [];
        $post_field = "";
        switch ($this->api_type) {
            case "GET": 
                foreach (array_keys($_GET) as $key) {
                    $result[$key] = $_GET[$key];
                }
                break; 
            default:
                $result = json_decode(file_get_contents("php://input"), true);
                $post_field = file_get_contents("php://input");
                if ($result === null && $post_field === "") {
                    $result = [];
                }
                break; 
        }

        if ($result === null) {
            $this->respondMissingData(["message" => "The JSON data supplied is not formatted properly."]);
        }

        return $result;
    }

    /**
     * @method getHeaders()
     *   @param array|null $headers
     * 
     *   @return array
     * 
     * $headers can take the form of an indexed array indicating the headers to retrieve
     * 
     * This returns all the HTTP headers of the Request
     * 
     * e.g. $allowed_origin = $api->getHeaders(["Origin"]); // Retrieve the Origin header
     */
    public function getHeaders($headers = null) {
        if (gettype($headers) !== "array" && gettype($headers) !== "NULL") {
            throw new Exception("The headers to retrieved, if specified, has to be in the form of an indexed array");
        }

        $result = [];
        foreach (array_keys($_SERVER) as $key) {
            if (strpos($key, "HTTP_") === 0) {
                $true_key = str_replace(" ", "-", ucwords(str_replace("_", " ", $key)));

                if ($headers === null || in_array($true_key, $headers)) {
                    $result[$true_key] = $_SERVER[$key]; 
                }
            }
        }

        return $result;
    }

    /**
     * @method JWTauthenticate()
     *   @param string $token
     *   @param string $refresh_token
     * 
     *   @return bool
     */
    public function JWTAuthenticate($token, $refresh_token) {}

    /**
     * @method respond()
     *   @param array $result
     *   @param int|null $status_code
     * 
     *   @return null
     * 
     * $result is the data to be returned
     * $status_code can be specified if a custom one is needed,
     *   null would default to the conventionally correct code
     * 
     * Returns the data the API is meant to return and set the HTTP status code 
     *   to the conventionally correct one
     * Terminates the process as a result
     * 
     * e.g. $api->respond(["message" => "Data retrieved", "data" => "123"]);
     *      // Successful response to the HTTP request
     */
    public function respond($result, $status_code = null) {
        if (gettype($result) !== "array") {
            throw new Exception("The response data has to be in the form of an associative array");
        }
        
        if (gettype($status_code) !== "integer" && gettype($status_code) !== "NULL") {
            throw new Exception("The status code, if specified, has to be an integer");
        }
        
        if ($status_code === null) {
            switch ($this->api_type) {
                case "GET": 
                    http_response_code(200); // 200 OK
                    break;
                case "POST": 
                    http_response_code(201); // 201 Created
                    break;
                case "PUT": 
                    http_response_code(200); // 200 OK
                    break;
                case "DELETE": 
                    http_response_code(204); // 204 No Content
                    break;
            }
        } else {
            http_response_code($status_code);
        }
        echo json_encode($result);
        exit; 
    }

    /**
     * @method respondError() 
     *   @param array $error_message
     *   @param int|null $status_code
     * 
     *   @return null
     * 
     * $error_message is the data to be returned that warns the user of error
     * $status_code can be specified if a custom one is needed,
     *   null would default to the conventionally correct code
     * 
     * Returns the data indicating an error occured with this API call and 
     *   set the HTTP status code to the conventionally correct one for standard errors
     * Terminates the process as a result
     * 
     * e.g. $api->respondError(["message" => "Data does not exist"]);
     *      // Failed response to the HTTP request
     */
    public function respondError($error_message, $status_code = null) {
        if (gettype($error_message) !== "array") {
            throw new Exception("The error response has to be in the form of an associative array");
        }

        if (gettype($status_code) !== "integer" && gettype($status_code) !== "NULL") {
            throw new Exception("The status code, if specified, has to be an integer");
        }

        if ($status_code === null) {
            switch ($this->api_type) {
                case "GET": 
                    http_response_code(404); // 404 Not Found
                    break;
                case "POST": 
                    http_response_code(403); // 403 Forbidden
                    break;
                case "PUT": 
                    http_response_code(403); // 403 Forbidden
                    break;
                case "DELETE": 
                    http_response_code(404); // 404 Not Found
                    break;
            }
        } else {
            http_response_code($status_code);
        }
        echo json_encode($error_message);
        exit; 
    }

    /**
     * @method respondFailedAuth() 
     *   @param array|null $error_message
     * 
     *   @return null
     * 
     * $error_message is the data to be returned that warns the user of error
     *   If null, it defaults to the JSON response - {"message": "Authorization failed."}
     * 
     * Returns the data indicating that the user's authentication is invalid or not present
     * Terminates the process as a result
     * 
     * e.g. $api->respondFailedAuth();
     *      // Failed authentication
     */
    public function respondFailedAuth($error_message = null) {
        if (gettype($error_message) !== "array" && gettype($error_message) !== "NULL") {
            throw new Exception("The error response, if specified, has to be in the form of an associative array");
        }

        http_response_code(401); // 401 Unauthorized
        if ($error_message === null) {
            echo json_encode(["message" => "Authorization failed."]);
            exit; 
        } else {
            echo json_encode($error_message);
            exit; 
        }
    }

    /**
     * @method respondMissingData() 
     *   @param array|null $error_message
     * 
     *   @return null
     * 
     * $error_message is the data to be returned that warns the user of error
     *   If null, it defaults to the JSON response - {"message": "Insufficient data supplied."}
     * 
     * Returns the data indicating that the user's request did not include all necessary parameters/information
     * Terminates the process as a result
     * 
     * e.g. $api->respondMissingData();
     *      // Not enough information supplied on HTTP request call
     */
    public function respondMissingData($error_message = null) {
        if (gettype($error_message) !== "array" && gettype($error_message) !== "NULL") {
            throw new Exception("The error response, if specified, has to be in the form of an associative array");
        }

        http_response_code(400); // 400 Bad Request
        if ($error_message === null) {
            echo json_encode(["message" => "Insufficient data supplied."]);
            exit; 
        } else {
            echo json_encode($error_message);
            exit; 
        }
    }
}
?>