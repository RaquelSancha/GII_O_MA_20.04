<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuariosGestionTest extends DuskTestCase
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

    /**
     * Test que comprueba si se ha aceptado una petición de registro
     *
     * @return void
     */
    public function testAceptarPeticion()
    {
        $this->browse(function (Browser $browser) {
           $browser ->visit('/admin/users')
                    ->clickLink('Aceptar')
                    ->waitForText('1usuarioTest@Test.es')
                    ->assertSee('1usuarioTest@Test.es');        
        });
    }


    /**
     * Test que comprueba si se ha declinado una petición de registro
     *
     * @return void
     */
    public function testDeclinarPeticion()
    {
        $this->browse(function (Browser $browser) {
           $browser ->visit('/admin/users')
                    ->clickLink('Declinar')
                    ->pause(3000)
                    ->assertDontSee('2usuarioTest@Test.es');        
        });
    }


    /**
     * Test que comprueba si se ha borrado un usario correctamente.
     *
     * @return void
     */
    public function testBorrarUsuario()
    {
        $this->browse(function (Browser $browser) {
           $browser ->visit('/admin/users')
                    ->press('Borrar')
                    ->pause(3000)
                    ->assertDontSee('1usuarioTest@Test.es');        
        });
    }
   
}
