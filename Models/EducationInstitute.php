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

class EducationInstitute extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes, HasRelationships, BelongsToThrough, HasEagerLimit, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'city_id',
        'status',
    ];

    /**
     * The attributes that should be sort.
     *
     * @var array<string, string>
     */
    protected $sortable = [
        'name',
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
     * Get all of the awards for the EducationInstitute
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function awards()
    {
        return $this->hasMany(UserAward::class, 'education_institute_id', 'id');
    }

    /**
     * Get all of the education for the EducationLevel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function education()
    {
        return $this->hasMany(UserEducation::class, 'education_institute_id', 'id');
    }

    /**
     * Get the city that owns the EducationInstitute
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}