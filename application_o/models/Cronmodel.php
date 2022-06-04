<?php
class Cronmodel extends CI_Model {
	public function seller(){
		$data = $this->db->query('select pl.purchase_id, cl.animal_id, cl.package_id, cl.created_on, pm.package_name, pm.package_days, ani.animal_purpose from package_users_log as pl, calllog as cl, package_masters as pm, animals as ani where pl.purchase_id = cl.purchase_id AND cl.purchase_id <> 0 AND cl.package_id = pm.package_id AND cl.package_type_id=2 AND cl.animal_id= ani.animal_id AND ani.animal_purpose = "2"')->result_array();
		foreach($data as $da){
			//echo $da['created_on'];
			$date = date('Y-m-d h:i:s',strtotime('+30 days',strtotime(str_replace('/', '-', $da['created_on'])))) . PHP_EOL;
			if($date < date('Y-m-d h:i:s'))
			$this->db->query("update animals set animal_purpose='0' WHERE `animal_id`='" .$da['animal_id'] . "'");
		}
	}
}