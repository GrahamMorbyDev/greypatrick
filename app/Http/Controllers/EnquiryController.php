<?php

namespace App\Http\Controllers;

use App\Models\ContactEnquiry;
use App\Models\QuoteEnquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class EnquiryController extends Controller
{
    public function quote(): View
    {
        return view('pages.quote', [
            'humanChallenge' => $this->challenge(),
        ]);
    }

    public function contact(): View
    {
        return view('pages.contact', [
            'humanChallenge' => $this->challenge(),
        ]);
    }

    public function submitQuote(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'project_name' => ['nullable', 'string', 'max:160'],
            'website' => ['nullable', 'url', 'max:255'],
            'project_type' => ['required', 'string', 'max:120'],
            'budget' => ['nullable', 'string', 'max:80'],
            'timeframe' => ['nullable', 'string', 'max:80'],
            'message' => ['required', 'string', 'max:4000'],
            'company_website' => ['prohibited'],
            'human_left' => ['required', 'integer'],
            'human_right' => ['required', 'integer'],
            'human_token' => ['required', 'string'],
            'human_answer' => ['required', 'integer'],
        ]);

        $this->validateChallenge($request);

        $validated = collect($validated)
            ->except(['company_website', 'human_left', 'human_right', 'human_token', 'human_answer'])
            ->all();

        QuoteEnquiry::create($validated);

        Mail::raw(view('mail.quote', ['data' => $validated])->render(), function ($message) use ($validated) {
            $message
                ->to(config('mail.to.address'))
                ->replyTo($validated['email'], $validated['name'])
                ->subject('New website quote request from '.$validated['name']);
        });

        return back()->with('status', 'Quote request sent. I will get back to you soon.');
    }

    public function submitContact(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:160'],
            'reason' => ['required', 'string', 'max:120'],
            'message' => ['required', 'string', 'max:4000'],
            'company_website' => ['prohibited'],
            'human_left' => ['required', 'integer'],
            'human_right' => ['required', 'integer'],
            'human_token' => ['required', 'string'],
            'human_answer' => ['required', 'integer'],
        ]);

        $this->validateChallenge($request);

        $validated = collect($validated)
            ->except(['company_website', 'human_left', 'human_right', 'human_token', 'human_answer'])
            ->all();

        ContactEnquiry::create($validated);

        Mail::raw(view('mail.contact', ['data' => $validated])->render(), function ($message) use ($validated) {
            $message
                ->to(config('mail.to.address'))
                ->replyTo($validated['email'], $validated['name'])
                ->subject('New contact enquiry from '.$validated['name']);
        });

        return back()->with('status', 'Message sent. I will get back to you soon.');
    }

    /**
     * @return array{left: int, right: int, token: string}
     */
    private function challenge(): array
    {
        $challenge = [
            'left' => random_int(3, 9),
            'right' => random_int(2, 8),
        ];

        $challenge['token'] = $this->signChallenge($challenge['left'], $challenge['right']);

        return $challenge;
    }

    private function validateChallenge(Request $request): void
    {
        $left = (int) $request->input('human_left');
        $right = (int) $request->input('human_right');
        $validToken = hash_equals(
            $this->signChallenge($left, $right),
            (string) $request->input('human_token')
        );
        $validAnswer = (int) $request->input('human_answer') === $left + $right;

        if (! $validToken || ! $validAnswer) {
            throw ValidationException::withMessages([
                'human_answer' => 'Please answer the quick anti-spam question correctly.',
            ]);
        }
    }

    private function signChallenge(int $left, int $right): string
    {
        return hash_hmac('sha256', $left.'|'.$right, (string) Config::get('app.key'));
    }
}
