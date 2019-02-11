<?php declare(strict_types = 1);

namespace arhone\converting\stemmer;

/**
 * Преобразует полные слова в их основы
 *
 * Interface StemmerInterface
 * @package arhone\converting\stemmer
 * @author Алексей Арх <info@arh.one>
 */
interface StemmerInterface {

    /**
     * @param string $text
     * @return string
     */
    public function stem (string $text) : string;

}