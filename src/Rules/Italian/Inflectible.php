<?php

declare(strict_types=1);

namespace Doctrine\Inflector\Rules\Italian;

use Doctrine\Inflector\Rules\Pattern;
use Doctrine\Inflector\Rules\Substitution;
use Doctrine\Inflector\Rules\Transformation;
use Doctrine\Inflector\Rules\Word;

/** @final */
class Inflectible
{
    /** @return iterable<Transformation> */
    public static function getSingular(): iterable
    {
        // Advanced ending rules
        yield new Transformation(new Pattern('sce'), 'scia');  // fasce → fascia
        yield new Transformation(new Pattern('sci$'), 'scio');  // fasci → fascio
        yield new Transformation(new Pattern('chi$'), 'co');  // bachi → baco
        yield new Transformation(new Pattern('che$'), 'ca');  // fotografiche → fotografica
        yield new Transformation(new Pattern('ghi$'), 'go');  // laghi → lago
        yield new Transformation(new Pattern('ghe$'), 'ga');  // targhe → targa
        yield new Transformation(new Pattern('esi$'), 'ese');  // paesi → paese
        yield new Transformation(new Pattern('ali$'), 'ale');  // ministeriali → ministeriale
        yield new Transformation(new Pattern('ari$'), 'ario');  // questionari → questionario
        yield new Transformation(new Pattern('eri$'), 'ero');  // numeri → numero
        yield new Transformation(new Pattern('li$'), 'lio');  // cimeli → cimelio

        // Standard ending rules
        yield new Transformation(new Pattern('e$'), 'a'); // case → casa
        yield new Transformation(new Pattern('i$'), 'o'); // libri → libro
        yield new Transformation(new Pattern('i$'), 'e'); // studenti → studente
    }

    /** @return iterable<Transformation> */
    public static function getPlural(): iterable
    {
        // Advanced ending rules
        yield new Transformation(new Pattern('scia$'), 'sce');  // fascia → fasce
        yield new Transformation(new Pattern('scio$'), 'sci');  // fascio → fasci
        yield new Transformation(new Pattern('co$'), 'chi');  // baco → bachi
        yield new Transformation(new Pattern('ca$'), 'che');  // fotografica → fotografiche
        yield new Transformation(new Pattern('go$'), 'ghi');  // lago → laghi
        yield new Transformation(new Pattern('ga$'), 'ghe');  // targa → targhe
        yield new Transformation(new Pattern('io$'), 'i');  // cimelio → cimeli

        // Standard ending rules
        yield new Transformation(new Pattern('a$'), 'e');  // casa → case
        yield new Transformation(new Pattern('o$'), 'i');  // libro → libri
        yield new Transformation(new Pattern('e$'), 'i');  // studente → studenti
    }

    /** @return iterable<Substitution> */
    public static function getIrregular(): iterable
    {
        // Irregular substitutions (singular => plural)
        $irregulars = [
            'ala' => 'ali',
            'albergo' => 'alberghi',
            'amica' => 'amiche',
            'amico' => 'amici',
            'ampio' => 'ampi',
            'arancia' => 'arance',
            'arma' => 'armi',
            'asparago' => 'asparagi',
            'banca' => 'banche',
            'belga' => 'belgi',
            'braccio' => 'braccia',
            'budello' => 'budella',
            'bue' => 'buoi',
            'caccia' => 'cacce',
            'calcagno' => 'calcagna',
            'camicia' => 'camicie',
            'cane' => 'cani',
            'capitale' => 'capitali',
            'carcere' => 'carceri',
            'casa' => 'case',
            'cassaforte' => 'casseforti',
            'cavaliere' => 'cavalieri',
            'centinaio' => 'centinaia',
            'cerchio' => 'cerchia',
            'cervello' => 'cervella',
            'chiave' => 'chiavi',
            'chirurgo' => 'chirurgi',
            'ciglio' => 'ciglia',
            'città' => 'città',
            'corno' => 'corna',
            'corpo' => 'corpi',
            'crisi' => 'crisi',
            'dente' => 'denti',
            'dio' => 'dei',
            'dito' => 'dita',
            'dottore' => 'dottori',
            'fiore' => 'fiori',
            'forte' => 'forti',
            'fratello' => 'fratelli',
            'fuoco' => 'fuochi',
            'gamba' => 'gambe',
            'giallo' => 'gialli',
            'ginocchio' => 'ginocchia',
            'gioco' => 'giochi',
            'giornale' => 'giornali',
            'giraffa' => 'giraffe',
            'labbro' => 'labbra',
            'lenzuolo' => 'lenzuola',
            'libro' => 'libri',
            'madre' => 'madri',
            'maestro' => 'maestri',
            'magico' => 'magici',
            'mago' => 'maghi',
            'maniaco' => 'maniaci',
            'manico' => 'manici',
            'mano' => 'mani',
            'medico' => 'medici',
            'membro' => 'membri',
            'metropoli' => 'metropoli',
            'migliaio' => 'migliaia',
            'miglio' => 'miglia',
            'mille' => 'mila',
            'mio' => 'miei',
            'moglie' => 'mogli',
            'mosaico' => 'mosaici',
            'muro' => 'muri',
            'nemico' => 'nemici',
            'nome' => 'nomi',
            'occhio' => 'occhi',
            'orecchio' => 'orecchi',
            'osso' => 'ossa',
            'paio' => 'paia',
            'pane' => 'pani',
            'papa' => 'papi',
            'pasta' => 'paste',
            'penna' => 'penne',
            'pesce' => 'pesci',
            'piede' => 'piedi',
            'pittore' => 'pittori',
            'poeta' => 'poeti',
            'porco' => 'porci',
            'porto' => 'porti',
            'problema' => 'problemi',
            'ragazzo' => 'ragazzi',
            're' => 're',
            'rene' => 'reni',
            'riso' => 'risa',
            'rosa' => 'rosa',
            'sale' => 'sali',
            'sarto' => 'sarti',
            'scuola' => 'scuole',
            'serie' => 'serie',
            'serramento' => 'serramenta',
            'sistema' => 'sistemi',
            'sorella' => 'sorelle',
            'specie' => 'specie',
            'staio' => 'staia',
            'stazione' => 'stazioni',
            'strido' => 'strida',
            'strillo' => 'strilla',
            'studio' => 'studi',
            'suo' => 'suoi',
            'superficie' => 'superfici',
            'tavolo' => 'tavoli',
            'tema' => 'temi',
            'tempio' => 'templi',
            'treno' => 'treni',
            'tuo' => 'tuoi',
            'uomo' => 'uomini',
            'uovo' => 'uova',
            'urlo' => 'urla',
            'valigia' => 'valigie',
            'vestigio' => 'vestigia',
            'vino' => 'vini',
            'viola' => 'viola',
            'zio' => 'zii',
        ];

        foreach ($irregulars as $singular => $plural) {
            yield new Substitution(new Word($singular), new Word($plural));
        }
    }
}
