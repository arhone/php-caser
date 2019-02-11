# Конвертер
Преобразует одно в другое

### Конвертер стиля
Преобразует одни стили написания в другие

```php
$caseConverter = new \arhone\converting\CaseConverter();

echo $caseConverter->camel('верблюжийСтиль')->snake(); // верблюжий_стиль
echo $caseConverter->title('Всё С Больших Букв')->train(); // Всё-С-Больших-Букв
echo $caseConverter->kebab('проткнутые-шампуром-слова')->pascal(); // ПроткнутыеШампуромСлова
echo $caseConverter->screamingSnake('ИМЯ_КОНСТАНТЫ')->pascal(); // ИмяКонстанты
```
