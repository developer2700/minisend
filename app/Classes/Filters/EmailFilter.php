<?php

namespace App\Classes\Filters;

use App\Models\Attachment;
use App\Models\Email;

class EmailFilter extends Filter
{
    /**
     * Filter by sender address
     * Get all the emails by the given email address.
     *
     * @param $email
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function sender($email)
    {
        return $this->builder->where('sender', 'like', $email . '%');
    }

    /**
     * Filter by Recipient address
     * Get all the emails by the given email address.
     *
     * @param $email
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function recipient($email)
    {
        return $this->builder->where('recipient', 'like', $email . '%');
    }

    /**
     * Filter by to subject
     * Get all the emails by the given subject
     *
     * @param $subject
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function subject($subject)
    {
        return $this->builder->where('subject', 'like', $subject . '%');
    }

    /**
     * Filter by id
     * Get the email by the given id.
     *
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function id($id)
    {
        return $this->builder->whereId($id);
    }

    /**
     * Filter by Status
     * Get the email by the given status.
     *
     * @param $status
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function status($status)
    {
        if (is_numeric($status)) {
            return $this->builder->whereStatus($status);
        } elseif ($status = array_search($status, Email::$statuses)) {
            return $this->builder->whereStatus($status);
        }
    }


}
