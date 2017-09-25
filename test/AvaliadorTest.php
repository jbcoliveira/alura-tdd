<?php

require_once 'CriadorDeLeilao.php';
require_once '../Avaliador.php';

class AvaliadorTest extends PHPUnit\Framework\TestCase {

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

    public function testDeveEntenderLancesEmOrdemCrescente() {

        $criador = new CriadorDeLeilao();

        $leilao = $criador->para("Produto")
                ->lance($this->usuario1, 12)
                ->lance($this->usuario2, 11)
                ->lance($this->usuario3, 10)
                ->constroi();


        $this->leiloeiro->avalia($leilao);

// comparando a saida com o esperado
        $maiorEsperado = 12;
        $menorEsperado = 10;


        $this->assertEquals($maiorEsperado, $this->leiloeiro->getMaiorLance(), 0.0001);
        $this->assertEquals($menorEsperado, $this->leiloeiro->getMenorLance(), 0.0001);

        $this->assertEquals(11, $this->leiloeiro->getvalorMedioLances($leilao), 0.0001);
    }

    public function testDeveEntenderUmLance() {
        $criador = new CriadorDeLeilao();

        $leilao = $criador->para("Produto")
                ->lance($this->usuario1, 12)
                ->constroi();



        $this->leiloeiro->avalia($leilao);



// comparando a saida com o esperado
        $maiorEsperado = 12;
        $menorEsperado = 12;


        $this->assertEquals($maiorEsperado, $this->leiloeiro->getMaiorLance(), 0.0001);
        $this->assertEquals($menorEsperado, $this->leiloeiro->getMenorLance(), 0.0001);
    }

    public function testDeveEntenderLancesEmOrdemAleatoria() {
        $criador = new CriadorDeLeilao();

        $leilao = $criador->para("Produto")
                ->lance($this->usuario1, 1)
                ->lance($this->usuario2, 5)
                ->lance($this->usuario1, 10)
                ->lance($this->usuario2, 6)
                ->lance($this->usuario1, 2)
                ->lance($this->usuario2, 9)
                ->constroi();


        $this->leiloeiro->avalia($leilao);

// comparando a saida com o esperado
        $maiorEsperado = 10;
        $menorEsperado = 1;


        $this->assertEquals(10, $this->leiloeiro->getMaiorLance(), 0.0001);
        $this->assertEquals(1, $this->leiloeiro->getMenorLance(), 0.0001);
    }

    public function testDeveEntenderLancesEmOrdemDecrecente() {
        $criador = new CriadorDeLeilao();

        $leilao = $criador->para("Produto")
                ->lance($this->usuario1, 1)
                ->lance($this->usuario2, 5)
                ->lance($this->usuario1, 2)
                ->lance($this->usuario2, 4)
                ->lance($this->usuario1, 9)
                ->lance($this->usuario2, 15)
                ->constroi();

        $this->leiloeiro->avalia($leilao);



// comparando a saida com o esperado
        $menorEsperado = 1;
        $maiorEsperado = 15;


        $this->assertEquals($menorEsperado, $this->leiloeiro->getMenorLance(), 0.0001);
        $this->assertEquals($maiorEsperado, $this->leiloeiro->getMaiorLance(), 0.0001);
    }

    public function testPegaOsTresMaiores() {
        $criador = new CriadorDeLeilao();

        $leilao = $criador->para("Produto")
                ->lance($this->usuario1, 1)
                ->lance($this->usuario2, 5)
                ->lance($this->usuario1, 2)
                ->lance($this->usuario2, 4)
                ->lance($this->usuario1, 9)
                ->lance($this->usuario2, 15)
                ->constroi();

        $this->leiloeiro->avalia($leilao);


        $this->assertEquals(15, $this->leiloeiro->getTresMaiores()[0]->getValor());
        $this->assertEquals(9, $this->leiloeiro->getTresMaiores()[1]->getValor());
        $this->assertEquals(5, $this->leiloeiro->getTresMaiores()[2]->getValor());
    }

    public function testApenasDoisLance() {
        $criador = new CriadorDeLeilao();

        $leilao = $criador->para("Produto")
                ->lance($this->usuario1, 1)
                ->lance($this->usuario1, 5) // vai ignorar, pois trata-se de segundo lance seguido
                ->constroi();


        $this->leiloeiro->avalia($leilao);


        $this->assertEquals(1, count($leilao->getLances()));
    }

    
    /**
     * @expectedException     Exception
     */
    public function testNenhumLance() {
        $criador = new CriadorDeLeilao();

        $leilao = $criador->para("Produto")
                ->constroi();

        $this->leiloeiro->avalia($leilao);

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



  $this->leiloeiro->avalia($leilao);

  echo  $this->leiloeiro->getvalorMedioLances($leilao);
 * 
 */