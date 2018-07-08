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

 
class Watch extends CI_Controller{
    public function index($slug='',$param1='',$param2=''){

        if ($slug == '') {        
         redirect('error');            
        }else if(count($this->db->get_where('videos', array('slug' => $slug))->result_array())<1){
            redirect('error');
        } else {
        	$this->common_model->watch_count_by_slug($slug);
            $data['watch_videos']           = $this->common_model->get_videos_by_slug($slug);
            $data['all_published_genre']    = $this->common_model->all_published_genre();
            $data['all_published_country']  = $this->common_model->all_published_country();
            $data['focus_keyword']          = $data['watch_videos']->focus_keyword;
            $data['meta_description']       = $data['watch_videos']->meta_description;

            if ($param2 == 'report'){
                $brokenVideo = $this->common_model->get_broken_link_video($param1);
                if(count($brokenVideo) > 0){

                    $this->db->where('video_id', $param1);
                    $this->db->update('broken_link', ['total_reports'=> $brokenVideo[0]->total_reports + 1]);    
                }
                else{
                    $this->db->insert('broken_link', ['video_id'=> $param1]);
                }

                redirect('watch/'.$slug);
                
            }

            $data['slug']                   = $slug;
            $data['param1']                 = $param1;
            $data['param2']                 = $param2;
            $data['page_name']              = 'watch';
            
            $this->load->view('front_end/index', $data);
        }
        //var_dump($slug,$param1,$param2);
    }

}