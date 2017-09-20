<?php

require './Usuario.php';
require './Lance.php';
require './Leilao.php';
require './Avaliador.php';

class AvaliadorTest {

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


        $this->assertEquals($maiorEsperado,$leiloeiro->getMaiorLance(), 0.0001);
        $this->assertEquals($menorEsperado, $leiloeiro->getMenorLance(), 0.0001);
    }

}
