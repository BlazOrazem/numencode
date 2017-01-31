<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends DuskTestCase
{
    /**
     * Test website homepage.
     *
     * @return void
     */
    public function testVisitHomepage()
    {
        $this->browse(function ($browser) {
            $browser->visit('/')
                ->assertSee('Numencode');
        });
    }

    /**
     * Test register page.
     *
     * @return void
     */
    public function testVisitRegisterPage()
    {
        $this->browse(function ($browser) {
            $browser->visit(route('en:register'))
                ->assertSee('Please Sign Up');
        });
    }
}
