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

class CareerCoachingBooking extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes, HasRelationships, BelongsToThrough, HasEagerLimit, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'career_coach_id',
        'career_coaching_type_id',
        'product_package_id',
        'booking_start',
        'booking_end',
        'actual_start',
        'actual_end',
        'message',
        'recording_link',
        'coach_remarks',
        'is_paid',
        'status',
    ];

    /**
     * The attributes that should be sort.
     *
     * @var array<string, string>
     */
    protected $sortable = [
        'user_id',
        'career_coach_id',
        'career_coaching_type_id',
        'product_package_id',
        'booking_start',
        'booking_end',
        'actual_start',
        'actual_end',
        'coach_remarks',
        'client_remarks',
        'ratting',
        'is_paid',
        'status',
        'created_at',
        'update_at',
    ];
    protected $dates = ['booking_start','booking_end','actual_start','actual_end'];
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
     * Get the user that owns the CareerCoachingBooking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the coach that owns the CareerCoachingBooking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function coach()
    {
        return $this->belongsTo(CareerCoach::class, 'career_coach_id');
    }

    /**
     * Get the type that owns the CareerCoachingBooking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(CareerCoachingType::class, 'career_coaching_type_id');
    }

    /**
     * Get the package that owns the CareerCoachingBooking
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function package()
    {
        return $this->belongsTo(ProductPackage::class, 'product_package_id');
    }

    /**
     * Get all of the members for the CareerCoachingBooking
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function members()
    {
        return $this->hasMany(CareerCoachingBookingMember::class, 'career_coaching_booking_id', 'id');
    }

    /**
     * Get all of the feedbacks for the CareerCoachingBooking
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function feedbacks()
    {
        return $this->hasMany(CareerCoachingBookingFeedback::class, 'career_coaching_booking_id', 'id');
    }

    /**
     * Get all of the logs for the CareerCoachingBooking
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logs()
    {
        return $this->hasMany(CareerCoachingBookingLog::class, 'career_coaching_booking_id', 'id');
    }
}
