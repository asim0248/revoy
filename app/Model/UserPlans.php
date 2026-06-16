<?php namespace App\Model;



use Illuminate\Database\Eloquent\Model;

use Session;

use DB;

use Auth;

use PDO;

use Redirect;

class UserPlans extends Model

{

    /**

     * The database table used by the model.

     *

     * @var string

     */

    protected $table = 'tbl_user_packages';

    protected $primaryKey = 'id';

	

	

	

}

