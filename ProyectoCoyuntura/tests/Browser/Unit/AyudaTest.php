<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AyudaTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testAyudaAdmins()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
            		->type( 'email','SuperAdmin@superadmin.es')
    				->type( 'password', 'superadmin')
    				->press('Inicio Sesión')
    				->waitForText('Bienvenido')
    				->clickLink('Ayuda')
    				->waitForText('Gestión de datos')
    				->assertPathIs('/help')
                    ->clickLink('SuperAdmin')
                    ->waitForText('Salir')
                    ->clickLink('Salir');
    	
        });
    }

    public function testAyudaInvitados()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Comienza')
                    ->waitForText('Bienvenido')
                    ->clickLink('Ayuda')
                    ->waitForText('Ayuda de la Aplicación')
                    ->assertPathIs('/helpGuest');
        });
    }

}
