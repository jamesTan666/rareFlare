<?php
/**
 * @package APICall
 * 
 * APICall Class helps simplify the REST API end-point calling process, 
 * such that boilerplate codes need not be repeated when calling REST APIs from the back-end 
 * using vanilla/pure PHP without a framework.  
 * 
 * It is a lightweight object meant to help call GET, POST, PUT, DELETE and OPTIONS APIs.
 * 
 * GET calls are for reading data from the server
 * POST calls are for creating new data entries in the server or more secure communications with the server
 * PUT calls are for upadting an existing data entry in the server
 * DELETE calls are for deleting an existing entry from the server
 * OPTIONS calls are for previewing what are the allowable ways 
 *   to call the API, such as what of the above methods to use or whether JWT authentication is needed
 * 
 * @method get() 
 *   @param string $target_url
 *   @param array|null $data
 *   @param array|null $headers
 *   @param boolean $is_return_str 
 * 
 *   @return array 
 * 
 * @method post() 
 *   @param string $target_url
 *   @param array|null $data
 *   @param array|null $headers
 *   @param boolean $is_return_str 
 * 
 *   @return array
 * 
 * @method put() 
 *   @param string $target_url
 *   @param array|null $data
 *   @param array|null $headers
 *   @param boolean $is_return_str 
 * 
 *   @return array
 * 
 * @method delete() 
 *   @param string $target_url
 *   @param array|null $data
 *   @param array|null $headers
 *   @param boolean $is_return_str 
 * 
 *   @return array
 * 
 * @method options() 
 *   @param string $target_url
 *   @param array|null $data
 *   @param array|null $headers
 *   @param boolean $is_return_str 
 * 
 *   @return array
 * 
 * * * * * * * * * * * * * * * * * * * * * * * *
 * 
 * * * * * * * * * * * * * * * * * * * * * * * *
 * 
 */
class APICall {
    /**
     * @method get() 
     *   @param string $target_url
     *   @param array|null $data
     *   @param array|null $headers
     *   @param boolean $is_return_str 
     * 
     *   @return array
     * 
     * Calls a GET API and returns the response body data
     * 
     * $target_url is the URL of the API to call
     * $data is an associative array that would be part of the request data
     * $headers are additional headers to add on to the base headers for an API request, 
     *   such as authorization headers
     * $is_return_str controls whether the data returned is a JSON string or an associative array
     *   and defaults to false
     * 
     * Data returned is an associative array or a JSON string
     * 
     * e.g. $response_data = $api->get("https://example.com/api/data", ["username" => "example"]);
     *      // Gets the data returned from "https://example.com/api/data" 
     */
    public function get($target_url, $data = null, $headers = null, $is_return_str = false) {
        if (gettype($target_url) !== "string") {
            throw new Exception("Target URL has to be a string");
        }

        if (gettype($data) !== "array" && gettype($data) !== "NULL") {
            throw new Exception("The request data, if specified, has to be an associative array");
        }

        if (gettype($headers) !== "array" && gettype($headers) !== "NULL") {
            throw new Exception("Headers, if specified, has to be an associative array");
        }

        if (gettype($is_return_str) !== "boolean") {
            throw new Exception("The flag to return a string or not has to be a boolean");
        }

        if ($data !== null) {
            $target_url .= "?" . http_build_query($data); 
        }

        $final_headers = ["Content-Type: application/json"];
        if ($headers !== null) {
            foreach (array_keys($headers) as $header) {
                $final_headers[] = trim($header) . ": " . trim($headers[$header]); 
            }
        }

        $curl = curl_init($target_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $final_headers);

        $response = curl_exec($curl); 
        curl_close($curl);

        if ($is_return_str) {
            return $response;
        } else {
            return json_decode($response, true);
        }
    }

    /**
     * @method post() 
     *   @param string $target_url
     *   @param array|null $data
     *   @param array|null $headers
     *   @param boolean $is_return_str 
     * 
     *   @return array
     * 
     * Calls a POST API and returns the response body data
     * 
     * $target_url is the URL of the API to call
     * $data is an associative array that would be part of the request data
     * $headers are additional headers to add on to the base headers for an API request, 
     *   such as authorization headers
     * $is_return_str controls whether the data returned is a JSON string or an associative array
     *   and defaults to false
     * 
     * Data returned is an associative array or a JSON string
     * 
     * e.g. $response_data = $api->post("https://example.com/api/data", ["username" => "example"]);
     *      // Gets the data returned from "https://example.com/api/data" 
     */
    public function post($target_url, $data = null, $headers = null, $is_return_str = false) {
        if (gettype($target_url) !== "string") {
            throw new Exception("Target URL has to be a string");
        }

        if (gettype($data) !== "array" && gettype($data) !== "NULL") {
            throw new Exception("The request data, if specified, has to be an associative array");
        }

        if (gettype($headers) !== "array" && gettype($headers) !== "NULL") {
            throw new Exception("Headers, if specified, has to be an associative array");
        }

        if (gettype($is_return_str) !== "boolean") {
            throw new Exception("The flag to return a string or not has to be a boolean");
        }

        if ($data === null) {
            $data = [];
        }

        $final_headers = ["Content-Type: application/json"];
        if ($headers !== null) {
            foreach (array_keys($headers) as $header) {
                $final_headers[] = trim($header) . ": " . trim($headers[$header]); 
            }
        }

        $curl = curl_init($target_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_HTTPHEADER, $final_headers);

        $response = curl_exec($curl); 
        curl_close($curl);

        if ($is_return_str) {
            return $response;
        } else {
            return json_decode($response, true);
        }
    }

