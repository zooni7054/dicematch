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

class Skill extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes, HasRelationships, BelongsToThrough, HasEagerLimit, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'career_track_id',
        'name',
        'status',
    ];

    /**
     * The attributes that should be sort.
     *
     * @var array<string, string>
     */
    protected $sortable = [
        'career_track_id',
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
     * Get the track that owns the Skill
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function track()
    {
        return $this->belongsTo(CareerTrack::class, 'career_track_id', 'id');
    }

    /**
     * The skills that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'skill_user')->withPivot(['score','level', 'status']);
    }

    /**
     * The languages that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function experiences()
    {
        return $this->belongsToMany(UserExperience::class, 'skill_user_experience')->withPivot([]);
    }

    /**
     * Get all of the quizes for the Skill
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quizes()
    {
        return $this->hasMany(Quiz::class, 'skill_id', 'id');
    }

    /**
     * Get all of the quizResults for the Skill
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quizResults()
    {
        return $this->hasMany(QuizResult::class, 'skill_id', 'id');
    }
}
