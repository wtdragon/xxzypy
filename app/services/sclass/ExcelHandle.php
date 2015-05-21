<?php

namespace App\Services\Sclass;

class ExcelHandle extends \Eloquent{
/**
	 * array foreach function to array
	 */	
public static function arr_foreach ($arr) {
    static $str;
    if (!is_array ($arr)) {
    return false;
    }
    foreach ($arr as $key => $val ) {
 
        if (is_array ($val)) {
              return array_map(array($this, 'arr_foreach'), $val);
        } else {
 
            $str[] = $val;
        }
    }
  return $str;
}
	public function getContentDataAttribute($data)
{
    return json_decode($data);
}

/**
	 * Display a listing of the resource.
	 * GET /college/articles
	 *
	 * @return Response
	 */
	    /**
	 * json数组循环得到其中值
	 * get data from ktest
	 *
	 * @return Response
	 */
	public function ktest_dejson($jarr)
	{
		// 
		$data=json_decode($jarr);
        $i=0;
        foreach ( $data as $unit )
         {
          $i++;
          $arr[$i]['majors']=$unit->Majors;
          $arr[$i]['careers']=$unit->Careers;

         }
   return $arr;
	}
	
public	 function objectToArray($d) {
 if (is_object($d)) {
 // Gets the properties of the given object
 // with get_object_vars function
 $d = get_object_vars($d);
 }
 
 if (is_array($d)) {
 /*
 * Return array converted to object
 * Using __FUNCTIfON__ (Magic constant)
 * for recursive call
 */
  return array_map(array($this, 'objectToArray'), $d);
 }
 else {
 // Return array
 return $d;
 }
 }
	 
}
