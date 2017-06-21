<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class Conexion extends DuskTestCase
{
    /**
     * A basic browser test example.
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
