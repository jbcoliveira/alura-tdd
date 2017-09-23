<?php

class Leilao {

    private $descricao;
    private $lances;

    function __construct($descricao) {
        $this->descricao = $descricao;
        $this->lances = array();
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getLances() {
        return $this->lances;
    }

    public function propoe(Lance $lance) {

        if (count($this->getLances()) == 0 ||
                ($this->permiteLance($lance->getUsuario()))) {
            $this->lances[] = $lance;
        }
    }

    private function qtdeDeLancesDo(Usuario $usuario) {
        $totalMesmoUsuario = 0;
        foreach ($this->getLances() as $lancesAnteriores) {
            $lancesAnteriores->getUsuario()->getNome() == $usuario->getNome() ? $totalMesmoUsuario++ : $totalMesmoUsuario = $totalMesmoUsuario;
        }

        return $totalMesmoUsuario;
    }

    private function ultimoLanceDado() {
        return $this->getLances()[count($this->getLances()) - 1];
    }

    private function permiteLance(Usuario $usuario) {
        return $this->qtdeDeLancesDo($usuario) <= 5 && $this->ultimoLanceDado()->getUsuario()->getNome() != $usuario->getNome();
    }

    private function ultimoLanceDo(Usuario $usuario) {
        $ultimo = null;
        
        
        foreach ($this->getLances() as $lance) {
            if ($lance->getUsuario()->getNome() == $usuario->getNome()) {
                $ultimo = $lance;
            }
        }
        return $ultimo;
    }

    public function dobraLance(Usuario $usuario) {
         $ultimoLance = $this->ultimoLanceDo($usuario);
        if($ultimoLance!=null) {
            $this->propoe(new Lance($usuario, $ultimoLance->getValor()*2));
        }
    }

}
