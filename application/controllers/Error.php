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
 
class Error extends CI_Controller{
    
    public function index(){

        $data['all_published_genre']= $this->common_model->all_published_genre();
        $data['all_published_country']= $this->common_model->all_published_country();
        $data['title'] = 'Page not found';
        $data['page_name']='404';
        $this->load->view('front_end/index',$data);
    }
}

