<?php
include "./connection/connect.php";

require('config.php');
require('razorpay-php-2.9.0/Razorpay.php');
include("config.php");

session_name("customer");
session_start();

if (isset($_SESSION['id'])) {
    $uid = $_SESSION['id'];

    $payQuery = "SELECT * FROM `register` WHERE id=$uid";
    $payRes = mysqli_query($con, $payQuery);

    $payRow = mysqli_fetch_assoc($payRes);

    $fname = $payRow['fname'];
    $lname = $payRow['lname'];
    $contact = $payRow['contact'];
    $email = $payRow['email'];


    // $fname = $_SESSION['fname'];
    // $lname = $_SESSION['lname'];
    // $email = $_SESSION['email'];
    // $contact = $_SESSION['contact'];


} else {
    header("location:login.php");
    exit();
}

use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);
$title = "Brews Fire Assoc.";
$currency = "INR";
$grandAmount = $_SESSION['grandAmount'];

$orderData = [
    'receipt' => "3456",
    'amount' => $grandAmount * 100, // 2000 rupees in paise
    'currency' => 'INR',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR') {
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$data = [
    "key" => $keyId,
    "amount" => $amount,
    "name" => $title,
    "description" => "Buy Tea Online",
    "image" => "https://s29.postimg.org/r6dj1g85z/daft_punk.jpg",
    "prefill" => [
        "name" => $fname . " " . $lname,
        "email" => $email,
        "contact" => $contact,
    ],
    "notes" => [
        "address" => "Hello World",
        "merchant_order_id" => "12312321",
    ],
    "theme" => [
        "color" => "#F37254"
    ],
    "order_id" => $razorpayOrderId,
];

if ($displayCurrency !== 'INR') {
    $data['display_currency'] = $displayCurrency;
    $data['display_amount'] = $displayAmount;
}

$json = json_encode($data);





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <center>
        <form action="verify.php" method="POST">
            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="<?php echo $data['key'] ?>"
                data-amount="<?php echo $data['amount'] ?>" data-currency="INR" data-name="<?php echo $data['name'] ?>"
                data-image="<?php echo $data['image'] ?>" data-description="<?php echo $data['description'] ?>"
                data-prefill.name="<?php echo $data['prefill']['name'] ?>"
                data-prefill.email="<?php echo $data['prefill']['email'] ?>"
                data-prefill.contact="<?php echo $data['prefill']['contact'] ?>" data-notes.shopping_order_id="3456"
                data-order_id="<?php echo $data['order_id'] ?>" <?php if ($displayCurrency !== 'INR') { ?>
                                data-display_amount="<?php echo $data['display_amount'] ?>" <?php } ?>
                <?php if ($displayCurrency !== 'INR') { ?>
                                data-display_currency="<?php echo $data['display_currency'] ?>" <?php } ?>>
            </script>
            <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
            <input type="hidden" name="shopping_order_id" value="3456">
        </form>
    </center>
</body>

</html>