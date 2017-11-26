<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminTest extends DuskTestCase
{
    /**
     * Test the admin dashboard login.
     *
     * @return void
     */
    public function testAdminLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('admin.dashboard'))
                ->assertSee('numencode');

            $browser->type('email', 'info@numencode.com')
                ->type('password', 'q1w2e3')
                ->press('Login')
                ->assertPathIs('/admin');
        });
    }
}
