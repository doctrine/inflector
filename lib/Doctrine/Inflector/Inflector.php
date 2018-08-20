<?php

declare(strict_types=1);

namespace Doctrine\Inflector;

use function chr;
use function function_exists;
use function lcfirst;
use function mb_strtolower;
use function ord;
use function preg_match;
use function preg_replace;
use function str_replace;
use function strlen;
use function strtolower;
use function strtr;
use function trim;
use function ucwords;

class Inflector
{
    /** @var WordInflector */
    private $singularizer;

    /** @var WordInflector */
    private $pluralizer;

    public function __construct(WordInflector $singularizer, WordInflector $pluralizer)
    {
        $this->singularizer = $singularizer;
        $this->pluralizer   = $pluralizer;
    }

    /**
     * Converts a word into the format for a Doctrine table name. Converts 'ModelName' to 'model_name'.
     */
    public function tableize(string $word) : string
    {
        return mb_strtolower(preg_replace('~(?<=\\w)([A-Z])~u', '_$1', $word));
    }

    /**
     * Converts a word into the format for a Doctrine class name. Converts 'table_name' to 'TableName'.
     */
    public function classify(string $word) : string
    {
        return str_replace([' ', '_', '-'], '', ucwords($word, ' _-'));
    }

    /**
     * Camelizes a word. This uses the classify() method and turns the first character to lowercase.
     */
    public function camelize(string $word) : string
    {
        return lcfirst($this->classify($word));
    }

    /**
     * Uppercases words with configurable delimiters between words.
     *
     * Takes a string and capitalizes all of the words, like PHP's built-in
     * ucwords function. This extends that behavior, however, by allowing the
     * word delimiters to be configured, rather than only separating on
     * whitespace.
     *
     * Here is an example:
     * <code>
     * <?php
     * $string = 'top-o-the-morning to all_of_you!';
     * echo $inflector->capitalize($string);
     * // Top-O-The-Morning To All_of_you!
     *
     * echo $inflector->capitalize($string, '-_ ');
     * // Top-O-The-Morning To All_Of_You!
     * ?>
     * </code>
     *
     * @param string $string     The string to operate on.
     * @param string $delimiters A list of word separators.
     *
     * @return string The string with all delimiter-separated words capitalized.
     */
    public function capitalize(string $string, string $delimiters = " \n\t\r\0\x0B-") : string
    {
        return ucwords($string, $delimiters);
    }

