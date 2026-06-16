<?php namespace App\Model;



use Illuminate\Database\Eloquent\Model;

use DB;

use PDO;

class Subscribe extends Model

{

    /**

     * The database table used by the model.

     *

     * @var string

     */

    protected $table = 'tbl_subscribe';

    //public $timestamps = false;

	

	/*

      |--------------------------------------------------------------------------

      | function to find value by key 

      |--------------------------------------------------------------------------

     */

    public static function findByEmail($key){

       

       $result=DB::select( DB::raw("SELECT *			

			FROM

				tbl_subscribe

			WHERE

				  email = '".$key."' 

			") );

         $result = json_decode(json_encode($result), true);

		return $result;

    }

    

    

}

