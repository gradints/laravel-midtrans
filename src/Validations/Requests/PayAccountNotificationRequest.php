<?php

namespace Gradints\LaravelMidtrans\Validations\Requests;

use Gradints\LaravelMidtrans\Validations\Rules\HasValidSignature;
use Illuminate\Foundation\Http\FormRequest;

class PayAccountNotificationRequest extends FormRequest
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
            'account_id' => 'required',
            'account_status' => 'required',
            'status_code' => 'required',
            'signature_key' => ['required', new HasValidSignature()],
        ];
    }
}
