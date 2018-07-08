<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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

class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();
		/* cache control */
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
	}

  public function index(){
		$data['all_published_slider']= $this->common_model->all_published_slider();
		$data['all_published_videos']= $this->common_model->all_published_videos();
		$data['all_published_request_movies']= $this->common_model->all_published_request_movies();
		$data['all_published_tv_series']= $this->common_model->all_published_tv_series();
		$data['all_published_trailers']= $this->common_model->all_published_trailers();
		$data['all_published_genre']= $this->common_model->all_published_genre();
		$data['all_published_country']= $this->common_model->all_published_country();
		$data['title'] = 'Watch Free Movies Online & Tv Shows at JomMovie.com';
		$data['page_name']='home';
		$this->load->view('front_end/index',$data);
	}
  
	public function search(){
		$search = $this->input->post('search');
		$this->load->library("pagination");
		$config = array();
		$config["base_url"] = base_url() . "home/search";
		$config["total_rows"] = $this->common_model->search_movies_record_count($search);
		$config["per_page"] = 24;
		$config["uri_segment"] = 3;
		$config['full_tag_open'] = '<div class="pagination-container text-center"><ul class ="pagination">';
		$config['full_tag_close'] = '</ul></div><!--pagination-->';

		$config['first_link'] = '«';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = '»';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = '&rarr;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&larr;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a><div class="pagination-hvr"></div></li>';

		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '<div class="pagination-hvr"></div></li>';
		$config['suffix']=  '.html';

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data["all_published_videos"] = $this->common_model->fetch_search_videos($config["per_page"], $page,$search);
		$data["links"] = $this->pagination->create_links();
       
		//$data['search_result']= $this->common_model->search_result($search);   
		$data['all_published_genre']= $this->common_model->all_published_genre();
		$data['all_published_country']= $this->common_model->all_published_country();
		$data['total_rows']=$config["total_rows"];
		$data['search_keyword']=$search;
		$data['title'] = $search.'-search results';
		$data['page_name']='search_results.php';
		$this->load->view('front_end/index',$data);
	}
  
    public function movies(){
		$this->load->library("pagination");
    
		$config = array();
		$config["base_url"] = base_url() . "home/movies";
		$config["total_rows"] = $this->common_model->movies_record_count();
		$config["per_page"] = 24;
		$config["uri_segment"] = 3;
	    $config['full_tag_open'] = '<div class="pagination-container text-center"><ul class ="pagination">';
		$config['full_tag_close'] = '</ul></div><!--pagination-->';

		$config['first_link'] = '«';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = '»';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = '&rarr;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&larr;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a><div class="pagination-hvr"></div></li>';

		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '<div class="pagination-hvr"></div></li>';
		// $config['suffix']=  '.html'; 
	

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data["all_published_videos"] = $this->common_model->all_published_videos($config["per_page"], $page);
		$data["links"] = $this->pagination->create_links();
    
		$data['all_published_genre']= $this->common_model->all_published_genre();
		$data['all_published_country']= $this->common_model->all_published_country();
	    $data['total_rows']=$config["total_rows"];
		$data['title'] = 'Free Movies Online at oVoo.Tv';
		$data['page_name']='movies';
		$this->load->view('front_end/index',$data);
	}

	public function tv_series(){
		$this->load->library("pagination");
    
		$config = array();
		$config["base_url"] = base_url() . "home/tv_series";
		$config["total_rows"] = $this->common_model->tv_series_record_count();
		$config["per_page"] = 24;
		$config["uri_segment"] = 3;
		$config['full_tag_open'] = '<div class="pagination-container text-center"><ul class ="pagination">';
		$config['full_tag_close'] = '</ul></div><!--pagination-->';

		$config['first_link'] = '«';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = '»';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = '&rarr;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&larr;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a><div class="pagination-hvr"></div></li>';

		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '<div class="pagination-hvr"></div></li>';
		$config['suffix']=  '.html'; 
  

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data["all_published_videos"] = $this->common_model->fetch_tv_series($config["per_page"], $page);
		$data["links"] = $this->pagination->create_links();
    
		$data['all_published_genre']= $this->common_model->all_published_genre();
		$data['all_published_country']= $this->common_model->all_published_country();
		$data['total_rows']=$config["total_rows"];
		$data['title'] = 'Free Movies Online';
		$data['page_name']='tv_series';
		$this->load->view('front_end/index',$data);
	}

	public function trailers(){
		$this->load->library("pagination");
    
		$config = array();
		$config["base_url"] = base_url() . "home/trailers";
		$config["total_rows"] = $this->common_model->trailers_record_count();
		$config["per_page"] = 24;
		$config["uri_segment"] = 3;
		$config['full_tag_open'] = '<div class="pagination-container text-center"><ul class ="pagination">';
		$config['full_tag_close'] = '</ul></div><!--pagination-->';

		$config['first_link'] = '«';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = '»';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = '&rarr;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&larr;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a><div class="pagination-hvr"></div></li>';

		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '<div class="pagination-hvr"></div></li>';
		$config['suffix']=  '.html'; 
  

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data["all_published_videos"] = $this->common_model->fetch_trailers($config["per_page"], $page);
		$data["links"] = $this->pagination->create_links();
    
		$data['all_published_genre']= $this->common_model->all_published_genre();
		$data['all_published_country']= $this->common_model->all_published_country();
		$data['total_rows']=$config["total_rows"];
		$data['title'] = 'Free Movies Online';
		$data['page_name']='movies';
		$this->load->view('front_end/index',$data);
	}  

	public function request_movies(){

		$this->load->library("pagination");
    
		$config = array();
		$config["base_url"] = base_url() . "home/request_movies";
		$config["total_rows"] = $this->common_model->requested_movie_record_count();
		$config["per_page"] = 24;
		$config["uri_segment"] = 3;
		$config['full_tag_open'] = '<div class="pagination-container text-center"><ul class ="pagination">';
		$config['full_tag_close'] = '</ul></div><!--pagination-->';

		$config['first_link'] = '«';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = '»';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = '&rarr;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&larr;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a><div class="pagination-hvr"></div></li>';

		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '<div class="pagination-hvr"></div></li>';
		$config['suffix']=  '.html'; 
  

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data["all_published_videos"] = $this->common_model->fetch_request_movies($config["per_page"], $page);
		$data["links"] = $this->pagination->create_links();
    
		$data['all_published_genre']= $this->common_model->all_published_genre();
		$data['all_published_country']= $this->common_model->all_published_country();
		$data['total_rows']=$config["total_rows"];
		$data['title'] = 'Free Movies  Request Online';
		$data['page_name']='request_movies';
		$this->load->view('front_end/index',$data);
    }

    public function request_for_movies(){

		$data['all_published_genre']= $this->common_model->all_published_genre();
		$data['all_published_country']= $this->common_model->all_published_country();
		$data['title'] = 'Send Us Movie Request';
		$data['page_name']='requiest_for_movie';
		$this->load->view('front_end/index',$data);
	}

