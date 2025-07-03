<?php

declare(strict_types=1);

namespace Doctrine\Tests\Inflector;

use Doctrine\Inflector\MultiWordInflector;
use Doctrine\Inflector\WordInflector;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class MultiWordInflectorTest extends TestCase
{
    /** @var WordInflector|MockObject */
    private $wordInflector;

    /** @var MultiWordInflector */
    private $multiWordInflector;

    protected function setUp(): void
    {
        $this->wordInflector      = $this->createMock(WordInflector::class);
        $this->multiWordInflector = new MultiWordInflector($this->wordInflector);
    }

    public function testInflectSingleWordDelegatesToWordInflector(): void
    {
        $this->wordInflector->expects(self::once())
            ->method('inflect')
            ->with('casa')
            ->willReturn('case');

        $result = $this->multiWordInflector->inflect('casa');
        self::assertSame('case', $result);
    }

    public function testInflectMultiWordItalianPhrases(): void
    {
        $this->wordInflector->expects(self::any())
            ->method('inflect')
            ->willReturnMap([
                ['carta', 'carte'],
                ['credito', 'crediti'],
                ['libro', 'libri'],
                ['giallo', 'gialli'],
                ['chiave', 'chiavi'],
                ['inglese', 'inglesi'],
                ['stazione', 'stazioni'],
                ['ferroviaria', 'ferroviarie'],
                ['macchina', 'macchine'],
                ['fotografica', 'fotografiche'],
                ['di', 'di'],
                ['geografica', 'geografiche'],
            ]);

        $testCases = [
            'carta di credito' => 'carte di crediti',
            'libro giallo' => 'libri gialli',
            'chiave inglese' => 'chiavi inglesi',
            'stazione ferroviaria' => 'stazioni ferroviarie',
            'macchina fotografica' => 'macchine fotografiche',
            'carta geografica' => 'carte geografiche',
        ];

        foreach ($testCases as $singular => $expectedPlural) {
            $result = $this->multiWordInflector->inflect($singular);
            self::assertSame($expectedPlural, $result);
        }
    }

    public function testInflectWithHyphenatedItalianWords(): void
    {
        $this->wordInflector->expects(self::any())
            ->method('inflect')
            ->willReturnMap([
                ['primo', 'primi'],
                ['piano', 'piani'],
                ['capo', 'capi'],
                ['stazione', 'stazioni'],
                ['cassaforte', 'casseforti'],
                ['forte', 'forti'],
            ]);

        $testCases = [
            'primo-piano' => 'primi-piani',
            'cassaforte-forte' => 'casseforti-forti',
        ];

        foreach ($testCases as $singular => $expectedPlural) {
            $result = $this->multiWordInflector->inflect($singular);
            self::assertSame($expectedPlural, $result);
        }
    }

    public function testInflectWithPrepositionsAndArticles(): void
    {
        $this->wordInflector->expects(self::any())
            ->method('inflect')
            ->willReturnMap([
                ['sistema', 'sistemi'],
                ['operativo', 'operativi'],
                ['carta', 'carte'],
                ['prepagata', 'prepagate'],
                ['aziendale', 'aziendali'],
                ['virtuale', 'virtuali'],
                ['ricaricabile', 'ricaricabili'],
            ]);

        $testCases = [
            'sistema operativo' => 'sistemi operativi',
            'carta prepagata' => 'carte prepagate',
            'carta aziendale' => 'carte aziendali',
            'carta virtuale' => 'carte virtuali',
            'carta ricaricabile' => 'carte ricaricabili',
        ];

        foreach ($testCases as $singular => $expectedPlural) {
            $result = $this->multiWordInflector->inflect($singular);
            self::assertSame($expectedPlural, $result);
        }
    }

    public function testInflectWithSpecialCharacters(): void
    {
        $this->wordInflector->expects(self::any())
            ->method('inflect')
            ->willReturnMap([
                ['caffè', 'caffè'],
                ['ristretto', 'ristretti'],
                ['tè', 'tè'],
                ['caldo', 'caldi'],
                ['menù', 'menù'],
                ['del', 'del'],
                ['giorno', 'giorni'],
            ]);

        $testCases = [
            'caffè ristretto' => 'caffè ristretti',
            'tè caldo' => 'tè caldi',
            'menù del giorno' => 'menù del giorni',
        ];

        foreach ($testCases as $singular => $expectedPlural) {
            $result = $this->multiWordInflector->inflect($singular);
            self::assertSame($expectedPlural, $result);
        }
    }
}
