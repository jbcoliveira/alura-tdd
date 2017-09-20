<?php



class Avaliador {

    private $maiorLance = -INF;
    private $menorLance = INF;

    
    function getMaiorLance() {
        return $this->maiorLance;
    }

    function getMenorLance() {
        return $this->menorLance;
    }

    function setMaiorLance($maiorLance) {
        $this->maiorLance = $maiorLance;
    }

    function setMenorLance($menorLance) {
        $this->menorLance = $menorLance;
    }

    public function avalia(Leilao $leilao) {
        foreach ($leilao->getLances() as $lance){
            if ($lance->getValor() > $this->getMaiorLance()){
                $this->setMaiorLance($lance->getValor());
            }
            
            if ($lance->getValor() < $this->getMenorLance()){                
                $this->setMenorLance($lance->getValor());
            }
                
        }
    }

}
