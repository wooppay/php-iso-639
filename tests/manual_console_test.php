<?php
namespace Wooppay;



use Wooppay\iso639\controllers\Iso639;

require __DIR__ . '/../src/controllers/Iso639.php';
$obj = new Iso639();
var_dump($obj->convert('eng', $obj::SUB));
