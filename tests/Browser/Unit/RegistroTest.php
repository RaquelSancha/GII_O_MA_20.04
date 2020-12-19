<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistroTest extends DuskTestCase
{
   
    public function testRegistroUsuarioMalPass()
    {
        $this->browse(function (Browser $browser) {
           $browser ->visit('/')
                    ->clickLink('Registro')
                    ->type( 'nombre','usuarioTest')
                    ->type( 'email', 'usuarioTest@Test.es')
                    ->type( 'password','usuario1')
                    ->type( 'repassword', '123412341234123')
                    ->press('Registrame')
                    ->waitForText('Las contraseñas no coinciden')
                    ->assertSee('Las contraseñas no coinciden');        
        });
    }

    public function testRegistroUsuarioNombreExistente()
    {
        $this->browse(function (Browser $browser) {
           $browser ->visit('/')
                    ->clickLink('Registro')
                    ->type( 'nombre','SuperAdmin')
                    ->type( 'email', 'usuarioTest@Test.es')
                    ->type( 'password','usuario1')
                    ->type( 'repassword', 'usuario1')
                    ->press('Registrame')
                    ->waitForText('El email o el nombre de usuario ya existen')
                    ->assertSee('El email o el nombre de usuario ya existen');        
        });
    }

    public function testRegistroUsuarioEmailExistente()
    {
        $this->browse(function (Browser $browser) {
           $browser ->visit('/')
                    ->clickLink('Registro')
                    ->type( 'nombre','usuarioTest')
                    ->type( 'email', 'SuperAdmin@superadmin.es')
                    ->type( 'password','usuario1')
                    ->type( 'repassword', 'usuario1')
                    ->press('Registrame')
                    ->waitForText('El email o el nombre de usuario ya existen')
                    ->assertSee('El email o el nombre de usuario ya existen');        
        });
    }
    public function testRegistroUsuario()
    {
        $this->browse(function (Browser $browser) {
           $browser ->visit('/')
                    ->clickLink('Registro')
                    ->type( 'nombre','1usuarioTest')
                    ->type( 'email', '1usuarioTest@Test.es')
                    ->type( 'password','usuario1')
                    ->type( 'repassword', 'usuario1')
                    ->press('Registrame')
                    ->waitForText('La solicitud se ha enviado correctamente')
                    ->assertSee('La solicitud se ha enviado correctamente');        
        });
    }
    public function testRegistroUsuario2()
    {
        $this->browse(function (Browser $browser) {
           $browser ->visit('/')
                    ->clickLink('Registro')
                    ->type( 'nombre','2usuarioTest')
                    ->type( 'email', '2usuarioTest@Test.es')
                    ->type( 'password','usuario1')
                    ->type( 'repassword', 'usuario1')
                    ->press('Registrame')
                    ->waitForText('La solicitud se ha enviado correctamente')
                    ->assertSee('La solicitud se ha enviado correctamente');        
        });
    }
}
