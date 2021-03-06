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

 
class Page extends CI_Controller{
    
    public function index($slug=''){
    	if ($slug=='') {
    		redirect('error');
    	}
        $data['page_details']= $this->common_model->get_page_details_by_slug($slug);
        $data['title'] = $data['page_details']->page_title;
        $data['focus_keyword'] = $data['page_details']->focus_keyword;
        $data['meta_description'] = $data['page_details']->meta_description;
        $data['page_name']='page';
        $this->load->view('front_end/index',$data);
        //var_dump($data);
        
    }

    public function about_us(){
        $data['title'] = 'About us';
        $data['page_name']='about';
        $this->load->view('front_end/index',$data);
    }
}

