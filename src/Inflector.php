<?php

declare(strict_types=1);

namespace Doctrine\Inflector;

use RuntimeException;

use function chr;
use function function_exists;
use function lcfirst;
use function mb_strtolower;
use function ord;
use function preg_match;
use function preg_replace;
use function sprintf;
use function str_replace;
use function strlen;
use function strtolower;
use function strtr;
use function trim;
use function ucwords;

/** @final */
class Inflector implements CaseConverter, Unaccenter, Slugifier, Pluralization
{
    private const ACCENTED_CHARACTERS = [
        'À' => 'A',
        'Á' => 'A',
        'Â' => 'A',
        'Ã' => 'A',
        'Ä' => 'Ae',
        'Æ' => 'Ae',
        'Å' => 'Aa',
        'æ' => 'a',
        'Ç' => 'C',
        'È' => 'E',
        'É' => 'E',
        'Ê' => 'E',
        'Ë' => 'E',
        'Ì' => 'I',
        'Í' => 'I',
        'Î' => 'I',
        'Ï' => 'I',
        'Ñ' => 'N',
        'Ò' => 'O',
        'Ó' => 'O',
        'Ô' => 'O',
        'Õ' => 'O',
        'Ö' => 'Oe',
        'Ù' => 'U',
        'Ú' => 'U',
        'Û' => 'U',
        'Ü' => 'Ue',
        'Ý' => 'Y',
        'ß' => 'ss',
        'à' => 'a',
        'á' => 'a',
        'â' => 'a',
        'ã' => 'a',
        'ä' => 'ae',
        'å' => 'aa',
        'ç' => 'c',
        'è' => 'e',
        'é' => 'e',
        'ê' => 'e',
        'ë' => 'e',
        'ì' => 'i',
        'í' => 'i',
        'î' => 'i',
        'ï' => 'i',
        'ñ' => 'n',
        'ò' => 'o',
        'ó' => 'o',
        'ô' => 'o',
        'õ' => 'o',
        'ö' => 'oe',
        'ù' => 'u',
        'ú' => 'u',
        'û' => 'u',
        'ü' => 'ue',
        'ý' => 'y',
        'ÿ' => 'y',
        'Ā' => 'A',
        'ā' => 'a',
        'Ă' => 'A',
        'ă' => 'a',
        'Ą' => 'A',
        'ą' => 'a',
        'Ć' => 'C',
        'ć' => 'c',
        'Ĉ' => 'C',
        'ĉ' => 'c',
        'Ċ' => 'C',
        'ċ' => 'c',
        'Č' => 'C',
        'č' => 'c',
        'Ď' => 'D',
        'ď' => 'd',
        'Đ' => 'D',
        'đ' => 'd',
        'Ē' => 'E',
        'ē' => 'e',
        'Ĕ' => 'E',
        'ĕ' => 'e',
        'Ė' => 'E',
        'ė' => 'e',
        'Ę' => 'E',
        'ę' => 'e',
        'Ě' => 'E',
        'ě' => 'e',
        'Ĝ' => 'G',
        'ĝ' => 'g',
        'Ğ' => 'G',
        'ğ' => 'g',
        'Ġ' => 'G',
        'ġ' => 'g',
        'Ģ' => 'G',
        'ģ' => 'g',
        'Ĥ' => 'H',
        'ĥ' => 'h',
        'Ħ' => 'H',
        'ħ' => 'h',
        'Ĩ' => 'I',
        'ĩ' => 'i',
        'Ī' => 'I',
        'ī' => 'i',
        'Ĭ' => 'I',
        'ĭ' => 'i',
        'Į' => 'I',
        'į' => 'i',
        'İ' => 'I',
        'ı' => 'i',
        'Ĳ' => 'IJ',
        'ĳ' => 'ij',
        'Ĵ' => 'J',
        'ĵ' => 'j',
        'Ķ' => 'K',
        'ķ' => 'k',
        'ĸ' => 'k',
        'Ĺ' => 'L',
        'ĺ' => 'l',
        'Ļ' => 'L',
        'ļ' => 'l',
        'Ľ' => 'L',
        'ľ' => 'l',
        'Ŀ' => 'L',
        'ŀ' => 'l',
        'Ł' => 'L',
        'ł' => 'l',
        'Ń' => 'N',
        'ń' => 'n',
        'Ņ' => 'N',
        'ņ' => 'n',
        'Ň' => 'N',
        'ň' => 'n',
        'ŉ' => 'N',
        'Ŋ' => 'n',
        'ŋ' => 'N',
        'Ō' => 'O',
        'ō' => 'o',
        'Ŏ' => 'O',
        'ŏ' => 'o',
        'Ő' => 'O',
        'ő' => 'o',
        'Œ' => 'OE',
        'œ' => 'oe',
        'Ø' => 'O',
        'ø' => 'o',
        'Ŕ' => 'R',
        'ŕ' => 'r',
        'Ŗ' => 'R',
        'ŗ' => 'r',
        'Ř' => 'R',
        'ř' => 'r',
        'Ś' => 'S',
        'ś' => 's',
        'Ŝ' => 'S',
        'ŝ' => 's',
        'Ş' => 'S',
        'ş' => 's',
        'Š' => 'S',
        'š' => 's',
        'Ţ' => 'T',
        'ţ' => 't',
        'Ť' => 'T',
        'ť' => 't',
        'Ŧ' => 'T',
        'ŧ' => 't',
        'Ũ' => 'U',
        'ũ' => 'u',
        'Ū' => 'U',
        'ū' => 'u',
        'Ŭ' => 'U',
        'ŭ' => 'u',
        'Ů' => 'U',
        'ů' => 'u',
        'Ű' => 'U',
        'ű' => 'u',
        'Ų' => 'U',
        'ų' => 'u',
        'Ŵ' => 'W',
        'ŵ' => 'w',
        'Ŷ' => 'Y',
        'ŷ' => 'y',
        'Ÿ' => 'Y',
        'Ź' => 'Z',
        'ź' => 'z',
        'Ż' => 'Z',
        'ż' => 'z',
        'Ž' => 'Z',
        'ž' => 'z',
        'ſ' => 's',
        '€' => 'E',
        '£' => '',
    ];

