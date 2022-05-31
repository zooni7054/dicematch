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
class Programs extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes, HasRelationships, BelongsToThrough, HasEagerLimit, Sortable,InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'class_id',
        'training_type',
        'title',
        'code',
        'track_id',
        'sub_track_id',
        'duration',
        'description',
        'brochure',
        'promo_video',
        'banner',
        'net_price',
        'gst_percent',
        'gst_amount',
        'total_price',
        'certificate_required',
        'certificate_template_id',
        'is_public_certificate',
        'program_policy',
        'total_weeks',
        'status',
		'created_by',
		'updated_by',
    ];

    /**
     * The attributes that should be sort.
     *
     * @var array<string, string>
     */
    protected $sortable = [
        'class_id',
        'title',
        'code',
        'track_id',
        'sub_track_id',
        'duration',
        'description',
        'brochure',
        'promo_video',
        'banner',
        'net_price',
        'gst_percent',
        'gst_amount',
        'total_price',
        'certificate_required',
        'certificate_template_id',
        'is_public_certificate',
        'program_policy',
        'total_weeks',
        'status',
        'created_at',
        'updated_at',
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

    public function registerMediaCollections() : void{
        $this->addMediaCollection('programBrochure')->singleFile();
        $this->addMediaCollection('programBanner')->singleFile();
    }

    public function registerMediaConversions(Media $media = null) : void{
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(300)
            ->nonQueued();
    }
    
}
