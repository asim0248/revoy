<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;
use Auth;
use PDO;
use Redirect;
class Admins extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'admin';
    
    public $timestamps = false;
    
    protected $primaryKey = 'id';
    
    /*
      |--------------------------------------------------------------------------
      | function to remove session data
      |--------------------------------------------------------------------------
     */
    
    public static function logout() {
        Session::forget('admin_id');
        Session::forget('admin_name');
       
    }
    
    
    
}
