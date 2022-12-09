<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"></link>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Custom Font -->
    <link rel="stylesheet" href="assets/css/fonts.css"><link>
</head>
<body>
    <!-- Code goes here -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col d-flex justify-content-center flex-column" id="app">
                <button class="btn btn-primary" @click="updateMessages()">Test</button>
                <div class="d-block" v-for="content in messages">
                    {{ content }}
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!-- Vue -->
    <script src="assets/js/vue.global.js"></script>
    <!-- Axios -->
    <script src="assets/js/axios.min.js"></script>

    <script>
        const app = Vue.createApp({
            data() {
                return {
                    messages: []
                };
            }, 
            methods: {
                updateMessages() {
                    let url = "api/testMongo.php";

                    axios.get(url)
                    .then((res) => {
                        this.messages = res.data.data;
                    })
                    .catch((err) => {
                        this.messages = [err.message];
                    })
                }
            }
        });

        app.mount("#app");
    </script>
</body>
</html>