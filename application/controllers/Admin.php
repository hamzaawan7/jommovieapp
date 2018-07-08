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
class Admin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('common_model');
        $this->load->database();

        //cache controling
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        ('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

    }

    //default index function, redirects to login/dashboard 
    public function index()
    {
        if ($this->session->userdata('admin_is_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        if ($this->session->userdata('admin_is_login') == 1)
            redirect(base_url() . 'admin/dashboard', 'refresh');
    }

    //dashboard
    function dashboard()
    {
        if ($this->session->userdata('admin_is_login') != 1)
            redirect(base_url(), 'refresh');
        /* start menu active/inactive section*/
        $this->session->unset_userdata('active_menu');
        $this->session->set_userdata('active_menu', '1');
        /* end menu active/inactive section*/
        $data['page_name'] = 'dashboard';
        $data['page_title'] = 'admin_dashboard';
        $this->load->view('admin/index', $data);

    }


    //  country
    function country($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_is_login') != 1)
            redirect(base_url(), 'refresh');
        // start menu active/inactive section
        $this->session->unset_userdata('active_menu');
        $this->session->set_userdata('active_menu', '2');
        // end menu active/inactive section


        if ($param1 == 'add') {
            $data['name'] = $this->input->post('name');
            $data['description'] = $this->input->post('description');
            $data['slug'] = url_title($this->input->post('name'), 'dash', TRUE);
            $data['publication'] = $this->input->post('publication');

            $this->db->insert('country', $data);
            $this->session->set_flashdata('success', 'Country added successed');
            redirect(base_url() . 'admin/country/', 'refresh');
        }

        if ($param1 == 'update') {
            $data['name'] = $this->input->post('name');
            $data['description'] = $this->input->post('description');
            $data['slug'] = url_title($this->input->post('name'), 'dash', TRUE);
            $data['publication'] = $this->input->post('publication');

            $this->db->where('country_id', $param2);
            $this->db->update('country', $data);
            $this->session->set_flashdata('success', 'Country update successed.');
            redirect(base_url() . 'admin/country/', 'refresh');
        }

        $data['page_name'] = 'country_manage';
        $data['page_title'] = 'Country Management';
        $data['countries'] = $this->db->get('country')->result_array();
        $this->load->view('admin/index', $data);


    }

    // genre
    function genre($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_is_login') != 1)
            redirect(base_url(), 'refresh');
        /* start menu active/inactive section*/
        $this->session->unset_userdata('active_menu');
        $this->session->set_userdata('active_menu', '3');
        /* end menu active/inactive section*/


        if ($param1 == 'add') {
            $data['name'] = $this->input->post('name');
            $data['description'] = $this->input->post('description');
            $data['slug'] = url_title($this->input->post('name'), 'dash', TRUE);
            $data['publication'] = $this->input->post('publication');

            $this->db->insert('genre', $data);
            $this->session->set_flashdata('success', 'Genre added successed');
            redirect(base_url() . 'admin/genre/', 'refresh');
        }

        if ($param1 == 'update') {
            $data['name'] = $this->input->post('name');
            $data['description'] = $this->input->post('description');
            $data['slug'] = url_title($this->input->post('name'), 'dash', TRUE);
            $data['publication'] = $this->input->post('publication');

            $this->db->where('genre_id', $param2);
            $this->db->update('genre', $data);
            $this->session->set_flashdata('success', 'Genre update successed.');
            redirect(base_url() . 'admin/genre/', 'refresh');
        }

        $data['page_name'] = 'genre_manage';
        $data['page_title'] = 'Genre Management';
        $data['genres'] = $this->db->get('genre')->result_array();
        $this->load->view('admin/index', $data);
    }

    function slider_setting($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_is_login') != 1)
            redirect(base_url(), 'refresh');
        /* start menu active/inactive section*/
        $this->session->unset_userdata('active_menu');
        $this->session->set_userdata('active_menu', '5');
        /* end menu active/inactive section*/
        if ($param1 == 'update') {
            $slider_type = $this->input->post('slider_type');
            if ($slider_type == 'movie') {
                $data['value'] = $slider_type;
                $this->db->where('title', 'slider_type');
                $this->db->update('config', $data);
                $data['value'] = $this->input->post('total_movie_in_slider');
                $this->db->where('title', 'total_movie_in_slider');
                $this->db->update('config', $data);

                $data['value'] = $this->input->post('slide_per_page');
                $this->db->where('title', 'slide_per_page');
                $this->db->update('config', $data);
                $this->session->set_flashdata('success', 'Slider setting update successed');
                redirect(base_url() . 'admin/slider_setting/', 'refresh');
            } else if ($slider_type == 'image') {
                $data['value'] = 'image';
                $this->db->where('title', 'slider_type');
                $this->db->update('config', $data);
                $this->session->set_flashdata('success', 'Slider setting update successed');
                redirect(base_url() . 'admin/slider_setting/', 'refresh');
            } else if ($slider_type == 'disable') {
                $data['value'] = 'disable';
                $this->db->where('title', 'slider_type');
                $this->db->update('config', $data);
                $this->session->set_flashdata('success', 'Slider setting update successed');
                redirect(base_url() . 'admin/slider_setting/', 'refresh');
            }
        }
        $data['page_name'] = 'slider_setting';
        $data['page_title'] = 'Slider Setting';
        $this->load->view('admin/index', $data);
    }

    // slider
    function slider($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_is_login') != 1)
            redirect(base_url(), 'refresh');
        /* start menu active/inactive section*/
        $this->session->unset_userdata('active_menu');
        $this->session->set_userdata('active_menu', '4');
        /* end menu active/inactive section*/


        if ($param1 == 'add') {
            $data['title'] = $this->input->post('title');
            $data['description'] = $this->input->post('description');
            $data['video_link'] = $this->input->post('video_link');
            $data['image_link'] = base_url() . 'uploads/no_image.jpg';

            if ($this->input->post('image_link') != '') {
                $data['image_link'] = $this->input->post('image_link');
            }

            $data['slug'] = url_title($this->input->post('title'), 'dash', TRUE);
            $data['publication'] = $this->input->post('publication');

            $this->db->insert('slider', $data);
            $insert_id = $this->db->insert_id();
            if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
                move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/sliders/slider-' . $insert_id . '.jpg');
                $data['image_link'] = base_url() . 'uploads/sliders/slider-' . $insert_id . '.jpg';
            }
            $this->db->where('slider_id', $insert_id);
            $this->db->update('slider', $data);

            $this->session->set_flashdata('success', 'Slider added successed');
            redirect(base_url() . 'admin/slider/', 'refresh');
        }

        if ($param1 == 'update') {
            $data['title'] = $this->input->post('title');
            $data['description'] = $this->input->post('description');
            $data['video_link'] = $this->input->post('video_link');
            $data['image_link'] = base_url() . 'uploads/no_image.jpg';

            if ($this->input->post('image_link') != '') {
                $data['image_link'] = $this->input->post('image_link');
            }

            if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
                move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/sliders/slider-' . $param2 . '.jpg');
                $data['image_link'] = base_url() . 'uploads/sliders/slider-' . $param2 . '.jpg';
            }
            $data['slug'] = url_title($this->input->post('title'), 'dash', TRUE);
            $data['publication'] = $this->input->post('publication');

            $this->db->where('slider_id', $param2);
            $this->db->update('slider', $data);
            $this->session->set_flashdata('success', 'Slider update successed.');
            redirect(base_url() . 'admin/slider/', 'refresh');
        }

        $data['page_name'] = 'slider_manage';
        $data['page_title'] = 'Slider Management';
        $data['sliders'] = $this->db->get('slider')->result_array();
        $this->load->view('admin/index', $data);


    }

    // add videos or movies
    function videos_add()
    {
        if ($this->session->userdata('admin_is_login') != 1)
            redirect(base_url(), 'refresh');
        /* start menu active/inactive section*/
        $this->session->unset_userdata('active_menu');
        $this->session->set_userdata('active_menu', '6');
        /* end menu active/inactive section*/


        $data['page_name'] = 'videos_add';
        $data['page_title'] = 'Videos Add';
        $this->load->view('admin/index', $data);
    }

    // edit videos or movies 
    function videos_edit($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_is_login') != 1)
            redirect(base_url(), 'refresh');
        /* start menu active/inactive section*/
        $this->session->unset_userdata('active_menu');
        $this->session->set_userdata('active_menu', '6');
        /* end menu active/inactive section*/


        $data['param1'] = $param1;
        $data['param2'] = $param2;
        $data['page_name'] = 'videos_edit';
        $data['page_title'] = 'Videos Edit';
        $this->load->view('admin/index', $data);
    }

    // edit videos or movies
    function videos_delete()
    {
        $response = array();
        $links = $this->input->post('ids');
        $this->db->where_in('broken_link_id', $links);
        $run = $this->db->delete('broken_link');
        if ($run) {
            $response['status'] = 'success';
            $response['message'] = 'Videos Deleted Successfully ...';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Unable to delete Videos ...';
        }
        echo json_encode($response);
    }

    // edit videos or movies
    function thumbnail_setting($param1 = '')
    {
        if ($this->session->userdata('admin_is_login') != 1) {
            redirect(base_url(), 'refresh');
            /* start menu active/inactive section*/
            $this->session->unset_userdata('active_menu');
            $this->session->set_userdata('active_menu', '5');
            /* end menu active/inactive section*/
        }
        if ($param1 == 'update') {
            $data['cols'] = $this->input->post('cols');
            $data['rows'] = $this->input->post('rows');
            $this->db->where('id', 1);
            $this->db->update('thumbnail', $data);

            $this->session->set_flashdata('success', 'Thumbnail setting update successed');
            redirect(base_url() . 'admin/thumbnail_setting/', 'refresh');
        }

        $data['page_name'] = 'thumbnail_setting';
        $data['page_title'] = 'Thumbnail Setting';
        $this->load->view('admin/index', $data);
    }

    // edit videos or movies 
    function broken_links($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_is_login') != 1)
            redirect(base_url(), 'refresh');
        /* start menu active/inactive section*/
        $this->session->unset_userdata('active_menu');
        $this->session->set_userdata('active_menu', 23);
        /* end menu active/inactive section*/

        $config = array();

        $config["base_url"] = base_url() . "admin/broken_links";
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config['full_tag_open'] = '<ul class ="pagination">';
        $config['full_tag_close'] = '</ul><!--pagination-->';

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
        $data['searchTerm'] = $this->input->get('q');
        if ($data['searchTerm'] == '')
            $data['searchTerm'] = NULL;

        $config["total_rows"] = count($this->db->get('broken_link')->result_array());

        $this->pagination->initialize($config);

        $data['last_row_num'] = $this->uri->segment(3);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["allVideos"] = $this->common_model->get_broken_link_videos($config["per_page"], $page);

        $data['param1'] = $param1;
        $data['param2'] = $param2;
        $data["links"] = $this->pagination->create_links();
        $data['total_rows'] = $config["total_rows"];
        $data['page_name'] = 'broken_links';
        $data['page_title'] = 'Broken Video Links';
        $this->load->view('admin/index', $data);
    }

    // add,edit videos or movies 
    function videos($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_is_login') != 1) {
            redirect(base_url(), 'refresh');
            /* start menu active/inactive section*/
            $this->session->unset_userdata('active_menu');
            $this->session->set_userdata('active_menu', '8');
            /* end menu active/inactive section*/
        }
        $title = $this->input->post('title');
        $this->db->select('title');
        $query_result = $this->db->get_where('videos');
        $new = true;
        if ($query_result->num_rows() > 0) {
            foreach ($query_result->result() as $row) {
                $video_title = str_replace("'", "", $row->title);
                if ($title == $video_title) {
                    $new = false;
                }
            }
        }
        if ($new && $param1 == 'add') {
            $source_name = $this->input->post('source_name');
            $embed_link = $this->input->post('embed_link');
            $order = $this->input->post('order');
            // $genre                      = $this->input->post('genre');
            $data['embed_link'] = $this->input->post('embed_link_main');
            if ($this->input->post('title')) {
                $data['title'] = $this->input->post('title');
            } else {
                $data['title'] = '';
            }
            if ($this->input->post('description')) {
                $data['description'] = $this->input->post('description');
            } else {
                $data['description'] = '';
            }
            $data['focus_keyword'] = $this->input->post('focus_keyword');
            $data['meta_description'] = $this->input->post('meta_description');
            $data['tags'] = $this->input->post('tags');
            //$data['image_link']         = $this->input->post('image_link');
            $data['runtime'] = $this->input->post('runtime');
            $data['stars'] = $this->input->post('stars');
            $data['rating'] = $this->input->post('rating');
            $data['director'] = $this->input->post('director');
            $data['writer'] = $this->input->post('writer');
            $data['release'] = $this->input->post('release');
            $data['country'] = $this->input->post('country');
            if ($this->input->post('genre')) {
                $data['genre'] = implode(',', $this->input->post('genre'));
            }
            $data['added_by'] = $this->session->userdata('user_id');
            if ($this->input->post('video_type')) {
                $data['video_type'] = implode(',', $this->input->post('video_type'));
            }
            $data['publication'] = $this->input->post('publication');
            $data['downloadable_link'] = $this->input->post('downloadable_link');
            $data['thumb_link'] = base_url() . 'uploads/no_image.jpg';
            $data['image_link'] = base_url() . 'uploads/no_image.jpg';
            if ($this->input->post('thumb_link') != '') {
                $data['thumb_link'] = $this->input->post('thumb_link');
                $data['image_link'] = $this->input->post('thumb_link');
            }

            $this->db->insert('videos', $data);
            //var_dump($data);
            $insert_id = $this->db->insert_id();

            $slug = url_title($this->input->post('slug'), 'dash', TRUE);
            $slug_num = $this->common_model->slug_num('videos', $slug);
            if ($slug_num > 0) {
                $slug = $slug . '-' . $insert_id;
            }
            $data_update['slug'] = $slug;
            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['name'] != '') {
                move_uploaded_file($_FILES['thumbnail']['tmp_name'], 'uploads/video_thumb/' . $slug . '.jpg');
                $data_update['thumb_link'] = base_url() . 'uploads/video_thumb/' . $slug . '.jpg';
                $data_update['image_link'] = base_url() . 'uploads/video_thumb/' . $slug . '.jpg';
            }
            $this->db->where('videos_id', $insert_id);
            $this->db->update('videos', $data_update);

            for ($i = 0; $i < sizeof($embed_link); $i++) {
                $Link_num = $i + 1;
                $source_data['source_name'] = $source_name[$i];
                $source_data['embed_link'] = $embed_link[$i];
                $source_data['order'] = $order[$i];
                $source_data['videos_id'] = $insert_id;
                $this->db->insert('video_source', $source_data);
            }

            // for($i=0;$i<sizeof($genre);$i++){
            //     $genre_data['genre_id']     = $genre[$i];
            //     $genre_data['video_id']       = $insert_id;
            //     $this->db->insert('video_genre', $genre_data);
            // }

            $this->load->model('email_model');
            $this->email_model->new_movie_notification($insert_id);
            $this->session->set_flashdata('success', 'Video added successed');
            redirect(base_url() . 'admin/videos/', 'refresh');
        } else if ($param1 == 'update') {
            $result = $this->db->get_where('videos', ['videos_id' => $param2]);
            $video = $result->result_array()[0];

            $data['title'] = $this->input->post('title');
            $data['description'] = $this->input->post('description');
            $data['focus_keyword'] = $this->input->post('focus_keyword');
            $data['meta_description'] = $this->input->post('meta_description');
            $data['tags'] = $this->input->post('tags');
            $source_name = $this->input->post('source_name');
            $embed_link = $this->input->post('embed_link');
            $order = $this->input->post('order');
            // $genre                      = $this->input->post('genre');
            $data['embed_link'] = $this->input->post('embed_link_main');
            $data['runtime'] = $this->input->post('runtime');
            $data['stars'] = $this->input->post('stars');
            $data['rating'] = $this->input->post('rating');
            $data['director'] = $this->input->post('director');
            $data['writer'] = $this->input->post('writer');
            $data['release'] = $this->input->post('release');
            $data['country'] = $this->input->post('country');
            $data['genre'] = implode(',', $this->input->post('genre'));

            if (is_null($video['added_by']) || $video['added_by'] == 0)
                $data['added_by'] = $this->session->userdata('user_id');

            $data['video_type'] = implode(',', $this->input->post('video_type'));
            //$data['slug']               = $slug;
            $data['publication'] = $this->input->post('publication');
            $data['downloadable_link'] = $this->input->post('downloadable_link');

            if ($this->input->post('thumb_link') != '') {
                $data['thumb_link'] = $this->input->post('thumb_link');
                $data['image_link'] = $this->input->post('thumb_link');
            }

            $slug = url_title($this->input->post('slug'), 'dash', TRUE);
            $slug_num = $this->common_model->slug_num('videos', $slug);
            if ($slug_num > 1) {
                $slug = $slug . '-' . $param1;
            }
            $data['slug'] = $slug;
            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['name'] != '') {
                move_uploaded_file($_FILES['thumbnail']['tmp_name'], 'uploads/video_thumb/' . $slug . '.jpg');
                $data['thumb_link'] = base_url() . 'uploads/video_thumb/' . $slug . '.jpg';
                $data['image_link'] = base_url() . 'uploads/video_thumb/' . $slug . '.jpg';
            }
            $this->db->where('videos_id', $param2);
            $this->db->update('videos', $data);
            $this->db->where('videos_id', $param2);
            $this->db->delete('video_source');
            // $this->db->where('video_id', $param2);
            // $this->db->delete('video_genre');
            for ($i = 0; $i < sizeof($embed_link); $i++) {
                $Link_num = $i + 1;
                $source_data['source_name'] = $source_name[$i];
                $source_data['embed_link'] = $embed_link[$i];
                $source_data['order'] = $order[$i];
                $source_data['videos_id'] = $param2;
                $this->db->where('videos_id', $param2);
                $this->db->insert('video_source', $source_data);
            }

            // for($i=0;$i<sizeof($genre);$i++){
            //     $genre_data['genre_id']     = $genre[$i];
            //     $genre_data['video_id']       = $param2;
            //     $this->db->where('videos_id', $param2);
            //     $this->db->insert('video_genre', $genre_data);
            // }
            $this->session->set_flashdata('success', 'Video update successed.');
            redirect(base_url() . 'admin/videos/', 'refresh');
        }

        $config = array();

        $config["base_url"] = base_url() . "admin/videos";
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config['full_tag_open'] = '<ul class ="pagination">';
        $config['full_tag_close'] = '</ul><!--pagination-->';

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
        $data['searchTerm'] = $this->input->get('q');
        if ($data['searchTerm'] == '')
            $data['searchTerm'] = NULL;

        $config["total_rows"] = count($this->common_model->get_videos_count($data['searchTerm']));

        $this->pagination->initialize($config);

        $data['last_row_num'] = $this->uri->segment(3);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["allVideos"] = $this->common_model->get_videos($config["per_page"], $page, $data['searchTerm']);
        $data["links"] = $this->pagination->create_links();
        $data['total_rows'] = $config["total_rows"];
        $data['page_name'] = 'videos_manage';
        $data['page_title'] = 'Videos Management';
        $this->load->view('admin/index', $data);


    }

    // videos or movies types
    function video_type($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_is_login') != 1)
            redirect(base_url(), 'refresh');
        /* start menu active/inactive section*/
        $this->session->unset_userdata('active_menu');
        $this->session->set_userdata('active_menu', '9');
        /* end menu active/inactive section*/

        if ($param1 == 'add') {

            $data['video_type'] = $this->input->post('video_type');
            $data['video_type_desc'] = $this->input->post('video_type_desc');

            $this->db->insert('video_type', $data);
            $this->session->set_flashdata('success', 'Video type added successed');
            redirect(base_url() . 'admin/video_type/', 'refresh');
        }
        if ($param1 == 'update') {


            $data['video_type'] = $this->input->post('video_type');
            $data['video_type_desc'] = $this->input->post('video_type_desc');

            $this->db->where('video_type_id', $param2);
            $this->db->update('video_type', $data);
            $this->session->set_flashdata('success', 'Video type update successed.');
            redirect(base_url() . 'admin/video_type/', 'refresh');
        }

        $data['page_name'] = 'video_type_manage';
        $data['page_title'] = 'Videos Type Management';
        $data['video_types'] = $this->db->get('video_type')->result_array();
        $this->load->view('admin/index', $data);


    }

    // add custom page
    function pages_add()
    {
        if ($this->session->userdata('admin_is_login') != 1)
            redirect(base_url(), 'refresh');
        /* start menu active/inactive section*/
        $this->session->unset_userdata('active_menu');
        $this->session->set_userdata('active_menu', '10');
        /* end menu active/inactive section*/


        $data['page_name'] = 'pages_add';
        $data['page_title'] = 'Page Add';
        $this->load->view('admin/index', $data);
    }

    // edit custom page
    function pages_edit($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_is_login') != 1)
            redirect(base_url(), 'refresh');
        /* start menu active/inactive section*/
        $this->session->unset_userdata('active_menu');
        $this->session->set_userdata('active_menu', '9');
        /* end menu active/inactive section*/


        $data['param1'] = $param1;
        $data['param2'] = $param2;
        $data['page_name'] = 'pages_edit';
        $data['page_title'] = 'page Edit';
        $this->load->view('admin/index', $data);
    }

    // add,update custom page
    function pages($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_is_login') != 1)
            redirect(base_url(), 'refresh');
        /* start menu active/inactive section*/
        $this->session->unset_userdata('active_menu');
        $this->session->set_userdata('active_menu', '11');
        /* end menu active/inactive section*/


        if ($param1 == 'add') {

            $data['page_title'] = $this->input->post('page_title');
            $data['content'] = $this->input->post('content');
            $data['primary_menu'] = $this->input->post('primary_menu');
            $data['footer_menu'] = $this->input->post('footer_menu');
            $data['focus_keyword'] = $this->input->post('focus_keyword');
            $data['meta_description'] = $this->input->post('meta_description');
            $data['publication'] = $this->input->post('publication');

            $this->db->insert('page', $data);
            $insert_id = $this->db->insert_id();

            $slug = url_title($this->input->post('slug'), 'dash', TRUE);
            $slug_num = $this->common_model->slug_num('page', $slug);
            if ($slug_num > 0) {
                $slug = $slug . '-' . $insert_id;
            }
            $data['slug'] = $slug;
            $this->db->where('page_id', $insert_id);
            $this->db->update('page', $data);


            $this->session->set_flashdata('success', 'Page added successed');
            redirect(base_url() . 'admin/pages/', 'refresh');
        } else if ($param1 == 'update') {
            $slug = url_title($this->input->post('slug'), 'dash', TRUE);
            $data['page_title'] = $this->input->post('page_title');
            $data['content'] = $this->input->post('content');
            $data['primary_menu'] = $this->input->post('primary_menu');
            $data['footer_menu'] = $this->input->post('footer_menu');
            $data['focus_keyword'] = $this->input->post('focus_keyword');
            $data['meta_description'] = $this->input->post('meta_description');
            $data['slug'] = $slug;
            $data['publication'] = $this->input->post('publication');


            $this->db->where('page_id', $param2);
            $this->db->update('page', $data);

            $slug_num = $this->common_model->slug_num('page', $slug);
            if ($slug_num > 1) {
                $slug = $slug . '-' . $param2;
            }
            $data['slug'] = $slug;
            $this->db->where('page_id', $param2);
            $this->db->update('page', $data);

            $this->session->set_flashdata('success', 'Page update successed.');
            redirect(base_url() . 'admin/pages/', 'refresh');
        } else {
            if ($param1 != '' && $param1 != NULL) {
                $data['type'] = $param1;
            } else {
                $data['type'] = '';
            }
        }

        $data['page_name'] = 'pages_manage';
        $data['page_title'] = 'Post Management';
        $this->load->view('admin/index', $data);


    }


    // add blog post

    function posts_add()
    {
        if ($this->session->userdata('admin_is_login') != 1)
            redirect(base_url(), 'refresh');
        /* start menu active/inactive section*/
        $this->session->unset_userdata('active_menu');
        $this->session->set_userdata('active_menu', '12');
        /* end menu active/inactive section*/


        $data['page_name'] = 'posts_add';
        $data['page_title'] = 'Posts Add';
        $this->load->view('admin/index', $data);
    }

    // edit blog post
    function posts_edit($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_is_login') != 1)
            redirect(base_url(), 'refresh');
        /* start menu active/inactive section*/
        $this->session->unset_userdata('active_menu');
        $this->session->set_userdata('active_menu', '12');
        /* end menu active/inactive section*/


        $data['param1'] = $param1;
        $data['param2'] = $param2;
        $data['page_name'] = 'posts_edit';
        $data['page_title'] = 'Post Edit';
        $this->load->view('admin/index', $data);
    }

    // add,update blog post
    function posts($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_is_login') != 1)
            redirect(base_url(), 'refresh');
        /* start menu active/inactive section*/
        $this->session->unset_userdata('active_menu');
        $this->session->set_userdata('active_menu', '13');
        /* end menu active/inactive section*/

        if ($param1 == 'add') {
            $data['post_title'] = $this->input->post('post_title');
            $data['content'] = $this->input->post('content');
            $data['focus_keyword'] = $this->input->post('focus_keyword');
            $data['meta_description'] = $this->input->post('meta_description');
            $data['category_id'] = implode(',', $this->input->post('category_id'));
            $data['publication'] = $this->input->post('publication');
            if ($this->input->post('thumb_link') != '') {
                $data['image_link'] = $this->input->post('thumb_link');
            }


            $this->db->insert('posts', $data);
            $insert_id = $this->db->insert_id();

            $slug = url_title($this->input->post('slug'), 'dash', TRUE);
            $slug_num = $this->common_model->slug_num('videos', $slug);
            if ($slug_num > 0) {
                $slug = $slug . '-' . $insert_id;
            }
            $data['slug'] = $slug;
            $data['image_link'] = base_url() . 'uploads/no_image.jpg';
            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['name'] != '') {
                move_uploaded_file($_FILES['thumbnail']['tmp_name'], 'uploads/post_thumb/' . $slug . '.jpg');
                $data['image_link'] = base_url() . 'uploads/post_thumb/' . $slug . '.jpg';
                $source = 'uploads/post_thumb/' . $slug . '.jpg';
                $destination = 'uploads/post_thumb/small/' . $slug . '.jpg';
                $this->common_model->create_small_thumbnail($source, $destination, "150", "150");
            }
            $this->db->where('posts_id', $insert_id);
            $this->db->update('posts', $data);


            $this->session->set_flashdata('success', 'Post added successed');
            redirect(base_url() . 'admin/posts/', 'refresh');
        } else if ($param1 == 'update') {
            $data['post_title'] = $this->input->post('post_title');
            $data['content'] = $this->input->post('content');
            $data['focus_keyword'] = $this->input->post('focus_keyword');
            $data['meta_description'] = $this->input->post('meta_description');
            $data['category_id'] = implode(',', $this->input->post('category_id'));
            $data['publication'] = $this->input->post('publication');
            if ($this->input->post('thumb_link') != '') {
                $data['image_link'] = $this->input->post('thumb_link');
            }
            $this->db->where('posts_id', $param2);
            $this->db->update('posts', $data);
            $slug = url_title($this->input->post('slug'), 'dash', TRUE);
            $slug_num = $this->common_model->slug_num('videos', $slug);
            if ($slug_num > 1) {
                $slug = $slug . '-' . $param2;
            }
            $data['slug'] = $slug;
            if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['name'] != '') {
                move_uploaded_file($_FILES['thumbnail']['tmp_name'], 'uploads/post_thumb/' . $slug . '.jpg');
                $data['image_link'] = base_url() . 'uploads/post_thumb/' . $slug . '.jpg';
                $source = 'uploads/post_thumb/' . $slug . '.jpg';
                $destination = 'uploads/post_thumb/small/' . $slug . '.jpg';
                $this->common_model->create_small_thumbnail($source, $destination, "150", "150");
            }
            $this->db->where('posts_id', $param2);
            $this->db->update('posts', $data);


            $this->session->set_flashdata('success', 'Post update successed.');
            redirect(base_url() . 'admin/posts/', 'refresh');
        } else {
            if ($param1 != '' && $param1 != NULL) {
                $data['type'] = $param1;
            } else {
                $data['type'] = '';
            }
        }

        $data['page_name'] = 'posts_manage';
        $data['page_title'] = 'Post Management';
        $this->load->view('admin/index', $data);


    }

    // post category
    function post_category($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_is_login') != 1)
            redirect(base_url(), 'refresh');
        /* start menu active/inactive section*/
        $this->session->unset_userdata('active_menu');
        $this->session->set_userdata('active_menu', '14');
        /* end menu active/inactive section*/

        if ($param1 == 'add') {

            $data['category'] = $this->input->post('category');
            $data['category_desc'] = $this->input->post('category_desc');

            $this->db->insert('post_category', $data);
            $this->session->set_flashdata('success', 'Post Category added successed');
            redirect(base_url() . 'admin/post_category/', 'refresh');
        }
        if ($param1 == 'update') {

            $data['category'] = $this->input->post('category');
            $data['category_desc'] = $this->input->post('category_desc');

            $this->db->where('post_category_id', $param2);
            $this->db->update('post_category', $data);
            $this->session->set_flashdata('success', 'Post category update successed.');
            redirect(base_url() . 'admin/post_category/', 'refresh');
        }

        $data['page_name'] = 'post_category_manage';
        $data['page_title'] = 'Post Category Management';
        $data['post_categories'] = $this->db->get('post_category')->result_array();
        $this->load->view('admin/index', $data);
    }

    // users
    function manage_user($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_is_login') != 1)
            redirect(base_url(), 'refresh');
        /* start menu active/inactive section*/
        $this->session->unset_userdata('active_menu');
        $this->session->set_userdata('active_menu', '15');
        /* end menu active/inactive section*/

        /* add new access */

        if ($param1 == 'add') {
            $data['name'] = $this->input->post('name');
            $data['username'] = $this->input->post('username');
            $data['password'] = md5($this->input->post('password'));
            $data['email'] = $this->input->post('email');
            $data['role'] = $this->input->post('role');

            $this->db->insert('user', $data);
            $this->session->set_flashdata('success', 'User added successed');
            redirect(base_url() . 'admin/manage_user/', 'refresh');
        }
        if ($param1 == 'update') {
            $data['name'] = $this->input->post('name');
            $data['username'] = $this->input->post('username');
            if ($this->input->post('password') != '' || $this->input->post('password') != NULL) {
                $data['password'] = md5($this->input->post('password'));
            }

            $data['email'] = $this->input->post('email');
            $data['role'] = $this->input->post('role');

            $this->db->where('user_id', $param2);
            $this->db->update('user', $data);
            $this->session->set_flashdata('success', 'User update successed.');
            redirect(base_url() . 'admin/manage_user/', 'refresh');
        }

        if ($param1 == 'delete') {
            $response = array();
            $user_id = $this->input->post('user_id');
            $this->db->where('user_id', $user_id);
            $run = $this->db->delete('user');
            if ($run) {
                $response['status'] = 'success';
                $response['message'] = 'Product Deleted Successfully ...';
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Unable to delete product ...';
            }
            echo json_encode($response);
        }

        $data['page_name'] = 'user_manage';
        $data['page_title'] = 'User Management';
        $data['users'] = $this->db->get('user')->result_array();
        $this->load->view('admin/index', $data);


    }


    // general setting
    function general_setting($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_is_login') != 1)
            redirect(base_url(), 'refresh');
        /* start menu active/inactive section*/
        $this->session->unset_userdata('active_menu');
        $this->session->set_userdata('active_menu', '16');
        /* end menu active/inactive section*/

        if ($param1 == 'update') {


            $data['value'] = $this->input->post('site_name');
            $this->db->where('title', 'site_name');
            $this->db->update('config', $data);

            $data['value'] = $this->input->post('site_url');
            $this->db->where('title', 'site_url');
            $this->db->update('config', $data);

            $data['value'] = $this->input->post('system_email');
            $this->db->where('title', 'system_email');
            $this->db->update('config', $data);

            $data['value'] = $this->input->post('business_address');
            $this->db->where('title', 'business_address');
            $this->db->update('config', $data);

            $data['value'] = $this->input->post('business_phone');
            $this->db->where('title', 'business_phone');
            $this->db->update('config', $data);

            $data['value'] = $this->input->post('contact_email');
            $this->db->where('title', 'contact_email');
            $this->db->update('config', $data);

            $data['value'] = $this->input->post('map_api');
            $this->db->where('title', 'map_api');
            $this->db->update('config', $data);

            $data['value'] = $this->input->post('map_lat');
            $this->db->where('title', 'map_lat');
            $this->db->update('config', $data);

            $data['value'] = $this->input->post('map_lng');
            $this->db->where('title', 'map_lng');
            $this->db->update('config', $data);

            $data['value'] = $this->input->post('front_end_theme');
            $this->db->where('title', 'front_end_theme');
            $this->db->update('config', $data);

            $data['value'] = $this->input->post('restrict_visitors');
            $this->db->where('title', 'restrict_visitors');
            $this->db->update('config', $data);

            $this->session->set_flashdata('success', 'Setting update successed.');
            redirect(base_url() . 'admin/general_setting/', 'refresh');
        }
        $data['page_name'] = 'general_setting';
        $data['page_title'] = 'General Setting';
        $this->load->view('admin/index', $data);
    }

    // general setting
    function email_setting($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_is_login') != 1)
            redirect(base_url(), 'refresh');
        /* start menu active/inactive section*/
        $this->session->unset_userdata('active_menu');
        $this->session->set_userdata('active_menu', '17');
        /* end menu active/inactive section*/

        if ($param1 == 'update') {
            $protocol = $this->input->post('protocol');
            if ($protocol == 'smtp') {
                $data['value'] = $this->input->post('protocol');
                $this->db->where('title', 'protocol');
                $this->db->update('config', $data);

                $data['value'] = $this->input->post('smtp_host');
                $this->db->where('title', 'smtp_host');
                $this->db->update('config', $data);

                $data['value'] = $this->input->post('smtp_user');
                $this->db->where('title', 'smtp_user');
                $this->db->update('config', $data);


                $data['value'] = $this->input->post('smtp_pass');
                $this->db->where('title', 'smtp_pass');
                $this->db->update('config', $data);

                $data['value'] = $this->input->post('smtp_port');
                $this->db->where('title', 'smtp_port');
                $this->db->update('config', $data);

                $data['value'] = $this->input->post('smtp_crypto');
                $this->db->where('title', 'smtp_crypto');
                $this->db->update('config', $data);
            } else if ($protocol == 'sendmail') {
                $data['value'] = $this->input->post('protocol');
                $this->db->where('title', 'protocol');
                $this->db->update('config', $data);

                $data['value'] = $this->input->post('mailpath');
                $this->db->where('title', 'mailpath');
                $this->db->update('config', $data);
            }

            $data['value'] = $this->input->post('contact_email');
            $this->db->where('title', 'contact_email');
            $this->db->update('config', $data);

            $this->session->set_flashdata('success', 'Setting update successed.');
            redirect(base_url() . 'admin/email_setting/', 'refresh');
        }
        $data['page_name'] = 'email_setting';
        $data['page_title'] = 'Email Setting';
        $this->load->view('admin/index', $data);
    }


    // logo setting
    function logo_setting($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_is_login') != 1)
            redirect(base_url(), 'refresh');
        /* start menu active/inactive section*/
        $this->session->unset_userdata('active_menu');
        $this->session->set_userdata('active_menu', '18');
        /* end menu active/inactive section*/

        if ($param1 == 'update') {
            move_uploaded_file($_FILES['website_logo']['tmp_name'], 'uploads/system_logo/logo.png');
            move_uploaded_file($_FILES['website_favicon']['tmp_name'], 'uploads/system_logo/favicon.ico');

            $this->session->set_flashdata('success', 'Logo update successed');

            redirect(base_url() . 'admin/logo_setting/', 'refresh');
        }

        $data['page_name'] = 'logo_setting';
        $data['page_title'] = 'Logo Setting';
        $this->load->view('admin/index', $data);
    }

    //footer setting
    function footer_setting($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_is_login') != 1)
            redirect(base_url(), 'refresh');
        /* start menu active/inactive section*/
        $this->session->unset_userdata('active_menu');
        $this->session->set_userdata('active_menu', '19');
        /* end menu active/inactive section*/

        if ($param1 == 'update') {
            $data['value'] = $this->input->post('footer1_title');
            $this->db->where('title', 'footer1_title');
            $this->db->update('config', $data);

            $data['value'] = $this->input->post('footer1_content');
            $this->db->where('title', 'footer1_content');
            $this->db->update('config', $data);

            $data['value'] = $this->input->post('footer2_title');
            $this->db->where('title', 'footer2_title');
            $this->db->update('config', $data);

            $data['value'] = $this->input->post('footer2_content');
            $this->db->where('title', 'footer2_content');
            $this->db->update('config', $data);

            $data['value'] = $this->input->post('footer3_title');
            $this->db->where('title', 'footer3_title');
            $this->db->update('config', $data);

            $data['value'] = $this->input->post('footer3_content');
            $this->db->where('title', 'footer3_content');
            $this->db->update('config', $data);

            $data['value'] = $this->input->post('copyright_text');
            $this->db->where('title', 'copyright_text');
            $this->db->update('config', $data);


            $this->session->set_flashdata('success', 'Footer update successed');

            redirect(base_url() . 'admin/footer_setting/', 'refresh');
        }

        $data['page_name'] = 'footer_setting';
        $data['page_title'] = 'Footer Content Management';
        $this->load->view('admin/index', $data);
    }

    //seo setting
    function seo_setting($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_is_login') != 1)
            redirect(base_url(), 'refresh');
        /* start menu active/inactive section*/
        $this->session->unset_userdata('active_menu');
        $this->session->set_userdata('active_menu', '20');
        /* end menu active/inactive section*/

        if ($param1 == 'update') {
            $data['value'] = $this->input->post('author');
            $this->db->where('title', 'author');
            $this->db->update('config', $data);

            $data['value'] = $this->input->post('focus_keyword');
            $this->db->where('title', 'focus_keyword');
            $this->db->update('config', $data);

            $data['value'] = $this->input->post('meta_description');
            $this->db->where('title', 'meta_description');
            $this->db->update('config', $data);

            $data['value'] = $this->input->post('google_analytics_id');
            $this->db->where('title', 'google_analytics_id');
            $this->db->update('config', $data);

            $data['value'] = $this->input->post('social_share_enable');
            $this->db->where('title', 'social_share_enable');
            $this->db->update('config', $data);

            $data['value'] = $this->input->post('facebook_comment_appid');
            $this->db->where('title', 'facebook_comment_appid');
            $this->db->update('config', $data);

            $data['value'] = $this->input->post('show_facebook_comment_box');
            $this->db->where('title', 'show_facebook_comment_box');
            $this->db->update('config', $data);

            $data['value'] = $this->input->post('show_comment_box');
            $this->db->where('title', 'show_comment_box');
            $this->db->update('config', $data);

            $data['value'] = $this->input->post('facebook_url');
            $this->db->where('title', 'facebook_url');
            $this->db->update('config', $data);

            $data['value'] = $this->input->post('twitter_url');
            $this->db->where('title', 'twitter_url');
            $this->db->update('config', $data);

            $data['value'] = $this->input->post('linkedin_url');
            $this->db->where('title', 'linkedin_url');
            $this->db->update('config', $data);

            $data['value'] = $this->input->post('vimeo_url');
            $this->db->where('title', 'vimeo_url');
            $this->db->update('config', $data);

            $data['value'] = $this->input->post('youtube_url');
            $this->db->where('title', 'youtube_url');
            $this->db->update('config', $data);


            $this->session->set_flashdata('success', 'SEO & social setting update successed');

            redirect(base_url() . 'admin/seo_setting/', 'refresh');
        }

        $data['page_name'] = 'seo_setting';
        $data['page_title'] = 'SEO Configuration Management';
        $this->load->view('admin/index', $data);
    }

    //ads setting
    function ad_setting($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_is_login') != 1)
            redirect(base_url(), 'refresh');
        /* start menu active/inactive section*/
        $this->session->unset_userdata('active_menu');
        $this->session->set_userdata('active_menu', '21');
        /* end menu active/inactive section*/

        if ($param1 == 'update') {
            $ad_250x300_type = $this->input->post('ad_250x300_type');
            $ad_160x600_type = $this->input->post('ad_160x600_type');
            if ($ad_250x300_type != 0) {
                if ($ad_250x300_type == 1) {
                    $data['value'] = base_url() . 'uploads/no_image.jpg';
                    if (isset($_FILES['ad_250x300_image']) && $_FILES['ad_250x300_image']['name'] != '') {
                        move_uploaded_file($_FILES['ad_250x300_image']['tmp_name'], 'uploads/ads/ad_250x300.jpg');
                        $data['value'] = base_url() . 'uploads/ads/ad_250x300.jpg';
                        $this->db->where('title', 'ad_250x300_image_url');
                        $this->db->update('config', $data);
                    }
                    if ($this->input->post('ad_250x300_image_url') != '') {
                        $data['value'] = $this->input->post('ad_250x300_image_url');
                        $this->db->where('title', 'ad_250x300_image_url');
                        $this->db->update('config', $data);
                    }

                    if ($this->input->post('ad_250x300_url') != '') {
                        $data['value'] = $this->input->post('ad_250x300_url');
                        $this->db->where('title', 'ad_250x300_url');
                        $this->db->update('config', $data);
                    }


                    $data['value'] = $this->input->post('ad_250x300_type');
                    $this->db->where('title', 'ad_250x300_type');
                    $this->db->update('config', $data);
                } else if ($ad_250x300_type == 2) {
                    $data['value'] = $this->input->post('ad_250x300_code');
                    $this->db->where('title', 'ad_250x300_code');
                    $this->db->update('config', $data);

                    $data['value'] = $this->input->post('ad_250x300_type');
                    $this->db->where('title', 'ad_250x300_type');
                    $this->db->update('config', $data);

                } else {
                    $data['value'] = $this->input->post('ad_250x300_code');
                    $this->db->where('title', 'ad_250x300_code');
                    $this->db->update('config', $data);

                }

            } else {
                $data['value'] = '0';
                $this->db->where('title', 'ad_250x300_type');
                $this->db->update('config', $data);
            }
            if ($ad_160x600_type != 0) {
                if ($ad_160x600_type == 1) {
                    $data['value'] = base_url() . 'uploads/no_image.jpg';
                    if (isset($_FILES['ad_160x600_image']) && $_FILES['ad_160x600_image']['name'] != '') {
                        move_uploaded_file($_FILES['ad_160x600_image']['tmp_name'], 'uploads/ads/ad_160x600.jpg');
                        $data['value'] = base_url() . 'uploads/ads/ad_160x600.jpg';
                        $this->db->where('title', 'ad_160x600_image_url');
                        $this->db->update('config', $data);
                    }
                    if ($this->input->post('ad_160x600_image_url') != '') {
                        $data['value'] = $this->input->post('ad_160x600_image_url');
                        $this->db->where('title', 'ad_160x600_image_url');
                        $this->db->update('config', $data);
                    }

                    if ($this->input->post('ad_160x600_url') != '') {
                        $data['value'] = $this->input->post('ad_160x600_url');
                        $this->db->where('title', 'ad_160x600_url');
                        $this->db->update('config', $data);
                    }


                    $data['value'] = $this->input->post('ad_160x600_type');
                    $this->db->where('title', 'ad_160x600_type');
                    $this->db->update('config', $data);
                } else if ($ad_160x600_type == 2) {
                    $data['value'] = $this->input->post('ad_160x600_code');
                    $this->db->where('title', 'ad_160x600_code');
                    $this->db->update('config', $data);

                    $data['value'] = $this->input->post('ad_160x600_type');
                    $this->db->where('title', 'ad_160x600_type');
                    $this->db->update('config', $data);

                } else {
                    $data['value'] = $this->input->post('ad_160x600_code');
                    $this->db->where('title', 'ad_160x600_code');
                    $this->db->update('config', $data);

                }

            } else {
                $data['value'] = '0';
                $this->db->where('title', 'ad_160x600_type');
                $this->db->update('config', $data);
            }
            $this->session->set_flashdata('success', 'Ads setting update successed');

            redirect(base_url() . 'admin/ad_setting/', 'refresh');
        }

        $data['page_name'] = 'ad_setting';
        $data['page_title'] = 'Ads Configuration';
        $this->load->view('admin/index', $data);
    }

    function test_mail()
    {
        $email = $this->input->post('email');
        if ($email != '') {
            $this->load->model('email_model');
            if ($this->email_model->test_mail($email)) {
                $this->session->set_flashdata('success', 'Mail Configuration is perfect');
                $this->session->set_flashdata('send_success', 'Mail Configuration is perfect.Please check your mail to confirm');
                redirect(base_url() . 'admin/email_setting/', 'refresh');
            } else {
                $this->session->set_flashdata('send_error', 'Mail Configuration is perfect');
                redirect(base_url() . 'admin/email_setting/', 'refresh');
            }

        }
        $this->session->set_flashdata('error', 'Please enter a valid email.');
        redirect(base_url() . 'admin/email_setting/', 'refresh');

    }

    // database backup and restore management
    function backup_restore($operation = '', $type = '')
    {

        if ($this->session->userdata('admin_is_login') != 1)
            redirect(base_url(), 'refresh');
        /* start menu active/inactive section*/
        $this->session->unset_userdata('active_menu');
        $this->session->set_userdata('active_menu', '22');
        /* end menu active/inactive section*/

        if ($operation == 'create') {
            $this->common_model->create_backup();
            $this->session->set_flashdata('success', 'Backup created..');
            redirect(base_url() . 'admin/backup_restore/', 'refresh');
        }
        if ($operation == 'download') {
            $this->load->helper('download');
            force_download('db_backup/' . $type, TRUE);
        }
        if ($operation == 'delete') {
            $this->load->helper('file');
            $path_to_file = 'db_backup/' . $type;
            if (unlink($path_to_file)) {
                $this->session->set_flashdata('success', 'Deleted');
                redirect(base_url() . 'admin/backup_restore/', 'refresh');
            } else {
                $this->session->set_flashdata('error', 'File not found..');
                redirect(base_url() . 'admin/backup_restore/', 'refresh');
            }
        }
        if ($operation == 'restore') {
            $this->common_model->restore_backup();
            $this->session->set_flashdata('backup_message', 'Backup Restored');
            redirect(base_url() . 'admin/backup_restore/', 'refresh');
        }

        $data['page_info'] = 'Create backup / restore from backup';
        $data['page_name'] = 'backup_restore';
        $data['page_title'] = 'Manage Backup and Restore';
        $this->load->view('admin/index', $data);
    }

    function view_modal($page_name = '', $param2 = '', $param3 = '')
    {
        $account_type = $this->session->userdata('login_type');
        $data['param2'] = $param2;
        $data['param3'] = $param3;
        $this->load->view('admin/' . $page_name . '.php', $data);

    }

    //profile
    function manage_profile()
    {
        if ($this->session->userdata('admin_is_login') != 1)
            redirect(base_url(), 'refresh');
        /* start menu active/inactive section*/
        $this->session->unset_userdata('active_menu');
        $this->session->set_userdata('active_menu', '12');
        /* end menu active/inactive section*/
        $data['page_name'] = 'manage_profile';
        $data['page_title'] = 'Update profile information';
        $data['profile_info'] = $this->db->get_where('user', array(
            'user_id' => $this->session->userdata('user_id')))->result_array();
        $this->load->view('admin/index', $data);
    }

    // profile
    function profile($param1 = '', $param2 = '', $param3 = '')
    {
        /* start menu active/inactive section*/
        $this->session->unset_userdata('active_menu');
        $this->session->set_userdata('active_menu', '12');
        /* end menu active/inactive section*/
        $user_id = $this->session->userdata('user_id');
        if ($this->session->userdata('admin_is_login') != 1)
            redirect(base_url() . 'login', 'refresh');
        if ($param1 == 'update') {
            $data['name'] = $this->input->post('name');
            $data['email'] = $this->input->post('email');

            $this->db->where('user_id', $user_id);
            $this->db->update('user', $data);
            $this->common_model->clear_cache();
            move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/user_image/' . $user_id . '.jpg');
            $this->common_model->clear_cache();
            $this->session->set_flashdata('success', 'Profile information updated.');
            redirect(base_url() . 'admin/manage_profile/', 'refresh');
        }
        if ($param1 == 'change_password') {
            $password = md5($this->input->post('password'));
            $new_password = md5($this->input->post('new_password'));
            $retype_new_password = md5($this->input->post('retype_new_password'));

            $current_password = $this->db->get_where('user', array(
                'user_id' => $this->session->userdata('user_id')
            ))->row()->password;

            if ($current_password == $password && $new_password == $retype_new_password) {
                $this->db->where('user_id', $this->session->userdata('user_id'));
                $this->db->update('user', array(
                    'password' => $new_password
                ));
                $this->session->set_flashdata('success', 'Password changed.');
            } elseif ($current_password != $password) {
                $this->session->set_flashdata('error', 'Old password not correct.');

            } else {
                $this->session->set_flashdata('error', 'Password not match.');
            }
            redirect(base_url() . 'admin/manage_profile/', 'refresh');
        }
    }

    //theme
    function manage_theme()
    {
        if ($this->session->userdata('admin_is_login') != 1)
            redirect(base_url(), 'refresh');
        /* start menu active/inactive section*/
        $this->session->unset_userdata('active_menu');
        $this->session->set_userdata('active_menu', '12');
        /* end menu active/inactive section*/
        $data['page_name'] = 'manage_theme';
        $data['page_title'] = 'Manage theme color';
        $this->load->view('admin/index', $data);
    }

    //universal delete function
    function delete_record()
    {
        $response = array();
        $row_id = $this->input->post('row_id');
        $table_name = $this->input->post('table_name');
        $table_row_id = $table_name . '_id';
        $this->db->where($table_row_id, $row_id);
        $query = $this->db->delete($table_name);
        if ($query == true) {
            $response['status'] = 'success';
            $response['message'] = tr_wd('Deleted Successfully ...');
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Unable to delete product ...';
        }
        echo json_encode($response);

    }

    //imdb import
    function import_imdb()
    {
        $response = array();
        $id = $_POST["id"];
        $response['submitted_data'] = $_POST;

        $data = file_get_contents('http://ovoo.spagreen.net/movie-scrapper/get_movie_info_imdbid.php?imdbid=' . $id);
        $data = json_decode($data, true);
        if (isset($data['Title'])) {
            $response['imdb_status'] = 'success';
            $response['title'] = $data['Title'];
            $response['plot'] = $data['Plot'];
            $response['runtime'] = $data['Runtime'];
            $response['stars'] = $data['Actors'];
            $response['rating'] = $data['imdbRating'];
            $response['director'] = $data['Director'];
            $response['writer'] = $data['Writer'];
            $response['release'] = $data['Released'];
            $response['poster'] = $data['Poster'];
            $response['genre'] = [];
            $response['response'] = $data['Response'];

            $genre = array_map('trim', explode(",", $data['Genre']));
            $this->db->where_in('name', $genre);
            $dbGenre = $this->db->get('genre')->result();
            foreach ($dbGenre as $genre1) {
                array_push($response['genre'], $genre1->genre_id);
            }
        } else {
            $response['imdb_status'] = 'fail';
            $response['title'] = '';
            $response['plot'] = '';
            $response['runtime'] = '';
            $response['stars'] = '';
            $response['rating'] = '';
            $response['director'] = '';
            $response['writer'] = '';
            $response['release'] = '';
            $response['poster'] = '';
            $response['genre'] = '';
            $response['response'] = $data['Response'];

        }
        echo json_encode($response);
    }

    // rating
    function rating()
    {
        $response = array();
        $rate = $_POST["rate"];
        $video_id = $_POST["video_id"];
        $post_status = $this->post_rating($rate, $video_id);
        $response['post_status'] = $post_status;
        $response['rate'] = $rate;
        $response['video_id'] = $video_id;
        echo json_encode($response);

    }

    // post rating
    function post_rating($rate, $video_id)
    {

        $ip = $_SERVER['REMOTE_ADDR'];

        $verify_data = array(
            'video_id' => $video_id,
            'ip' => $ip
        );

        $data = array(
            'video_id' => $video_id,
            'rating' => $rate,
            'ip' => $ip
        );

        $query = $this->db->get_where('rating', $verify_data);
        $rating = $query->result_array();
        $num_row = $query->num_rows();
        if ($num_row > 0) {
            $this->db->where($verify_data);
            $this->db->update('rating', $data);
        } else {
            $this->db->insert('rating', $data);
            $current_rating = $this->db->get_where('videos', array('videos_id' => $video_id))->row()->total_rating;
            $rating = $current_rating + 1;
            $this->db->where('videos_id', $video_id);
            $this->db->update('videos', array('total_rating' => $rating));

        }
        return "success";
    }

    //movie scraper

    function movie_scrapper_manage()
    {
        if ($this->session->userdata('admin_is_login') != 1)
            redirect(base_url(), 'refresh');
        /* start menu active/inactive section*/
        $this->session->unset_userdata('active_menu');
        $this->session->set_userdata('active_menu', '7');
        /* end menu active/inactive section*/
        $data['page_name'] = 'movie_scrapper';
        $data['page_title'] = 'Movie Scrapper';
        $this->load->view('admin/index', $data);
    }

    //movie scraper management

    public function movie_scrapper()
    {
        $message = '';
        $list = trim($this->input->post('movie_list'));
        if ($list == '' || $list == NULL) {
            $message = '<div class="alert alert-warning"><strong>Note:</strong> Enter a least one movie title..</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url() . 'admin/videos_add/', 'refresh');
        }
        $explode = explode(',', $list);
        foreach ($explode as $movieName) {
            $url = 'http://ovoo.spagreen.net/movie-scrapper/get_movie_info_title.php?title=' . urlencode($movieName);
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1");
            $data = curl_exec($curl);
            curl_close($curl);
            $data = json_decode($data, true);
            //var_dump($data);
            if (isset($data['Title'])) {
                $imdbid = $data['imdbID'];
                $title = $data['Title'];
                $plot = $data['Plot'];
                $runtime = $data['Runtime'];
                $stars = $data['Actors'];
                $rating = $data['imdbRating'];
                $director = $data['Director'];
                $writer = $data['Writer'];
                $release = $data['Released'];
                $poster = $data['Poster'];
                $response = $data['Response'];
                $genres = explode(',', $data['Genre']);
                $genre_i = "";
                $i = 0;
                foreach ($genres as $genre) {
                    $i++;
                    if ($i > 1) {
                        $genre_i .= ',';
                    }
                    $genre_i .= $this->common_model->get_genre_id_by_name($genre);
                }
                $countries = explode(',', $data['Country']);
                $country_i = '';
                $j = 0;
                foreach ($countries as $country) {
                    $j++;
                    if ($j > 1) {
                        $country_i .= ',';
                    }
                    $country_i .= $this->common_model->get_country_id_by_name($country);
                }

                $imdb_data['imdbid'] = $imdbid;
                $imdb_data['title'] = $title;
                $imdb_data['description'] = $plot;
                $imdb_data['runtime'] = $runtime;
                $imdb_data['stars'] = $stars;
                $imdb_data['imdb_rating'] = $rating;
                $imdb_data['director'] = $director;
                $imdb_data['writer'] = $writer;
                $imdb_data['release'] = $release;
                $imdb_data['genre'] = $genre_i;
                $imdb_data['country'] = $country_i;
                $imdb_data['video_type'] = $this->common_model->escapeString(trim('1,4'));
                $imdb_data['downloadable_link'] = $this->common_model->escapeString(trim('#'));
                $imdb_data['embed_link'] = 'https://www.youtube.com/embed?listType=search&list=' . $title;
                $imdb_data['thumb_link'] = $poster;
                $imdb_data['image_link'] = $poster;
                $imdb_data['publication'] = '0';
                $result_row = count($this->db->get_where('videos', array('imdbid' => $imdbid))->result_array());

                if ($result_row == 0) {
                    $this->db->insert('videos', $imdb_data);
                    $insert_id = $this->db->insert_id();
                    $slug = url_title($title, 'dash', TRUE);
                    $slug_num = $this->common_model->slug_num('videos', $slug);
                    if ($slug_num > 0) {
                        $slug = $slug . '-' . $insert_id;
                    }
                    $slug_data['slug'] = $slug;
                    $this->db->where('videos_id', $insert_id);
                    $this->db->update('videos', $slug_data);
                    $message .= '<div class="alert alert-success"><strong>' . $movieName . ' </strong> Successfully added on your system.</div>';
                } else if ($result_row > 0) {
                    $message .= '<div class="alert alert-warning"><strong>' . $movieName . ' </strong> already exist on your system.</div>';
                }

            }
        }
        $this->session->set_flashdata('message', $message);
        redirect(base_url() . 'admin/movie_scrapper_manage/', 'refresh');
    }

}
