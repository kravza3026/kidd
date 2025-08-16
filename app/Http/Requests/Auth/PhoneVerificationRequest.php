<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class PhoneVerificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
//        if (! hash_equals((string) $this->user()->getKey(), (string) $this->route('id'))) {
//            return false;
//        }

//        if (! hash_equals(sha1($this->user()->getPhoneForVerification()), (string) $this->route('code'))) {
//            return false;
//        }

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
            //
        ];
    }

    /**
     * Fulfill the email verification request.
     *
     * @return void
     */
    public function fulfill()
    {
        if (! $this->user()->hasVerifiedPhone()) {
            $this->user()->markPhoneAsVerified();

            event(new Verified($this->user()));
        }
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return \Illuminate\Validation\Validator
     */
    public function withValidator(Validator $validator)
    {
        return $validator;
    }
}
