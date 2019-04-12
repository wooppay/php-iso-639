###Php iso-639 converter

##Instalation

```
composer require wooppay/php-iso-639-converter
```

##Using

This class was provide only one method ISO639::convertCode();

```php
use Wooppay\ISO639\ISO639;

$converter = new ISO639();
$result = $converter->convertCode($converter::NAME_OF_639_1, $converter::NAME_OF_639_2t, 'zh');
```