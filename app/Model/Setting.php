<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use PDO;
class Setting extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_settings';
    public $timestamps = false;
	
	/*
      |--------------------------------------------------------------------------
      | function to find value by key 
      |--------------------------------------------------------------------------
     */
    public static function findByKey($key){
       
       $result =DB::select( DB::raw("SELECT key_value			
			FROM
				tbl_settings
			WHERE
				  key_name = '".$key."' 
			") );
			
		//echo '<pre>'; print_r($result); exit;	
       
		return $result[0]->key_value;
    }
    
    
}
