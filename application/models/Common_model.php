<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * OVOO Movie Streaming CMS.
 *
 * Web based warranty and inventory tracking system available on codecanyon
 *
 * @package     OVOO
 * @author      Abdul Mannan
 * @copyright   Copyright (c) 2014 - 2016 SpaGreen,
 * @license     http://codecanyon.net/wiki/support/legal-terms/licensing-terms/
 * @link        http://www.spagreen.net
 * @link        support@spagreen.net
 *
 **/
class Common_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    /* clear cache*/
    function clear_cache()
    {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }


    function check_email_username($username = '', $email = '')
    {
        $this->db->where('email', $email);
        $this->db->or_where('username', $username);
        //var_dump($username,$email);
        $rows = count($this->db->get('user')->result_array());
        if ($rows > 0) {
            return TRUE;
        } else {
            return FALSE;
        }

    }

    function check_email($email = '')
    {
        $this->db->where('email', $email);
        $rows = count($this->db->get('user')->result_array());
        if ($rows > 0) {
            return TRUE;
        } else {
            return FALSE;
        }

    }

    function check_token($token = '')
    {
        $this->db->where('token', $token);
        $rows = count($this->db->get('user')->result_array());
        if ($rows > 0) {
            return TRUE;
        } else {
            return FALSE;
        }

    }


    function slug_exist($table = '', $slug = '')
    {
        $rows = count($this->db->get_where($table, array('slug' => $slug))->result_array());
        if ($rows > 0) {
            return TRUE;
        } else {
            return FALSE;
        }

    }

    function slug_num($table = '', $slug = '')
    {
        return count($this->db->get_where($table, array('slug' => $slug))->result_array());

    }


    function get_video_type($video_type_id = '')
    {
        $query = $this->db->get_where('video_type', array('video_type_id' => $video_type_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['video_type'];

    }

    function get_category_name($category_id = '')
    {
        $query = $this->db->get_where('post_category', array('post_category_id' => $category_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['category'];

    }


    /* get image url */
    function get_img($type = '', $id = '')
    {
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
            $image_url = base_url() . 'uploads/user.jpg';

        return $image_url;
    }

    /* create and download database backup*/
    function create_backup()
    {
        $this->load->dbutil();
        $options = array(
            'format' => 'txt',
            'add_drop' => TRUE,
            'add_insert' => TRUE,
            'newline' => "\n"
        );

        $tables = array('');
        $file_name = 'ovoo_backup_' . date('Y-m-d-H-i-s');
        $backup = $this->dbutil->backup(array_merge($options, $tables));
        $this->load->helper('file');
        write_file('db_backup/' . $file_name . '.sql', $backup);
        //$this->load->helper('download');
        //force_download($file_name.'.sql', $backup);
        return 'done';
    }


    /* restore database backup*/
    function restore_backup()
    {

        move_uploaded_file($_FILES['backup_file']['tmp_name'], 'uploads/backup.sql');

        $prefs = array(
            'filepath' => 'uploads/backup.sql',
            'delete_after_upload' => TRUE,
            'delimiter' => ';'
        );

        $schema = htmlspecialchars(file_get_contents($prefs['filepath']));

        $query = rtrim(trim($schema), "\n;");

        $query_list = explode(";", $query);
        $this->truncate();


        foreach ($query_list as $query) {
            $this->db->query($query);
        }
        /*$restore =& $this->dbutil->restore($prefs);
    */
        unlink($prefs['filepath']);
    }

    /* empty data from table */
    function truncate()
    {
        $this->db->truncate('access');
        $this->db->truncate('accessories');
        $this->db->truncate('apps');
        $this->db->truncate('brand');
        $this->db->truncate('category');
        $this->db->truncate('computer');
        $this->db->truncate('ip');
        $this->db->truncate('device');
        $this->db->truncate('os');
        $this->db->truncate('supplier');
    }

    function reset_database()
    {
        $this->set_custom_value();
        $this->truncate();
        $prefs = array(
            'filepath' => 'uploads/data.sql',
            'delete_after_upload' => FALSE,
            'delimiter' => ';'
        );

        $schema = htmlspecialchars(file_get_contents($prefs['filepath']));

        $query = rtrim(trim($schema), "\n;");

        $query_list = explode(";", $query);
        $this->truncate();
        foreach ($query_list as $query) {
            $this->db->query($query);
        }
        unlink($prefs['filepath']);

    }

    function set_custom_value()
    {
        $data['value'] = "Luke Dhaka Company Limited";
        $this->db->where('title', 'company_name');
        $this->db->update('config', $data);

        $data['value'] = "Gulshan, Dhaka-1200";
        $this->db->where('title', 'address');
        $this->db->update('config', $data);

        $data['value'] = "880100000000";
        $this->db->where('title', 'phone');
        $this->db->update('config', $data);

        $data['value'] = "support@spagreen.net";
        $this->db->where('title', 'system_email');
        $this->db->update('config', $data);
    }

    public function all_published_slider()
    {
        return $this->db->get_where('slider', array('publication' => '1'), 8)->result();
    }

    public function all_published_videos($limit = NULL, $start = NULL)
    {
        if($limit == NULL){
            $num = 2;
            $col = 6;
            $col = $this->db->get_where('thumbnail', array('id' => 1))->row()->cols;
            if ($col == 6) {
                $num = 2;
            } else if ($col == 4) {
                $num = 3;
            } else if ($col == 3) {
                $num = 4;
            } else if ($col == 2) {
                $num = 6;
            }
            $rows = $this->db->get_where('thumbnail', array('id' => 1))->row()->rows;
            $limit = $rows * $num;
        }
        $this->db->select("*, RIGHT(  `release` , 4 ) as year");
        $this->db->from('videos');
        $this->db->where("FIND_IN_SET(left(1,10),video_type)>0");
        $this->db->where('publication', '1');
        $this->db->where('RIGHT(`release`, 4 ) != "N/A"');
        $this->db->order_by("year DESC, videos_id DESC");
        $this->db->limit($limit, $start);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function all_published_tv_series()
    {
        $num = 2;
        $col = 6;
        $col = $this->db->get_where('thumbnail', array('id' => 1))->row()->cols;
        if ($col == 6) {
            $num = 2;
        } else if ($col == 4) {
            $num = 3;
        } else if ($col == 3) {
            $num = 4;
        } else if ($col == 2) {
            $num = 6;
        }
        $rows = $this->db->get_where('thumbnail', array('id' => 1))->row()->rows;
        $limit = $rows * $num;
        $this->db->select("*, RIGHT(  `release` , 4 ) as year");
        $this->db->from('videos');
        $this->db->where("FIND_IN_SET(left(2,10),video_type)>0");
        $this->db->where('publication', '1');
        $this->db->where('RIGHT(`release`, 4 ) != "N/A"');
        $this->db->order_by("year DESC, videos_id DESC");
        $this->db->limit($limit);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function all_published_request_movies()
    {
        $this->db->select('*');
        $this->db->from('videos');
        $this->db->where("FIND_IN_SET(left(3,10),video_type)>0");
        //$this->db->where('video_type', '3');
        $this->db->where('publication', '1');
        $this->db->order_by("videos_id", "desc");
        $this->db->limit(12);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function all_page_on_primary_menu()
    {
        $this->db->select('*');
        $this->db->from('page');
        $this->db->where('primary_menu', '1');
        $this->db->where('deletable', '1');
        $this->db->order_by("page_id", "ASC");
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function all_page_on_footer_menu()
    {
        $this->db->select('*');
        $this->db->from('page');
        $this->db->where('footer_menu', '1');
        $this->db->order_by("page_id", "ASC");
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }


    public function all_published_trailers()
    {
        $this->db->select('*');
        $this->db->from('videos');
        $this->db->where("FIND_IN_SET(left(4,10),video_type)>0");
        //$this->db->where('video_type', '4');
        $this->db->where('publication', '1');
        $this->db->order_by("videos_id", "desc");
        $this->db->limit(6);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function video_genres($video_id)
    {

        $genres = $this->db->select('genre.*')
            ->from('video_genre')
            ->join('genre', 'video_genre = genre.genre_id')
            ->where('video_genre', array('video_id' => $video_id))
            ->result();

        $data = [];
        foreach ($genres as $genre) {
            array_push($data, $genre['id']);
        }

        return $data;
    }

    public function all_published_genre()
    {

        return $this->db->get_where('genre', array('publication' => '1'))->result();
    }


    public function all_published_country()
    {

        return $this->db->get_where('country', array('publication' => '1'))->result();
    }

    public function get_videos_by_slug($slug)
    {
        return $this->db->get_where('videos', array('slug' => $slug))->row();
    }

    public function watch_count_by_slug($slug)
    {
        $videos_id = $this->db->get_where('videos', array('slug' => $slug))->row()->videos_id;
        $total_view = $this->db->get_where('videos', array('slug' => $slug))->row()->total_view;
        $data['total_view'] = $total_view + 1;
        $this->db->where('videos_id', $videos_id);
        $this->db->update('videos', $data);
    }

    public function get_genre_by_slug($slug)
    {
        $genre_id = $this->db->get_where('genre', array('slug' => $slug))->row();

        $this->db->select('*');
        $this->db->from('videos');
        $this->db->where('genre', $genre_id->genre_id);
        $this->db->where('publication', '1');
        $this->db->order_by("videos_id", "desc");
        $this->db->limit(24);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_video_by_star($limit, $start, $star)
    {

        $this->db->select('*');
        $this->db->from('videos');
        $this->db->like('stars', $star);
        $this->db->where('publication', '1');
        $this->db->order_by("videos_id", "desc");
        $this->db->limit(24);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return '';

    }

    public function get_video_by_star_record_count($star)
    {
        $this->db->select('*');
        $this->db->from('videos');
        $this->db->like('stars', $star);
        $this->db->where('publication', '1');
        $this->db->order_by("videos_id", "desc");
        $this->db->limit(24);
        $query = $this->db->get();
        return $query->num_rows();
    }


    public function get_video_by_director($limit, $start, $director)
    {

        $this->db->select('*');
        $this->db->from('videos');
        $this->db->like('director', $director);
        $this->db->where('publication', '1');
        $this->db->order_by("videos_id", "desc");
        $this->db->limit(24);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return '';

    }

    public function get_videos_count($whereCondition = NULL)
    {

        $this->db->select('*');
        $this->db->from('videos');
        if (!empty($whereCondition))
            $this->db->like('title', $whereCondition);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();

        }
    }

    public function get_videos($limit = NULL, $start = NULL, $whereCondition = NULL)
    {

        $this->db->select('videos.*, user.name');
        $this->db->from('videos');
        $this->db->join('user', 'videos.added_by = user.user_id', 'left');
        if (!empty($whereCondition))
            $this->db->like('title', $whereCondition);
        $this->db->order_by("videos_id", "desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();

        }
    }

    public function get_broken_link_video($id)
    {

        $this->db->select('*');
        $this->db->from('broken_link');
        $this->db->where('video_id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }

    public function get_broken_link_videos($limit = NULL, $start = NULL)
    {
        $this->db->select('*, videos.slug');
        $this->db->from('videos');
        $this->db->join('broken_link', 'videos.videos_id = broken_link.video_id');
        $this->db->join('user', 'videos.added_by = user.user_id', 'left');
        $this->db->order_by("last_reported desc, total_reports desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
    }

    public function get_admin_videos_count($limit = NULL, $start = NULL)
    {
        $query = $this->db->select('user.user_id, user.name, user.email, COUNT(videos.videos_id) as original_videos')
            ->from('user')
            ->join('videos', 'user.user_id = videos.added_by')
            ->where('user.role', 'admin')
            ->order_by('original_videos', 'DESC')
            ->group_by('user.user_id')
            ->get();
        $admins = $query->result_array();
        $array = [];
        $i = 0;
        foreach ($admins as $admin) {
            $array[$i]['user_id'] = $admin['user_id'];
            $array[$i]['name'] = $admin['name'];
            $array[$i]['email'] = $admin['email'];
            $array[$i]['total_videos'] = $admin['original_videos'];
            $i++;
        }
        $query1 = $this->db->select('v.added_by, s.*, COUNT(s.video_source_id) as extra_vs')
            ->from('videos as v')
            ->join('video_source as s', 'v.videos_id = s.videos_id')
            ->group_by('v.added_by')
            ->get();
        $sources = $query1->result_array();
        foreach ($array as &$a) {
            foreach ($sources as $source) {
                if ($source['added_by'] == $a['user_id']) {
                    /*echo 'User : ' . $a['name'] . ' | Total Videos Before : ' . $a['total_videos']
                        . ' | Total Videos Extra : ' . $source['extra_vs'] . " ---------------- ";*/
                    $a['total_videos'] = $a['total_videos'] + $source['extra_vs'];
                }
            }
        }

        $array = $this->array_msort($array, array('total_videos' => SORT_DESC));
        $array = array_slice($array, 0, 10);
        return $array;
    }

    private function array_msort($array, $cols)
    {
        $colarr = array();
        foreach ($cols as $col => $order) {
            $colarr[$col] = array();
            foreach ($array as $k => $row) {
                $colarr[$col]['_' . $k] = strtolower($row[$col]);
            }
        }
        $eval = 'array_multisort(';
        foreach ($cols as $col => $order) {
            $eval .= '$colarr[\'' . $col . '\'],' . $order . ',';
        }
        $eval = substr($eval, 0, -1) . ');';
        eval($eval);
        $ret = array();
        foreach ($colarr as $col => $arr) {
            foreach ($arr as $k => $v) {
                $k = substr($k, 1);
                if (!isset($ret[$k])) $ret[$k] = $array[$k];
                $ret[$k][$col] = $array[$k][$col];
            }
        }
        return $ret;

    }

    public function get_video_by_director_record_count($director)
    {
        $this->db->select('*');
        $this->db->from('videos');
        $this->db->like('director', $director);
        $this->db->where('publication', '1');
        $this->db->order_by("videos_id", "desc");
        $this->db->limit(24);
        $query = $this->db->get();
        return $query->num_rows();
    }


    public function get_video_by_tags($limit, $start, $tags)
    {

        $this->db->select('*');
        $this->db->from('videos');
        $this->db->like('tags', $tags);
        $this->db->where('publication', '1');
        $this->db->order_by("videos_id", "desc");
        $this->db->limit(24);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return '';

    }

    public function get_video_by_year($limit, $start, $year)
    {

        $this->db->select('*');
        $this->db->from('videos');
        $this->db->like('release', $year);
        $this->db->where('publication', '1');
        $this->db->order_by("videos_id", "desc");
        $this->db->limit(24);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return '';

    }

    public function get_video_by_tags_record_count($tag)
    {
        $this->db->select('*');
        $this->db->from('videos');
        $this->db->like('tags', $tag);
        $this->db->where('publication', '1');
        $this->db->order_by("videos_id", "desc");
        $this->db->limit(24);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_video_by_year_record_count($year)
    {
        $this->db->select('*');
        $this->db->from('videos');
        $this->db->like('release', $year);
        $this->db->where('publication', '1');
        $this->db->order_by("videos_id", "desc");
        $this->db->limit(24);
        $query = $this->db->get();
        return $query->num_rows();
    }


    public function get_country_by_slug($slug)
    {
        $country_id = $this->db->get_where('country', array('slug' => $slug))->row();

        $this->db->select('*');
        $this->db->from('videos');
        $this->db->where('country', $country_id->country_id);
        $this->db->where('publication', '1');
        $this->db->order_by("videos_id", "desc");
        $this->db->limit(32);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;

    }

    public function get_country_id_by_name($name)
    {
        $result = count($this->db->get_where('country', array('name' => $name))->result_array());
        if ($result > 0) {
            $country_id = $this->db->get_where('country', array('name' => $name))->row();
            return $country_id->country_id;
        } else {
            $data['name'] = $name;
            $data['description'] = $name;
            $data['slug'] = url_title($name, 'dash', TRUE);
            $data['publication'] = '1';
            $this->db->insert('country', $data);
            return $this->db->insert_id();
        }

    }

    public function get_genre_id_by_name($name)
    {
        $result = count($this->db->get_where('genre', array('name' => $name))->result_array());
        if ($result > 0) {
            $genre_id = $this->db->get_where('genre', array('name' => $name))->row();
            return $genre_id->genre_id;
        } else {
            $data['name'] = $name;
            $data['description'] = $name;
            $data['slug'] = url_title($name, 'dash', TRUE);
            $data['publication'] = '1';
            $this->db->insert('genre', $data);
            return $this->db->insert_id();
        }

    }

    public function movies_record_count()
    {

        $query = $this->db->where("FIND_IN_SET(left(1,10),video_type)>0")->get('videos');

        return $query->num_rows();
    }

    public function search_movies_record_count($search = '')
    {
        $query = $this->db->like('title', $search)->get('videos');

        return $query->num_rows();
    }

    public function tv_series_record_count()
    {
        $query = $this->db->where("FIND_IN_SET(left(2,10),video_type)>0")->get('videos');
        //$query = $this->db->where('video_type', '2')->get('videos');

        return $query->num_rows();
    }

    public function requested_movie_record_count()
    {
        $query = $this->db->where("FIND_IN_SET(left(3,10),video_type)>0")->get('videos');
        //$query = $this->db->where('video_type', '3')->get('videos');

        return $query->num_rows();
    }

    public function trailers_record_count()
    {
        $query = $this->db->where("FIND_IN_SET(left(4,10),video_type)>0")->get('videos');
        //$query = $this->db->where('video_type', '4')->get('videos');

        return $query->num_rows();
    }

    public function fetch_videos($limit, $start)
    {
        $this->db->limit($limit, $start);

        $this->db->select('*');
        $this->db->from('videos');
        //$this->db->where('video_type', '1');
        $this->db->where("FIND_IN_SET(left(1,10),video_type)>0");
        $this->db->where('publication', '1');
        $this->db->order_by("videos_id", "desc");
        $this->db->limit(24);
        $query = $this->db->get();


        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function fetch_search_videos($limit, $start, $search)
    {
        $this->db->limit($limit, $start);

        $this->db->select('*');
        $this->db->from('videos');
        $this->db->like('title', $search);
        $this->db->where('publication', '1');
        $this->db->order_by("videos_id", "desc");
        $this->db->limit(24);
        $query = $this->db->get();


        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }


    public function fetch_tv_series($limit, $start)
    {
        $this->db->limit($limit, $start);

        $this->db->from('videos');
        $this->db->where("FIND_IN_SET(left(2,10),video_type)>0");
        //$this->db->where('video_type', '2');
        $this->db->where('publication', '1');
        $this->db->order_by("videos_id", "desc");
        $this->db->limit(24);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function fetch_request_movies($limit, $start)
    {
        $this->db->limit($limit, $start);

        $this->db->select('*');
        $this->db->from('videos');
        $this->db->where("FIND_IN_SET(left(3,10),video_type)>0");
        //$this->db->where('video_type', '3');
        $this->db->where('publication', '1');
        $this->db->order_by("videos_id", "desc");
        $this->db->limit(32);
        $query = $this->db->get();


        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function fetch_trailers($limit, $start)
    {
        $this->db->limit($limit, $start);

        $this->db->select('*');
        $this->db->from('videos');
        $this->db->where("FIND_IN_SET(left(4,10),video_type)>0");
        //$this->db->where('video_type', '4');
        $this->db->where('publication', '1');
        $this->db->order_by("videos_id", "desc");
        $this->db->limit(32);
        $query = $this->db->get();


        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }

    public function fetch_genre_video_by_slug($limit, $start, $slug)
    {
        $genre_id = $this->db->get_where('genre', array('slug' => $slug))->row();
        $this->db->limit($limit, $start);
        $this->db->select('*');
        $this->db->from('videos');
        $this->db->where("FIND_IN_SET(" . $genre_id->genre_id . ",genre) > 0");
        // $this->db->where('genre', $genre_id->genre_id);
        //$this->db->where('video_type', '3');
        $this->db->where('publication', '1');
        $this->db->order_by("videos_id", "desc");
        $this->db->limit(24);
        $query = $this->db->get();


        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return '';
    }

    public function fetch_genre_video_by_slug_record_count($slug)
    {
        $genre_id = $this->db->get_where('genre', array('slug' => $slug))->row();
        $query = $this->db->where("FIND_IN_SET(" . $genre_id->genre_id . ",genre) > 0")->get('videos');

        return $query->num_rows();
    }


    public function fetch_country_video_by_slug($limit, $start, $slug)
    {
        $country_id = $this->db->get_where('country', array('slug' => $slug))->row();
        $this->db->limit($limit, $start);
        $this->db->select('*');
        $this->db->from('videos');
        $this->db->where('country', $country_id->country_id);
        //$this->db->where('video_type', '3');
        $this->db->where('publication', '1');
        $this->db->order_by("videos_id", "desc");
        $this->db->limit(24);
        $query = $this->db->get();


        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return '';
    }

    public function fetch_country_video_by_slug_record_count($slug)
    {
        $country_id = $this->db->get_where('country', array('slug' => $slug))->row();
        $query = $this->db->where(array('country' => $country_id->country_id))->get('videos');

        return $query->num_rows();
    }


    public function fetch_blog_post($limit, $start)
    {
        $this->db->limit($limit, $start);
        $this->db->select('*');
        $this->db->from('posts');
        $this->db->where('publication', '1');
        $this->db->order_by("posts_id", "DESC");
        $this->db->limit(10);
        $query = $this->db->get();


        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return '';
    }

    public function fetch_blog_post_record_count()
    {

        $query = $this->db->where(array('publication' => '1'))->get('posts');

        return $query->num_rows();
    }

    public function post_comments_record_count_by_id($id = '')
    {

        $query = $this->db->where(array('post_id' => $id, 'comment_type' => '1', 'publication' => '1'))->get('post_comments');

        return $query->num_rows();
    }

    public function fetch_blog_post_by_category_record_count($slug)
    {
        $category_id = $this->db->get_where('post_category', array('slug' => $slug))->row();
        $this->db->where("FIND_IN_SET(left($category_id->post_category_id,10),category_id)>0");
        $this->db->where('publication', '1');
        $query = $this->db->get('posts');
        return $query->num_rows();
    }

    public function fetch_blog_post_by_category($limit, $start, $slug)
    {
        $category_id = $this->db->get_where('post_category', array('slug' => $slug))->row();
        $this->db->limit($limit, $start);
        $this->db->select('*');
        $this->db->where("FIND_IN_SET(left($category_id->post_category_id,10),category_id)>0");
        $this->db->where('publication', '1');
        $this->db->order_by("posts_id", "desc");
        $this->db->limit(10);
        $query = $this->db->get('posts');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return '';
    }

    public function fetch_blog_post_by_author_record_count($slug)
    {
        $author_id = $this->db->get_where('user', array('slug' => $slug))->row();
        $this->db->where('user_id', $author_id->user_id);
        $this->db->where('publication', '1');
        $query = $this->db->get('posts');
        return $query->num_rows();
    }

    public function fetch_blog_post_by_author($limit, $start, $slug)
    {
        $author_id = $this->db->get_where('user', array('slug' => $slug))->row();
        $this->db->limit($limit, $start);
        $this->db->select('*');
        $this->db->where('user_id', $author_id->user_id);
        $this->db->where('publication', '1');
        $this->db->order_by("posts_id", "desc");
        $this->db->limit(10);
        $query = $this->db->get('posts');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return '';
    }


    public function search_result($search)
    {
        $this->db->like('title', $search);
        $query = $this->db->get('videos');
        return $query->result();
    }


    function get_image_url($type = '', $id = '')
    {
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
            $image_url = base_url() . 'uploads/user.jpg';

        return $image_url;
    }


    function get_name_by_id($user_id)
    {
        $query = $this->db->get_where('user', array('user_id' => $user_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name'];
    }

    function get_slug_by_user_id($user_id)
    {
        $query = $this->db->get_where('user', array('user_id' => $user_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['slug'];
    }

    function get_category_name_by_id($category_id)
    {
        $query = $this->db->get_where('post_category', array('post_category_id' => $category_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['category'];
    }

    function get_slug_by_category_id($category_id)
    {
        $query = $this->db->get_where('post_category', array('post_category_id' => $category_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['slug'];
    }

    public function get_posts_by_slug($slug)
    {
        return $this->db->get_where('posts', array('slug' => $slug))->row();
    }

    public function related_posts($id = '')
    {
        $this->db->select('*');
        $this->db->from('posts');
        $this->db->where("FIND_IN_SET(left($id,10),category_id)>0");
        $this->db->where('publication', '1');
        $this->db->order_by("posts_id", "desc");
        $this->db->limit(2);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function create_small_thumbnail($source = '', $destination = '', $width = '', $height = '')
    {
        $this->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['height'] = $height;
        $config['width'] = $width;
        $config['new_image'] = $destination;//you should have write permission here..
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
    }

    public function get_page_details_by_slug($slug)
    {
        return $this->db->get_where('page', array('slug' => $slug))->row();
    }

    function get_video_title_by_id($videos_id)
    {
        $query = $this->db->get_where('videos', array('videos_id' => $videos_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['title'];
    }


    function escapeString($val)
    {
        $db = get_instance()->db->conn_id;
        $val = mysqli_real_escape_string($db, $val);
        return $val;
    }

    function time_ago($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }


}

