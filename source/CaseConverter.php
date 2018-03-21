<?php declare(strict_types = 1);
namespace arhone\converter;

/**
 * Преобразователь стилей написания
 *
 * Interface CaseConverter
 * @package arhone\converter
 * @author Алексей Арх <info@arh.one>
 */
class CaseConverter implements CaseConverterInterface {

    /**
     * @var array
     */
    protected $primitive = [];

    /**
     * CaseConverter constructor.
     */
    public function __construct () {

    }

    /**
     * camelCase
     *
     * @param string|null $string
     * @return CaseConverterInterface|string
     */
    public function camel (string $string = null) {

        if (!empty($string)) {

            $string = implode('.', preg_split('#((?<=.)(?=[[:upper:]][[:lower:]])|(?<=[[:lower:]])(?=[[:upper:]]))#u', $string));
            $this->primitive = explode('.', mb_strtolower($string));
            return $this;

        } else {

            $string = str_replace(' ', '', $this->title());
            return mb_strtolower(mb_substr($string, 0, 1)) . mb_substr($string, 1);;

        }

    }

    /**
     * lowerCamelCase
     *
     * @param string|null $string
     * @return CaseConverterInterface|string
     */
    public function lowerCamel (string $string = null) {

        return $this->camel((string)$string);

    }

    /**
     * snake_case
     *
     * @param string|null $string
     * @return CaseConverterInterface|string
     */
    public function snake (string $string = null) {

        if (!empty($string)) {

            $this->primitive = explode('_', mb_strtolower($string));
            return $this;

        } else {

            return implode('_', $this->primitive);

        }

    }

    /**
     * under_score
     *
     * @param string|null $string
     * @return CaseConverterInterface|string
     */
    public function underScore (string $string = null) {

        return $this->snake((string)$string);

    }

    /**
     * SCREAMING_SNAKE_CASE
     *
     * @param string|null $string
     * @return CaseConverterInterface|string
     */
    public function screamingSnake (string $string = null) {

        if (!empty($string)) {

            $this->primitive = explode('_', mb_strtolower($string));
            return $this;

        } else {

            return mb_strtoupper(implode('_', $this->primitive));

        }

    }

    /**
     * PascalCase
     *
     * @param string|null $string
     * @return CaseConverterInterface|string
     */
    public function pascal (string $string = null) {

        if (!empty($string)) {

            $this->primitive = explode('_', mb_strtolower($string));
            return $this;

        } else {

            return str_replace(' ', '', $this->title());

        }

    }

    /**
     * UpperCamelCase
     *
     * @param string|null $string
     * @return CaseConverterInterface|string
     */
    public function upperCamel (string $string = null) {

        return $this->pascal((string)$string);

    }

    /**
     * kebab-case
     *
     * @param string|null $string
     * @return CaseConverterInterface|string|string
     */
    public function kebab (string $string = null) {

        if (!empty($string)) {

            $this->primitive = explode('-', mb_strtolower($string));
            return $this;
            
        } else {

            return implode('-', $this->primitive);

        }

    }

    /**
     * Train-Case
     *
     * @param string|null $string
     * @return CaseConverterInterface|string
     */
    public function train (string $string = null) {

        if (!empty($string)) {

            $this->primitive = explode('-', mb_strtolower($string));
            return $this;

        } else {

            return str_replace(' ', '-', $this->title());

        }

    }

    /**
     * Title Case
     *
     * @param string|null $string
     * @return CaseConverterInterface|string
     */
    public function title (string $string = null) {

        if (!empty($string)) {

            $this->primitive = explode(' ', mb_strtolower($string));
            return $this;

        } else {

            return mb_convert_case(implode(' ', $this->primitive), MB_CASE_TITLE, 'UTF-8');

        }

    }

}