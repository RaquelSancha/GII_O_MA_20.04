<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdministradorTest extends DuskTestCase
{
    /**
     * Login del Admin
     *
     * @return void
     */
    public function testLoginAdmin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type( 'email','Admin@admin.es')
                    ->type( 'password', 'admin1')
                    ->press('Inicio Sesión')
                    ->waitForText('Bienvenido')
                    ->assertPathIs('/home');
        });
    }
    /**
     * Permiso para modificar la tabla.
     *
     * @return void
     */
    public function testModificarTabla()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/tables')
                    ->waitForText('Modificar Valores') 
                    ->clickLink('Modificar Valores')    
                    ->pause(2000)
                    ->assertPathIs('/tables/5/edit');
        });
    }

    /**
     * Permiso para gestionar los datos
     *
     * @return void
     */
    public function testGestionDatos()
    {
        $this->browse(function (Browser $browser) {
           $browser->visit('/')
                    ->clickLink('Comienza')
                    ->waitForText('Bienvenido')
                    ->clickLink('Gestión Datos')
                    ->waitForText('Mostrar')
                    ->assertPathIs('/data/choose');
        });
    }

    /**
     * Permiso para gestionar los los usuarios
     *
     * @return void
     */
    public function testAdministraciónUsuarios()
    {
        $this->browse(function (Browser $browser) {
           $browser ->visit('/')
                    ->clickLink('Comienza')
                    ->waitForText('Bienvenido')
                    ->clickLink('Administración')
                    ->waitForText('Usuarios')
                    ->clickLink('Usuarios')
                    ->waitForText('No tienes permiso')
                    ->assertSee('No tienes permiso');
        });
    }

}
