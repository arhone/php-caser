### Стеммер Портера
Позволяет организовать нечёткое сравнение слов, преобразуя полные слова в их основы


```php
$stemmer = new \arhone\converting\stemmer\Stemmer();

echo $stemmer->convert('матрёшка'); // матрешк
echo $stemmer->convert('матрёшкой'); // матрешк
echo $stemmer->convert('матрёшке');  // матрешк
echo $stemmer->convert('Хочешь сделать хорошо — сделай сам!'); // хочеш сдела хорош — сдела сам!