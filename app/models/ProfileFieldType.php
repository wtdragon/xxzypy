<?php   

/**
 * Class ProfileTypeField
 *
 * @author jacopo beschi jacopo@jacopobeschi.com
 */
class ProfileFieldType extends \Eloquent
{
    protected $table = "profile_field_type";

    protected $fillable = ["description"];

    public function profile_field()
    {
        return $this->hasMany('ProfileField');
    }
} 