<?php declare(strict_types=1);

namespace arhone\conversion\stemmer;

/**
 * Преобразует полные слова в их основы
 *
 * Class RussianStemmer
 * @package arhone\conversion\stemmer
 * @author Алексей Арх <info@arh.one>
 */
class RussianStemmer implements StemmerInterface {

    /**
     * @var array
     */
    const INSTRUCTION = [
        'vowel' => 'аеиоуыэюя',
        'perfective_gerund' => [
            '(в|вши|вшись)$',
            '(ив|ивши|ившись|ыв|ывши|ывшись)$'
        ],
        'reflexive'  => '(ся|сь)$',
        'adjective'  => '(ее|ие|ые|ое|ими|ыми|ей|ий|ый|ой|ем|им|ым|ом|его|ого|ему|ому|их|ых|ую|юю|ая|яя|ою|ею)$',
        'participle' => [
            '(ем|нн|вш|ющ|щ)',
            '(ивш|ывш|ующ)'
        ],
        'verb' => [
            '(ла|на|ете|йте|ли|й|л|ем|н|ло|но|ет|ют|ны|ть|ешь|нно)$',
            '(ила|ыла|ена|ейте|уйте|ите|или|ыли|ей|уй|ил|ыл|им|ым|ен|ило|ыло|ено|ят|ует|уют|ит|ыт|ены|ить|ыть|ишь|ую|ю)$'
        ],
        'noun' => '(а|ев|ов|ие|ье|е|иями|ями|ами|еи|ии|и|ией|ей|ой|ий|й|иям|ям|ием|ем|ам|ом|о|у|ах|иях|ях|ы|ь|ию|ью|ю|ия|ья|я)$',
        'superlative'  => '(ейш|ейше)$',
        'derivational' => '(ост|ость)$'
    ];

    /**
     * @var array
     */
    static $cache;

    /**
     * @var string
     */
    protected $word;

    /**
     * Конвертирует текст в текст с основами вместо слов
     *
     * @param string $text
     * @param string|null $language
     * @return string
     */
    public function convert (string $text, string $language = null): string {

        $words = [];
        foreach (explode(' ', $text) as $word) {
            $words[] = $this->getWordBase($word);
        }

        return implode(' ', $words);

    }

    /**
     * Возвращает основу слова
     *
     * @param string $word
     * @return string
     */
    protected function getWordBase (string $word) {

        $word = str_replace('ё', 'е' , mb_strtolower($word));
        if (isset(self::$cache[$word])) {
            return self::$cache[$word];
        }

        $this->word  = $word;
        [$rv, , $r2] = $this->getRegions($word);

        if (!$this->removeEnding(self::INSTRUCTION['perfective_gerund'], $rv)) {

            $this->removeEnding(self::INSTRUCTION['reflexive'], $rv);

            $regex = [
                self::INSTRUCTION['participle'][0] . self::INSTRUCTION['adjective'],
                self::INSTRUCTION['participle'][1] . self::INSTRUCTION['adjective']
            ];
            if(!($this->removeEnding($regex, $rv) || $this->removeEnding(self::INSTRUCTION['adjective'], $rv))){

                if (!$this->removeEnding(self::INSTRUCTION['verb'], $rv)) {
                    $this->removeEnding(self::INSTRUCTION['noun'], $rv);
                }

            }

        }

        $this->removeEnding('и$', $rv);
        $this->removeEnding(self::INSTRUCTION['derivational'], $r2);
        if ($this->removeEnding('нн$', $rv)) {
            $this->word .= 'н';
        }
        $this->removeEnding(self::INSTRUCTION['superlative'], $rv);
        $this->removeEnding('ь$', $rv);

        return self::$cache[$word] = $this->word;

    }

    /**
     * Возвращает области слова
     *
     * @param string $word
     * @return array
     */
    protected function getRegions (string $word) : array {

        $state  = 0;
        $length = mb_strlen($word, 'utf8');

        [$rv, $r1, $r2] = 0;
        for ($i = 1; $i < $length; $i++) {

            $prevChar = mb_substr($word, $i - 1, 1, 'utf8');
            $char	  = mb_substr($word, $i, 1, 'utf8');

            // Область слова после первой гласной. Она может быть пустой, если гласные в слове отсутствуют
            if (!$state && $this->isVowel($char)) {

                $rv    = $i + 1;
                $state = 1;

            // Область слова после первого сочетания "гласная-согласная"
            } elseif ($state == 1 && $this->isVowel($prevChar) && !$this->isVowel($char)) {

                $r1     = $i + 1;
                $state	= 2;

            // Область r1 после первого сочетания "гласная-согласная"
            } elseif ($state == 2 && $this->isVowel($prevChar) && !$this->isVowel($char)) {

                $r2 = $i + 1;
                break;

            }

        }

        return [$rv, $r1, $r2];

    }

    /**
     * Удаляет окончание слова
     *
     * @param string|array $regex
     * @param null|int $region
     * @return bool
     */
    public function removeEnding ($regex, ?int $region) : bool {

        $prefix = mb_substr($this->word, 0, $region, 'utf8');
        $word   = substr($this->word, strlen($prefix));

        if (is_array($regex)) {

            if (preg_match('#.+[а|я]' . $regex[0] . '#u', $word)) {
                $this->word = $prefix . preg_replace('#' . $regex[0] . '#u', '', $word);
                return true;
            }

            $regex = $regex[1];

        }

        if (preg_match('#.+' . $regex . '#u', $word)) {
            $this->word = $prefix . preg_replace('#' . $regex . '#u', '', $word);
            return true;
        }

        return false;

    }

    /**
     * Проверка на гласность
     *
     * @param string $char
     * @return bool
     */
    private function isVowel (string $char) : bool {

        return (strpos(self::INSTRUCTION['vowel'], $char) !== false);

    }

}