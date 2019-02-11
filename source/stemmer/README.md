### Стеммер Портера (в разработке)
Позволяет организовать нечёткое сравнение слов, преобразуя полные слова в их основы


```php
$stemmer = new \arhone\converting\stemmer\Stemmer();

echo $stemmer->convert('матрёшка'); // матрешк
echo $stemmer->convert('матрёшкой'); // матрешк
echo $stemmer->convert('матрёшке');  // матрешк
```