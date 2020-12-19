<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class Conexion extends DuskTestCase
{
    /**
     * Test que comprueba que se realiza la conexion a la aplicacion correctamente
     *
     * @return void
     */
    public function testConexion()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Comienza');
        });
    }
}
