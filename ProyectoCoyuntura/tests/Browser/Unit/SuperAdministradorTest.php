<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdministradorTest extends DuskTestCase
{
    /**
     * Login del Super Admin
     *
     * @return void
     */
    public function testLoginSuperAdmin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type( 'email','SuperAdmin@superadmin.es')
                    ->type( 'password', 'superadmin')
                    ->press('Inicio Sesión')
                    ->waitForText('Bienvenido')
                    ->assertPathIs('/home');        
        });
    }
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
    public function testAdministraciónUsuarios()
    {
        $this->browse(function (Browser $browser) {
           $browser ->visit('/')
                    ->clickLink('Comienza')
                    ->waitForText('Bienvenido')
                    ->clickLink('Administración')
                    ->waitForText('Usuarios')
                    ->clickLink('Usuarios')
                    ->waitForText('SuperAdmin')
                    ->assertPathIs('/admin/users');
        });
    }

}
