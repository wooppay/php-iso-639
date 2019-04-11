<?php
namespace Wooppay;

require __DIR__ . '/../src/ISO639.php';
$obj = new ISO639();
$obj->convertCode($obj::NAME_OF_639_1, $obj::NAME_OF_639_2b, 'en');

