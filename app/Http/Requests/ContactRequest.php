<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|min:2|max:255|string|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|max:255|email:rfc,dns',
            'subject' => 'nullable|max:255|string|min:3',
            'message' => 'required|min:10|max:250|string',
            'website' => 'size:0',           // honeypot
            'form_token' => 'required',
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            // Reject forms submitted too fast (bots) or on a stale/expired token.
            try {
                $tokenData = decrypt($this->input('form_token'));
                $elapsed = now()->timestamp - ($tokenData['timestamp'] ?? 0);

                if ($elapsed < config('contact.min_fill_time')) {
                    $validator->errors()->add('form_token', 'Please take your time to fill the form.');
                }
                if ($elapsed > 3600) {
                    $validator->errors()->add('form_token', 'Form has expired. Please refresh and try again.');
                }
            } catch (\Exception $e) {
                $validator->errors()->add('form_token', 'Invalid form submission.');
            }

            $message = $this->input('message', '');

            if (preg_match_all('/https?:\/\//', $message) > 2) {
                $validator->errors()->add('message', 'Message contains too many links.');
            }
            if (preg_match('/(.)\1{10,}/', $message)) {
                $validator->errors()->add('message', 'Message contains invalid patterns.');
            }
        });
    }
}
