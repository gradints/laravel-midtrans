<?php

namespace Gradints\LaravelMidtrans\Validations\Requests;

use Gradints\LaravelMidtrans\Validations\Rules\HasValidSignature;
use Illuminate\Foundation\Http\FormRequest;

class PaymentNotificationRequest extends FormRequest
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
            'order_id' => 'required',
            'status_code' => 'required',
            'gross_amount' => 'required',
            'signature_key' => ['required', app(HasValidSignature::class)],
        ];
    }
}
