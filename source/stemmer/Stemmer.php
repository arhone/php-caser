<?php declare(strict_types = 1);

namespace arhone\converting\stemmer;

/**
 * Преобразует полные слова в их основы
 *
 * Class RussionStemmer
 * @package arhone\converting\stemmer
 * @author Алексей Арх <info@arh.one>
 */
class Stemmer implements StemmerInterface {

    /**
     * @var string
     */
    protected $defaultLanguage = 'ru';

    /**
     * Stemmer constructor.
     * @param string $defaultLanguage
     */
    public function __construct (string $defaultLanguage = 'ru') {
        $this->defaultLanguage = $defaultLanguage;
    }

    /**
     * @param string $text
     * @return string
     */
    public function convert (string $text) : string {

        return '';

    }

}