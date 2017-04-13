<?php
require 'PHPMailer/PHPMailerAutoload.php';
$out_file = "out.png";
if($_POST["pdf"] == true) { $out_file = "out.pdf"; }

// Generate out_file
$phantom = "phantomjs ".getcwd()."/rasterize.js ".$_POST["url"]." ".$out_file." ".$_POST["username"]." ".$_POST["password"];
//print($phantom); //DEBUG
exec($phantom);

// Mail it!
$email = new PHPMailer();
$email->From      = 'jlawrence@air.org';
$email->FromName  = 'RenderSender';
$email->Subject   = "Render of ".$_POST["url"];
$email->Body      = "Render of ".$_POST["url"]." sent from http://stg_d8_6000.airgility.org/RenderSender/";
$send_to = split(",", $_POST["send_to"]);
foreach($send_to as &$send_addr)
{
	$email->AddAddress($send_addr);
}
$file_to_attach = getcwd().'/'.$out_file;
$email->AddAttachment($file_to_attach);
$email->Send();

// Send user back to form
header("Location: ./")

?>
