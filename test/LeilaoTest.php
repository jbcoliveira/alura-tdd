<?php

require '../Usuario.php';
require '../Lance.php';
require '../Leilao.php';
require '../Avaliador.php';

class LeilaoTest extends PHPUnit\Framework\TestCase {

    public function testnaoDeveAceitarDoisLancesSeguidosDoMesmoUsuario() {
        $leilao = new Leilao("Produto");


        $usuario1 = new Usuario("usuario1");

        $leilao->propoe(new Lance($usuario1, 12));
        $leilao->propoe(new Lance($usuario1, 11));

        $this->assertEquals(1, count($leilao->getLances()));
    }

    public function testnaoDeveAceitarMaisDoQue5LancesDeUmMesmoUsuario() {
        $leilao = new Leilao("Produto");


        $usuario1 = new Usuario("usuario1");
        $usuario2 = new Usuario("usuario2");

        $leilao->propoe(new Lance($usuario1, 1));
        $leilao->propoe(new Lance($usuario2, 2));

        $leilao->propoe(new Lance($usuario1, 3));
        $leilao->propoe(new Lance($usuario2, 4));

        $leilao->propoe(new Lance($usuario1, 5));
        $leilao->propoe(new Lance($usuario2, 6));

        $leilao->propoe(new Lance($usuario1, 7));
        $leilao->propoe(new Lance($usuario2, 8));

        $leilao->propoe(new Lance($usuario1, 9));
        $leilao->propoe(new Lance($usuario2, 10));

        //$leilao->propoe(new Lance($usuario1, 11));


        $this->assertEquals(10, count($leilao->getLances()));
    }

    public function testDobraLance() {
        $leilao = new Leilao("Produto");


        $usuario1 = new Usuario("usuario1");
        $usuario2 = new Usuario("usuario2");

        $leilao->propoe(new Lance($usuario1, 1));
        $leilao->propoe(new Lance($usuario2, 2));

        $leilao->propoe(new Lance($usuario1, 3));
        $leilao->propoe(new Lance($usuario2, 4));

        $leilao->propoe(new Lance($usuario1, 5));
        $leilao->propoe(new Lance($usuario2, 6));

        $leilao->propoe(new Lance($usuario1, 7));
        $leilao->propoe(new Lance($usuario2, 8));



        //$leilao->propoe(new Lance($usuario1, 11));




        $leilao->dobraLance($usuario1);


        $this->assertEquals(9, count($leilao->getLances()));
        $this->assertEquals(14, $leilao->getLances()[8]->getValor());
    }
    
    
        public function testDobraLanceSemNenhumLance() {
        $leilao = new Leilao("Produto");


        $usuario1 = new Usuario("usuario1");
       
        $leilao->dobraLance($usuario1);


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