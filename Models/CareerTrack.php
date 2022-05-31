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
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CareerTrack extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes, HasRelationships, BelongsToThrough, HasEagerLimit, Sortable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'parent_id',
        'name',
        'status',
    ];

    /**
     * The attributes that should be sort.
     *
     * @var array<string, string>
     */
    protected $sortable = [
        'parent_id',
        'name',
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
     * Get the subtrack that owns the CareerTrack
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parentTrack()
    {
        return $this->belongsTo(CareerTrack::class, 'parent_id');
    }

    /**
     * Get all of the subtracks for the CareerTrack
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subTracks()
    {
        return $this->hasMany(CareerTrack::class, 'parent_id', 'id');
    }

    /**
     * Get all of the users for the CareerTrack
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class, 'career_track_id', 'id');
    }

    /**
     * Get all of the skills for the CareerTrack
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function skills()
    {
        return $this->hasMany(Skill::class, 'career_track_id', 'id');
    }

    /**
     * Get all of the coaches for the CareerTrack
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function coaches()
    {
        return $this->hasMany(CareerCoach::class, 'career_track_id', 'id');
    }

    public function registerMediaCollections() : void{
        $this->addMediaCollection('career-tracks')->singleFile();
    }

    public function registerMediaConversions(Media $media = null) : void{
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(300);
        $this->addMediaConversion('careerTrack358x200')
            ->width(358)
            ->height(200);
    }

}
