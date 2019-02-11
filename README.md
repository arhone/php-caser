# Конвертер
Преобразует одно в другое

### Конвертер стиля
Преобразует одни стили написания в другие

```php
$caser = new \arhone\converting\caser\Caser();

echo $caser->camel('верблюжийСтиль')->snake(); // верблюжий_стиль
echo $caser->title('Всё С Больших Букв')->train(); // Всё-С-Больших-Букв
echo $caser->kebab('проткнутые-шампуром-слова')->pascal(); // ПроткнутыеШампуромСлова
echo $caser->screamingSnake('ИМЯ_КОНСТАНТЫ')->pascal(); // ИмяКонстанты
```

### Стеммер Портера (в разработке)
Позволяет организовать нечёткое сравнение слов, преобразуя полные слова в их основы


```php
$stemmer = new \arhone\converting\stemmer\Stemmer();

echo $stemmer->convert('матрёшка'); // матрешк
echo $stemmer->convert('матрёшкой'); // матрешк
echo $stemmer->convert('матрёшке');  // матрешк
```