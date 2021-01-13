<?php

namespace App\Classes\Transformers;

class EmailTransformer extends Transformer
{
    protected $resourceName = 'email';

    public function transform($data)
    {
        return [
            'id' => $data['id'],
            'sender' => $data['sender'],
            'recipient' => $data['recipient'],
            'subject' => $data['subject'],
            'text' => $data['text'],
            'html' => $data['html'],
            'status' => $data['status_text'],
            'created_at' => $data['created_at']->format('Y-m-d H:i:s'),
            'updated_at' => $data['updated_at']->format('Y-m-d H:i:s'),
            'attachments' => $data->attachments,
        ];
    }
}
