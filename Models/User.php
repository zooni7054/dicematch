<?php

namespace App\Models;

use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Kyslik\ColumnSortable\Sortable;

use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use \Znck\Eloquent\Traits\BelongsToThrough;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;
use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, CascadeSoftDeletes, HasRelationships, BelongsToThrough, HasEagerLimit, Sortable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'profile_id',
        'profile_slug',
        'name',
        'email',
        'password',
        'about',
        'phone',
        'cnic',
        'dob',
        'gender',
        'city_id',
        'address',
        'profile_headline',
        'wizard',
        'linkedin',
        'facebook',
        'twitter',
        'instagram',
        'github',
        'completion_progress',
        'status',
        'career_track_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'dob' => 'datetime:Y-m-d',
    ];

    /**
     * The attributes that should be sort.
     *
     * @var array<string, string>
     */
    protected $sortable = [
        'name',
        'city_id',
        'gender',
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
     * Boot function from Laravel.
     */
    protected static function boot()
    {
        parent::boot();

        User::creating(function($model) {
            $model->profile_id = Str::uuid()->toString();
        });
    }

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

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }



    public function registerMediaCollections() : void{
        $this->addMediaCollection('avatar')->singleFile();
    }

    public function registerMediaConversions(Media $media = null) : void{
        $this->addMediaConversion('thumb')
            ->width(150)
            ->height(150)
            ->nonQueued();
    }


    /**
     * Get the city that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    /**
     * Get the role that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(UserRole::class, 'user_role_id');
    }


    /**
     * Get all of the education for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function education()
    {
        return $this->hasMany(UserEducation::class, 'user_id', 'id')->orderBy('start_date', 'desc');
    }

    /**
     * The languages that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function languages()
    {
        return $this->belongsToMany(Language::class, 'language_user')->withPivot(['reading_scale','listening_scale', 'writing_scale', 'speaking_scale']);
    }

    /**
     * Get all of the education for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courses()
    {
        return $this->hasMany(UserCourse::class, 'user_id', 'id')->orderBy('start_date', 'desc');
    }

    /**
     * Get the careerTrack that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function track()
    {
        return $this->belongsTo(CareerTrack::class, 'career_track_id');
    }

    /**
     * The skills that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'skill_user')->withPivot(['score','level', 'status']);
    }

    /**
     * Get all of the awards for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function awards()
    {
        return $this->hasMany(UserAward::class, 'user_id', 'id')->orderBy('issue_date', 'desc');
    }

    /**
     * Get all of the experiences for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function experiences()
    {
        return $this->hasMany(UserExperience::class, 'user_id', 'id')->orderBy('start_date', 'desc');
    }

    /**
     * The badges that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'badge_user')->withPivot([]);
    }

    /**
     * Get all of the interests for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function interests()
    {
        return $this->hasMany(UserInterest::class, 'user_id', 'id')->orderBy('id', 'desc');
    }

    /**
     * Get all of the certifications for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function certifications()
    {
        return $this->hasMany(UserCertification::class, 'user_id', 'id')->orderBy('issue_date', 'desc');
    }

    /**
     * Get all of the certifications for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function publications()
    {
        return $this->hasMany(UserPublication::class, 'user_id', 'id')->orderBy('publication_date', 'desc');
    }

    /**
     * Get all of the patents for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function patents()
    {
        return $this->hasMany(UserPatent::class, 'user_id', 'id')->orderBy('issue_date', 'desc');
    }

    /**
     * Get all of the quizResults for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quizResults()
    {
        return $this->hasMany(QuizResult::class, 'user_id', 'id');
    }

    /**
     * Get all of the connectionRequestsSent for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function connectionRequestsSent()
    {
        return $this->hasMany(ConnectionRequest::class, 'user_id', 'id');
    }

    /**
     * Get all of the connectionRequestsSent for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function connectionRequestsReceived()
    {
        return $this->hasMany(ConnectionRequest::class, 'connected_user_id', 'id');
    }

    /**
     * Get all of the connections for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userConnections()
    {
        return $this->hasMany(ConnectionUser::class, 'user_id', 'id');
    }

    /**
     * Get all of the connections for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userWithConnections()
    {
        return $this->hasMany(ConnectionUser::class, 'connected_user_id', 'id');
    }

    /**
     * Get all of the connections for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function connections()
    {
        return $this->userConnections->merge($this->userWithConnections);
    }

    /**
     * Get all of the posts for the PostType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    /**
     * Get all of the postLikes for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postLikes()
    {
        return $this->hasMany(PostLike::class, 'user_id', 'id');
    }

    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postComments()
    {
        return $this->hasMany(PostComment::class, 'user_id', 'id');
    }

    /**
     * Get all of the postCommentsLikes for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postCommentsLikes()
    {
        return $this->hasMany(PostCommentLike::class, 'user_id', 'id');
    }

    /**
     * Get all of the communities for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function communities()
    {
        return $this->hasMany(CommunityMember::class, 'user_id', 'id');
    }

    /**
     * Get all of the communityPollSubmissions for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function communityPollSubmissions()
    {
        return $this->hasMany(CommunityPollSubmission::class, 'user_id', 'id');
    }

    /**
     * Get the rewardWallet associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rewardWallet()
    {
        return $this->hasOne(RewardWallet::class, 'user_id', 'id');
    }

    /**
     * The todos that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function todos()
    {
        return $this->belongsToMany(Todo::class, 'todo_user')->withPivot(['status']);
    }

    /**
     * Get all of the invoices for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'user_id', 'id');
    }

    /**
     * Get the careerCoach associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function coach()
    {
        return $this->hasOne(CareerCoach::class, 'user_id', 'id');
    }

    /**
     * Get all of the coachings for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function coachings()
    {
        return $this->hasMany(CareerCoachingBooking::class, 'user_id', 'id');
    }
    /**
     * The products that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'coach_products')->withPivot([]);
    }

    public function latestEducation(){
        $education = $this->education()->orderBy('start_date', 'desc')->first();
        return $education;
    }
}
