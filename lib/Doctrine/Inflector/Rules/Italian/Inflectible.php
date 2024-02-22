<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules\Italian;

use Doctrine\Inflector\Rules\Pattern;
use Doctrine\Inflector\Rules\Substitution;
use Doctrine\Inflector\Rules\Transformation;
use Doctrine\Inflector\Rules\Word;

class Inflectible
{
    /**
     * @return Transformation[]
     */
    public static function getSingular() : iterable
    {
        yield new Transformation(new Pattern('e$'), 'a');
        yield new Transformation(new Pattern('i$'), 'o');
    }

    /**
     * @return Transformation[]
     */
    public static function getPlural() : iterable
    {
        yield new Transformation(new Pattern('i?a$'), 'e');
        yield new Transformation(new Pattern('i?e$'), 'i');
        yield new Transformation(new Pattern('i?o$'), 'i');
    }

    /**
     * @return Substitution[]
     */
    public static function getIrregular() : iterable
    {
        yield new Substitution(new Word('ala'), new Word('ali'));
        yield new Substitution(new Word('amico'), new Word('amici'));
        yield new Substitution(new Word('ampio'), new Word('ampli'));
        yield new Substitution(new Word('arma'), new Word('armi'));
        yield new Substitution(new Word('asparago'), new Word('asparagi'));
        yield new Substitution(new Word('belga'), new Word('belgi'));
        yield new Substitution(new Word('braccio'), new Word('braccia'));
        yield new Substitution(new Word('budello'), new Word('budella'));
        yield new Substitution(new Word('bue'), new Word('buoi'));
        yield new Substitution(new Word('calcagno'), new Word('calcagna'));
        yield new Substitution(new Word('carcere'), new Word('carceri'));
        yield new Substitution(new Word('centinaio'), new Word('centinaia'));
        yield new Substitution(new Word('cerchio'), new Word('cerchia'));
        yield new Substitution(new Word('cervello'), new Word('cervella'));
        yield new Substitution(new Word('chirurgo'), new Word('chirurgi'));
        yield new Substitution(new Word('ciglio'), new Word('ciglia'));
        yield new Substitution(new Word('corno'), new Word('corna'));
        yield new Substitution(new Word('cuoio'), new Word('cuoia'));
        yield new Substitution(new Word('dio'), new Word('dei'));
        yield new Substitution(new Word('dito'), new Word('dita'));
        yield new Substitution(new Word('eco'), new Word('echi'));
        yield new Substitution(new Word('equivoco'), new Word('equivoci'));
        yield new Substitution(new Word('farmaco'), new Word('farmaci'));
        yield new Substitution(new Word('ferramento'), new Word('ferramenta'));
        yield new Substitution(new Word('filamento'), new Word('filamenta'));
        yield new Substitution(new Word('filo'), new Word('fila'));
        yield new Substitution(new Word('fondamento'), new Word('fondamenta'));
        yield new Substitution(new Word('gesto'), new Word('gesta'));
        yield new Substitution(new Word('ginocchio'), new Word('ginocchia'));
        yield new Substitution(new Word('greco'), new Word('greci'));
        yield new Substitution(new Word('gregge'), new Word('greggi'));
        yield new Substitution(new Word('grido'), new Word('grida'));
        yield new Substitution(new Word('interiore'), new Word('interiora'));
        yield new Substitution(new Word('labbro'), new Word('labbra'));
        yield new Substitution(new Word('lenzuolo'), new Word('lenzuola'));
        yield new Substitution(new Word('magico'), new Word('magici'));
        yield new Substitution(new Word('maniaco'), new Word('maniaci'));
        yield new Substitution(new Word('manico'), new Word('manici'));
        yield new Substitution(new Word('mano'), new Word('mani'));
        yield new Substitution(new Word('medico'), new Word('medici'));
        yield new Substitution(new Word('membro'), new Word('membra'));
        yield new Substitution(new Word('migliaio'), new Word('migliaia'));
        yield new Substitution(new Word('miglio'), new Word('miglia'));
        yield new Substitution(new Word('mille'), new Word('mila'));
        yield new Substitution(new Word('mio'), new Word('miei'));
        yield new Substitution(new Word('mosaico'), new Word('mosaici'));
        yield new Substitution(new Word('muro'), new Word('mura'));
        yield new Substitution(new Word('nemico'), new Word('nemici'));
        yield new Substitution(new Word('orecchio'), new Word('orecchie'));
        yield new Substitution(new Word('osso'), new Word('ossa'));
        yield new Substitution(new Word('paio'), new Word('paia'));
        yield new Substitution(new Word('porco'), new Word('porci'));
        yield new Substitution(new Word('rene'), new Word('reni'));
        yield new Substitution(new Word('riso'), new Word('risa'));
        yield new Substitution(new Word('rosa'), new Word('rosa'));
        yield new Substitution(new Word('serramento'), new Word('serramenta'));
        yield new Substitution(new Word('staio'), new Word('staia'));
        yield new Substitution(new Word('strido'), new Word('strida'));
        yield new Substitution(new Word('strillo'), new Word('strilla'));
        yield new Substitution(new Word('suo'), new Word('suoi'));
        yield new Substitution(new Word('tempio'), new Word('templi'));
        yield new Substitution(new Word('tuo'), new Word('tuoi'));
        yield new Substitution(new Word('uomo'), new Word('uomini'));
        yield new Substitution(new Word('uovo'), new Word('uova'));
        yield new Substitution(new Word('urlo'), new Word('urla'));
        yield new Substitution(new Word('vestigio'), new Word('vestigia'));
        yield new Substitution(new Word('viola'), new Word('viola'));
    }
}
