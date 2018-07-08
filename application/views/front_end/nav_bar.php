<?php   $about_us_enable            =   $this->db->get_where('config' , array('title'=>'about_us_enable'))->row()->value;
        $about_us_to_primary_menu   =   $this->db->get_where('config' , array('title'=>'about_us_to_primary_menu'))->row()->value;
?>
<!-- Nav Bar-->
<nav class="navbar navbar-default" role="navigation" style="padding: 0px; margin: 0px;">
    <div class="container">
        <div class="container-fluid">

            <!-- Brand and toggle get grouped for better mobile display -->

            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <a class="navbar-brand active" href="<?php echo base_url(); ?>"><i class="fi ion-ios-home-outline"></i></a> </div>

            <!-- Collect the nav links, forms, and other content for toggling -->

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Genre <span class="caret"></span></a>
                        <div class="dropdown-menu row col-lg-12 three-column-navbar" role="menu">
                            <?php $all_published_genre= $this->common_model->all_published_genre();
                                            foreach ($all_published_genre as $genre):                                                
                                             ?>

                            <div class="col-md-3">
                                <ul class="menu-item list-unstyled">
                                    <li><a href="<?php echo base_url('genre/'.$genre->slug.'.html'); ?>"><?php echo $genre->name; ?></a></li>

                                </ul>
                            </div>
                            <?php endforeach; ?>


                        </div>
                    </li>
                    <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Country <span class="caret"></span></a>
                        <div class="dropdown-menu row col-lg-12 three-column-navbar" role="menu">
                            <?php $all_published_country= $this->common_model->all_published_country();
                                            foreach ($all_published_country as $country):                                                
                            ?>

                            <div class="col-md-3">
                                <ul class="menu-item list-unstyled">
                                    <li><a href="<?php echo base_url('country/'.$country->slug.'.html'); ?>"><?php echo $country->name; ?></a></li>

                                </ul>
                            </div>
                            <?php endforeach; ?>


                        </div>
                    </li>
                    <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Year <span class="caret"></span></a>
                        <div class="dropdown-menu row col-lg-12 three-column-navbar" role="menu">
                            <?php $current_year = date("Y");
                            $end_year = $current_year - 27;
                            for($i=$current_year;$i>$end_year;$i--): ?>

                            <div class="col-md-3">
                                <ul class="menu-item list-unstyled">
                                    <li><a href="<?php echo base_url('year/'.$i.'.html'); ?>"><?php echo $i; ?></a></li>

                                </ul>
                            </div>
                            <?php endfor; ?>
                            <div class="col-md-3">
                                <ul class="menu-item list-unstyled">
                                    <li><a href="<?php echo base_url('year.html'); ?>">More..</a></li>

                                </ul>
                            </div>


                        </div>
                    </li>
                    <li><a href="<?php echo base_url('movies.html')?>">Movies</a></li>
                    <li><a href="<?php echo base_url('tv-series.html')?>">TV Series</a></li>
                    <!-- <li> <a href="<?php //echo base_url('request-movies.html')?>">Requested Movies</a></li>
                    <li><a href="<?php //echo base_url('blog.html')?>">Blog</a></li> -->
                    <?php if($about_us_enable =='1' && $about_us_to_primary_menu =='1'):?>
                    <li><a href="<?php echo base_url('about-us.html')?>">About Us</a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo base_url('contact-us.html')?>">Contact Us</a></li>
                    <?php $all_page_on_primary_menu= $this->common_model->all_page_on_primary_menu();
                                            foreach ($all_page_on_primary_menu as $pages):                                                
                    ?>
                <li><a href="<?php echo base_url().'page/'.$pages->slug?>"><?php echo $pages->page_title?></a></li>
                <?php endforeach; ?>
                <li>
                    <div class="search">
                        <form action="<?php echo base_url()?>search" method="post">
                            <input name="search" type="search" class="search-box" />
                            <button type="submit">
                              <span class="search-button">
                                <span class="fa fa-search"></span>
                              </span>
                            </button>
                        </form>
                    </div>
                </li>
                <li class="search_tools"><a href="#"><span class="fa fa-search"></span></a></li>
              </ul>          
                   
            </div>
        </div>
    </div>
</nav>
<!-- bootstrap menu -->
<script>
  $(".dropdown").hover(function () {
    $(this).toggleClass("open");
  });        
  $('.search_tools').click(function(){                    
    $(".search").toggleClass('open');
    if($(".search").hasClass("open")==true){
      $(this).html('<a href="#"><span class="fa fa-close"></span></a>');
    }else{
      $(this).html('<a href="#"><span class="fa fa-search"></span></a>');
    }
  });
</script>
<!-- bootstrap menu -->
<!-- Nav Bar-->