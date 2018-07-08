<?php
$col = 6;
$col = $this->db->get_where('thumbnail', array('id' => 1))->row()->cols;
?>
<!-- Secondary Section -->
<div id="section-opt">
    <div class="container">
        <div class="row">
            <!-- Upcomming Movies -->
            <!-- <div class="col-md-12 col-sm-12"> -->
            <!-- <div class="latest-movie movie-opt"> -->
            <!-- <div class="movie-heading overflow-hidden"> <span>Upcoming Movies</span>
                        <div class="disable-bottom-line"></div>
						<a href="<?php //echo base_url();?>trailers" class="btn btn-success pull-right">View More<i class="fa fa-angle-double-right m-l-10" aria-hidden="true"></i></a>
                    </div> -->
            <!--  <div class="row clean-preset">
                        <div class="movie-container">
                            <?php //foreach ($all_published_trailers as $trailers) :?>
                            <div class="col-md-2 col-sm-3 col-xs-4">
                                <div class="latest-movie-img-container">
                                    <div class="movie-img"> <img class="img-responsive" src="<?php //echo $trailers->image_link;?>" alt="<?php //echo $trailers->title;?>"> <a href="<?php //echo base_url('watch/'.$trailers->slug).'.html';?>" class="ico-play ico-play-sm"> <img class="img-responsive play-svg svg" src="<?php //echo base_url(); ?>assets/front_end/images/play-button.svg" alt="play" onerror="this.src='<?php //echo base_url(); ?>assets/front_end/images/play-button.png'"> </a>
                                        <div class="overlay-div"></div>
                                    </div>
                                    <div class="movie-title">
                                        <h1><a href="<?php //echo base_url('watch/'.$trailers->slug).'.html';?>"><?php //echo $trailers->title;?></a></h1>
                                        <p class="movie-desc"> <span><i class="fa fa-clock-o" aria-hidden="true"></i> <?php //echo $trailers->runtime;?></span><span>&nbsp;&#47;</span> <span><?php //echo $trailers->total_view;?> views</span> </p>
                                    </div>
                                </div>
                            </div>
                            <?php //endforeach; ?>
                        </div>
                    </div> -->
            <!-- </div> -->
            <!-- </div> -->
            <!-- End Upcomming Movies -->
            <!-- Latest Movies -->

            <div class="col-md-12 col-sm-12">
                <div class="latest-movie movie-opt">
                    <div class="movie-heading overflow-hidden"><span>Latest Movies</span>
                        <div class="disable-bottom-line"></div>
                        <a href="<?php echo base_url(); ?>movies" class="btn btn-success pull-right">View More<i
                                    class="fa fa-angle-double-right m-l-10" aria-hidden="true"></i></a>
                    </div>
                    <div class="row clean-preset">
                        <div class="movie-container">
                            <?php foreach ($all_published_videos as $videos) : ?>
                                    <div class="col-md-<?= $col ?> col-sm-3 col-xs-6">
                                        <div class="latest-movie-img-container">
                                            <div class="movie-img"><img class="img-responsive"
                                                                        src="<?php echo $videos->image_link; ?>"
                                                                        alt="<?php echo $videos->title; ?>"
                                                                        style="min-height: 235px !important; max-height: 235px !important;">
                                                <a
                                                        href="<?php echo base_url('watch/' . $videos->slug) . '.html'; ?>"
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
                                                    <a href="<?php echo base_url('watch/' . $videos->slug) . '.html'; ?>"><?php echo $videos->title; ?></a>
                                                </h1>
                                                <p class="movie-desc"><span><i class="fa fa-clock-o"
                                                                               aria-hidden="true"></i> <?php echo $videos->runtime; ?></span><span>&nbsp;&#47;</span>
                                                    <span><?php echo $videos->total_view; ?> views</span></p>
                                            </div>
                                        </div>
                                    </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Latest Movies -->

            <!-- Latest TV Series -->


            <div class="col-md-12 col-sm-12">
                <div class="latest-movie movie-opt">
                    <div class="movie-heading overflow-hidden"><span>Latest TV-Series</span>
                        <div class="disable-bottom-line"></div>
                        <a href="<?php echo base_url(); ?>tv-series" class="btn btn-success pull-right">View More<i
                                    class="fa fa-angle-double-right m-l-10" aria-hidden="true"></i></a>
                    </div>
                    <div class="row clean-preset">
                        <div class="movie-container">
                            <?php foreach ($all_published_tv_series as $tv_series) : ?>
                                <div class="col-md-<?= $col ?> col-sm-3 col-xs-6">
                                    <div class="latest-movie-img-container">
                                        <div class="movie-img">
                                            <img class="img-responsive"
                                                 src="<?php echo $tv_series->image_link; ?>"
                                                 alt="<?php echo $tv_series->title; ?>"
                                                 style="min-height: 235px !important; max-height: 235px !important;"
                                            >
                                            <a
                                                    href="<?php echo base_url('watch/' . $tv_series->slug) . '.html'; ?>"
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
                                                <a href="<?php echo base_url('watch/' . $tv_series->slug) . '.html'; ?>"><?php echo $tv_series->title; ?></a>
                                            </h1>
                                            <p class="movie-desc"><span><i class="fa fa-clock-o"
                                                                           aria-hidden="true"></i> <?php echo $tv_series->runtime; ?></span><span>&nbsp;&#47;</span>
                                                <span><?php echo $tv_series->total_view; ?> views</span></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End Latest TV Series -->

            <!-- Requested Movies -->

            <!-- <div class="col-md-12 col-sm-12">
                <div class="latest-movie movie-opt">
                    <div class="movie-heading overflow-hidden"> <span>Requested Movies</span>
                        <div class="disable-bottom-line"></div>
						<a href="<?php //echo base_url();?>request-movies.html" class="btn btn-success pull-right">View More<i class="fa fa-angle-double-right m-l-10" aria-hidden="true"></i></a>
                    </div>
                    <div class="row clean-preset">
                        <div class="movie-container">
                            <?php //foreach ($all_published_request_movies as $request_movies) :?>
                            <div class="col-md-2 col-sm-3 col-xs-4">
                                <div class="latest-movie-img-container">
                                    <div class="movie-img"> <img class="img-responsive" src="<?php //echo $request_movies->image_link;?>" alt="<?php //echo $request_movies->title;?>"> <a href="<?php //echo base_url('watch/'.$request_movies->slug).'.html';?>" class="ico-play ico-play-sm"> <img class="img-responsive play-svg svg" src="<?php //echo base_url(); ?>assets/front_end/images/play-button.svg" alt="play" onerror="this.src='<?php //echo base_url(); ?>assets/front_end/images/play-button.png'"> </a>
                                        <div class="overlay-div"></div>
                                    </div>
                                    <div class="movie-title">
                                        <h1><a href="<?php //echo base_url('watch/'.$request_movies->slug).'.html';?>"><?php //echo $request_movies->title;?></a></h1>
                                        <p class="movie-desc"> <span><i class="fa fa-clock-o" aria-hidden="true"></i> <?php //echo $request_movies->runtime;?></span><span>&nbsp;&#47;</span> <span><?php //echo $request_movies->total_view;?> views</span> </p>
                                    </div>
                                </div>
                            </div>
                            <?php //endforeach; ?>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- End Requested Movies -->

        </div>
    </div>
</div>

<!-- Secondary Section -->
