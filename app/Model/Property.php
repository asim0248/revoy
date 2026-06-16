<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use PDO;
class Property extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_property';
   
	public function agent()
    {
        return $this->belongsTo(Agents::class, 'user_id');
    }
	
	public function assestant_agent()
    {
        return $this->belongsTo(Agents::class, 'assestant_user_id');
    }
	
	public function property_option()
    {
        return $this->belongsTo(Propertyoptions::class, 'category_id');
    }
	
	public function property_type()
    {
        return $this->belongsTo(Propertytypes::class, 'property_type_id');
    }
	
	public function property_authory()
    {
        return $this->belongsTo(Propertyauthority::class, 'property_authority');
    }
	
	public function property_state()
    {
        return $this->belongsTo(States::class, 'state_id');
    }
	
    public function package()
    {
        return $this->belongsTo(Plans::class, 'package_id');
    }
	
	public static function GetSectionListing(){
      
       $result=DB::select( DB::raw("SELECT p.*,tbl_users.name as user_name,tbl_users.id as user_id,tbl_users.phone as user_phone,tbl_property_option.name as category			
			FROM
				tbl_property as p
				LEFT JOIN tbl_users ON tbl_users.id = p.user_id
				LEFT JOIN tbl_property_option ON tbl_property_option.id = p.category_id
			WHERE
				  p.admin_status = 'Yes' AND p.status = 'Yes' AND p.is_featured='Yes' AND tbl_users.status = 'Yes'
			") );
        $result = json_decode(json_encode($result), true);
		return $result ;
    }
	
	
	public static function get_total_by_state($sid){
      
	   $q = "SELECT count(id) as total			
			FROM
				tbl_property 
			WHERE
				  admin_status = 'Yes' AND status = 'Yes' AND state_id = ".$sid." ";
	   
        $result = DB::select( DB::raw($q) );
        $result = json_decode(json_encode($result), true);
		
		return $result[0]['total'] ;
    }
	
}
