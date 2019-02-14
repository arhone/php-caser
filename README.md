### Конвертер стиля
Преобразует одни стили написания в другие

```php
use arhone\caser\Caser;

$caser = new Caser();

echo $caser->camel('верблюжийСтиль')->snake(); // верблюжий_стиль
echo $caser->title('Всё С Больших Букв')->train(); // Всё-С-Больших-Букв
echo $caser->kebab('проткнутые-шампуром-слова')->pascal(); // ПроткнутыеШампуромСлова
echo $caser->screamingSnake('ИМЯ_КОНСТАНТЫ')->pascal(); // ИмяКонстанты
```
