<?php
class Admin_composition extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('admin_detail');
		$this->load->model('api_model');
		$this->load->model('login_cheak_model');
		ini_set('max_execution_time', 0); 
		ini_set('memory_limit','2048M');
		if(!$this->session->userdata("user_id")){
	        redirect('');	    
		}
	}
    public function index(){
        $this->load->view('admin/layouts/admin_nav');
		$this->load->view('admin/layouts/admin_header');
		$this->load->view('admin/composition');
		$this->load->view('admin/layouts/admin_footer');
    }
    public function composition_add(){
        if(isset($_REQUEST['submit'])){
            $data['name'] = $this->input->get_post('name');
			$data['unit'] = $this->input->get_post('rate_unit');
			$this->form_validation->set_rules('name','Please Enter Composition Name','required|trim');
			$this->form_validation->set_rules('rate_unit','Please Select Unit','required');
			if($this->form_validation->run('add_bank')){
                if($this->api_model->submit('feed_composition', $data)){
					$this->session->set_flashdata('add_bank','Your Composition is Added.');
					redirect(base_url().'admin_composition');
				}else{
					$this->session->set_flashdata('add_bank','Database Error.');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/composition_add');
					$this->load->view('admin/layouts/admin_footer');
				}
            }else{
                $this->load->view('admin/layouts/admin_nav');
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/composition_add');
                $this->load->view('admin/layouts/admin_footer');
            }
        }else{
            $this->load->view('admin/layouts/admin_nav');
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/composition_add');
            $this->load->view('admin/layouts/admin_footer');
        }
    }
    public function edit($id){
        $feed_data['data'] = $this->api_model->get_data('id = '.$id.'','feed_composition');
        if(isset($_REQUEST['submit'])){
            $data['name'] = $this->input->get_post('name');
			$data['unit'] = $this->input->get_post('rate_unit');
			$this->form_validation->set_rules('name','Please Enter Composition Name','required|trim');
			$this->form_validation->set_rules('rate_unit','Please Select Unit','required');
			if($this->form_validation->run('add_bank')){
                if($this->api_model->get_data_update('id = '.$id.'','feed_composition', $data)){
					$this->session->set_flashdata('add_bank','Your Composition is Added.');
					redirect(base_url().'admin_composition');
				}else{
					$this->session->set_flashdata('add_bank','Database Error.');
					$this->load->view('admin/layouts/admin_nav');
					$this->load->view('admin/layouts/admin_header');
					$this->load->view('admin/composition_edit', $feed_data);
					$this->load->view('admin/layouts/admin_footer');
				}
            }else{
                $this->load->view('admin/layouts/admin_nav');
                $this->load->view('admin/layouts/admin_header');
                $this->load->view('admin/composition_edit', $feed_data);
                $this->load->view('admin/layouts/admin_footer');
            }
        }else{

            $this->load->view('admin/layouts/admin_nav');
            $this->load->view('admin/layouts/admin_header');
            $this->load->view('admin/composition_edit', $feed_data);
            $this->load->view('admin/layouts/admin_footer');
        }
    }
    public function composition_search(){
        $name =  $this->input->get('name');
		$start = $this->input->get_post('start');
		$perpage = 10;
        $where = '';
        if($name != ''){
            $where = 'name like = "%'.$name.'% "';
        }
		$detail = $this->api_model->get_data($where , 'feed_composition', '', 'id, name, (select name from unit where feed_composition.unit = id) as unit, isactive', $start, $perpage);
		$detail['count'] = $this->api_model->get_data($where , 'feed_composition', '', 'count(*) as count');
		if($detail)
		{
			$json_data = $detail;
		}
		else
		{
			$json_data['error'] = '1';
		}
		echo json_encode($json_data);
    }
    public function composition_status(){
        $id = $this->input->get_post('id');
        $name =  $this->input->get_post('name');
		$start = $this->input->get_post('start');
        $data['isactive'] = $this->input->get_post('status');
		$perpage = 10;
        $where = '';
        if($name != ''){
            $where = 'name like = "%'.$name.'% "';
        }
        if($this->api_model->get_data_update('id = '.$id.'', 'feed_composition', $data)){
            $detail = $this->api_model->get_data($where , 'feed_composition', '', 'id, name, (select name from unit where feed_composition.unit = id) as unit, isactive', $start, $perpage);
            $detail['count'] = $this->api_model->get_data($where , 'feed_composition', '', 'count(*) as count');
            if($detail)
            {
                $json_data = $detail;
            }
            else
            {
                $json_data['error'] = '1';
            }
            echo json_encode($json_data);
        }
    }
}