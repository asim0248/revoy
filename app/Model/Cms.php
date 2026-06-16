<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;
use PDO;

class Cms extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_cms';
    protected $primaryKey = 'id';
    
    
    
    /*
      |--------------------------------------------------------------------------
      | function to get all 
      |--------------------------------------------------------------------------
     */
    public static function findAll($id){
      
       $result=DB::select( DB::raw("SELECT *			
			FROM
				tbl_cms
			WHERE
				  status = 'Yes' and id !=".$id." 
			") );
        $result = json_decode(json_encode($result), true);
		return $result;
    }
	/*
      |--------------------------------------------------------------------------
      | function to get all 
      |--------------------------------------------------------------------------
     */
	public static function fillComboCMS($intValue = 0) {
		$cmbo = '<select name="p_id" id="p_id" class="form-control">';
		$cmbo .='<option value="0">-- None-- </option>';
		$get_options = self::get_cat_selectlist(0,0);
		$options = '';
		if (count($get_options) > 0) {
			$categories = $intValue;
			foreach ($get_options as $key => $value) {
				$options .="<option value=\"$key\"";
					if ($intValue == "$key") {
						$options .=" selected=\"selected\"";
					}
				$options .=">$value</option>\n";
			}
		}
		$cmbo .= $options;
		$cmbo .='</select>';
		return $cmbo;
	}
	
	public static function get_cat_selectlist($current_cat_id,$count) {
		static $option_results;
		if (!isset($current_cat_id)) {
			$current_cat_id =0;
		}
		$count = $count+1;
		$indent_flag = '';
		$sql =  'SELECT id, name from tbl_cms  where    p_id =  '.$current_cat_id.'  ORDER BY id';
 		
        $result = DB::select( DB::raw($sql) );
		
        $result = json_decode(json_encode($result), true);
		if(count($result)>0){
			foreach ($result as $parent) {
					$cat_id   = $parent['id'];
					$cat_name = $parent['name'];
					if ($current_cat_id!=0) {
						for ($x=2; $x<=$count; $x++) {
							$indent_flag .=  '>';
						}
					}
					$add = '';
					if ($current_cat_id!=0) {
						$sql_level = 'SELECT * from tbl_cms  where   id  =  '.$current_cat_id;
						
						$row_level = DB::select( DB::raw($sql_level) );
						$row_level = json_decode(json_encode($row_level), true);
						
						$add = $row_level[0]['name']." -> ";
					}
					$cat_name = $add." ".$cat_name;
					$option_results[$cat_id] = $cat_name;
					self::get_cat_selectlist($cat_id, $count);
					
					
			}
		}
		return $option_results;
	}
    
    
    
 }
