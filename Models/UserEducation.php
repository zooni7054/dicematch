<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use \Znck\Eloquent\Traits\BelongsToThrough;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;
use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UserEducation extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes, HasRelationships, BelongsToThrough, HasEagerLimit, Sortable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'education_institute_id',
        'education_field_id',
        'education_level_id',
        'start_date',
        'end_date',
        'qualification_name',
        'is_currently_here',
        'marks',
        'social_activities',
        'description',
        'sort_order',
    ];

    /**
     * The attributes that should be sort.
     *
     * @var array<string, string>
     */
    protected $sortable = [
        'qualification_name',
        'start_date',
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

    public function registerMediaCollections() : void{
        $this->addMediaCollection('education')->singleFile();
    }

    public function registerMediaConversions(Media $media = null) : void{
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(200)
            ->nonQueued();
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
     * Get the user that owns the UserCourse
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the institute that owns the UserEducation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function institute()
    {
        return $this->belongsTo(EducationInstitute::class, 'education_institute_id');
    }

    /**
     * Get the field that owns the UserEducation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function field()
    {
        return $this->belongsTo(EducationField::class, 'education_field_id');
    }

    /**
     * Get the level that owns the UserEducation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function level()
    {
        return $this->belongsTo(EducationLevel::class, 'education_level_id');
    }
}
