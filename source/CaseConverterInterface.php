<?php declare(strict_types = 1);
namespace arhone\converter;

/**
 * Преобразователь стилей написания
 *
 * Interface CaseConverterInterface
 * @package arhone\converter
 * @author Алексей Арх <info@arh.one>
 */
interface CaseConverterInterface {

    /**
     * CaseConverterInterface constructor.
     */
    public function __construct ();

    /**
     * @param string|null $string
     * @return CaseConverterInterface
     */
    public function camel (string $string = null): CaseConverterInterface;

    /**
     * @param string|null $string
     * @return CaseConverterInterface
     */
    public function lowerCamel (string $string = null): CaseConverterInterface;

    /**
     * @param string|null $string
     * @return CaseConverterInterface
     */
    public function snake (string $string = null): CaseConverterInterface;

    /**
     * SCREAMING_SNAKE_CASE
     *
     * @param string|null $string
     * @return CaseConverterInterface
     */
    public function screamingSnake (string $string = null): CaseConverterInterface;

    /**
     * @param string|null $string
     * @return CaseConverterInterface
     */
    public function pascal (string $string = null): CaseConverterInterface;

    /**
     * @param string|null $string
     * @return CaseConverterInterface
     */
    public function upperCamel (string $string = null): CaseConverterInterface;

    /**
     * @param string|null $string
     * @return CaseConverterInterface
     */
    public function kebab (string $string = null): CaseConverterInterface;

    /**
     * @param string|null $string
     * @return CaseConverterInterface
     */
    public function train (string $string = null): CaseConverterInterface;

    /**
     * @param string|null $string
     * @return CaseConverterInterface
     */
    public function title (string $string = null): CaseConverterInterface;

    /**
     * @return string
     */
    public function __toString () : string;

}