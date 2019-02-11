<?php declare(strict_types=1);

namespace arhone\converting\stemmer;

/**
 * Преобразует полные слова в их основы
 *
 * Class Stemmer
 * @package arhone\converting\stemmer
 * @author Алексей Арх <info@arh.one>
 */
class Stemmer implements StemmerInterface {

    const VOWEL = 'аеёиоуыэюя';
    const REGEX_PERFECTIVE_GERUNDS1 = '(в|вши|вшись)$';
    const REGEX_PERFECTIVE_GERUNDS2 = '(ив|ивши|ившись|ыв|ывши|ывшись)$';
    const REGEX_ADJECTIVE = '(ее|ие|ые|ое|ими|ыми|ей|ий|ый|ой|ем|им|ым|ом|его|ого|ему|ому|их|ых|ую|юю|ая|яя|ою|ею)$';
    const REGEX_PARTICIPLE1 = '(ем|нн|вш|ющ|щ)';
    const REGEX_PARTICIPLE2 = '(ивш|ывш|ующ)';
    const REGEX_REFLEXIVES = '(ся|сь)$';
    const REGEX_VERB1 = '(ла|на|ете|йте|ли|й|л|ем|н|ло|но|ет|ют|ны|ть|ешь|нно)$';
    const REGEX_VERB2 = '(ила|ыла|ена|ейте|уйте|ите|или|ыли|ей|уй|ил|ыл|им|ым|ен|ило|ыло|ено|ят|ует|уют|ит|ыт|ены|ить|ыть|ишь|ую|ю)$';
    const REGEX_NOUN = '(а|ев|ов|ие|ье|е|ьё|иями|ями|ами|еи|ии|и|ией|ей|ой|ий|й|иям|ям|ием|ем|ам|ом|о|у|ах|иях|ях|ы|ь|ию|ью|ю|ия|ья|я)$';
    const REGEX_SUPERLATIVE = '(ейш|ейше)$';
    const REGEX_DERIVATIONAL = '(ост|ость)$';
    const REGEX_I = 'и$';
    const REGEX_NN = 'нн$';
    const REGEX_SOFT_SIGN = 'ь$';

    /**
     * @var array
     */
    static $cache;

    /**
     * Stemmer constructor.
     * @param string $defaultLanguage
     * @throws \Exception
     */
    public function __construct (string $defaultLanguage = 'ru') {

        if ($defaultLanguage != 'ru') {
            throw new \Exception('Язык не поддерживается');
        }

    }

    /**
     * @param string $text
     * @param string|null $language
     * @return string
     */
    public function convert (string $text, string $language = null): string {

        $originalInternalEncoding = mb_internal_encoding();
        mb_internal_encoding('UTF-8');

        $words = [];
        foreach (explode(' ', $text) as $word) {

            $originWord = str_replace('ё', 'е', mb_strtolower($word));

            if (!isset(self::$cache[$originWord])) {

                $word = $originWord;

                [$rv, $r2] = self::findRegions($word);

                // Шаг 1: Найти окончание PERFECTIVE GERUND. Если оно существует – удалить его и завершить этот шаг.
                if (!$this->removeEndings($word, array(self::REGEX_PERFECTIVE_GERUNDS1, self::REGEX_PERFECTIVE_GERUNDS2), $rv)) {

                    // Иначе, удаляем окончание REFLEXIVE (если оно существует).
                    $this->removeEndings($word, self::REGEX_REFLEXIVES, $rv);

                    // Затем в следующем порядке пробуем удалить окончания: ADJECTIVAL, VERB, NOUN. Как только одно из них найдено – шаг завершается.
                    if (!($this->removeEndings(
                            $word,
                            array(
                                self::REGEX_PARTICIPLE1 . self::REGEX_ADJECTIVE,
                                self::REGEX_PARTICIPLE2 . self::REGEX_ADJECTIVE
                            ),
                            $rv
                        ) || $this->removeEndings($word, self::REGEX_ADJECTIVE, $rv))
                    ) {
                        if (!$this->removeEndings($word, array(self::REGEX_VERB1, self::REGEX_VERB2), $rv)) {
                            $this->removeEndings($word, self::REGEX_NOUN, $rv);
                        }
                    }
                }

                // Шаг 2: Если слово оканчивается на и – удаляем и.
                $this->removeEndings($word, self::REGEX_I, $rv);

                // Шаг 3: Если в R2 найдется окончание DERIVATIONAL – удаляем его.
                $this->removeEndings($word, self::REGEX_DERIVATIONAL, $r2);

                // Шаг 4: Возможен один из трех вариантов:
                // 1. Если слово оканчивается на нн – удаляем последнюю букву.
                if ($this->removeEndings($word, self::REGEX_NN, $rv)) {
                    $word .= 'н';
                }

                // 2. Если слово оканчивается на SUPERLATIVE – удаляем его и снова удаляем последнюю букву, если слово оканчивается на нн.
                $this->removeEndings($word, self::REGEX_SUPERLATIVE, $rv);

                // 3. Если слово оканчивается на ь – удаляем его.
                $this->removeEndings($word, self::REGEX_SOFT_SIGN, $rv);

                self::$cache[$originWord] = $word;

            }

            $words[] = self::$cache[$originWord];

        }

        mb_internal_encoding($originalInternalEncoding);
        return implode(' ', $words);

    }

    /**
     * @param string $word
     * @param string|string[] $regex
     * @param int $region
     *
     * @return bool
     */
    public static function removeEndings (&$word, $regex, $region) {

        $prefix = mb_substr($word, 0, $region, 'UTF-8');
        $ending = mb_substr($word, mb_strlen($prefix, 'UTF-8'), null, 'UTF-8');

        if (is_array($regex)) {

            if (preg_match('/.+[ая]' . $regex[0] . '/ui', $ending)) {
                $word = $prefix . preg_replace('/' . $regex[0] . '/ui', '', $ending);
                return true;
            }
            $regex = $regex[1];

        }

        if (preg_match('/.+' . $regex . '/ui', $ending)) {
            $word = $prefix . preg_replace('/' . $regex . '/ui', '', $ending);
            return true;
        }

        return false;

    }

    /**
     * @param string $word
     *
     * @return int[]
     */
    private static function findRegions ($word) {

        $rv = 0;
        $state = 0;
        $wordLength = mb_strlen($word, 'UTF-8');
        for ($i = 1; $i < $wordLength; $i++) {

            $prevChar = mb_substr($word, $i - 1, 1, 'UTF-8');
            $char = mb_substr($word, $i, 1, 'UTF-8');

            switch ($state) {
                case 0:
                    if (self::isVowel($char)) {
                        $rv = $i + 1;
                        $state = 1;
                    }
                    break;
                case 1:
                    if (self::isVowel($prevChar) && !self::isVowel($char)) {
                        $state = 2;
                    }
                    break;
                case 2:
                    if (self::isVowel($prevChar) && !self::isVowel($char)) {
                        return [$rv, $i + 1];
                    }
                    break;
            }

        }

        return [$rv, 0];
        
    }

    /**
     * @param string $char
     *
     * @return bool
     */
    private static function isVowel ($char) {

        return mb_stripos(self::VOWEL, $char, 0, 'UTF-8') !== false;

    }

}