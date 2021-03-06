<?php

namespace App\Http\Requests\Api\Email;

use App\Http\Requests\Api\ApiRequest;

class UpdateEmail extends ApiRequest
{
    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    public function validationData()
    {
        return $this->get('email') ?: [];
    }

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
            'sender' => 'required|string|max:255',
            'recipient' => 'required|string|max:255',
            'subject' => 'sometimes|string|max:255',
            'text' => 'sometimes|string',
            'html' => 'sometimes|string',
            'attachments' => 'sometimes',
        ];
    }
}
