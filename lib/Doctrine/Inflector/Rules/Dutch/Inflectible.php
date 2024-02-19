<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules\Dutch;

use Doctrine\Inflector\Rules\Pattern;
use Doctrine\Inflector\Rules\Substitution;
use Doctrine\Inflector\Rules\Transformation;
use Doctrine\Inflector\Rules\Word;

/**
 *  // http://nl.wikipedia.org/wiki/Klinker_(klank)
 *  private $klinker = '(a|e|i|o|u|ij)';
 *  private $korteKlinker = '(u|i|e|a|o)';          // @todo '(ie|oe)'. $plofKlank
 *
 *  // http://nl.wikipedia.org/wiki/Medeklinker
 *  private $plofKlank = '(p|t|k|b|d)';
 *  private $wrijfKlank = '(f|s|ch|sj|v|z|g|j)';    // journaal
 *  private $neusKlank = '(m|n|ng)';
 *  private $vloeiKlank = '(l|r)';
 *  private $glijKlank = '(j|w)';                   // jaar
 *  private $affricate = '(ts|zz|tsj|g)';           // /d3/ gin
 *  private $missingFromWiki = '(c|h|p|q|x|y|z)';
 *
 *  public function __construct()
 *  {
 *      $this->medeklinker = '(' . $this->missingFromWiki . '|' . $this->plofKlank . '|' . $this->wrijfKlank . '|' . $this->neusKlank . '|' . $this->vloeiKlank . '|' . $this->glijKlank . '|' . $this->affricate . ')';
 *      $this->medeklinker = '((c|h|p|q|x|y|z)|(p|t|k|b|d)|(f|s|ch|sj|v|z|g|j)|(m|n|ng)|(l|r)|(j|w)|(ts|zz|tsj|g))';
 *  }
 */
class Inflectible
{
    /**
     * @return iterable<Transformation>
     */
    public static function getSingular(): iterable
    {
        // http://nl.wikipedia.org/wiki/Meervoud_(Nederlands)#Klinkerverandering
        yield new Transformation(new Pattern('()heden$'), '\1heid');

        // http://nl.wikipedia.org/wiki/Meervoud_(Nederlands)#Beroepen_eindigend_op_-man
        yield new Transformation(new Pattern('()mannen$'), '\1man');

        // http://nl.wikipedia.org/wiki/Meervoud_(Nederlands)#Latijnse_meervoudsvormen
        yield new Transformation(new Pattern('()ices$'), '\1ex');

        // http://nl.wikipedia.org/wiki/Meervoud_(Nederlands)#Stapelmeervoud
        yield new Transformation(new Pattern('^(ei|gemoed|goed|hoen|kind|lied|rad|rund)eren$'), '\1');

        // http://nl.wikipedia.org/wiki/Nederlandse_grammatica
        yield new Transformation(new Pattern('()ijen$'), '\1ij');

        yield new Transformation(new Pattern('()ieen$'), '\1ie');       // ën

        yield new Transformation(new Pattern('()((a|e|i|o|u|ij))s$'), '\1\2');

        yield new Transformation(new Pattern('()((s)s)en$'), '\1s');

        yield new Transformation(new Pattern('()((c|h|p|q|x|y|z)|(p|t|k|b|d)|(f|s|ch|sj|v|z|g|j)|(m|n|ng)|(l|r)|(j|w)|(ts|zz|tsj|g))en$'), '\1\2');
    }

