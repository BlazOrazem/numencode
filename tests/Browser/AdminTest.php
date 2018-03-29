<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminTest extends DuskTestCase
{
    /**
     * Test the admin dashboard login.
     */
    public function testAdminLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('admin.dashboard'))
                ->pause(2000)
                ->press('Login')
                ->assertSee('The email field is required')
                ->assertSee('The password field is required')
                ->type('email', 'info@numencode.com')
                ->type('password', 'q1w2e3')
                ->press('Login')
                ->assertSee('Dashboard')
                ->screenshot('login-success');
        });
    }
}
