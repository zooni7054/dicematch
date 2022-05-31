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

class UserCertification extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes, HasRelationships, BelongsToThrough, HasEagerLimit, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'organization',
        'issue_date',
        'expiry_date',
        'credential_id',
        'credential_url',
    ];

    /**
     * The attributes that should be sort.
     *
     * @var array<string, string>
     */
    protected $sortable = [
        'issue_date',
        'expiry_date',
        'user_id',
        'title',
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
        'issue_date' => 'datetime:Y-m-d',
        'expiry_date' => 'datetime:Y-m-d',
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

    public function setIssueDateAttribute($value)
    {
        $date = Carbon::createFromFormat('d-m-Y', $value);
        $this->attributes['issue_date'] = $date->toDateString();
    }

    public function setExpiryDateAttribute($value)
    {
        if($value){
            $date = Carbon::createFromFormat('d-m-Y', $value);
            $this->attributes['expiry_date'] = $date->toDateString();
        }
        else{
            $this->attributes['expiry_date'] = NULL;
        }
    }

    /**
     * Get the user that owns the UserCertification
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'other_key');
    }
}
