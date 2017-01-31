<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testAdminLogin()
    {
        $this->browse(function ($browser, $secondBrowser) {
            $browser->visit(route('admin.dashboard'))
                ->assertSee('numencode');

            $secondBrowser->visit(route('admin.dashboard'))
                ->type('email', 'info@numencode.com')
                ->type('password', 'q1w2e3')
                ->press('Login')
                ->assertPathIs('/admin');
        });
    }
}
