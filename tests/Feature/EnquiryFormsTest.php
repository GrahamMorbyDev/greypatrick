<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class EnquiryFormsTest extends TestCase
{
    use RefreshDatabase;

    public function test_quote_form_accepts_valid_submissions(): void
    {
        Mail::fake();

        $this->withSession(['quote_challenge' => ['answer' => 7]])
            ->post('/quote', [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'project_name' => 'Example Co',
                'website' => 'https://example.com',
                'project_type' => 'New website',
                'budget' => '£1,500 - £3,000',
                'timeframe' => '2-4 weeks',
                'message' => 'I need a new website for my business.',
                'human_answer' => 7,
            ])
            ->assertRedirect()
            ->assertSessionHasNoErrors()
            ->assertSessionHas('status');

        $this->assertDatabaseHas('quote_enquiries', [
            'email' => 'test@example.com',
            'project_type' => 'New website',
            'status' => 'new',
        ]);

    }

    public function test_contact_form_accepts_valid_submissions(): void
    {
        Mail::fake();

        $this->withSession(['contact_challenge' => ['answer' => 9]])
            ->post('/contact', [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'reason' => 'Website project',
                'message' => 'Can we talk about a website?',
                'human_answer' => 9,
            ])
            ->assertRedirect()
            ->assertSessionHasNoErrors()
            ->assertSessionHas('status');

        $this->assertDatabaseHas('contact_enquiries', [
            'email' => 'test@example.com',
            'reason' => 'Website project',
            'status' => 'new',
        ]);

    }

    public function test_contact_form_rejects_incorrect_anti_spam_answer(): void
    {
        Mail::fake();

        $this->withSession(['contact_challenge' => ['answer' => 9]])
            ->post('/contact', [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'reason' => 'Website project',
                'message' => 'Can we talk about a website?',
                'human_answer' => 8,
            ])
            ->assertRedirect()
            ->assertSessionHasErrors('human_answer');

        $this->assertDatabaseMissing('contact_enquiries', [
            'email' => 'test@example.com',
        ]);
    }
}
