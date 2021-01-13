<?php

namespace App\Http\Requests\Api\Email;

use App\Http\Requests\Api\ApiRequest;

class DeleteEmail extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
//        $email = $this->route('email');
//        return !count($email->attachments);
    }
}
