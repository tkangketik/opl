<?php

namespace Midtrans;

session_start();
require_once "../../koneksi.php";
// require_once dirname(__FILE__) . '/vendor/midtrans/midtrans-php/Midtrans.php';
require_once '../../vendor/midtrans/midtrans-php/Midtrans.php';

// Set your Merchant Server Key
\Midtrans\Config::$serverKey    = 'SB-Mid-server-uVKMZ5mc-E0VvT4HjBRh5Vpk';
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = false;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized  = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds        = true;
// Required


$pelanggan = $_SESSION['username'];
$email = $_SESSION['email'];
$telepon = $_SESSION['telepon'];

foreach($_SESSION['shopping_cart'] as $SBCSitem)
						{
							// Don't list items with 0 qty
							if($SBCSitem['quantity']!=0) {

							// For calculating total values with decimals
							$pricedecimal = str_replace(",",".",$SBCSitem['unitprice']);
							$qtydecimal = str_replace(",",".",$SBCSitem['quantity']);

							$pricedecimal = (float)$pricedecimal;
							$qtydecimal = (float)$qtydecimal;
							$qtydecimaltotal = $qtydecimaltotal + $qtydecimal;

							$totaldecimal = $pricedecimal*$qtydecimal;

							// We store order detail in HTML
							$OrderDetail .= "<tr><td>".$SBCSitem['item']."</td><td>".$currency." ".$SBCSitem['unitprice']." </td><td>".$SBCSitem['quantity']."</td><td>".$currency." ".$totaldecimal." </td></tr>";

							// Write cart to screen
							echo
							"
							<tr class='tablerow'>
								<td><a href=\"?date=".$date."&remove=".$linenumber."\" class=\"btn btn-danger btn-xs\" onclick=\"return confirm('Are you sure?')\">X</a> ".$SBCSitem['item']."</td>
								<td>".$currency." ".$SBCSitem['unitprice']." </td>
								<td>".$SBCSitem['quantity']."</td>
								<td>".$currency." ".$totaldecimal." </td>
							</tr>
							";

							$item_details[] = [
								'id' => 'ITEM',
								'price' => $SBCSitem['unitprice'],
								'quantity' => $SBCSitem['quantity'],
								'name' => $SBCSitem['item']
							  ];

							// Total
							$total += $totaldecimal;

							}
							$linenumber++;
						}

$transaction_details = array(
    'order_id' => rand(),
    'gross_amount' => $totaldecimal, 
  );

//   $item_details[] = [
//     'id' => 'ITEM',
//     'price' => $SBCSitem['unitprice'],
//     'quantity' => $SBCSitem['quantity'],
//     'name' => $SBCSitem['item']
//   ];

// Optional
$billing_address = array(
    'first_name'    =>  $pelanggan,
    'phone'         =>  $telepon,
    'country_code'  => 'IDN'
);

// Optional
$shipping_address = array(
    'first_name'    =>  $pelanggan,
    'phone'         =>  $telepon,
    'country_code'  => 'IDN'
);

// Optional
$customer_details = array(
    'first_name'    => $pelanggan,
    'email'         => $email,
    'phone'         => $telepon,
    'billing_address'  => $billing_address,
    'shipping_address' => $shipping_address
);

// Fill SNAP API parameter
$params = array(
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $item_details,
);

try {
    // Get Snap Payment Page URL
    // $paymentUrl = Snap::createTransaction($params)->redirect_url;
    $snapToken = \Midtrans\Snap::getSnapToken($params);
    echo json_encode(['token' => $snapToken]);

    // Redirect to Snap Payment Page
    // header('Location: ' . $paymentUrl);
} catch (Exception $e) {
    echo $e->getMessage();
}
