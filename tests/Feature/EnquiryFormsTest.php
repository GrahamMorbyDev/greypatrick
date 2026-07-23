<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use RuntimeException;
use Tests\TestCase;

class EnquiryFormsTest extends TestCase
{
    use RefreshDatabase;

    public function test_quote_form_accepts_valid_submissions(): void
    {
        Mail::fake();
        $challenge = $this->challenge(3, 4);

        $this->post('/quote', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'project_name' => 'Example Co',
            'website' => 'https://example.com',
            'project_type' => 'New website',
            'budget' => '£1,500 - £3,000',
            'timeframe' => '2-4 weeks',
            'message' => 'I need a new website for my business.',
            ...$challenge,
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
        $challenge = $this->challenge(4, 5);

        $this->post('/contact', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'reason' => 'Website project',
            'message' => 'Can we talk about a website?',
            ...$challenge,
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
        $challenge = $this->challenge(4, 5);

        $this->post('/contact', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'reason' => 'Website project',
            'message' => 'Can we talk about a website?',
            ...$challenge,
            'human_answer' => 8,
        ])
            ->assertRedirect()
            ->assertSessionHasErrors('human_answer');

        $this->assertDatabaseMissing('contact_enquiries', [
            'email' => 'test@example.com',
        ]);
    }

    public function test_contact_form_still_saves_when_email_delivery_fails(): void
    {
        Log::spy();
        Mail::shouldReceive('raw')
            ->once()
            ->andThrow(new RuntimeException('Resend failed'));

        $challenge = $this->challenge(4, 5);

        $this->post('/contact', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'reason' => 'Website project',
            'message' => 'Can we talk about a website?',
            ...$challenge,
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

        Log::shouldHaveReceived('error')
            ->once()
            ->withArgs(fn (string $message): bool => $message === 'Enquiry saved but email notification failed.');
    }

    public function test_mail_recipient_config_does_not_use_reserved_global_to_address(): void
    {
        $this->assertNull(Config::get('mail.to'));
        $this->assertSame('grahampatrickdev@gmail.com', Config::get('mail.enquiry_recipient.address'));
        $this->assertSame('Grey Patrick', Config::get('mail.enquiry_recipient.name'));
    }

    /**
     * @return array{human_left: int, human_right: int, human_token: string}
     */
    private function challenge(int $left, int $right): array
    {
        return [
            'human_left' => $left,
            'human_right' => $right,
            'human_token' => hash_hmac('sha256', $left.'|'.$right, Config::get('app.key')),
        ];
    }
}
