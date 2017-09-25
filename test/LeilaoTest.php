<?php

require_once 'CriadorDeLeilao.php';
require_once '../Avaliador.php';

class LeilaoTest extends PHPUnit\Framework\TestCase {

    private $leiloeiro;
    private $usuario1;
    private $usuario2;
    private $usuario3;

    public function setUp() {
        $this->leiloeiro = new Avaliador();
        $this->usuario1 = new Usuario("usuario1");
        $this->usuario2 = new Usuario("usuario2");
        $this->usuario3 = new Usuario("usuario3");
    }

    public function tearDown() {
//
    }

    public static function setUpBeforeClass() {
        var_dump("before class");
    }

    public static function tearDownAfterClass() {
        var_dump("after class");
    }

    public function testnaoDeveAceitarDoisLancesSeguidosDoMesmoUsuario() {

        $criador = new CriadorDeLeilao();

        $leilao = $criador->para("Produto")
                ->lance($this->usuario1, 12)
                ->lance($this->usuario1, 11)
                ->constroi();


        $this->assertEquals(1, count($leilao->getLances()));
    }

    public function testnaoDeveAceitarMaisDoQue5LancesDeUmMesmoUsuario() {

        $criador = new CriadorDeLeilao();

        $leilao = $criador->para("Produto")
                ->lance($this->usuario1, 1)
                ->lance($this->usuario2, 2)
                ->lance($this->usuario1, 3)
                ->lance($this->usuario2, 4)
                ->lance($this->usuario1, 5)
                ->lance($this->usuario2, 6)
                ->lance($this->usuario1, 7)
                ->lance($this->usuario2, 8)
                ->lance($this->usuario1, 9)
                ->lance($this->usuario2, 10)
                ->constroi();

        $this->assertEquals(10, count($leilao->getLances()));
    }

    public function testDobraLance() {
        $criador = new CriadorDeLeilao();

        $leilao = $criador->para("Produto")
                ->lance($this->usuario1, 1)
                ->lance($this->usuario2, 2)
                ->lance($this->usuario1, 3)
                ->lance($this->usuario2, 4)
                ->lance($this->usuario1, 5)
                ->lance($this->usuario2, 6)
                ->lance($this->usuario1, 7)
                ->lance($this->usuario2, 8)
                ->constroi();


        $leilao->dobraLance($this->usuario1);


        $this->assertEquals(9, count($leilao->getLances()));
        $this->assertEquals(14, $leilao->getLances()[8]->getValor());
    }

    public function testDobraLanceSemNenhumLance() {
        $criador = new CriadorDeLeilao();

        $leilao = $criador->para("Produto")
                ->constroi();


        $leilao->dobraLance($this->usuario1);

        $this->assertEquals(0, count($leilao->getLances()));
    }

}

/*
$leilao = new Leilao("Produto");


        $usuario1 = new Usuario("usuario1");
        $usuario2 = new Usuario("usuario2");
        $usuario3 = new Usuario("usuario3");

        $leilao->propoe(new Lance($usuario1, 12));
        $leilao->propoe(new Lance($usuario2, 11));
        $leilao->propoe(new Lance($usuario3, 10));

        $leiloeiro = new Avaliador();

        $leiloeiro->avalia($leilao);
     
        echo $leiloeiro->getvalorMedioLances($leilao);
 * 
 */