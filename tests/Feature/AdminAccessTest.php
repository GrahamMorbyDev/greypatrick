<?php

namespace Tests\Feature;

use App\Models\User;
use Filament\Panel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_the_admin_email_can_access_the_filament_panel(): void
    {
        $panel = Panel::make()->id('admin');

        $admin = User::factory()->create([
            'email' => 'grahampatrickdev@gmail.com',
        ]);

        $otherUser = User::factory()->create([
            'email' => 'other@example.com',
        ]);

        $this->assertTrue($admin->canAccessPanel($panel));
        $this->assertFalse($otherUser->canAccessPanel($panel));
    }
}
