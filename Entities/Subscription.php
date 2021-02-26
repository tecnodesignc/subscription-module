<?php

namespace Modules\Subscription\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Modules\Order\Entities\OrderItem;

class Subscription extends Model
{
    protected $table = 'subscription__subscriptions';
    protected $fillable = [
        "init_date",
        "end_date",
        "active",
        "total",
        "plan_id",
        "user_id"
    ];
    /**
     * The attributes that should be casted to native types
     * @var array
     */
    protected $casts = [
        'init_date' => 'datetime',
        'end_date' => 'datetime',
        'active' => 'boolean',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function orderItem()
    {
        return $this->morphOne(OrderItem::class, 'itemmable');
    }
    /**
     * relation ship User entity
     * @return mixed
     */
    public function user()
    {
        $driver = config('encore.user.config.driver');

        return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User");
    }

    /*public function getEndDateAttribute($date)
    {
        return Carbon::parse($date);
    }
    public function getInitDateAttribute($date)
    {
        return Carbon::parse($date);
    }*/

}
