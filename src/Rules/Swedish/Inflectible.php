<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules\Swedish;

use Doctrine\Inflector\Rules\Pattern;
use Doctrine\Inflector\Rules\Substitution;
use Doctrine\Inflector\Rules\Transformation;
use Doctrine\Inflector\Rules\Word;

class Inflectible
{
    /** @return Transformation[] */
    public static function getSingular(): iterable
    {
        yield new Transformation(new Pattern('/eringar$/i'), 'ering');
        yield new Transformation(new Pattern('/ioner$/i'), 'ion');
        yield new Transformation(new Pattern('/eer$/i'), 'eum');
        yield new Transformation(new Pattern('/örer$/i'), 'ör');
        yield new Transformation(new Pattern('/ärer$/i'), 'är');
        yield new Transformation(new Pattern('/erier$/i'), 'erie');
        yield new Transformation(new Pattern('/dier$/i'), 'die');
        yield new Transformation(new Pattern('/orer$/i'), 'or');
        yield new Transformation(new Pattern('/ier$/i'), 'i');
        yield new Transformation(new Pattern('/jer$/i'), 'j');
        yield new Transformation(new Pattern('/nar$/i'), 'en');
        yield new Transformation(new Pattern('/kar$/i'), 'ke');
        yield new Transformation(new Pattern('/kor$/i'), 'ka');
        yield new Transformation(new Pattern('/mar$/i'), 'me');
        yield new Transformation(new Pattern('/nar$/i'), 'n');
        yield new Transformation(new Pattern('/nor$/i'), 'na');
        yield new Transformation(new Pattern('/rar$/i'), 'er');
        yield new Transformation(new Pattern('/sor$/i'), 'sa');
        yield new Transformation(new Pattern('/tor$/i'), 'ta');
        yield new Transformation(new Pattern('/der$/i'), 'd');
        yield new Transformation(new Pattern('/ter$/i'), 't');
        yield new Transformation(new Pattern('/or$/i'), 'a');
        yield new Transformation(new Pattern('/ar$/i'), '');
        yield new Transformation(new Pattern('/er$/i'), '');
    }

    /** @return Transformation[] */
    public static function getPlural(): iterable
    {
        yield new Transformation(new Pattern('/ering$/i'), 'eringar');
        yield new Transformation(new Pattern('/ion$/i'), 'ioner');
        yield new Transformation(new Pattern('/ör$/i'), 'örer');
        yield new Transformation(new Pattern('/är$/i'), 'ärer');
        yield new Transformation(new Pattern('/or$/i'), 'orer');
        yield new Transformation(new Pattern('/i$/i'), 'ier');
        yield new Transformation(new Pattern('/j$/i'), 'jer');
        yield new Transformation(new Pattern('/um$/i'), 'er');
        yield new Transformation(new Pattern('/en$/i'), 'nar');
        yield new Transformation(new Pattern('/er$/i'), 'rar');
        yield new Transformation(new Pattern('/ie$/i'), 'ier');
        yield new Transformation(new Pattern('/ka$/i'), 'kor');
        yield new Transformation(new Pattern('/na$/i'), 'nor');
        yield new Transformation(new Pattern('/sa$/i'), 'sor');
        yield new Transformation(new Pattern('/ta$/i'), 'tor');
        yield new Transformation(new Pattern('/a$/i'), 'or');
        yield new Transformation(new Pattern('/t$/i'), 'ter');
        yield new Transformation(new Pattern('/d$/i'), 'der');
        yield new Transformation(new Pattern('/e$/i'), 'ar');
        yield new Transformation(new Pattern('/([bfghjklmnpqrstvwxyz])$/i'), '\1ar');
        yield new Transformation(new Pattern('/$/'), 'er');
    }

    /** @return Substitution[] */
    public static function getIrregular(): iterable
    {
        yield new Substitution(new Word('and'), new Word('änder'));
        yield new Substitution(new Word('bok'), new Word('böcker'));
        yield new Substitution(new Word('bonde'), new Word('bönder'));
        yield new Substitution(new Word('brand'), new Word('bränder'));
        yield new Substitution(new Word('bror'), new Word('bröder'));
        yield new Substitution(new Word('cykel'), new Word('cyklar'));
        yield new Substitution(new Word('dotter'), new Word('döttrar'));
        yield new Substitution(new Word('dräkt'), new Word('dräkter'));
        yield new Substitution(new Word('fader'), new Word('fäder'));
        yield new Substitution(new Word('far'), new Word('fäder'));
        yield new Substitution(new Word('fjäder'), new Word('fjädrar'));
        yield new Substitution(new Word('fot'), new Word('fötter'));
        yield new Substitution(new Word('get'), new Word('getter'));
        yield new Substitution(new Word('gås'), new Word('gäss'));
        yield new Substitution(new Word('hand'), new Word('händer'));
        yield new Substitution(new Word('huvud'), new Word('huvuden'));
        yield new Substitution(new Word('ko'), new Word('kor'));
        yield new Substitution(new Word('land'), new Word('länder'));
        yield new Substitution(new Word('ledamot'), new Word('ledamöter'));
        yield new Substitution(new Word('lem'), new Word('lemmar'));
        yield new Substitution(new Word('lus'), new Word('löss'));
        yield new Substitution(new Word('man'), new Word('män'));
        yield new Substitution(new Word('moder'), new Word('mödrar'));
        yield new Substitution(new Word('mor'), new Word('mödrar'));
        yield new Substitution(new Word('mus'), new Word('möss'));
        yield new Substitution(new Word('månad'), new Word('månader'));
        yield new Substitution(new Word('natt'), new Word('nätter'));
        yield new Substitution(new Word('rand'), new Word('ränder'));
        yield new Substitution(new Word('rot'), new Word('rötter'));
        yield new Substitution(new Word('skrift'), new Word('skrifter'));
        yield new Substitution(new Word('son'), new Word('söner'));
        yield new Substitution(new Word('stad'), new Word('städer'));
        yield new Substitution(new Word('strand'), new Word('stränder'));
        yield new Substitution(new Word('syster'), new Word('systrar'));
        yield new Substitution(new Word('tand'), new Word('tänder'));
        yield new Substitution(new Word('trad'), new Word('trådar'));
        yield new Substitution(new Word('trakt'), new Word('trakter'));
        yield new Substitution(new Word('tå'), new Word('tår'));
        yield new Substitution(new Word('vinter'), new Word('vintrar'));
        yield new Substitution(new Word('vy'), new Word('vyer'));
        yield new Substitution(new Word('vän'), new Word('vänner'));
        yield new Substitution(new Word('äpple'), new Word('äpplen'));
        yield new Substitution(new Word('ö'), new Word('öar'));
        yield new Substitution(new Word('öde'), new Word('öden'));
        yield new Substitution(new Word('öga'), new Word('ögon'));
        yield new Substitution(new Word('ört'), new Word('örter'));
        yield new Substitution(new Word('öra'), new Word('öron'));
        yield new Substitution(new Word('öre'), new Word('ören'));
    }
}
