<?php

require '../AnoBissexto.php';

class AnoBissextoTest extends PHPUnit\Framework\TestCase {

    function testAnoBissexto() {
        $ano = new AnoBissexto();
        $this->assertEquals(true, $ano->ehBissexto(2011));
    }

}
