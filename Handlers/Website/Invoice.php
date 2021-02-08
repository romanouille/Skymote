<?php
if (!$userLogged) {
	http_response_code(401);
	require "Handlers/Website/Error.php";
}

if (!$admin) {
	if (!$user->hasInvoice($match[0])) {
		http_response_code(404);
		require "Handlers/Website/Error.php";
	}
}

$invoiceData = $user->loadInvoice($match[0]);


header("Content-Type: application/pdf");

require "Core/fpdf.class.php";
require "Core/InvoicePrinter.class.php";

$invoice = new InvoicePrinter();
$invoice->setLogo("inc/logo-web-transparent.png");
$invoice->setColor("#007fff");
$invoice->setType("Facture");
$invoice->setReference("#{$match[0]}");
$invoice->setDate(date("d/m/Y", $invoiceData["timestamp"]));
$invoice->setTime(date("H:i:s", $invoiceData["timestamp"]));
//$invoice->setDue(date('M dS ,Y', strtotime('+3 months')));
$invoice->setFrom(array("Romuald Richard","8 La bergerie","28120 Nonvilliers-Grandhoux","France","SIRET 83828793600010"));
$invoice->setTo(json_decode($invoiceData["recipient"]));

$products = json_decode($invoiceData["products"]);
$total = 0;

foreach ($products as $product) {
	$total += $product[6];
	$invoice->addItem($product[0], $product[1], $product[2], $product[3], $product[4], $product[5], $product[6]);
}

$invoice->addTotal("Total", $total);
$invoice->addTotal("TVA 0%", 0);
$invoice->addTotal("Total dû", $total, true);
$invoice->addBadge("Payé");
//$invoice->addTitle("Important Notice");
//$invoice->addParagraph("No item will be replaced or refunded if you don't have the invoice with you. You can refund within 2 days of purchase.");
$invoice->setFooternote("TVA non applicable, article 293B du CGI");
$pdfInvoice = $invoice->render();
echo $pdfInvoice;