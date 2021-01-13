<?php

namespace App\Repositories\Eloquent;

use App\Models\Email;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\EmailRepositoryInterface;
use App\Classes\Paginate\Paginate;
use App\Classes\Filters\EmailFilter;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class EmailRepository extends BaseRepository implements EmailRepositoryInterface
{
    /**
     * EmailRepository constructor.
     *
     * @param Email $email
     * @throws \Exception
     */
    public function __construct(Email $email)
    {
        parent::__construct($email);
    }

}

