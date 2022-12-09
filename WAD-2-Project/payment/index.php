<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script>src="../public/assets/js/axios.min.js"</script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="https://unpkg.com/vue@next"></script>

  <title>Pay Page</title>
</head>
<body>
  <div class="container">
    <h2 class="my-4 text-center">Network Your Payment</h2>
    <form action="./charge.php" method="post" id="payment-form">
      <div class="form-row">
       <input type="text" name="first_name" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Name" id="first_name"  readonly="readonly">
       <input type="email" name="email" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Email Address" id="email"  readonly="readonly">
       <select name="amount" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Amount to donate" readonly="readonly">
          <option value="999">$9.99 SGD</option>
       </select>
        <div id="card-element" class="form-control">
          <!-- a Stripe Element will be inserted here. -->
        </div>
        <!-- Used to display form errors -->
        <div id="card-errors" role="alert"></div>
      </div>
      <button>Submit Payment</button>
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://js.stripe.com/v3/"></script>
  <script src="./js/charge.js"></script>
  <script>
        var url="../public/api/user.php";
        para= {
            id:"2"
        };

        axios.get(url, {params:para})
            .then(response => {
                console.log(response.data.data.email);
                let d=response.data.data;
                var name= d.username;
                var mail=d.email
                document.getElementById("first_name").value = d.username;
                document.getElementById("email").value = d.email;


            })
            .catch(error => {
                console.log(error.message)
                //document.getElementById("txtHint").innerText = error.message;
            });



          console.log(document.getElementById("first_name").value);
  </script>

</body>
</html>
