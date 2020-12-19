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
     * Test que restringe a un usuario modificar tablas
     *
     * @return void
     */
    public function testRestriccionModificarTabla()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/tables')
                    ->waitForText('Modificar Valores') 
                    ->clickLink('Modificar Valores') 	
                    ->waitForText('Inicia sesión')
                    ->assertPathIs('/login');
        });
    }


    /**
     * Test que restringe a un usuario entrar a la gestion de datos
     * @return void
     */
    public function testGestionDatos()
    {
        $this->browse(function (Browser $browser) {
           $browser->visit('/')
                    ->clickLink('Comienza')
                    ->waitForText('Bienvenido')
                    ->clickLink('Gestión Datos')
                    ->waitForText('Inicia sesión')
                    ->assertPathIs('/login');
        });
    }
    /**
     * Test que restringe a un usuario entrar a la administracion de usuarios
     *
     * @return void
     */
    public function testAdministraciónUsuarios()
    {
        $this->browse(function (Browser $browser) {
           $browser->visit('/')
                    ->clickLink('Comienza')
                    ->waitForText('Bienvenido')
                    ->clickLink('Administración')
                    ->waitForText('Usuarios')
                    ->clickLink('Usuarios')
                    ->waitForText('Inicia sesión')
                    ->assertPathIs('/login');
        });
    }

   
}