    /**
     * Checks if the given string seems like it has utf8 characters in it.
     *
     * @param string $string The string to check for utf8 characters in.
     */
    public function seemsUtf8(string $string) : bool
    {
        for ($i = 0; $i < strlen($string); $i++) {
            if (ord($string[$i]) < 0x80) {
                continue; // 0bbbbbbb
            } elseif ((ord($string[$i]) & 0xE0) === 0xC0) {
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

    /**
     * Remove any illegal characters, accents, etc.
     *
     * @param  string $string String to unaccent
     *
     * @return string Unaccented string
     */
    public function unaccent(string $string) : string
    {
        if (preg_match('/[\x80-\xff]/', $string) === false) {
            return $string;
        }

        if ($this->seemsUtf8($string)) {
            $characters = [
                // Decompositions for Latin-1 Supplement
                chr(195) . chr(128) => 'A',
                chr(195) . chr(129) => 'A',
                chr(195) . chr(130) => 'A',
                chr(195) . chr(131) => 'A',
                chr(195) . chr(132) => 'A',
                chr(195) . chr(133) => 'A',
                chr(195) . chr(135) => 'C',
                chr(195) . chr(136) => 'E',
                chr(195) . chr(137) => 'E',
                chr(195) . chr(138) => 'E',
                chr(195) . chr(139) => 'E',
                chr(195) . chr(140) => 'I',
                chr(195) . chr(141) => 'I',
                chr(195) . chr(142) => 'I',
                chr(195) . chr(143) => 'I',
                chr(195) . chr(145) => 'N',
                chr(195) . chr(146) => 'O',
                chr(195) . chr(147) => 'O',
                chr(195) . chr(148) => 'O',
                chr(195) . chr(149) => 'O',
                chr(195) . chr(150) => 'O',
                chr(195) . chr(153) => 'U',
                chr(195) . chr(154) => 'U',
                chr(195) . chr(155) => 'U',
                chr(195) . chr(156) => 'U',
                chr(195) . chr(157) => 'Y',
                chr(195) . chr(159) => 's',
                chr(195) . chr(160) => 'a',
                chr(195) . chr(161) => 'a',
                chr(195) . chr(162) => 'a',
                chr(195) . chr(163) => 'a',
                chr(195) . chr(164) => 'a',
                chr(195) . chr(165) => 'a',
                chr(195) . chr(167) => 'c',
                chr(195) . chr(168) => 'e',
                chr(195) . chr(169) => 'e',
                chr(195) . chr(170) => 'e',
                chr(195) . chr(171) => 'e',
                chr(195) . chr(172) => 'i',
                chr(195) . chr(173) => 'i',
                chr(195) . chr(174) => 'i',
                chr(195) . chr(175) => 'i',
                chr(195) . chr(177) => 'n',
                chr(195) . chr(178) => 'o',
                chr(195) . chr(179) => 'o',
                chr(195) . chr(180) => 'o',
                chr(195) . chr(181) => 'o',
                chr(195) . chr(182) => 'o',
                chr(195) . chr(182) => 'o',
                chr(195) . chr(185) => 'u',
                chr(195) . chr(186) => 'u',
                chr(195) . chr(187) => 'u',
                chr(195) . chr(188) => 'u',
                chr(195) . chr(189) => 'y',
                chr(195) . chr(191) => 'y',
                // Decompositions for Latin Extended-A
                chr(196) . chr(128) => 'A',
                chr(196) . chr(129) => 'a',
                chr(196) . chr(130) => 'A',
                chr(196) . chr(131) => 'a',
                chr(196) . chr(132) => 'A',
                chr(196) . chr(133) => 'a',
                chr(196) . chr(134) => 'C',
                chr(196) . chr(135) => 'c',
                chr(196) . chr(136) => 'C',
                chr(196) . chr(137) => 'c',
                chr(196) . chr(138) => 'C',
                chr(196) . chr(139) => 'c',
                chr(196) . chr(140) => 'C',
                chr(196) . chr(141) => 'c',
                chr(196) . chr(142) => 'D',
                chr(196) . chr(143) => 'd',
                chr(196) . chr(144) => 'D',
                chr(196) . chr(145) => 'd',
                chr(196) . chr(146) => 'E',
                chr(196) . chr(147) => 'e',
                chr(196) . chr(148) => 'E',
                chr(196) . chr(149) => 'e',
                chr(196) . chr(150) => 'E',
                chr(196) . chr(151) => 'e',
                chr(196) . chr(152) => 'E',
                chr(196) . chr(153) => 'e',
                chr(196) . chr(154) => 'E',
                chr(196) . chr(155) => 'e',
                chr(196) . chr(156) => 'G',
                chr(196) . chr(157) => 'g',
                chr(196) . chr(158) => 'G',
                chr(196) . chr(159) => 'g',
                chr(196) . chr(160) => 'G',
                chr(196) . chr(161) => 'g',
                chr(196) . chr(162) => 'G',
                chr(196) . chr(163) => 'g',
                chr(196) . chr(164) => 'H',
                chr(196) . chr(165) => 'h',
                chr(196) . chr(166) => 'H',
                chr(196) . chr(167) => 'h',
                chr(196) . chr(168) => 'I',
                chr(196) . chr(169) => 'i',
                chr(196) . chr(170) => 'I',
                chr(196) . chr(171) => 'i',
                chr(196) . chr(172) => 'I',
                chr(196) . chr(173) => 'i',
                chr(196) . chr(174) => 'I',
                chr(196) . chr(175) => 'i',
                chr(196) . chr(176) => 'I',
                chr(196) . chr(177) => 'i',
                chr(196) . chr(178) => 'IJ',
                chr(196) . chr(179) => 'ij',
                chr(196) . chr(180) => 'J',
                chr(196) . chr(181) => 'j',
                chr(196) . chr(182) => 'K',
                chr(196) . chr(183) => 'k',
                chr(196) . chr(184) => 'k',
                chr(196) . chr(185) => 'L',
                chr(196) . chr(186) => 'l',
                chr(196) . chr(187) => 'L',
                chr(196) . chr(188) => 'l',
                chr(196) . chr(189) => 'L',
                chr(196) . chr(190) => 'l',
                chr(196) . chr(191) => 'L',
                chr(197) . chr(128) => 'l',
                chr(197) . chr(129) => 'L',
                chr(197) . chr(130) => 'l',
                chr(197) . chr(131) => 'N',
                chr(197) . chr(132) => 'n',
                chr(197) . chr(133) => 'N',
                chr(197) . chr(134) => 'n',
                chr(197) . chr(135) => 'N',
                chr(197) . chr(136) => 'n',
                chr(197) . chr(137) => 'N',
                chr(197) . chr(138) => 'n',
                chr(197) . chr(139) => 'N',
                chr(197) . chr(140) => 'O',
                chr(197) . chr(141) => 'o',
                chr(197) . chr(142) => 'O',
                chr(197) . chr(143) => 'o',
                chr(197) . chr(144) => 'O',
                chr(197) . chr(145) => 'o',
                chr(197) . chr(146) => 'OE',
                chr(197) . chr(147) => 'oe',
                chr(197) . chr(148) => 'R',
                chr(197) . chr(149) => 'r',
                chr(197) . chr(150) => 'R',
                chr(197) . chr(151) => 'r',
                chr(197) . chr(152) => 'R',
                chr(197) . chr(153) => 'r',
                chr(197) . chr(154) => 'S',
                chr(197) . chr(155) => 's',
                chr(197) . chr(156) => 'S',
                chr(197) . chr(157) => 's',
                chr(197) . chr(158) => 'S',
                chr(197) . chr(159) => 's',
                chr(197) . chr(160) => 'S',
                chr(197) . chr(161) => 's',
                chr(197) . chr(162) => 'T',
                chr(197) . chr(163) => 't',
                chr(197) . chr(164) => 'T',
                chr(197) . chr(165) => 't',
                chr(197) . chr(166) => 'T',
                chr(197) . chr(167) => 't',
                chr(197) . chr(168) => 'U',
                chr(197) . chr(169) => 'u',
                chr(197) . chr(170) => 'U',
                chr(197) . chr(171) => 'u',
                chr(197) . chr(172) => 'U',
                chr(197) . chr(173) => 'u',
                chr(197) . chr(174) => 'U',
                chr(197) . chr(175) => 'u',
                chr(197) . chr(176) => 'U',
                chr(197) . chr(177) => 'u',
                chr(197) . chr(178) => 'U',
                chr(197) . chr(179) => 'u',
                chr(197) . chr(180) => 'W',
                chr(197) . chr(181) => 'w',
                chr(197) . chr(182) => 'Y',
                chr(197) . chr(183) => 'y',
                chr(197) . chr(184) => 'Y',
                chr(197) . chr(185) => 'Z',
                chr(197) . chr(186) => 'z',
                chr(197) . chr(187) => 'Z',
                chr(197) . chr(188) => 'z',
                chr(197) . chr(189) => 'Z',
                chr(197) . chr(190) => 'z',
                chr(197) . chr(191) => 's',
                // Euro Sign
                chr(226) . chr(130) . chr(172) => 'E',
                // GBP (Pound) Sign
                chr(194) . chr(163) => '',
                'Ä' => 'Ae',
                'ä' => 'ae',
                'Ü' => 'Ue',
                'ü' => 'ue',
                'Ö' => 'Oe',
                'ö' => 'oe',
                'ß' => 'ss',
                // Norwegian characters
                'Å'=>'Aa',
                'Æ'=>'Ae',
                'Ø'=>'O',
                'æ'=>'a',
                'ø'=>'o',
                'å'=>'aa',
            ];

            $string = strtr($string, $characters);
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

    /**
     * Convert any passed string to a url friendly string.
     * Converts 'My first blog post' to 'my-first-blog-post'
     *
     * @param  string $string String to urlize.
     *
     * @return string Urlized string.
     */
    public function urlize(string $string) : string
    {
        // Remove all non url friendly characters with the unaccent function
        $string = $this->unaccent($string);

        if (function_exists('mb_strtolower')) {
            $string = mb_strtolower($string);
        } else {
            $string = strtolower($string);
        }

        // Remove all none word characters
        $string = preg_replace('/\W/', ' ', $string);

        // More stripping. Replace spaces with dashes
        $string = strtolower(preg_replace(
            '/[^A-Z^a-z^0-9^\/]+/',
            '-',
            preg_replace(
                '/([a-z\d])([A-Z])/',
                '\1_\2',
                preg_replace(
                    '/([A-Z]+)([A-Z][a-z])/',
                    '\1_\2',
                    preg_replace('/::/', '/', $string)
                )
            )
        ));

        return trim($string, '-');
    }

    /**
     * Returns a word in singular form.
     *
     * @param string $word The word in plural form.
     *
     * @return string The word in singular form.
     */
    public function singularize(string $word) : string
    {
        return $this->singularizer->inflect($word);
    }

    /**
     * Returns a word in plural form.
     *
     * @param string $word The word in singular form.
     *
     * @return string The word in plural form.
     */
    public function pluralize(string $word) : string
    {
        return $this->pluralizer->inflect($word);
    }
}
