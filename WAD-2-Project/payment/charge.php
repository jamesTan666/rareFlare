<?php
  require_once('vendor/autoload.php');
  #require_once('config/db.php');
  #require_once('lib/pdo_db.php');
  #require_once('models/Customer.php');
  #require_once('models/Transaction.php');


$ini = parse_ini_file('../config.ini');

\Stripe\Stripe::setApiKey($ini['sk_test']);

 // Sanitize POST Array
 $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

 $first_name = $POST['first_name'];
 $amount = $POST['amount'];
 $email = $POST['email'];
 $token = $POST['stripeToken'];
 $now = new DateTime();
  //echo $now->format('Y-m-d H:i:s');    // MySQL datetime format
// Create Customer In Stripe
$customer = \Stripe\Customer::create(array(
  "email" => $email,
  "source" => $token
));

// Charge Customer
$charge = \Stripe\Charge::create(array(
  "amount" => $amount,
  "currency" => "sgd",
  "description" => "Networking Payment",
  "customer" => $customer->id
));

// Customer Data
$customerData = [
  'id' => $charge->customer,
  'first_name' => $first_name,
  #'last_name' => $last_name,
  'email' => $email
];

// Instantiate Customer
//$customer = new Customer();

// Add Customer To DB
//$customer->addCustomer($customerData);


// Transaction Data
$transactionData = [
  'id' => $charge->id,
  'customer_id' => $charge->customer,
  'product' => $charge->description,
  'amount' => $charge->amount,
  'currency' => $charge->currency,
  'status' => $charge->status,
];

// Instantiate Transaction
//$transaction = new Transaction();

// Add Transaction To DB
//$transaction->addTransaction($transactionData);

// Redirect to success
header('Location: ../sendMail/send.php?tid='.$charge->id.'&product='.$charge->description.'&email='.$email);
