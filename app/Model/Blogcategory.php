<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;
use PDO;

class Blogcategory extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_blog_category';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
   
	/*
      |--------------------------------------------------------------------------
      | function detail
      |--------------------------------------------------------------------------
     */
    public static function findDetail($find,$id){
      
       $result=DB::select( DB::raw("SELECT ".$find."			
			FROM
				tbl_blog_category
			WHERE
				  id = '".$id."' 
			") );
       $result = json_decode(json_encode($result), true);
		if(count($result)>0){
		return ($find=='*')?$result: $result[0][$find];
		}else {
			return '';
		}
    }
	
    
    
 }
