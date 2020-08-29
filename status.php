<?php
// Medical Response System for Smart City
include('phpqrcode/qrlib.php');

// outputs image directly into browser, as PNG stream
QRcode::png('PHP QR Code :)'); 
?>