<?php

namespace App\Models;

use Carbon\Carbon;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use \Znck\Eloquent\Traits\BelongsToThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;
use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserExperience extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes, HasRelationships, BelongsToThrough, HasEagerLimit, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'company_id',
        'employment_type_id',
        'title',
        'start_date',
        'end_date',
        'is_current',
        'description',
        'sort_order',
    ];

    /**
     * The attributes that should be sort.
     *
     * @var array<string, string>
     */
    protected $sortable = [
        'title',
        'start_date',
        'end_date',
        'sort_order',
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
    protected $casts = [
        'start_date' => 'datetime:Y-m-d',
        'end_date' => 'datetime:Y-m-d',
    ];

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

    public function setStartDateAttribute($value)
    {
        $date = Carbon::createFromFormat('d-m-Y', $value);
        $this->attributes['start_date'] = $date->toDateString();
    }

    public function setEndDateAttribute($value)
    {
        if($value){
            $date = Carbon::createFromFormat('d-m-Y', $value);
            $this->attributes['end_date'] = $date->toDateString();
        }
        else{
            $this->attributes['end_date'] = NULL;
        }
    }

    public function setIsCurrentAttribute($value)
    {
        if($value){
            $this->attributes['is_current'] = 1;
        }
        else{
            $this->attributes['is_current'] = 0;
        }
    }

    /**
     * Get the user that owns the UserExperience
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the company that owns the UserExperience
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    /**
     * Get the employmentType that owns the UserExperience
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(EmploymentType::class, 'employment_type_id');
    }

    /**
     * The languages that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'skill_user_experience')->withPivot([]);
    }

    public function duration(){
        $end_date = now();
        if($this->end_date){
            $end_date = $this->end_date;
        }
        $diff = $this->start_date->diffInDays($end_date);

        if($diff > 365){
            $years = round($diff / 365);
            return ($years == 1) ? $years.' Year' : $years.' Years' ;
        }

        if($diff > 30){
            $months = round($diff / 30);
            return ($months == 1) ? $months.' Month' : $months.' Months' ;
        }

        return ($diff == 1) ? $diff.' Day' : $diff.' Days' ;
    }
}
