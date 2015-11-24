<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BasicTest extends TestCase
{
    /** @test */
    public function visitHomepage()
    {
        $this->visit('/')
             ->see('Laravel Clean Slate');
    }

    /** @test */
    public function visitRegisterPage()
    {
        $this->visit('/auth/register')
            ->see('Please Sign Up');
    }

    /** @test */
    public function visitAdminDashboard()
    {
        $this->visit('/admin')
            ->see('Admin Dashboard');
    }
}
