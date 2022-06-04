<?php 
class User_detail extends CI_Model {
	public function get_detail($id=false, $clause=false)
	{
		if($clause){$this->db->where($clause);}
		if($id){$this->db->where('admin_id', $id);}
		$q = $this->db->get('admin')->result_array();
		if ( $q !="") {
			return $q;
		} else {
			return FALSE;
		}
	}
	public function get_user_by_id($id){
		$detail = $this->db->where('id',$id)->get('m_user')->result_array();
		return $detail;
	}
	public function push_detail($data)
	{
		$insert_data = array(
		'name' => $data['name'],
		'username' => $data['name'],
		'phone' =>  $data['phone'],
		'address' =>  $data['address'],
		'reg_no' =>  $data['tin_no'],
		'email' => $data['email']
		);
		$this->db->where('id', $data['id']);
		$res = $this->db->update('m_user', $insert_data);
		return $res; 
	}
	public function chanege_pass($data)
	{
		$insert_data = array(
		'password' => md5($data['password'])
		);
		$this->db->where('id', $data['id']);
		$res = $this->db->update('m_user', $insert_data);
		return $res; 
	}
	public function insert_detail($data)
	{
		$this->db->insert('m_user', $data);
		return TRUE;
	}
	public function get_user_list()
	{
		$detail = $this->db->where('status <>','2')->get('m_user')->result_array();
		return $detail;
	}
	public function cheak_user($data)
	{
		$detail = $this->db->or_where($data)->get('m_user')->result_array();
		return $detail;
	}
	
}