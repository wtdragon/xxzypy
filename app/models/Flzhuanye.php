<?php
use Nicolaslopezj\Searchable\SearchableTrait;
class Flzhuanye extends \Eloquent {
	protected $fillable = [];
	protected $table = 'flzhuanye';  
	public function yjfl(){
    return $this->belongsTo('Yierjifl','yjfldm');
    }
	public function xkfl(){
    return $this->belongsTo('Yierjifl','xkfldm');
    }
	protected $searchable = [
        'columns' => [
            'zymc' => 10,
        ],
    ];
}