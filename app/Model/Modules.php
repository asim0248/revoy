<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;
use PDO;

class Modules extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_modules';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    
	public static function permissions($slug){
		   
			if(Session::get('admin_role_id')!=1) {
				  
				   $sql_modlue = "SELECT modules_list			
										FROM tbl_role
										LEFT JOIN  admin ON role_id = tbl_role.id
										WHERE  admin .role_id = '". Session::get('admin_role_id')."' ";
				  
				     $result = DB::select($sql_modlue);
					  $result = json_decode(json_encode($result), true);
					 if(count($result)>0){
					 $array_md = json_decode($result[0]['modules_list'],TRUE);
					 }else {
						 $array_md = array();
					 }
					
					if(in_array($slug,$array_md)){
						return TRUE;
					}else {
						return FALSE;
					}
					
			}else {
				return TRUE;
			}
    }
    
 }
