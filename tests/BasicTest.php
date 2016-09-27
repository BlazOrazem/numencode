<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BasicTest extends TestCase
{
    /** @test */
    public function visitHomepage()
    {
        $this->visit(url('/'))
             ->see('Numencode');
    }

    /** @test */
    public function visitRegisterPage()
    {
        $this->visit(route('register'))
            ->see('Please Sign Up');
    }

    /** @test */
    public function visitAdminDashboard()
    {
        $this->visit(route('admin.dashboard'))
            ->see('Admin Dashboard');
    }
}
