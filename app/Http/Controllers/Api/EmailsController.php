<?php

namespace App\Http\Controllers\Api;

use App\Models\Email;
use App\Classes\Filters\EmailFilter;
use App\Http\Requests\Api\Email\CreateEmail;
use App\Http\Requests\Api\Email\UpdateEmail;
use App\Http\Requests\Api\Email\DeleteEmail;
use App\Classes\Transformers\EmailTransformer;
use App\Repositories\Interfaces\EmailRepositoryInterface;

class EmailsController extends ApiController
{

    protected $repository;

    /**
     * EmailsController constructor.
     *
     * @param EmailRepositoryInterface $emailRepository
     * @param EmailTransformer $transformer
     */
    public function __construct(EmailRepositoryInterface $emailRepository, EmailTransformer $transformer)
    {
        $this->repository = $emailRepository;
        $this->transformer = $transformer;

        // this is for jwt auth and we won't use it here in this project
//        $this->middleware('auth.api')->except(['index', 'show']);
//        $this->middleware('auth.api:optional')->only(['index', 'show']);
    }

    /**
     * Get all the companies.
     *
     * @param EmailFilter $filter
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function index(EmailFilter $filter)
    {
        $companies = $this->repository->paginate($filter);

        return $this->respondWithPagination($companies);
    }

    /**
     * Create a new email and return the email if successful.
     *
     * @param CreateEmail $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateEmail $request)
    {
        $email = $this->repository->create($request->get('email'));
        if ($request->has('email.attachments')) {
            foreach ($request->input('email.attachments') as $attachment) {
                $email->attachments()->create($attachment);
            }
        }
        return $this->respondWithTransformer($email);
    }

    /**
     * Get the email given by its id.
     *
     * @param Email $email
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Email $email)
    {
        return $this->respondWithTransformer($email);
    }

    /**
     * Update the email given by its slug and return the email if successful.
     *
     * @param UpdateEmail $request
     * @param Email $email
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function update(UpdateEmail $request, Email $email)
    {
        $email = $this->repository->update($email->id, $request->get('email'));
        if ($request->has('email.attachments')) {
            $email->attachments()->delete();
            foreach ($request->input('email.attachments') as $attachment) {
                $email->attachments()->create($attachment);
            }
        }
        return $this->respondWithTransformer($email);
    }

    /**
     * Delete the email .
     *
     * @param DeleteEmail $request
     * @param Email $email
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(DeleteEmail $request, Email $email)
    {
        if ($this->repository->delete($email)) {
            return $this->respondSuccess();
        } else {
            return $this->respondForbidden();
        }
    }
}
