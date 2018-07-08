<div class="row">
  <div class="col-md-3">
    <div class="widget-small primary"><i class="icon fa fa-video-camera fa-3x"></i>
        <div class="info">
            <h4><?php echo tr_wd('published_videos') ?></h4>
            <p><b class="counter"><?php echo count($this->db->get_where('videos', array('publication' => '1'))->result_array());?></b></p>
        </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="widget-small info"><i class="icon fa fa-video-camera fa-3x"></i>
        <div class="info">
            <h4><?php echo tr_wd('unpublished_videos') ?></h4>
            <p><b class="counter"><?php echo count($this->db->get_where('videos', array('publication' => '0'))->result_array());?></b></p>
        </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="widget-small warning"><i class="icon fa fa-archive fa-3x"></i>
        <div class="info">
            <h4><?php echo tr_wd('published_genre') ?></h4>
            <p><b class="counter"><?php echo count($this->db->get_where('genre', array('publication' => '1'))->result_array()); ?></b></p>
        </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="widget-small danger"><i class="icon fa fa-file-video-o fa-3x"></i>
        <div class="info">
            <h4><?php echo tr_wd('video_category') ?></h4>
            <p><b class="counter"><?php echo count($this->db->get('video_type')->result_array()); ?></b></p>
        </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-3">
    <div class="widget-small primary coloured-icon"><i class="icon fa fa-flag fa-3x"></i>
        <div class="info">
            <h4><?php echo tr_wd('countries') ?></h4>
            <p><b class="counter"><?php echo count($this->db->get('country')->result_array());?></b></p>
        </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="widget-small info coloured-icon"><i class="icon fa fa-file-text-o fa-3x"></i>
        <div class="info">
            <h4><?php echo tr_wd('unpublished_pages') ?></h4>
            <p><b class="counter"><?php echo count($this->db->get_where('page', array('publication' => '1'))->result_array());?></b></p>
        </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="widget-small warning coloured-icon"><i class="icon fa fa-pencil-square-o fa-3x"></i>
        <div class="info">
            <h4><?php echo tr_wd('published_posts') ?></h4>
            <p><b class="counter"><?php echo count($this->db->get_where('posts', array('publication' => '1'))->result_array()); ?></b></p>
        </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="widget-small danger coloured-icon"><i class="icon fa fa-users fa-3x"></i>
        <div class="info">
            <h4><?php echo tr_wd('register_user') ?></h4>
            <p><b class="counter"><?php echo count($this->db->get('user')->result_array()); ?></b></p>
        </div>
    </div>
  </div>
