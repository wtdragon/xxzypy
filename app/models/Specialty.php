<?php
use Nicolaslopezj\Searchable\SearchableTrait;
class Specialty extends \Eloquent {
	protected $fillable = [];
	protected $primaryKey = 'scid';
	public function college(){
    return $this->belongsTo('College','collegeID');
    }
	use SearchableTrait;
	protected $searchable = [
        'columns' => [
            'name' => 10,
        ],
    ];
	
}