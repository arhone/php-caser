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
    protected $case      = null;

    /**
     * CaseConverter constructor.
     */
    public function __construct () {

    }

    /**
     * camelCase
     *
     * @param string|null $string
     * @return CaseConverterInterface
     */
    public function camel (string $string = null) : CaseConverterInterface {



    }

    /**
     * lowerCamelCase
     *
     * @param string|null $string
     * @return CaseConverterInterface
     */
    public function lowerCamel (string $string = null) : CaseConverterInterface {

    }

    /**
     * snake_case
     *
     * @param string|null $string
     * @return CaseConverterInterface
     */
    public function snake (string $string = null) : CaseConverterInterface {

        if (!empty($string)) {

            $this->primitive = explode('_', $string);

        } else {

            $this->case = implode('_', $this->primitive);

        }

        return $this;

    }

    /**
     * SCREAMING_SNAKE_CASE
     *
     * @param string|null $string
     * @return CaseConverterInterface
     */
    public function screamingSnake (string $string = null): CaseConverterInterface {


    }

    /**
     * PascalCase
     *
     * @param string|null $string
     * @return CaseConverterInterface
     */
    public function pascal (string $string = null) : CaseConverterInterface {

    }

    /**
     * UpperCamelCase
     *
     * @param string|null $string
     * @return CaseConverterInterface
     */
    public function upperCamel (string $string = null) : CaseConverterInterface {

    }

    /**
     * kebab-case
     *
     * @param string|null $string
     * @return CaseConverterInterface
     */
    public function kebab (string $string = null) : CaseConverterInterface {

        if (!empty($string)) {

            $this->primitive = explode('-', $string);

        } else {

            $this->case = implode('-', $this->primitive);

        }

        return $this;

    }

    /**
     * Train-Case
     *
     * @param string|null $string
     * @return CaseConverterInterface
     */
    public function train (string $string = null) : CaseConverterInterface {

    }

    /**
     * Title Case
     *
     * @param string|null $string
     * @return CaseConverterInterface
     */
    public function title (string $string = null) : CaseConverterInterface {

    }

    /**
     * @return string
     */
    public function __toString () : string {

        return (string)$this->case;

    }

}