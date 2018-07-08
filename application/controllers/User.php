<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


/**
 * Ovoo-Movie & Video Stremaing CMS Pro
 * ----------------------------- OVOO -----------------------------
 * -------------- Movie & Video Stremaing CMS Pro -----------------
 * -------- Professional video content management system ----------
 *
 * @package     OVOO-Movie & Video Stremaing CMS Pro
 * @author      Abdul Mannan/Spa Green Creative
 * @copyright   Copyright (c) 2014 - 2017 SpaGreen,
 * @license     http://codecanyon.net/wiki/support/legal-terms/licensing-terms/ 
 * @link        http://www.spagreen.net
 * @link        support@spagreen.net
 *
 **/



class User extends CI_Controller{   
    
	function __construct(){
			parent::__construct();
            $this->load->model('common_model');
            $this->load->library('user_agent');
			$this->load->database();
		
       		/*cache controling*/
			$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
            $this->output->set_header('Pragma: no-cache');
            $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	}
    
    // index function
    public function index() {
        if ($this->session->userdata('login_status') == 1)
            redirect(base_url() . 'user/profile', 'refresh');
        if ($this->session->userdata('login_status') != 1)
            redirect(base_url() . 'user/login', 'refresh');
    }

    // login function
    public function login() {
        if ($this->session->userdata('login_status') == 1)
            redirect(base_url() . 'user/profile', 'refresh');
        $data['page_name']      = 'login';
        $data['title']     = 'Login | Signup';
        $this->session->set_userdata('referred_from', $this->agent->referrer());
        $this->load->view('front_end/index', $data);
    }

