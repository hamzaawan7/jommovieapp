<!-- Breadcrumb -->
<div id="title-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-8 col-xs-12">
                <div class="page-title">
                    <h1 class="text-uppercase">
                        <?php echo $watch_videos->title; ?>
                    </h1>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-12 text-right">
                <ul class="breadcrumb">
                    <li>
                        <a href="<?php echo base_url(); ?>"><i class="fi ion-ios-home"></i>Home</a>
                    </li>
                    <li class="active">Movies</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumb -->
<div id="movie-details">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php if ($this->session->userdata('login_status') == 1 || $this->db->get_where('config', array('title' => 'restrict_visitors'))->row()->value == '0'): ?>
                    <div class="movie-payer">
                        <div class="responsive-embed responsive-make">
                            <?php if ($param1 == '') { ?>
                                <iframe class="responsive-embed-item" id="myVideo" src="<?php echo $watch_videos->embed_link; ?>"
                                        allowfullscreen="true" webkitallowfullscreen="true"
                                        mozallowfullscreen="true"></iframe>
                            <?php } else {
                                $embed_link_extra = $this->db->get_where('video_source', array('video_source_id' => $param1))->row()->embed_link;;
                                ?>
                                <iframe class="responsive-embed-item" id="myVideo" src="<?php if ($embed_link_extra != '') {
                                    echo $embed_link_extra;
                                } else {
                                    echo 'https://www.youtube.com/embed?listType=search&amp;list=' . $watch_videos->title;
                                } ?>" allowfullscreen="true" webkitallowfullscreen="true"
                                        mozallowfullscreen="true"></iframe>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="m-b-20">
                        <?php
                        $this->db->order_by('order', 'ASC');
                        $video_source = $this->db->get_where('video_source', array('videos_id' => $watch_videos->videos_id))->result_array();
                        $num_source = count($video_source);
                        $i = 0;
                        $j = 0;
                        $check = false;
                        foreach ($video_source as $source):
                            $j++;
                            $i++;
                            if ($j % 6 == 1) {
                                ?>
                                <div class="row">
                                <div class="col-md-12">
                                <?php
                                if (!$check) {
                                    $check = true;
                                    $j++;
                                    ?>
                                    <div class="col-sm-2" style="margin-top: 1% !important;">
                                        <a href="<?php echo base_url() . 'watch/' . $watch_videos->slug . '.html'; ?>"
                                           class="btn <?php if ($param1 == '') {
                                               echo 'btn-success';
                                           } else {
                                               echo 'btn-default';
                                           } ?> m-r-20" id="source00">
                                            Main
                                        </a>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                            <div class="col-sm-2" style="margin-top: 1% !important;">
                                <a href="<?php echo base_url() . 'watch/' . $watch_videos->slug . '/' . $source['video_source_id'] . '.html'; ?>"
                                   class="btn <?php if ($param1 == $source['video_source_id']) {
                                       echo 'btn-success';
                                   } else {
                                       echo 'btn-default';
                                   } ?> m-r-20" id="source<?php echo $i; ?>"
                                   style="<?php if ($param1 != $source['video_source_id']) {
                                       echo 'background-color: #e4e4e4';
                                   } ?>">
                                    <?php echo $source['source_name'] ?>
                                </a>
                            </div>
                            <?php
                            if ($j % 6 == 0) {
                                $j = 0;
                                ?>
                                </div>
                                </div>
                                <?php
                            }
                            ?>
                        <?php endforeach; ?>
                        <?php
                        if ($j != 0) { ?>
                    </div>
                <?php } ?>
                </div>
                <?php else: ?>
                    <h3 class="text-center">Please <a class="btn btn-success btn-sm"
                                                      href="<?php echo base_url('user/login'); ?>"> <span
                                    class="btn-label"><i class="fi ion-log-in"></i></span>Login</a> to watch
                        the
                        video
                    </h3>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-6 text-right">
                <a href="<?php echo base_url() . '/watch/' . $watch_videos->slug . '/' . $watch_videos->videos_id . '/report' ?>"
                   class="btn btn-success"><span class="btn-label"><i class="fa fa-chain-broken"></i></span>
                    Report
                    Broken Link</a>
                <?php if ($this->session->userdata('admin_is_login') == 1): ?>
                    <a href="<?php echo base_url() . 'admin/videos_edit/' . $watch_videos->videos_id; ?>"
                       class="btn btn-success"><span class="btn-label"><i class="fa fa-pencil"></i></span> Edit
                        Video</a>
                <?php endif; ?>
                <a href="<?php echo $watch_videos->downloadable_link; ?>" class="btn btn-success"><span
                            class="btn-label"><i class="fa fa-download"></i></span> Download</a>

            </div>
        </div>
        <div class="row m-t-20">
            <div class="col-md-9 col-sm-8">
                <div class="movie-details-container">
                    <div class="row">
                        <div class="col-md-3 m-t-20"><img class="img-responsive" style="min-width: 183px;"
                                                          src="<?php echo $watch_videos->image_link; ?>"
                                                          alt="<?php echo $watch_videos->title; ?>"></div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1>
                                        <?php echo $watch_videos->title; ?>
                                    </h1>
                                    <?php if ($this->db->get_where('config', array('title' => 'social_share_enable'))->row()->value == '1'): ?>
                                        <!-- Addthis Social tool -->
                                        <script type="text/javascript"
                                                src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58d74b9dcfd76af7"></script>
                                        <div class="addthis_inline_share_toolbox m-t-30 m-b-10"></div>
                                        <!-- Addthis Social tool -->
                                    <?php endif; ?>
                                    <p>
                                        <?php echo $watch_videos->description; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <p><strong>Genre: </strong>
                                        <?php $genre_lists = explode(',', $watch_videos->genre);
                                        foreach ($genre_lists as $genre_list):
                                            $genre = $this->db->get_where('genre', array('genre_id' => $genre_list))->row();
                                            ?>

                                            <a href="<?php echo site_url('genre/' . $genre->slug) ?>"><?php echo $genre->name; ?></a>
                                        <?php endforeach; ?> </p>
                                    <p><strong>Actor: </strong>
                                        <?php $stars = explode(',', $watch_videos->stars);
                                        foreach ($stars as $star):
                                            ?>
                                            <a href="<?php echo base_url() . 'star/' . $star; ?>">
                                                <?php echo $star; ?>
                                            </a>
                                        <?php endforeach; ?> </p>
                                    <p><strong>Director: </strong>
                                        <?php $directors = explode(',', $watch_videos->director);
                                        foreach ($directors as $director):
                                            ?>
                                            <a href="<?php echo base_url() . 'director/' . $director; ?>">
                                                <?php echo $director; ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </p>
                                    <p><strong>Country: </strong>
                                        <?php
                                        $countries = explode(',', $watch_videos->country);
                                        foreach ($countries as $country):
                                            $country = $this->db->get_where('country', array('country_id' => $country))->row();
                                            ?>
                                            <a href="<?php echo site_url('country/' . $country->slug) ?>"><?php echo $country->name; ?></a>
                                        <?php endforeach; ?>
                                    </p>
                                    <p><strong>Release: </strong>
                                        <?php echo $watch_videos->release; ?>
                                    </p>
                                </div>
                                <div class="col-md-6 text-left">
                                    <p><strong>Duration:</strong>
                                        <?php echo $watch_videos->runtime; ?>
                                    </p>
                                    <p><strong>Quality:</strong> <span class="btn btn-xs btn-default">HD</span>
                                    </p>
                                    <p><strong>Rating:</strong>
                                        <?php echo $watch_videos->rating; ?>
                                    </p>
                                    <p>
                                        <strong><img
                                                    src="<?php echo base_url(); ?>assets/front_end/images/imdb-logo.png"></strong>
                                        <?php echo $watch_videos->imdb_rating; ?>
                                    </p>
                                    <div class='rating_selection pull-left'><strong
                                                id="rated">Rating(<?php echo $watch_videos->total_rating; ?>
                                            )</strong><br>
                                        <input checked id='rating_0' class="rate_now" name='rating' type='radio'
                                               value='0'>
                                        <label for='rating_0'> <span>Unrated</span> </label>
                                        <input id='rating_1' class="rate_now" name='rating' type='radio'
                                               value='1'>
                                        <label for='rating_1'> <span>Rate 1 Star</span> </label>
                                        <input id='rating_2' class="rate_now" name='rating' type='radio'
                                               value='2'>
                                        <label for='rating_2'> <span>Rate 2 Stars</span> </label>
                                        <input id='rating_3' class="rate_now" name='rating' type='radio'
                                               value='3'
                                               checked>
                                        <label for='rating_3'> <span>Rate 3 Stars</span> </label>
                                        <input id='rating_4' class="rate_now" name='rating' type='radio'
                                               value='4'>
                                        <label for='rating_4'> <span>Rate 4 Stars</span> </label>
                                        <input id='rating_5' class="rate_now" name='rating' type='radio'
                                               value='5'>
                                        <label for='rating_5'> <span>Rate 5 Stars</span> </label>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($this->db->get_where('config', array('title' => 'facebook_comment_appid'))->row()->value != '' &&
                        $this->db->get_where('config', array('title' => 'show_facebook_comment_box'))->row()->value == '1'
                    ): ?>
                        <!-- facebook comments -->
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="border">Facebook Comments</h2>
                                <div class="fb-comments"
                                     data-href="<?php echo base_url(); ?>/watch/<?php echo $watch_videos->slug; ?>.html"
                                     data-width="800" data-numposts="30"></div>
                                <div id="fb-root"></div>
                                <script>
                                    (function (d, s, id) {
                                        var js, fjs = d.getElementsByTagName(s)[0];
                                        if (d.getElementById(id)) return;
                                        js = d.createElement(s);
                                        js.id = id;
                                        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=<?php echo $this->db->get_where('config', array('title' => 'facebook_comment_appid'))->row()->value; ?>";
                                        fjs.parentNode.insertBefore(js, fjs);
                                    }(document, 'script', 'facebook-jssdk'));
                                </script>
                            </div>
                        </div>
                        <!-- END facebook comments -->
                    <?php endif; ?>
                    <?php $total_comments = count($this->db->get_where('comments', array('video_id' => $watch_videos->videos_id, 'comment_type' => '1'))->result_array());
                    if ($total_comments > 0) :
                        ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="page-sidebar">
                                    <!--Comments Area-->
                                    <div class="comments-section">
                                        <div class="section-title">
                                            <h4 class="text-left title-bottom text-uppercase tp-mb30 tp-pb5">
                                                <?php echo $total_comments; ?> Comments found</h4>
                                        </div>
                                        <div class="comment-box">
                                            <?php $this->db->order_by('comments_id', 'DESC');
                                            $comments = $this->db->get_where('comments', array('video_id' => $watch_videos->videos_id, 'comment_type' => '1'))->result_array();
                                            foreach ($comments as $comment):
                                                ?>
                                                <div class="comment"
                                                     id="comment<?php echo $comment['user_id']; ?>">
                                                    <div class="author-thumbnail"><img
                                                                src="<?php echo $this->common_model->get_image_url('user', $comment['user_id']); ?>"
                                                                alt="<?php echo $this->common_model->get_name_by_id($comment['user_id']); ?>">
                                                    </div>
                                                    <div class="comment-text">
                                                        <strong><?php echo $this->common_model->get_name_by_id($comment['user_id']); ?></strong>
                                                        - posted
                                                        <?php echo $this->common_model->time_ago($comment['comment_at'], false); ?>
                                                    </div>
                                                    <div class="text">
                                                        <?php echo $comment['comment']; ?>
                                                    </div>
                                                </div>

                                                <?php $this->db->order_by('comments_id', 'ASC');
                                                $comment_replays = $this->db->get_where('comments', array('video_id' => $watch_videos->videos_id, 'comment_type' => '2', 'replay_for' => $comment['comments_id']))->result_array();
                                                foreach ($comment_replays as $comment_replay):
                                                    ?>
                                                    <div class="comment coment-replay">
                                                        <div class="author-thumbnail"><img
                                                                    src="<?php echo $this->common_model->get_image_url('user', $comment_replay['user_id']); ?>"
                                                                    alt="<?php echo $this->common_model->get_name_by_id($comment_replay['user_id']); ?>">
                                                        </div>
                                                        <div class="comment-text">
                                                            <strong><?php echo $this->common_model->get_name_by_id($comment_replay['user_id']); ?></strong>
                                                            - posted
                                                            <?php echo $this->common_model->time_ago($comment_replay['comment_at'], false); ?>
                                                        </div>
                                                        <div class="text">
                                                            <?php echo $comment_replay['comment']; ?>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                                <div class="comment coment-replay">
                                                    <form class="custom-form" method="post"
                                                          action="<?php echo base_url('comments/replay'); ?>">
                                                        <textarea name="comment" id="comment" class="form-control"
                                                                  rows="2" placeholder="Repay" required></textarea>
                                                        <input type="hidden" name="video_id"
                                                               value="<?php echo $watch_videos->videos_id; ?>">
                                                        <input type="hidden" name="replay_for"
                                                               value="<?php echo $comment['comments_id']; ?>">
                                                        <input type="hidden" name="url"
                                                               value="<?php echo base_url(uri_string());; ?>">
                                                        <div>
                                                            <?php if ($this->session->userdata('login_status') == 1) { ?>
                                                                <button type="submit" value="submit"
                                                                        class="btn btn-success btn-sm pull-right m-t-20">
                                                                    <span class="btn-label"><i
                                                                                class="fi ion-ios-undo-outline"></i></span>Replay
                                                                </button>
                                                            <?php } else { ?>
                                                                <a class="btn btn-success btn-sm pull-right m-t-20"
                                                                   href="<?php echo base_url('login'); ?>"> <span
                                                                            class="btn-label"><i
                                                                                class="fi ion-log-in"></i></span>Login
                                                                    to Replay </a>
                                                            <?php } ?>
                                                        </div>
                                                    </form>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <?php if ($this->db->get_where('config', array('title' => 'show_comment_box'))->row()->value == '1'): ?>
                                <div id="comment-container">
                                    <div class="movie-heading overflow-hidden"><span class="wow fadeInUp"
                                                                                     data-wow-duration="0.8s">Leave a comment</span>
                                        <div class="disable-bottom-line wow zoomIn"
                                             data-wow-duration="0.8s"></div>
                                    </div>
                                    <form class="comment-form" method="post"
                                          action="<?php echo base_url('comments/comment'); ?>">
                                        <input type="hidden" name="video_id"
                                               value="<?php echo $watch_videos->videos_id; ?>">
                                        <input type="hidden" name="url"
                                               value="<?php echo base_url(uri_string()); ?>">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <textarea name="comment" id="cmnt-user-msg" rows="4"
                                                              class="form-control" placeholder="MESSAGE"
                                                              required></textarea>
                                                    <div class="input-top-line"></div>
                                                    <div class="input-bottom-line"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <?php if ($this->session->userdata('login_status') == 1) { ?>
                                                    <button type="submit" value="submit"
                                                            class="btn btn-success"><span
                                                                class="btn-label"><i
                                                                    class="fi ion-ios-compose-outline"></i></span>Post
                                                        Comments
                                                    </button>
                                                <?php } else { ?>
                                                    <a class="btn btn-success"
                                                       href="<?php echo base_url('login'); ?>">
                                                                <span class="btn-label"><i
                                                                            class="fi ion-log-in"></i></span>Login
                                                        to Comments </a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php endif; ?>
                            <div class="similler-movie">
                                <div class="movie-heading overflow-hidden"><span class="wow fadeInUp"
                                                                                 data-wow-duration="0.8s"> Related Videos </span>
                                    <div class="disable-bottom-line wow zoomIn" data-wow-duration="0.8s"></div>
                                </div>
                                <div class="row">
                                    <div class="movie-container">
                                        <?php
                                        $i = 0;
                                        $related_videos = $this->db->get_where('videos', array('publication' => '1', 'genre' => $watch_videos->genre), 12)->result();
                                        foreach ($related_videos as $v):
                                            $i++; ?>
                                            <div class="col-md-2 col-sm-3 col-xs-4">
                                                <div class="latest-movie-img-container">
                                                    <div class="movie-img"><img class="img-responsive"
                                                                                src="<?php echo $v->image_link; ?>"
                                                                                alt="<?php echo $v->title; ?>">
                                                        <a
                                                                href="<?php echo base_url('watch/' . $v->slug) . '.html'; ?>"
                                                                class="ico-play ico-play-sm"> <img
                                                                    class="img-responsive play-svg svg"
                                                                    src="<?php echo base_url(); ?>assets/front_end/images/play-button.svg"
                                                                    alt="play"
                                                                    onerror="this.src='<?php echo base_url(); ?>assets/front_end/images/play-button.png'">
                                                        </a>
                                                        <div class="overlay-div"></div>
                                                    </div>
                                                    <div class="movie-title">
                                                        <h1>
                                                            <a href="<?php echo base_url('watch/' . $v->slug) . '.html'; ?>"><?php echo $v->title; ?></a>
                                                        </h1>
                                                        <p class="movie-desc"><span><i class="fa fa-clock-o"
                                                                                       aria-hidden="true"></i> <?php echo $v->runtime; ?></span><span>&nbsp;&#47;</span>
                                                            <span><?php echo $v->total_view; ?> views</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php if ($i == 6) {
                                            echo "</div></div><div class='row'><div class='movie-container'>";
                                        } ?>
                                        <?php endforeach; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 m-t-10">
                <div class="row">
                    <div class="col-md-12">
                        <div class="ad_300x250 m-b-20">
                            <?php $ad_250x300 = $this->db->get_where('config', array('title' => 'ad_250x300_type'))->row()->value;
                            if ($ad_250x300 != 0) {
                                if ($ad_250x300 == 1) {
                                    echo '<a href="' . $this->db->get_where('config', array('title' => 'ad_250x300_url'))->row()->value . '"><img src="' . $this->db->get_where('config', array('title' => 'ad_250x300_image_url'))->row()->value . '" width="265"></a>';
                                } else if ($ad_250x300 == 2) {
                                    echo $this->db->get_where('config', array('title' => 'ad_250x300_code'))->row()->value;
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="sidebar">
                    <div class="sidebar-movie most-liked">
                        <h1 class="sidebar-title">Most Rated</h1>
                        <?php $this->db->order_by('total_rating', 'ASC');
                        $most_rated_videos = $this->db->get_where('videos', array('publication' => '1'), 5)->result();
                        foreach ($most_rated_videos as $most_rated_video):
                            ?>

                            <div class="media">
                                <div class="media-left"><img src="<?php echo $most_rated_video->image_link; ?>"
                                                             alt="<?php echo $most_rated_video->title; ?>"
                                                             width="40">
                                </div>
                                <div class="media-body">
                                    <h1>
                                        <a href="<?php echo base_url('watch/' . $most_rated_video->slug) . '.html'; ?>"><?php echo $most_rated_video->title; ?></a>
                                    </h1>
                                    <p>
                                        <span><i class="fa fa-star"></i> <?php echo $most_rated_video->total_rating; ?></span>
                                        <span><i class="fa fa-eye"></i> <?php echo $most_rated_video->total_view; ?></span>
                                    </p>
                                </div>
                            </div>

                        <?php endforeach ?>
                    </div>
                    <div class="sidebar-movie most-viewed">
                        <h1 class="sidebar-title">Most Viewed</h1>
                        <?php $this->db->order_by('total_view', 'ASC');
                        $most_rated_videos = $this->db->get_where('videos', array('publication' => '1'), 5)->result();
                        foreach ($most_rated_videos as $most_rated_video):
                            ?>

                            <div class="media">
                                <div class="media-left"><img src="<?php echo $most_rated_video->image_link; ?>"
                                                             alt="<?php echo $most_rated_video->title; ?>"
                                                             width="40">
                                </div>
                                <div class="media-body">
                                    <h1>
                                        <a href="<?php echo base_url('watch/' . $most_rated_video->slug) . '.html'; ?>"><?php echo $most_rated_video->title; ?></a>
                                    </h1>
                                    <p>
                                        <span><i class="fa fa-star"></i> <?php echo $most_rated_video->total_rating; ?></span>
                                        <span><i class="fa fa-eye"></i> <?php echo $most_rated_video->total_view; ?></span>
                                    </p>
                                </div>
                            </div>

                        <?php endforeach ?>
                    </div>
                    <?php if ($watch_videos->tags != '' && $watch_videos->tags != NULL): ?>
                        <div class="tags">
                            <h1 class="sidebar-title">Tags</h1>
                            <ul class="list-inline list-unstyled">
                                <?php $tags = explode(',', $watch_videos->tags);
                                foreach ($tags as $tag):
                                    ?>
                                    <li><h2>
                                            <a href="<?php echo base_url() . 'tags/' . $tag . '.html'; ?>"><?php echo $tag; ?></a>
                                        </h2></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <div class="google_add m-l-50">
                        <?php $ad_160x600 = $this->db->get_where('config', array('title' => 'ad_160x600_type'))->row()->value;
                        if ($ad_160x600 != 0) {
                            if ($ad_160x600 == 1) {
                                echo '<a href="' . $this->db->get_where('config', array('title' => 'ad_160x600_url'))->row()->value . '"><img src="' . $this->db->get_where('config', array('title' => 'ad_160x600_image_url'))->row()->value . '"></a>';
                            } else if ($ad_160x600 == 2) {
                                echo $this->db->get_where('config', array('title' => 'ad_160x600_code'))->row()->value;
                            }
                        }
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        //var videoID = 'responsive-embed-item';
        //var sourceID = 'mp4video';
        //var newmp4 = 'https://www.youtube.com/embed/qTd3Qc5N7Pg';
        //var newposter = 'media/video-poster2.jpg';

        $('#source1').click(function (event) {
            alert(sdsd);
            /*
             $('.'+videoID).get(0).pause();
             $('#'+sourceID).attr('src', newmp4);
             $('#'+videoID).get(0).load();
             //$('#'+videoID).attr('poster', newposter); //Change video poster
             $('#'+videoID).get(0).play();
             });*/
        });
    });
</script>

<!-- Ajax Rating -->
<script src="<?php echo base_url(); ?>assets/front_end/js/jquery-1.12.3.min.js"></script>
<script>
    $('.rate_now').click(function () {
        rate = $(this).val();
        video_id = "<?php echo $watch_videos->videos_id;?>";
        current_rating = "<?php echo $watch_videos->total_rating;?>";
        total_rating = Number(current_rating) + Number(1);
        //alert(rate+video_id);
        if (parseInt(rate) && parseInt(video_id)) {
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url() . 'admin/rating';?>",
                data: "rate=" + rate + "&video_id=" + video_id,
                dataType: 'json',
                success: function (response) {
                    var post_status = response.post_status;
                    var rate = response.rate;
                    var video_id = response.video_id;

                    if (post_status == "success") {
                        $('#rated').html('Rating(' + total_rating + ')');
                        //alert("Successed");
                    } else {

                        //alert('Not Successed');
                    }

                }
            });
        }


    });
</script>
<!-- End ajax Rating -->