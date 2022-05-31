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
use DB;
class CareerCoach extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes, HasRelationships, BelongsToThrough, HasEagerLimit, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'career_track_id',
        'status',
    ];

    /**
     * The attributes that should be sort.
     *
     * @var array<string, string>
     */
    protected $sortable = [
        'user_id',
        'career_track_id',
        'status',
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
     * Get the user that owns the CareerCoach
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the careerTrack that owns the CareerCoach
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function careerTrack()
    {
        return $this->belongsTo(CareerTrack::class, 'career_track_id');
    }

    /**
     * Get all of the timesheet for the CareerCoach
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function timesheet()
    {
        return $this->hasMany(CareerCoachTimesheet::class, 'career_coach_id', 'id');
    }

    /**
     * Get all of the leaves for the CareerCoach
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function leaves()
    {
        return $this->hasMany(CareerCoachLeave::class, 'career_coach_id', 'id');
    }

    /**
     * Get all of the bookings for the CareerCoach
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookings()
    {
        return $this->hasMany(CareerCoachingBooking::class, 'career_coach_id', 'id');
    }
    public static function careerCoachesTimeSheet($params=[])
    {
        $primaryKey     =   "career_coaches.id";
        $query          =  DB::table('career_coaches');
        $query->join('career_coach_timesheets', 'career_coach_timesheets.career_coach_id', '=', 'career_coaches.id');
        $query->selectRaw("career_coach_timesheets.*,career_coaches.user_id");
        //fetch data by conditions
        if(array_key_exists("conditions",$params))
        {
            foreach($params['conditions'] as $key => $value)
            {
                $query->where($key,$value);
            }
        }

        if(array_key_exists("whereNotIn",$params))
        {
            foreach($params['whereNotIn'] as $key => $value)
            {
                $query->whereNotIn($key,$value);
            }
        }
        if(array_key_exists($primaryKey,$params))
        {
            $query->where($primaryKey,$params[$primaryKey]);
            $result =   $query->get();
        }
        else
        {
            //set start and limit
            if(array_key_exists("orderbyfield",$params) && array_key_exists("orderby",$params))
            {
                $query->orderBy($params['orderbyfield'], $params['orderby']);
            }
            else
            {
               $query->orderBy($primaryKey,"ASC");
            }
            if(array_key_exists("start",$params) && array_key_exists("limit",$params))
            {
                $query->offset($params['start']);
                $query->limit($params['limit']);
            }
            elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params))
            {
                $query->limit($params['limit']);
            }
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count')
            {
                $result = $query->count();
            }
            else
            {
                $result = $query->get();
            }
        }
        return $result;
    }
}
