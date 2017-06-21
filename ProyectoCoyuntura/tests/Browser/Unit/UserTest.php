<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTest extends DuskTestCase
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
    				->assertPathIs('/home')
    				->clickLink('SuperAdmin')
    				->waitForText('Salir')
    				->clickLink('Salir');
    	
        });
    }
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
    				->assertPathIs('/home')
    				->clickLink('Admin')
    				->waitForText('Salir')
    				->clickLink('Salir');
        });
    }
     /**
     * Entrada a la aplicación del invitado
     *
     * @return void
     */
    public function testLoginInvitado()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
    				->clickLink('Comienza')
    				->waitForText('Bienvenido')
    				->assertPathIs('/homeGuest');
    	
        });
    }


}
