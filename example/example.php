<?php
include 'vendor/autoload.php';

use hasnhasan\PoTranslater;

$pt = new PoTranslater();
$pt->setPoFile('en_US.po')
    ->setSource('en')
    ->setTarget('tr')
    ->parse()
    ->translate()
    ->save();

?>