</div>

    <div class="row">
      <div class="col-sm-12">
        <div class="panel panel-border panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title"><?php echo tr_wd('recent_comments') ?></h3>
          </div>
          <div class="panel-body">
            <table id="datatable-fixed-header" class="table table-striped table-bordered success">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Video</th>
                  <th>Comments</th>
                  <th>Comments At</th>
                </tr>
              </thead>
              <tbody>
                <?php
                                    
                
                $this->db->LIMIT('5' );
                $this->db->order_by('comment_at', 'desc' );                                    
                $comments = $this->db->get('comments')->result_array();                                  
                foreach ($comments as $comment): ?>
                <tr>
                <td><?php echo $this->common_model->get_name_by_id($comment['user_id']); ?></td>
                <td><?php echo $this->common_model->get_video_title_by_id($comment['video_id']); ?></td>
                  <td><?php echo $comment['comment']; ?></td>
                  <td><?php echo $comment['comment_at']; ?></td>                 
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

        <div class="row">
        <div class="col-sm-6">
        <div class="panel panel-border panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title"><?php echo tr_wd('most_popular_video') ?></h3>
          </div>
          <div class="panel-body">
            <table id="datatable-fixed-header" class="table table-striped table-bordered success">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Release</th>
                  <th>Total View</th>
                </tr>
              </thead>
              <tbody>
                <?php
                                    
                
                $this->db->LIMIT('5' );
                $this->db->order_by('total_view', 'desc' );                                    
                $videos = $this->db->get('videos')->result_array();                                  
                foreach ($videos as $video): ?>
                <tr>
                  <td><a href="<?php echo base_url().'watch/'.$video['slug'].'.html'; ?>" target="_blank"><?php echo $video['title']; ?></a></td>
                  <td><a href="<?php echo base_url().'watch/'.$video['slug'].'.html'; ?>" target="_blank"><?php echo $video['release']; ?></a></td>
                  <td><a href="<?php echo base_url().'watch/'.$video['slug'].'.html'; ?>" target="_blank"><?php echo $video['total_view']; ?></a></td>                 
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="panel panel-border panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title"><?php echo tr_wd('top_rated_video') ?></h3>
          </div>
          <div class="panel-body">
            <table id="datatable-fixed-header" class="table table-striped table-bordered success">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Release</th>
                  <th>Total Rating</th>
                </tr>
              </thead>
              <tbody>
                <?php
                                    
                
                $this->db->LIMIT('5' );
                $this->db->order_by('total_rating', 'desc' );                                    
                $videos = $this->db->get('videos')->result_array();                                  
                foreach ($videos as $video): ?>
                <tr>
                  <td><a href="<?php echo base_url().'watch/'.$video['slug'].'.html'; ?>" target="_blank"><?php echo $video['title']; ?></a></td>
                  <td><a href="<?php echo base_url().'watch/'.$video['slug'].'.html'; ?>" target="_blank"><?php echo $video['release']; ?></a></td>
                  <td><a href="<?php echo base_url().'watch/'.$video['slug'].'.html'; ?>" target="_blank"><?php echo $video['total_rating']; ?></a></td>                 
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      </div>

    <div class="row">
    <div class="col-sm-6">
        <div class="panel panel-border panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title"><?php echo tr_wd('recent_registration') ?></h3>
          </div>
          <div class="panel-body">
            <table id="datatable-fixed-header" class="table table-striped table-bordered success">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Join At</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $this->db->LIMIT('5' );
                $this->db->order_by('join_date', 'desc' );                                    
                $subscribers = $this->db->get('user')->result_array();                                  
                foreach ($subscribers as $subscriber): ?>
                <tr>
                  <td><?php echo $subscriber['name']; ?></td>
                  <td><?php echo $subscriber['email']; ?></td>
                  <td><?php echo $subscriber['join_date']; ?></td>                 
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="panel panel-border panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title"><?php echo tr_wd('recent_subscriber') ?></h3>
          </div>
          <div class="panel-body">
            <table id="datatable-fixed-header" class="table table-striped table-bordered success">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Subscribe At</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $this->db->LIMIT('5' );
                $this->db->order_by('subscribe_at', 'desc' );                                    
                $subscribers = $this->db->get('subscriber')->result_array();                                  
                foreach ($subscribers as $subscriber): ?>
                <tr>
                  <td><?php echo $subscriber['name']; ?></td>
                  <td><?php echo $subscriber['email']; ?></td>
                  <td><?php echo $subscriber['subscribe_at']; ?></td>                 
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="panel panel-border panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Admins Video</h3>
          </div>
          <div class="panel-body">
            <table id="datatable-fixed-header" class="table table-striped table-bordered success">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Total Videos</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $admins = $this->common_model->get_admin_videos_count();
                foreach ($admins as $admin): ?>
                <tr>
                  <td><?php echo $admin['name']; ?></td>
                  <td><?php echo $admin['email']; ?></td>
                  <td><?php echo $admin['total_videos']; ?></td>                 
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

<script src="<?php echo base_url();?>assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
<script src="<?php echo base_url();?>assets/plugins/counterup/jquery.counterup.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.counter').counterUp({
            delay: 1000,
            time: 2000
        });

    });

</script>