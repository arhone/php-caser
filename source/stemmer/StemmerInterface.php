<?php declare(strict_types = 1);

namespace arhone\conversion\stemmer;

/**
 * Преобразует полные слова в их основы
 *
 * Interface StemmerInterface
 * @package arhone\conversion\stemmer
 * @author Алексей Арх <info@arh.one>
 */
interface StemmerInterface {

    /**
     * Конвертирует текст в текст с основами вместо слов
     *
     * @param string $text
     * @param string|null $language
     * @return string
     */
    public function convert (string $text, string $language = null) : string;

}