    // logout function
    function logout() {
        $this->session->unset_userdata('');
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(base_url() , 'refresh');
    }
    // signup function
    function signup($param1='', $param2='')  {
        if ($param1 == 'do_signup') {
            $name               = $this->input->post('name');
            $username               = $this->input->post('username');
            $email                  = $this->input->post('email');
            $password               = $this->input->post('password');
            $password2               = $this->input->post('password2');
            $data['name']           = $name;
            $data['email']          = $email;
            $data['username']       = $username;
            $data['password']       = md5($password );
            $data['role']           = 'subscriber';
            $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]');
            $this->form_validation->set_rules('username', 'Username', 'required|min_length[3]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');
            $this->form_validation->set_rules('password2', 'Confirm Password', 'required|matches[password]|min_length[4]');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('error', validation_errors());
                redirect(base_url() . 'user/login', 'refresh');
            }
            else
            {
                $user_exist             = $this->common_model->check_email_username($username,$email);
                if($user_exist){
                    $this->session->set_flashdata('error', 'Signup fail.username or email is already exist on system');
                    
                }else{
                    $data['join_date']       = date('Y-m-d H:i:s');
                    $data['last_login']       = date('Y-m-d H:i:s');
                    $this->db->insert('user', $data);
                    $this->load->model('email_model');
                    $this->email_model->account_opening_email($username, $email, $password);
                    $this->session->set_flashdata('success', 'Signup successfully.now you can login to system');                    
                    redirect(base_url() . 'user/login', 'refresh');
                }

            }                       
        }
        redirect(base_url() . 'user/login', 'refresh');
    }

    // forget password function
    function forget_password($param1='', $param2='') {
        if ($param1 == 'do_reset') {           
            $email                  = $this->input->post('email');            
            $user_exist             = $this->common_model->check_email($email);
            //var_dump($user_exist , $email);
            if($user_exist){ 
                $token = bin2hex(openssl_random_pseudo_bytes(16));               
                $data['token'] = $token;
                $this->db->where('email',$email);
                $this->db->update('user',$data);
                $this->load->model('email_model');
                $this->email_model->password_reset_email($email, $token);
                $this->session->set_flashdata('success', 'Please Check Your Email to Complete Password Reset.');
                redirect(base_url() . 'user/forget_password', 'refresh');                
            }else{
            $this->session->set_flashdata('error', 'Email not found on our system');            
            redirect(base_url() . 'user/forget_password', 'refresh');
            }         
            
        }
        $data['page_name']      = 'forget_password';
        $data['title']     = 'Password Recovery';        
        $this->load->view('front_end/index', $data);
        //redirect(base_url() . 'login', 'refresh');

    }
    // complete password reset function
    function complete_reset($param1='', $param2='') {
        if ($param1 == 'save') {

            $token                      = $this->input->post('token');
            $password                   = $this->input->post('password');
            $password2                  = $this->input->post('password2');
            $email                      = $this->db->get_where('user' , array('token' => $token))->row()->email;
            $this->form_validation->set_rules('token', 'token', 'required|min_length[3]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');
            $this->form_validation->set_rules('password2', 'Confirm Password', 'required|matches[password]|min_length[4]');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('error', validation_errors());
                redirect(base_url() . 'user/complete_reset?token='.$token, 'refresh'); 
            }

            else{
                $data['token']      = '';
                $data['password']   = md5($password);
                $this->db->where('token', $token);
                $this->db->update('user', $data);
                $this->load->model('email_model');
                $this->email_model->password_reset_confirmation($email);
                $this->session->set_flashdata('login_success', 'Password Changed');
                redirect(base_url() . 'user/login', 'refresh');
            }

        }
            $token                  = $this->input->get('token');
            if(isset($token) && $token !=''){
                $token_exist             = $this->common_model->check_token($token);
                if($token_exist){                               
                $data['token'] = $token;
                $data['page_name']      = 'new_password';
                $data['title']     = 'New Password';        
                $this->load->view('front_end/index', $data);
                }else{
                $this->session->set_flashdata('error', 'Invalid token..');
                redirect(base_url() . 'user/forget_password', 'refresh');
                }
            }else{
                $this->session->set_flashdata('error', 'Invalid token..');
                redirect(base_url() . 'user/forget_password', 'refresh');
            }
            //$this->session->set_flashdata('error', 'Invalid token..');
            //redirect(base_url() . 'login/forget_password', 'refresh');
            
        }

    

    
    // validate login  function
    function validate_login($username   =   '' , $password   =  ''){
         $credential    =   array(  'username' => $username , 'password' => $password );        
         
         // Checking login credential for admin
        $query = $this->db->get_where('user' , $credential);
        $row = $query->row();
        if ($query->num_rows() > 0) {
            $this->session->set_userdata('login_status', '1');
            $this->session->set_userdata('user_id', $row->user_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('username', $row->username);                     
            $this->db->where('user_id', $row->user_id);
            $this->db->update('user', array(
                'last_login' => date('Y-m-d H:i:s')
            )); 
            if($row->role=='admin'){
              $this->session->set_userdata('admin_is_login', '1');
              $this->session->set_userdata('login_type', 'admin');
            }
            if($row->role=='subscriber'){
              $this->session->set_userdata('user_is_login', '1');
              $this->session->set_userdata('login_type', 'subscriber');
            }
              return 'success';
        }
        
        return 'invalid';       
    }

    
    // dashboard function
    function dashboard(){
        if ($this->session->userdata('user_is_login') != 1)
            redirect(base_url(), 'refresh');
        	/* start menu active/inactive section*/
        	$this->session->unset_userdata('active_menu');
        	$this->session->set_userdata('active_menu', '1');
        	/* end menu active/inactive section*/
        	$data['page_name']             = 'dashboard';
        	$data['page_title']            = 'User Dashboard';
        	$this->load->view('user/index', $data);
    }
    // manage profile function
    function manage_profile(){
    	if ($this->session->userdata('user_is_login') != 1)
            redirect(base_url(), 'refresh');
            /* start menu active/inactive section*/
            $this->session->unset_userdata('active_menu');
            $this->session->set_userdata('active_menu', '12');
            /* end menu active/inactive section*/
            $data['page_name']      = 'manage_profile';
            $data['page_title']     = 'Update profile information';
            $data['profile_info']   = $this->db->get_where('user', array(
            'user_id' => $this->session->userdata('user_id')))->result_array();
            $this->load->view('user/index', $data);
    }

    // profile function
    function profile($param1 = '', $param2 = ''){
            $user_id=$this->session->userdata('user_id');
        if ($this->session->userdata('login_status') != 1)
            redirect(base_url() . 'login', 'refresh');
        if ($param1 == 'update') {
            $data['name']  = $this->input->post('name');
            $data['gender'] = $this->input->post('gender');             
            $this->db->where('user_id', $user_id);
            $this->db->update('user', $data);
            move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/user_image/' .$user_id.'.jpg');            
            $this->session->set_flashdata('success', 'Profile information updated.');
            redirect(base_url() . 'user/update_profile/', 'refresh');
        }
            $data['page_name']      = 'profile';
            $data['title']     = 'Manage Profile';
            $data['profile_info']   = $this->db->get_where('user', array(
            'user_id' => $this->session->userdata('user_id')))->row();
            $this->load->view('front_end/index', $data);

    }
    // update profile function
    function update_profile($param1 = '', $param2 = ''){
            $user_id=$this->session->userdata('user_id');
        if ($this->session->userdata('login_status') != 1)
            redirect(base_url() . 'login', 'refresh');        
            $data['page_name']      = 'update_profile';
            $data['title']     = 'Update Profile';
            $data['profile_info']   = $this->db->get_where('user', array(
            'user_id' => $this->session->userdata('user_id')))->row();
            $this->load->view('front_end/index', $data);

    }
    // password change function
    function change_password($param1 = '', $param2 = ''){
        $user_id=$this->session->userdata('user_id');
        if ($this->session->userdata('login_status') != 1)
            redirect(base_url() . 'login', 'refresh');
        if ($param1 == 'update') {
            $password               = md5($this->input->post('password'));
            $new_password           = md5($this->input->post('new_password'));
            $retype_new_password    = md5($this->input->post('retype_new_password'));
            
            $current_password       = $this->db->get_where('user', array(
                'user_id' => $this->session->userdata('user_id')
            ))->row()->password;
            
            if ($current_password == $password && $new_password == $retype_new_password) {
                $this->db->where('user_id', $this->session->userdata('user_id'));
                $this->db->update('user', array(
                    'password' => $new_password
                ));
                $this->session->set_flashdata('success', 'Password changed.');
            }
            elseif ($current_password !=$password ){
                $this->session->set_flashdata('error', 'Old password not correct.');

            } else {
                $this->session->set_flashdata('error', 'Password not match.');
            }
            redirect(base_url() . 'user/change_password/', 'refresh');        
        }

            $data['page_name']      = 'change_password';
            $data['title']     = 'Change Password';
            $data['profile_info']   = $this->db->get_where('user', array(
            'user_id' => $this->session->userdata('user_id')))->row();
            $this->load->view('front_end/index', $data);
    }
    // login function
    function do_login(){
        
        //Ajax username and password request
        $username                       = $this->input->post('username');
        $password                       = md5($this->input->post('password'));
        $referred_url = $this->session->userdata('referred_from');
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[1]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[1]');
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('login_error', validation_errors());
            redirect(base_url() . 'user/login', 'refresh');
        }
        else
        {            
            $login_status   = $this->validate_login( $username ,  $password);
            $this->session->unset_userdata('referred_from');
            if ($login_status == 'success') {
                if($this->session->userdata('admin_is_login')==1)
                redirect(base_url() . 'admin/dashboard', 'refresh');
            redirect($referred_url);
            // redirect(base_url() . 'user/profile', 'refresh');
            }else{
                $this->session->set_flashdata('login_error', 'Username & password not match..');
                redirect(base_url() . 'user/login', 'refresh');
            }            
        }        
    }



    function subscribe(){
        $response = array();        
        //Ajax database name,username and password request
        $email                   = $_POST["email"];
        $name                   = $_POST["name"];       
        $response['submitted_data'] = $_POST;
        $subscribe_status = $this->add_subscriber($name,$email);
        $response['subscribe_status'] = $subscribe_status; 
        
        //Replying ajax request with validation response
        echo json_encode($response);
    }

    function add_subscriber($name="", $email=""){
    $query = $this->db->get_where('user' , array('email' => $email));
        if ($query->num_rows() < 1) {
            $data['name']           = $name;
            $data['username']       = $email;
            $data['password']       = md5($email);
            $data['email']          = $email;
            $data['email']          = $email;
            $data['role']           = 'subscriber';
            $data['join_date']      = date('Y-m-d H:i:s');
            $data['last_login']     = date('Y-m-d H:i:s');             
            $this->db->insert('user', $data);
            $this->load->model('email_model');
            if($this->email_model->send_confirmation_to_subscriber($email)){
            return 'success';
            }else{
               return 'error'; 
            }
        }
        else if ($query->num_rows() > 0) {
            return 'exist';
        }
        else{
            return 'error';
        }
    }

}
    
