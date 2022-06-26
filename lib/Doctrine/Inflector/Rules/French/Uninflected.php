<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules\French;

use Doctrine\Inflector\Rules\Pattern;

final class Uninflected
{
    /**
     * @return Pattern[]
     */
    public static function getSingular(): iterable
    {
        yield from self::getDefault();
    }

    /**
     * @return Pattern[]
     */
    public static function getPlural(): iterable
    {
        yield from self::getDefault();
    }

    /**
     * @return Pattern[]
     */
    private static function getDefault(): iterable
    {
        yield new Pattern('accès');
        yield new Pattern('abus');
        yield new Pattern('albatros');
        yield new Pattern('anchois');
        yield new Pattern('anglais');
        yield new Pattern('autobus');
        yield new Pattern('bois');
        yield new Pattern('brebis');
        yield new Pattern('carquois');
        yield new Pattern('cas');
        yield new Pattern('chas');
        yield new Pattern('colis');
        yield new Pattern('concours');
        yield new Pattern('corps');
        yield new Pattern('cours');
        yield new Pattern('cyprès');
        yield new Pattern('décès');
        yield new Pattern('devis');
        yield new Pattern('discours');
        yield new Pattern('dos');
        yield new Pattern('embarras');
        yield new Pattern('engrais');
        yield new Pattern('entrelacs');
        yield new Pattern('excès');
        yield new Pattern('fils');
        yield new Pattern('fois');
        yield new Pattern('gâchis');
        yield new Pattern('gars');
        yield new Pattern('glas');
        yield new Pattern('héros');
        yield new Pattern('intrus');
        yield new Pattern('jars');
        yield new Pattern('jus');
        yield new Pattern('kermès');
        yield new Pattern('lacis');
        yield new Pattern('legs');
        yield new Pattern('lilas');
        yield new Pattern('marais');
        yield new Pattern('mars');
        yield new Pattern('matelas');
        yield new Pattern('mépris');
        yield new Pattern('mets');
        yield new Pattern('mois');
        yield new Pattern('mors');
        yield new Pattern('obus');
        yield new Pattern('os');
        yield new Pattern('palais');
        yield new Pattern('paradis');
        yield new Pattern('parcours');
        yield new Pattern('pardessus');
        yield new Pattern('pays');
        yield new Pattern('plusieurs');
        yield new Pattern('poids');
        yield new Pattern('pois');
        yield new Pattern('pouls');
        yield new Pattern('printemps');
        yield new Pattern('processus');
        yield new Pattern('progrès');
        yield new Pattern('puits');
        yield new Pattern('pus');
        yield new Pattern('rabais');
        yield new Pattern('radis');
        yield new Pattern('recors');
        yield new Pattern('recours');
        yield new Pattern('refus');
        yield new Pattern('relais');
        yield new Pattern('remords');
        yield new Pattern('remous');
        yield new Pattern('rictus');
        yield new Pattern('rhinocéros');
        yield new Pattern('repas');
        yield new Pattern('rubis');
        yield new Pattern('sans');
        yield new Pattern('sas');
        yield new Pattern('secours');
        yield new Pattern('sens');
        yield new Pattern('souris');
        yield new Pattern('succès');
        yield new Pattern('talus');
        yield new Pattern('tapis');
        yield new Pattern('tas');
        yield new Pattern('taudis');
        yield new Pattern('temps');
        yield new Pattern('tiers');
        yield new Pattern('univers');
        yield new Pattern('velours');
        yield new Pattern('verglas');
        yield new Pattern('vernis');
        yield new Pattern('virus');
    }
}
