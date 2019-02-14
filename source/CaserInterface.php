<?php declare(strict_types = 1);

namespace arhone\caser;

/**
 * Преобразователь стилей написания
 *
 * Interface CaserInterface
 * @package arhone\caser
 * @author Алексей Арх <info@arh.one>
 */
interface CaserInterface {

    /**
     * CaserInterface constructor.
     */
    public function __construct ();

    /**
     * camelCase
     *
     * @param string|null $string
     * @return CaserInterface|string
     */
    public function camel (?string $string = null);

    /**
     * lowerCamelCase
     *
     * @param string|null $string
     * @return CaserInterface|string
     */
    public function lowerCamel (?string $string = null);

    /**
     * snake_case
     *
     * @param string|null $string
     * @return CaserInterface|string
     */
    public function snake (?string $string = null);

    /**
     * under_score
     *
     * @param string|null $string
     * @return CaserInterface|string
     */
    public function underScore (?string $string = null);

    /**
     * SCREAMING_SNAKE_CASE
     *
     * @param string|null $string
     * @return CaserInterface|string
     */
    public function screamingSnake (?string $string = null);

    /**
     * PascalCase
     *
     * @param string|null $string
     * @return CaserInterface|string
     */
    public function pascal (?string $string = null);

    /**
     * UpperCamelCase
     *
     * @param string|null $string
     * @return CaserInterface|string
     */
    public function upperCamel (?string $string = null);

    /**
     * kebab-case
     *
     * @param string|null $string
     * @return CaserInterface|string
     */
    public function kebab (?string $string = null);

    /**
     * Train-Case
     *
     * @param string|null $string
     * @return CaserInterface|string
     */
    public function train (?string $string = null);

    /**
     * Title Case
     *
     * @param string|null $string
     * @return CaserInterface|string
     */
    public function title (?string $string = null);

}