/*
      public function about(){

      $data['all_published_genre']= $this->common_model->all_published_genre();
      $data['all_published_country']= $this->common_model->all_published_country();
      $data['title'] = $this->db->get_where('config' , array('title'=>'about_us_title'))->row()->value;
      $data['page_name']='about';
      $this->load->view('front_end/index',$data);
  }
  */

	public function dmca(){

		$data['all_published_genre']= $this->common_model->all_published_genre();
		$data['all_published_country']= $this->common_model->all_published_country();
		$data['title'] = 'DMCA';
		$data['page_name']='dmca';
		$this->load->view('front_end/index',$data);
	}


  
	public function faq(){

		$data['all_published_genre']= $this->common_model->all_published_genre();
		$data['all_published_country']= $this->common_model->all_published_country();
		$data['title'] = 'FAQ';
		$data['page_name']='faq';
		$this->load->view('front_end/index',$data);
	}
  
  
    public function policy(){

		$data['all_published_genre']= $this->common_model->all_published_genre();
		$data['all_published_country']= $this->common_model->all_published_country();
		$data['title'] = 'Privacy Policy';
		$data['page_name']='policy';
		$this->load->view('front_end/index',$data);
	}
  
  
    public function terms(){

		$data['all_published_genre']= $this->common_model->all_published_genre();
		$data['all_published_country']= $this->common_model->all_published_country();
		$data['title'] = 'Terms & Condition';
		$data['page_name']='terms';
		$this->load->view('front_end/index',$data);
	}
  
  
    public function contact(){

		$data['all_published_genre']= $this->common_model->all_published_genre();
		$data['all_published_country']= $this->common_model->all_published_country();
		$data['title'] = 'Contact Us';
		$data['page_name']='contact';
		$this->load->view('front_end/index',$data);
	}

	function send_message(){
        $response = array();        
        //Ajax database name,username and password request
        $name                   = $_POST["name"];
        $email                   = $_POST["email"]; 
        $message                   = $_POST["message"];
        //$this->email_model->contact_email($name , $email, $message);
        $response['status'] = 'success';        
        //Replying ajax request with validation response
        echo json_encode($response);
    }

    function contact_process(){
    	$name 			= $this->input->post('name');
    	$email 			= $this->input->post('email');
    	$message		= $this->input->post('message');
        $this->form_validation->set_rules('name', 'Name', 'required|min_length[3]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|min_length[8]');
		$this->form_validation->set_rules('message', 'Message', 'required|min_length[8]');
		if ($this->form_validation->run() == FALSE)
        {
        	$this->session->set_flashdata('error', validation_errors());
            redirect(base_url() . 'contact-us.html', 'refresh');
        }
        else
        {
        	$this->load->model('email_model');
        	if($this->email_model->contact_email($name , $email, $message)){
        		//$insert_id = '1043';
        		//$this->email_model->new_movie_notification($insert_id);
        		$this->session->set_flashdata('success', 'Message send successfully.');
    		}else{
    			$this->session->set_flashdata('error', 'Oops! Something went wrong.');	
    	    	redirect(base_url() . 'contact-us.html', 'refresh');
    		}
    	}
    	redirect(base_url() . 'contact-us.html', 'refresh');
    }

    function send_movie_requiest(){
        $response = array();        
        //Ajax database name,username and password request
        $name                   = $_POST["name"];
        $email                   = $_POST["email"];
        $movie_name                   = $_POST["movie_name"];  
        $message                   = $_POST["message"];
        //$this->email_model->contact_email($name , $email, $message);
        $response['status'] = 'success';        
        //Replying ajax request with validation response
        echo json_encode($response);        
                
        
    }



}