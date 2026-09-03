<?php namespace App\Model;



use Illuminate\Database\Eloquent\Model;

use Session;

use DB;

use Auth;

use PDO;

use Redirect;

class Agents extends Model

{

    /**

     * The database table used by the model.

     *

     * @var string

     */

    protected $table = 'tbl_users';

    protected $primaryKey = 'id';

	

	

	/*

      |--------------------------------------------------------------------------

      | function detail

      |--------------------------------------------------------------------------

     */

    public static function get_code(){
       $result=DB::select( DB::raw("SELECT count(id) as total 			

			FROM

				tbl_users

			WHERE

				   role_id = 1
			") );

        $result = json_decode(json_encode($result), true);

		$number = $result[0]['total']+2;

		$number = 'Revoy'.str_pad($number, 5, '0', STR_PAD_LEFT);;

		

		return $number;

		

    }

	

	public static function get_invoice_number($id){

      

       

		$number = 'PPP_INV_'.str_pad($id, 5, '0', STR_PAD_LEFT);;

		return $number;

		

    }
	
	
	public static function get_user_id($user_id){
		$q = "SELECT id,role_id,agency_id 			

			FROM

				tbl_users

			WHERE

				   id = ".$user_id."
			";
		$result=DB::select( DB::raw($q) );

        $result = json_decode(json_encode($result), true);
      	$result = $result[0];
		if($result['agency_id']!=0){
			return $user_id;
		}else {
			$users[] = $user_id;
				 $q = "SELECT id,role_id,agency_id 			
	
				FROM
	
					tbl_users
	
				WHERE
	
					   agency_id = ".$result['id']."
				";
			$result = DB::select( DB::raw($q) );
	
			$result = json_decode(json_encode($result), true);
			if(count($result)>0){
				foreach ($result as $row){
					$users[] = $row['id'];
				}
			}
			
			$user_ids = implode(',',$users);
			return $user_ids;
		}
		
		

    }
	
	
	public function agent()
    {
        return $this->belongsTo(Agents::class, 'parent_agent_id');
    }
	

     public static function logout() {

        Session::forget('user_id');

        Session::forget('user_name');
		Session::forget('user_role_id');
		Session::forget('user_agency_id');

       

    }

}

