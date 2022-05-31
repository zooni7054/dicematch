<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use \Znck\Eloquent\Traits\BelongsToThrough;
use Spatie\MediaLibrary\InteractsWithMedia;
use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;
use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProgramTestimonials extends Model implements HasMedia
{
    use HasFactory,  HasRelationships, BelongsToThrough, HasEagerLimit, Sortable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'program_id',
        'title',
        'subtitle',
        'type',
        'message',
        'created_by',
        'updated_by',
		'created_at',
        'update_at'
    ];

    /**
     * The attributes that should be sort.
     *
     * @var array<string, string>
     */
    protected $sortable = [
        'program_id',
        'title',
        'subtitle',
        'type',
        'message',
        'created_by',
        'updated_by',
		'created_at',
        'update_at'
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
    public function scopeSearch($query, $request)
    {

        // search queries

        // if($request->has('column')){
        //     $query = $query->where('column', $request->column);
        // }

        return $query;
    }

    public function registerMediaCollections() : void{
        $this->addMediaCollection('testimonialThumb')->singleFile();
        $this->addMediaCollection('testimonialVideo')->singleFile();
    }

    public function registerMediaConversions(Media $media = null) : void{
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(300)
			->performOnCollections('testimonialThumb', 'testimonialVideo')
            ->nonQueued();
    }
}
