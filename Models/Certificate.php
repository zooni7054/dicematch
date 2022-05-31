<?php

namespace App\Models;

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

class Certificate extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes, HasRelationships, BelongsToThrough, HasEagerLimit, Sortable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'link',
        'status',
    ];

    /**
     * The attributes that should be sort.
     *
     * @var array<string, string>
     */
    protected $sortable = [
        'name',
        'link',
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
    public function scopeSearch($query, $request)
    {

        // search queries

        // if($request->has('column')){
        //     $query = $query->where('column', $request->column);
        // }

        return $query;
    }
	public function program()
    {
        return $this->hasMany(Programs::class, 'certificate_template_id', 'id');
    }
}
