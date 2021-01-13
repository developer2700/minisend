<?php

namespace App\Models;

use App\Classes\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class Email extends Model
{
    use Filterable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emails';

    public static $statuses = array(
        '0' => 'Posted',
        '1' => 'Sent',
        '2' => 'Failed'
    );

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sender',
        'recipient',
        'subject',
        'text',
        'html',
        'status',
    ];

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
     * Load all required relationships with only necessary content.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLoadRelations($query)
    {
        return $query->with(['attachments'])
            ->withCount(['attachments']);
    }

    /**
     * Load all new emails .
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->whereStatus(0);
    }

    /**
     * Get the user that owns the article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attachments()
    {
        return $this->HasMany(Attachment::class);
    }

    /**
     * Accessors get status by text
     *
     * @return string
     */
    public function getStatusTextAttribute()
    {
        return self::$statuses[$this->status ? : 0];
    }

    /**
     * Accessors get status by text
     *
     * @param $value
     * @return string
     */
    public function setStatusAttribute($value)
    {
        if (is_numeric($value) && in_array($value, self::$statuses)) {
            $this->attributes['status'] = $value;
        } elseif (false !== $key = array_search($value, self::$statuses)) {
            $this->attributes['status'] = $key;
        } else {
            $this->attributes['status'] = self::$statuses[0];
        }
    }
}
