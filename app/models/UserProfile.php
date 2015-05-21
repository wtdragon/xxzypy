<?php  

/**
 * Class UserProfile
 *
 * @author jacopo beschi jacopo@jacopobeschi.com
 */

class UserProfile extends \Eloquent
{
    protected $table = "user_profile";

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'vat',
        'state',
        'city',
        'country',
        'zip',
        'code',
        'address',
        'avatar'
    ];

    protected $guarded = ["id"];

    public function user()
    {
        return $this->belongsTo('User', "user_id");
    }

    public function profile_field()
    {
        return $this->hasMany('ProfileField');
    }

    public function getAvatarAttribute()
    {
        return isset($this->attributes['avatar']) ? base64_encode($this->attributes['avatar']) : null;
    }

   
} 