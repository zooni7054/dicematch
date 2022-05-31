<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;
use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;
use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
use \Znck\Eloquent\Traits\BelongsToThrough;

class CareerCoachingBookingLog extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes, HasRelationships, BelongsToThrough, HasEagerLimit, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'career_coaching_booking_id',
        'booking_start',
        'booking_end',
    ];

    /**
     * The attributes that should be sort.
     *
     * @var array<string, string>
     */
    protected $sortable = [
        'career_coaching_booking_id',
        'booking_start',
        'booking_end',
        'created_at',
        'update_at',
    ];

    /**
     * The attributes that should be SoftDeletes.
     *
     * @var array<string, string>
     */
    protected $cascadeDeletes = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    public function scopeSearch($query, $request){

        // search queries

        // if($request->has('column')){
        //     $query = $query->where('column', $request->column);
        // }

        return $query;
    }

    /**
     * Get the booking that owns the CareerCoachingBookingLog
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function booking()
    {
        return $this->belongsTo(CareerCoachingBooking::class, 'career_coaching_booking_id');
    }
}
