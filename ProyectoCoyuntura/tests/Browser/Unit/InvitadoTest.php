<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class invitadoTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testRestriccionInsertar()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/form/new')
                    ->type('nombre_variable', 'nombre_variable')
                    ->type('fuente', 'fuente')
                    ->type('descripcion', 'descripcion')
                    ->type('tipo', 'tipo')
                    ->type('Burgos','ambitos[]')
                    ->type('categorias1','categorias[]')
                    ->type('2013','years[]')
                    ->type('Enviar datos');


    	
        });
    }

   
}
