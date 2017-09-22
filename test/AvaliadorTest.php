<?php

//require_once 'PHPUnit/Framework/TestCase';
require '../Usuario.php';
require '../Lance.php';
require '../Leilao.php';
require '../Avaliador.php';

class AvaliadorTest extends PHPUnit\Framework\TestCase {

    public function testDeveEntenderLancesEmOrdemCrescente() {
        $leilao = new Leilao("Produto");


        $usuario1 = new Usuario("usuario1");
        $usuario2 = new Usuario("usuario2");
        $usuario3 = new Usuario("usuario3");

        $leilao->propoe(new Lance($usuario1, 12));
        $leilao->propoe(new Lance($usuario2, 11));
        $leilao->propoe(new Lance($usuario3, 10));

        $leiloeiro = new Avaliador();

        $leiloeiro->avalia($leilao);



// comparando a saida com o esperado
        $maiorEsperado = 12;
        $menorEsperado = 10;


        $this->assertEquals($maiorEsperado, $leiloeiro->getMaiorLance(), 0.0001);
        $this->assertEquals($menorEsperado, $leiloeiro->getMenorLance(), 0.0001);

        $this->assertEquals(11, $leiloeiro->getvalorMedioLances($leilao), 0.0001);
    }

    public function testDeveEntenderUmLance() {
        $leilao = new Leilao("Produto");


        $usuario1 = new Usuario("usuario1");

        $leilao->propoe(new Lance($usuario1, 12));

        $leiloeiro = new Avaliador();

        $leiloeiro->avalia($leilao);



// comparando a saida com o esperado
        $maiorEsperado = 12;
        $menorEsperado = 12;


        $this->assertEquals($maiorEsperado, $leiloeiro->getMaiorLance(), 0.0001);
        $this->assertEquals($menorEsperado, $leiloeiro->getMenorLance(), 0.0001);
    }

    public function testDeveEntenderLancesEmOrdemAleatoria() {
        $leilao = new Leilao("Produto");


        $usuario1 = new Usuario("usuario1");
        $usuario2 = new Usuario("usuario2");


        $leilao->propoe(new Lance($usuario1, 1));
        $leilao->propoe(new Lance($usuario2, 5));
        $leilao->propoe(new Lance($usuario1, 10));
        $leilao->propoe(new Lance($usuario2, 6));
        $leilao->propoe(new Lance($usuario1, 2));
        $leilao->propoe(new Lance($usuario2, 9));


        $leiloeiro = new Avaliador();

        $leiloeiro->avalia($leilao);



// comparando a saida com o esperado
        $maiorEsperado = 10;
        $menorEsperado = 1;


        $this->assertEquals(10, $leiloeiro->getMaiorLance(), 0.0001);
        $this->assertEquals(1, $leiloeiro->getMenorLance(), 0.0001);
    }

    public function testDeveEntenderLancesEmOrdemDecrecente() {
        $leilao = new Leilao("Produto");


        $usuario1 = new Usuario("usuario1");
        $usuario2 = new Usuario("usuario2");


        $leilao->propoe(new Lance($usuario1, 15));
        $leilao->propoe(new Lance($usuario2, 13));
        $leilao->propoe(new Lance($usuario1, 10));
        $leilao->propoe(new Lance($usuario2, 9));
        $leilao->propoe(new Lance($usuario1, 7));
        $leilao->propoe(new Lance($usuario2, 5));


        $leiloeiro = new Avaliador();

        $leiloeiro->avalia($leilao);



// comparando a saida com o esperado
        $menorEsperado = 5;
        $maiorEsperado = 15;


        $this->assertEquals(5, $leiloeiro->getMenorLance(), 0.0001);
        $this->assertEquals(15, $leiloeiro->getMaiorLance(), 0.0001);
    }

    public function testPegaOsTresMaiores() {
        $leilao = new Leilao("Produto");


        $usuario1 = new Usuario("usuario1");
        $usuario2 = new Usuario("usuario2");


        $leilao->propoe(new Lance($usuario1, 10));
        $leilao->propoe(new Lance($usuario1, 15));
        $leilao->propoe(new Lance($usuario2, 13));
        $leilao->propoe(new Lance($usuario2, 9));
        $leilao->propoe(new Lance($usuario1, 7));



        $leiloeiro = new Avaliador();

        $leiloeiro->avalia($leilao);


        $this->assertEquals(15, $leiloeiro->getTresMaiores()[0]->getValor());
        $this->assertEquals(13, $leiloeiro->getTresMaiores()[1]->getValor());
        $this->assertEquals(10, $leiloeiro->getTresMaiores()[2]->getValor());

        
    }
    
    
    public function testApenasDoisLance() {
        $leilao = new Leilao("Produto");


        $usuario1 = new Usuario("usuario1");
        $usuario2 = new Usuario("usuario2");


        $leilao->propoe(new Lance($usuario1, 10));
        $leilao->propoe(new Lance($usuario1, 15));



        $leiloeiro = new Avaliador();

        $leiloeiro->avalia($leilao);


        $this->assertEquals(2, count($leilao->getLances()));
    }

    public function testNenhumLance() {
        $leilao = new Leilao("Produto");


        $usuario1 = new Usuario("usuario1");
        $usuario2 = new Usuario("usuario2");



        $leiloeiro = new Avaliador();

        $leiloeiro->avalia($leilao);


        $this->assertEquals(NULL, count($leilao->getLances()));
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