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

### Стеммер Портера (в разработке)
Позволяет организовать нечёткое сравнение слов, преобразуя полные слова в их основы


```php
$stemmer = new \arhone\converting\Stemmer();

echo $stemmer->text('матрёшка'); // матрешк
echo $stemmer->text('матрёшкой'); // матрешк
echo $stemmer->text('матрёшке');  // матрешк
```