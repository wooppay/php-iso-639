###Php iso-639 converter

##Instalation

```
composer require wooppay/php-iso-639-converter
```

##Using

This class was provide only one method ISO639::convert();

```php
use Wooppay\ISO639\ISO639;

$converter = new ISO639();
$result = $converter->convert('zh', $converter::SUB_FORMAT_639_2b);
```