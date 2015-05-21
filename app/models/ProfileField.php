<?php   
/**
 * Class ProfileType
 *
 * @author jacopo beschi jacopo@jacopobeschi.com
 */
class ProfileField extends \Eloquent
{
    protected $table = "profile_field";

    protected $fillable = ["value", "profile_id", "profile_field_type_id"];

    public function profile_field_type()
    {
        return $this->belongsTo('ProfileFieldType','profile_field_type_id');
    }

    public function user_profile()
    {
        return $this->belongsTo('UserProfile','user_profile_id');
    }
} 