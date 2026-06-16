<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;
use PDO;

class Quicklinks extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_quick_links';
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
				tbl_quick_links
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
	
	/*
      |--------------------------------------------------------------------------
      | function detail
      |--------------------------------------------------------------------------
     */
    public static function fillCombo($intValue = 0){
		$get_options = Quicklinks::get_cat_selectlist(0,0);
		$cmbo = '';
		$options = '';
        $cmbo .= '<select name="pid" id="pid" class="form-control">';
		$cmbo .='<option value="0">-- None-- </option>';
		$get_options = Quicklinks::get_cat_selectlist(0,0);
		if (is_array($get_options) && count($get_options) > 0) {
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
	
	 public static function get_cat_selectlist($current_cat_id,$count){
		    static $option_results;
			$add = '';
			$indent_flag = '';
			if (!isset($current_cat_id)) {
				$current_cat_id =0;
			}
			$count = $count+1;
			
			
	  
       $get_options = DB::select( DB::raw("SELECT *			
			FROM
				tbl_quick_links
			WHERE
				  pid = '".$current_cat_id."' 
			") );
       
	    $get_options = json_decode(json_encode($get_options), true);
		
		$num_options = count($get_options);
		if ($num_options > 0) {
			foreach ($get_options as $rows) { 
				$cat_id   = $rows['id'];
				$cat_name = $rows['name'];
				if ($current_cat_id!=0) {
 					for ($x=2; $x<=$count; $x++) {
						$indent_flag .=  '>';
	 				}
				}
				
				if ($current_cat_id!=0) {
					
					$row_level = DB::select( DB::raw("SELECT *			
									FROM
										tbl_quick_links
									WHERE
										  id = '".$current_cat_id."' 
									") );
									
					$add = $row_level[0]->name."> ";				
					
				}
				$cat_name = $add." ".$cat_name;
				$option_results[$cat_id] = $cat_name;
				Quicklinks::get_cat_selectlist($cat_id, $count);
			}
		}
			
		return $option_results;	
	 }
	
	
	
    
    
 }