    /**
     * @return iterable<Transformation>
     */
    public static function getPlural(): iterable
    {
        // @todo already in plural (?)
        // @todo refine
        yield new Transformation(new Pattern('()(e)(s)$'), '\1\2\3\3en');

        // http://nl.wikipedia.org/wiki/Meervoud_(Nederlands)#Klinkerverandering
        yield new Transformation(new Pattern('()heid$'), '\1heden');

        // http://nl.wikipedia.org/wiki/Meervoud_(Nederlands)#Beroepen_eindigend_op_-man
        yield new Transformation(new Pattern('()man$'), '\1mannen');

        // http://nl.wikipedia.org/wiki/Meervoud_(Nederlands)#Latijnse_meervoudsvormen
        yield new Transformation(new Pattern('()ix$'), '\1ices');

        yield new Transformation(new Pattern('()ex$'), '\1ices');

        // http://nl.wikipedia.org/wiki/Meervoud_(Nederlands)#Stapelmeervoud
        yield new Transformation(new Pattern('^(ei|gemoed|goed|hoen|kind|lied|rad|rund)$'), '\1eren');

        // http://nl.wikipedia.org/wiki/Nederlandse_grammatica
        yield new Transformation(new Pattern('()ij$'), '\1ijen');

        yield new Transformation(new Pattern('()orie$'), '\1orieen');   // ën klemtoon

        yield new Transformation(new Pattern('()io$'), '\1io\'s');

        yield new Transformation(new Pattern('()(a|e|i|o|u|ij)$'), '\1\2s');

        yield new Transformation(new Pattern('()(((c|h|p|q|x|y|z)|(p|t|k|b|d)|(f|s|ch|sj|v|z|g|j)|(m|n|ng)|(l|r)|(j|w)|(ts|zz|tsj|g))e((c|h|p|q|x|y|z)|(p|t|k|b|d)|(f|s|ch|sj|v|z|g|j)|(m|n|ng)|(l|r)|(j|w)|(ts|zz|tsj|g)))$'), '\1\2s');

        yield new Transformation(new Pattern('()(((c|h|p|q|x|y|z)|(p|t|k|b|d)|(f|s|ch|sj|v|z|g|j)|(m|n|ng)|(l|r)|(j|w)|(ts|zz|tsj|g))(u|i|e|a|o)s)$'), '\1\2sen');

        yield new Transformation(new Pattern('()(((c|h|p|q|x|y|z)|(p|t|k|b|d)|(f|s|ch|sj|v|z|g|j)|(m|n|ng)|(l|r)|(j|w)|(ts|zz|tsj|g))s)$'), '\1\2en');

        yield new Transformation(new Pattern('()s$'), '\1zen');

        yield new Transformation(new Pattern('()((c|h|p|q|x|y|z)|(p|t|k|b|d)|(f|s|ch|sj|v|z|g|j)|(m|n|ng)|(l|r)|(j|w)|(ts|zz|tsj|g))$'), '\1\2en');
    }

    /**
     * @return iterable<Substitution>
     */
    public static function getIrregular(): iterable
    {
        // http://nl.wikipedia.org/wiki/Klemtoon
        yield new Substitution(new Word('olie'), new Word('oliën'));

        yield new Substitution(new Word('industrie'), new Word('industrieën'));

        yield new Substitution(new Word('idee'), new Word('ideeën'));

        // @todo: above 3 examples maybe could be compacted into a rule

        // http://nl.wikipedia.org/wiki/Meervoud_(Nederlands)#Klinkerverandering
        yield new Substitution(new Word('lid'), new Word('leden'));

        yield new Substitution(new Word('smid'), new Word('smeden'));

        // @todo: above 2 examples might be compacted into a rule
        // @todo: also f.i. ooglid oogleden

        yield new Substitution(new Word('schip'), new Word('schepen'));

        yield new Substitution(new Word('stad'), new Word('steden'));

        // http://nl.wikipedia.org/wiki/Meervoud_(Nederlands)#Stapelmeervoud
        yield new Substitution(new Word('gelid'), new Word('gelederen'));

        yield new Substitution(new Word('kalf'), new Word('kalveren'));

        yield new Substitution(new Word('lam'), new Word('lammeren'));

        // http://nl.wikipedia.org/wiki/Meervoud_(Nederlands)#Onregelmatige_meervoudsvorming
        yield new Substitution(new Word('koe'), new Word('koeien'));

        yield new Substitution(new Word('vlo'), new Word('vlooien'));

        yield new Substitution(new Word('leerrede'), new Word('leerredenen'));

        yield new Substitution(new Word('lende'), new Word('lendenen'));

        yield new Substitution(new Word('epos'), new Word('epen'));

        yield new Substitution(new Word('genius'), new Word('geniën'));

        yield new Substitution(new Word('aanbod'), new Word('aanbiedingen'));

        yield new Substitution(new Word('beleg'), new Word('belegeringen'));

        yield new Substitution(new Word('dank'), new Word('dankbetuigingen'));

        yield new Substitution(new Word('gedrag'), new Word('gedragingen'));

        yield new Substitution(new Word('genot'), new Word('genietingen'));

        yield new Substitution(new Word('lof'), new Word('lofbetuigingen'));

        // http://nl.wikipedia.org/wiki/Meervoud_(Nederlands)#Latijnse_meervoudsvormen
        yield new Substitution(new Word('quaestrix'), new Word('quaestrices'));

        yield new Substitution(new Word('matrix'), new Word('matrices'));
    }
}
