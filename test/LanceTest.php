<?php

require_once 'CriadorDeLeilao.php';
require_once '../Avaliador.php';

class LanceTest extends PHPUnit\Framework\TestCase {

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
//        var_dump("before class");
    }

    public static function tearDownAfterClass() {
        //      var_dump("after class");
    }

    /**
     * @expectedException     InvalidArgumentException
     */
    public function testLanceIgualaZero() {
        $criador = new CriadorDeLeilao();

        $leilao = $criador->para("Produto")
                ->lance($this->usuario1, 0)
                ->constroi();


        $this->leiloeiro->avalia($leilao);
    }

    /**
     * @expectedException     InvalidArgumentException
     */
    public function testLanceNegativo() {
        $criador = new CriadorDeLeilao();

        $leilao = $criador->para("Produto")
                ->lance($this->usuario1, -50)
                ->constroi();


        $this->leiloeiro->avalia($leilao);
    }

}
