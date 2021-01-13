<?php

namespace App\Classes\Filters;

use App\Classes\Transformers\AttachmentTransformer;
use App\Models\Attachment;
use App\Repositories\Interfaces\EmailRepositoryInterface;
use App\Repositories\Interfaces\AttachmentRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AttachmentFilter extends Filter
{

    protected $emailRepository;

    /**
     * Filter constructor.
     *
     * @param \Illuminate\Http\Request $request
     * @param EmailRepositoryInterface $emailRepository
     */
    public function __construct(Request $request, EmailRepositoryInterface $emailRepository)
    {
        parent::__construct($request);
        $this->emailRepository = $emailRepository;
    }

    /**
     * Filter by name
     * Get all the attachments by the given file name.
     *
     * @param $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function file_name($name)
    {
        return $this->builder->where('filename', 'like', $name . '%');
    }

    /**
     * Filter by id
     * Get the station by the given id.
     *
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function id($id)
    {
        return $this->builder->whereId($id);
    }

    /**
     * Filter by email_id
     * Get the attachments by the given email_id.
     *
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function email_id($id)
    {
        return $this->builder->where('email_id', $id);
    }




}