    /** @var WordInflector */
    private $singularizer;

    /** @var WordInflector */
    private $pluralizer;

    public function __construct(WordInflector $singularizer, WordInflector $pluralizer)
    {
        $this->singularizer = $singularizer;
        $this->pluralizer   = $pluralizer;
    }

    /** {@inheritDoc} */
    public function tableize(string $word): string
    {
        $tableized = preg_replace('~(?<=\\w)([A-Z])~u', '_$1', $word);

        if ($tableized === null) {
            throw new RuntimeException(sprintf(
                'preg_replace returned null for value "%s"',
                $word
            ));
        }

        return mb_strtolower($tableized);
    }

    /** {@inheritDoc} */
    public function classify(string $word): string
    {
        return str_replace([' ', '_', '-'], '', ucwords($word, ' _-'));
    }

    /** {@inheritDoc} */
    public function camelize(string $word): string
    {
        return lcfirst($this->classify($word));
    }

    /** {@inheritDoc} */
    public function capitalize(string $string, string $delimiters = " \n\t\r\0\x0B-"): string
    {
        return ucwords($string, $delimiters);
    }

    /** {@inheritDoc} */
    public function seemsUtf8(string $string): bool
    {
        for ($i = 0; $i < strlen($string); $i++) {
            if (ord($string[$i]) < 0x80) {
                continue; // 0bbbbbbb
            }

            if ((ord($string[$i]) & 0xE0) === 0xC0) {
                $n = 1; // 110bbbbb
            } elseif ((ord($string[$i]) & 0xF0) === 0xE0) {
                $n = 2; // 1110bbbb
            } elseif ((ord($string[$i]) & 0xF8) === 0xF0) {
                $n = 3; // 11110bbb
            } elseif ((ord($string[$i]) & 0xFC) === 0xF8) {
                $n = 4; // 111110bb
            } elseif ((ord($string[$i]) & 0xFE) === 0xFC) {
                $n = 5; // 1111110b
            } else {
                return false; // Does not match any model
            }

            for ($j = 0; $j < $n; $j++) { // n bytes matching 10bbbbbb follow ?
                if (++$i === strlen($string) || ((ord($string[$i]) & 0xC0) !== 0x80)) {
                    return false;
                }
            }
        }

        return true;
    }

