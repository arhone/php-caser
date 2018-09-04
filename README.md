# Converter
Преобразует одно в другое

### CaseConverter
Преобразует одни стили написания в другие

```php
$CaseConverter = new \arhone\converting\CaseConverter();

echo $CaseConverter->camel('верблюжийСтиль')->snake(); // верблюжий_стиль
echo $CaseConverter->title('Всё С Больших Букв')->train(); // Всё-С-Больших-Букв
echo $CaseConverter->kebab('проткнутые-шампуром-слова')->pascal(); // ПроткнутыеШампуромСлова
echo $CaseConverter->screamingSnake('ИМЯ_КОНСТАНТЫ')->pascal(); // ИмяКонстанты
```