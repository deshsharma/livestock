<?php
class About extends CI_Controller {
	public function __construct() {
        parent::__construct();
        // load email lib
        $this->load->library('email');
		$this->load->library('form_validation');
		$this->load->library('session');
    }
    public function index(){
        $active['active'] = 'about';
        $this->load->view('layout/header', $active);
        $this->load->view('about');
		$this->load->view('blog');
        $this->load->view('layout/footer');
    }
	
	 public function treatment(){
        $active['active'] = 'serve';
        $this->load->view('layout/header', $active);
        $this->load->view('treatment');
		 $this->load->view('blog');
        $this->load->view('layout/footer');
    }
	
		public function insemination(){
            $active['active'] = 'serve';
        $this->load->view('layout/header', $active);
        $this->load->view('insemination');
		$this->load->view('blog');
        $this->load->view('layout/footer');
    }
	
		 public function semen(){
            $active['active'] = 'serve';
        $this->load->view('layout/header', $active);
        $this->load->view('semen');
		 $this->load->view('blog');
        $this->load->view('layout/footer');
    }
    
    public function semen_detail(){
        $active['active'] = 'serve';
        $this->load->view('layout/header', $active);
        $this->load->view('semen_detail.php');
		 $this->load->view('blog');
        $this->load->view('layout/footer');
    }
			 public function nutrition_consultancy(){
                $active['active'] = 'serve';
        $this->load->view('layout/header', $active);
        $this->load->view('nutrition_consultancy');
		 $this->load->view('blog');
        $this->load->view('layout/footer');
    }
	
			 public function farm_management(){
                $active['active'] = 'serve';
        $this->load->view('layout/header', $active);
        $this->load->view('farm_management');
		 $this->load->view('blog');
        $this->load->view('layout/footer');
    }
	

	public function contact(){
        $this->load->view('layout/header');
        $this->load->view('contact');
		// $this->load->view('blog');
        $this->load->view('layout/footer');
    }

    public function privacy_policy(){
        $this->load->view('layout/header');
        $this->load->view('privacy_policy');
		// $this->load->view('blog');
        $this->load->view('layout/footer');
    }
	
	 // send information
    public function send() {
        
        // field name, error message, validation rules
        $this->form_validation->set_rules('name', 'Name', 'trim|required');     
        $this->form_validation->set_rules('email', 'Your Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('contact_no', 'Phone', 'trim|required');
        $this->form_validation->set_rules('comment', 'message', 'trim|required');
		
 	  
        if($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msg', validation_errors());
         redirect('/contact');
        } else {        
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $contact_no = $this->input->post('contact_no');
            $comment = $this->input->post('comment');            
            if(!empty($email)) {
                // send mail
                $config = array (
                  'mailtype' => 'html',
                  'charset'  => 'utf-8',
                  'priority' => '1'
                );
                
                $message = '<p style="font-size:14px;font-weight:normal;margin-bottom:10px;margin-top:0;">Livestoc Contact page enquiry
				</p><p style="font-size:14px;font-weight:normal;margin-bottom:10px;margin-top:0;">Name:'.$name.',
				</p><p style="font-size:14px;font-weight:normal;margin-bottom:10px;margin-top:0;">Contact_no:'.$contact_no.',
				</p><p style="font-size:14px;font-weight:normal;margin-bottom:10px;margin-top:0;">Message:'.$comment.'
				</p>';   
                
                $this->email->initialize($config);
                $this->email->from($email, $name);
                $this->email->to("support@livestoc.com");
                $this->email->subject('Contact Form');
                //$message = $this->load->view('mailTemplate/contactForm', $dataMail, TRUE);
                $this->email->message($message);
                $this->email->send();
 
                // confirm mail
                $bodyMsg = '<p style="font-size:14px;font-weight:normal;margin-bottom:10px;margin-top:0;">Thank you for contacting Livestoc.Our Tean will contact you soon.</p>';                 
                
 
                $this->email->initialize($config);
                $this->email->from("amazebrandlance@gmail.com", 'Livestoc');
                $this->email->to($email);
                $this->email->subject('Contact Form Confimation');
                $this->email->message($bodyMsg);
                $this->email->send();                
            }
            $this->session->set_flashdata('msg', 'Thank you for your message. It has been sent.');
            redirect('/contact');
        }
    }
}
