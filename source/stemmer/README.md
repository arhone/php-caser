### Стеммер Портера
Позволяет организовать нечёткое сравнение слов, преобразуя полные слова в их основы


```php
use arhone\conversion\stemmer\RussianStemmer;

$stemmer = new RussianStemmer();

echo $stemmer->convert('матрёшка'); // матрешк
echo $stemmer->convert('матрёшкой'); // матрешк
echo $stemmer->convert('матрёшке');  // матрешк
echo $stemmer->convert('Хочешь сделать хорошо — сделай сам!'); // хочеш сдела хорош — сдела сам!
```