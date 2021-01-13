<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Classes\Filters\Filterable;

class Attachment extends Model
{
    use Filterable;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'email_attachments';
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email_id',
        'filename',
    ];

    /**
     * Get the Email that own this station.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function email()
    {
        return $this->belongsTo(Email::class);
    }

    /**
     * Load all required relationships with only necessary content.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLoadRelations($query)
    {
        return $query->with(['email']);

    }

}
