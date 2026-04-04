<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:2|max:255|string|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|max:255|email:rfc,dns',
            'subject' => 'nullable|max:255|string|min:3',
            'message' => 'required|min:10|max:250|string',

            // Honeypot field - should be empty
            'website' => 'size:0',

            // Time-based token validation
            'form_token' => 'required',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Time-based validation - form must be filled for at least 5 seconds
            try {
                $tokenData = decrypt($this->input('form_token'));
                $timestamp = $tokenData['timestamp'] ?? 0;
                $elapsed = now()->timestamp - $timestamp;

                $minTime = env('CONTACT_MIN_FILL_TIME', 5);
                if ($elapsed < $minTime) {
                    $validator->errors()->add('form_token', 'Please take your time to fill the form.');
                }

                // Token should not be older than 1 hour
                if ($elapsed > 3600) {
                    $validator->errors()->add('form_token', 'Form has expired. Please refresh and try again.');
                }
            } catch (\Exception $e) {
                $validator->errors()->add('form_token', 'Invalid form submission.');
            }

            // Check for suspicious patterns in message
            $message = $this->input('message', '');

            // Count URLs in message - reject if more than 2 links
            $urlCount = preg_match_all('/https?:\/\//', $message);
            if ($urlCount > 2) {
                $validator->errors()->add('message', 'Message contains too many links.');
            }

            // Check for repeated characters (spam pattern)
            if (preg_match('/(.)\1{10,}/', $message)) {
                $validator->errors()->add('message', 'Message contains invalid patterns.');
            }
        });
    }
}