    /** {@inheritDoc} */
    public function unaccent(string $string): string
    {
        if (preg_match('/[\x80-\xff]/', $string) === false) {
            return $string;
        }

        if ($this->seemsUtf8($string)) {
            $string = strtr($string, self::ACCENTED_CHARACTERS);
        } else {
            $characters = [];

            // Assume ISO-8859-1 if not UTF-8
            $characters['in'] =
                  chr(128)
                . chr(131)
                . chr(138)
                . chr(142)
                . chr(154)
                . chr(158)
                . chr(159)
                . chr(162)
                . chr(165)
                . chr(181)
                . chr(192)
                . chr(193)
                . chr(194)
                . chr(195)
                . chr(196)
                . chr(197)
                . chr(199)
                . chr(200)
                . chr(201)
                . chr(202)
                . chr(203)
                . chr(204)
                . chr(205)
                . chr(206)
                . chr(207)
                . chr(209)
                . chr(210)
                . chr(211)
                . chr(212)
                . chr(213)
                . chr(214)
                . chr(216)
                . chr(217)
                . chr(218)
                . chr(219)
                . chr(220)
                . chr(221)
                . chr(224)
                . chr(225)
                . chr(226)
                . chr(227)
                . chr(228)
                . chr(229)
                . chr(231)
                . chr(232)
                . chr(233)
                . chr(234)
                . chr(235)
                . chr(236)
                . chr(237)
                . chr(238)
                . chr(239)
                . chr(241)
                . chr(242)
                . chr(243)
                . chr(244)
                . chr(245)
                . chr(246)
                . chr(248)
                . chr(249)
                . chr(250)
                . chr(251)
                . chr(252)
                . chr(253)
                . chr(255);

            $characters['out'] = 'EfSZszYcYuAAAAAACEEEEIIIINOOOOOOUUUUYaaaaaaceeeeiiiinoooooouuuuyy';

            $string = strtr($string, $characters['in'], $characters['out']);

            $doubleChars = [];

            $doubleChars['in'] = [
                chr(140),
                chr(156),
                chr(198),
                chr(208),
                chr(222),
                chr(223),
                chr(230),
                chr(240),
                chr(254),
            ];

            $doubleChars['out'] = ['OE', 'oe', 'AE', 'DH', 'TH', 'ss', 'ae', 'dh', 'th'];

            $string = str_replace($doubleChars['in'], $doubleChars['out'], $string);
        }

        return $string;
    }

    /** {@inheritDoc} */
    public function urlize(string $string): string
    {
        // Remove all non url friendly characters with the unaccent function
        $unaccented = $this->unaccent($string);

        if (function_exists('mb_strtolower')) {
            $lowered = mb_strtolower($unaccented);
        } else {
            $lowered = strtolower($unaccented);
        }

        $replacements = [
            '/\W/' => ' ',
            '/([A-Z]+)([A-Z][a-z])/' => '\1_\2',
            '/([a-z\d])([A-Z])/' => '\1_\2',
            '/[^A-Z^a-z^0-9^\/]+/' => '-',
        ];

        $urlized = $lowered;

        foreach ($replacements as $pattern => $replacement) {
            $replaced = preg_replace($pattern, $replacement, $urlized);

            if ($replaced === null) {
                throw new RuntimeException(sprintf(
                    'preg_replace returned null for value "%s"',
                    $urlized
                ));
            }

            $urlized = $replaced;
        }

        return trim($urlized, '-');
    }

    /** {@inheritDoc} */
    public function singularize(string $word): string
    {
        return $this->singularizer->inflect($word);
    }

    /** {@inheritDoc} */
    public function pluralize(string $word): string
    {
        return $this->pluralizer->inflect($word);
    }
}
