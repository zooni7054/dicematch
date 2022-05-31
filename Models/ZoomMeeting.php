<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
use \Znck\Eloquent\Traits\BelongsToThrough;
use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;
use Kyslik\ColumnSortable\Sortable;

class ZoomMeeting extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes, HasRelationships, BelongsToThrough, HasEagerLimit, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "table_name",
        "topic",
        "meeting_id",
        "uuid",
        "host_id",
        "host_email",
        "table_id",
        "start_link",
        "join_link",
        "password",
        "status",
        "response_json",
        'created_at',
        'update_at',
    ];

    /**
     * The attributes that should be sort.
     *
     * @var array<string, string>
     */
    protected $sortable = [
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
}
