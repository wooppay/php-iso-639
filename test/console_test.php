<?php
namespace Wooppay;

use Wooppay\ISO639\ISO639;

require __DIR__ . '/../src/ISO639.php';
$obj = new ISO639();
var_dump($obj->convertCode($obj::NAME_OF_639_1, $obj::NAME_OF_639_2t, 'eng'));
