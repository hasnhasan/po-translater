<?php
include 'vendor/autoload.php';

use PoTranslater\PoTranslate;

$pt = new PoTranslate();
$pt->setPoFile('en_US.po')
    ->setSource('en')
    ->setTarget('tr')
    ->parse()
    ->translate()
    ->save();

?>