    /**
     * @method put() 
     *   @param string $target_url
     *   @param array|null $data
     *   @param array|null $headers
     *   @param boolean $is_return_str 
     * 
     *   @return array
     * 
     * Calls a PUT API and returns the response body data
     * 
     * $target_url is the URL of the API to call
     * $data is an associative array that would be part of the request data
     * $headers are additional headers to add on to the base headers for an API request, 
     *   such as authorization headers
     * $is_return_str controls whether the data returned is a JSON string or an associative array
     *   and defaults to false
     * 
     * Data returned is an associative array or a JSON string
     * 
     * e.g. $response_data = $api->put("https://example.com/api/data", ["username" => "example"]);
     *      // Gets the data returned from "https://example.com/api/data" 
     */
    public function put($target_url, $data = null, $headers = null, $is_return_str = false) {
        if (gettype($target_url) !== "string") {
            throw new Exception("Target URL has to be a string");
        }

        if (gettype($data) !== "array" && gettype($data) !== "NULL") {
            throw new Exception("The request data, if specified, has to be an associative array");
        }

        if (gettype($headers) !== "array" && gettype($headers) !== "NULL") {
            throw new Exception("Headers, if specified, has to be an associative array");
        }

        if (gettype($is_return_str) !== "boolean") {
            throw new Exception("The flag to return a string or not has to be a boolean");
        }

        if ($data === null) {
            $data = [];
        }

        $final_headers = ["Content-Type: application/json"];
        if ($headers !== null) {
            foreach (array_keys($headers) as $header) {
                $final_headers[] = trim($header) . ": " . trim($headers[$header]); 
            }
        }

        $curl = curl_init($target_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_HTTPHEADER, $final_headers);

        $response = curl_exec($curl); 
        curl_close($curl);

        if ($is_return_str) {
            return $response;
        } else {
            return json_decode($response, true);
        }
    }

    /**
     * @method delete() 
     *   @param string $target_url
     *   @param array|null $data
     *   @param array|null $headers
     *   @param boolean $is_return_str 
     * 
     *   @return array
     * 
     * Calls a DELETE API and returns the response body data
     * 
     * $target_url is the URL of the API to call
     * $data is an associative array that would be part of the request data
     * $headers are additional headers to add on to the base headers for an API request, 
     *   such as authorization headers
     * $is_return_str controls whether the data returned is a JSON string or an associative array
     *   and defaults to false
     * 
     * Data returned is an associative array or a JSON string
     * 
     * e.g. $response_data = $api->delete("https://example.com/api/data", ["username" => "example"]);
     *      // Gets the data returned from "https://example.com/api/data" 
     */
    public function delete($target_url, $data = null, $headers = null, $is_return_str = false) {
        if (gettype($target_url) !== "string") {
            throw new Exception("Target URL has to be a string");
        }

        if (gettype($data) !== "array" && gettype($data) !== "NULL") {
            throw new Exception("The request data, if specified, has to be an associative array");
        }

        if (gettype($headers) !== "array" && gettype($headers) !== "NULL") {
            throw new Exception("Headers, if specified, has to be an associative array");
        }

        if (gettype($is_return_str) !== "boolean") {
            throw new Exception("The flag to return a string or not has to be a boolean");
        }

        $final_headers = ["Content-Type: application/json"];
        if ($headers !== null) {
            foreach (array_keys($headers) as $header) {
                $final_headers[] = trim($header) . ": " . trim($headers[$header]); 
            }
        }

        $curl = curl_init($target_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        if ($data !== null) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, $final_headers);

        $response = curl_exec($curl); 
        curl_close($curl);

        if ($is_return_str) {
            return $response;
        } else {
            return json_decode($response, true);
        }
    }

    /**
     * @method options() 
     *   @param string $target_url
     *   @param array|null $data
     *   @param array|null $headers
     *   @param boolean $is_return_str 
     * 
     *   @return array
     * 
     * Calls an API using the OPTIONS method and returns the response body data
     *   which shows the request headers permitted or required
     * 
     * $target_url is the URL of the API to call
     * $data is an associative array that would be part of the request data
     * $headers are additional headers to add on to the base headers for an API request, 
     *   such as authorization headers
     * $is_return_str controls whether the data returned is a JSON string or an associative array
     *   and defaults to false
     * 
     * Data returned is an associative array or a JSON string
     * 
     * e.g. $response_data = $api->options("https://example.com/api/data", ["username" => "example"]);
     *      // Gets the data returned from a pre-flight request to "https://example.com/api/data" 
     */
    public function options($target_url, $data = null, $headers = null, $is_return_str = false) {
        if (gettype($target_url) !== "string") {
            throw new Exception("Target URL has to be a string"); 
        }

        if (gettype($data) !== "array" && gettype($data) !== "NULL") {
            throw new Exception("The request data, if specified, has to be an associative array");
        }

        if (gettype($headers) !== "array" && gettype($headers) !== "NULL") {
            throw new Exception("Headers, if specified, has to be an associative array");
        }

        if (gettype($is_return_str) !== "boolean") {
            throw new Exception("The flag to return a string or not has to be a boolean");
        }

        $final_headers = ["Content-Type: application/json"];
        if ($headers !== null) {
            foreach ($headers as $header) {
                $final_headers[] = trim($header) . ": " . trim($headers[$header]); 
            }
        }

        $curl = curl_init($target_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "OPTIONS");
        if ($data !== null) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, $final_headers);

        $response = curl_exec($curl); 
        curl_close($curl);

        if ($is_return_str) {
            return $response;
        } else {
            return json_decode($response, true);
        }
    }
}
?>