<?php $active_menu = $this->session->userdata('active_menu'); ?>
<!-- Side-Nav-->
<aside class="main-sidebar hidden-print">
    <section class="sidebar">
        <!-- Sidebar Menu-->
        <ul class="sidebar-menu">
            <li calss="<?php if ($active_menu == 1) {
                echo "active";
            } ?>"><a href="<?php echo base_url() . 'admin/dashboard'; ?>"
                     class="waves-effect waves-light <?php if ($active_menu == 1) {
                         echo "active";
                     } ?>" id="65"><i class="lnr lnr-home"></i><span> DASHBOARD </span> </a></li>
            <li class="<?php if ($active_menu == 2) {
                echo "active";
            } ?>"><a href="<?php echo base_url(); ?>admin/country"
                     class="waves-effect waves-light <?php if ($active_menu == 2) {
                         echo "active";
                     } ?>" id="53"><i class="fa fa-globe"></i><span>COUNTRY</span></a></li>
            <li class="<?php if ($active_menu == 3) {
                echo "active";
            } ?>"><a href="<?php echo base_url(); ?>admin/genre"
                     class="waves-effect waves-light <?php if ($active_menu == 3) {
                         echo "active";
                     } ?>" id="53"><i class="fa fa-archive"></i><span>GENRE</span></a></li>
            <li class="treeview <?php if ($active_menu == 4 || $active_menu == 5) {
                echo "active";
            } ?>"><a href="#" class="waves-effect waves-light"><i class="fa fa-stack-overflow"></i><span>SLIDER</span><i
                            class="fa fa-angle-right"></i> </a>
                <ul class="treeview-menu">
                    <li class="<?php if ($active_menu == 4) {
                        echo "active";
                    } ?>"><a href="<?php echo base_url() . 'admin/slider/' ?>"
                             class="waves-effect waves-light <?php if ($active_menu == 4) {
                                 echo "active";
                             } ?>"><i class="fa fa-stack-overflow"></i>IMAGE SLIDER</span> </a></li>
                    <li class="<?php if ($active_menu == 5) {
                        echo "active";
                    } ?>"><a href="<?php echo base_url() . 'admin/slider_setting/' ?>"
                             class="waves-effect waves-light <?php if ($active_menu == 5) {
                                 echo "active";
                             } ?>"><i class="fa fa-gears" aria-hidden="true"></i>SLIDER SETTING</span> </a></li>
                </ul>
            </li>
            <li class="treeview <?php if ($active_menu == 6 || $active_menu == 7 || $active_menu == 8 || $active_menu == 9) {
                echo "active";
            } ?>"><a href="#" class="waves-effect waves-light"><i class="fa fa-video-camera"
                                                                  aria-hidden="true"></i><span>VIDEOS</span><i
                            class="fa fa-angle-right"></i> </a>
                <ul class="treeview-menu">
                    <li class="<?php if ($active_menu == 6) {
                        echo "active";
                    } ?>"><a href="<?php echo base_url() . 'admin/videos_add/' ?>"
                             class="waves-effect waves-light <?php if ($active_menu == 6) {
                                 echo "active";
                             } ?>"><i class="fa fa-plus" aria-hidden="true"></i>NEW VIDEO</span> </a></li>
                    <li class="<?php if ($active_menu == 7) {
                        echo "active";
                    } ?>"><a href="<?php echo base_url() . 'admin/movie_scrapper_manage/' ?>"
                             class="waves-effect waves-light <?php if ($active_menu == 7) {
                                 echo "active";
                             } ?>"><i class="fa fa-plus" aria-hidden="true"></i>MOVIE SCRAPPER</span> </a></li>
                    <li class="<?php if ($active_menu == 8) {
                        echo "active";
                    } ?>"><a href="<?php echo base_url() . 'admin/videos/' ?>"
                             class="waves-effect waves-light <?php if ($active_menu == 8) {
                                 echo "active";
                             } ?>"><i class="fa fa-list" aria-hidden="true"></i> ALL VIDEOS</span> </a></li>
                    <li class="<?php if ($active_menu == 9) {
                        echo "active";
                    } ?>"><a href="<?php echo base_url() . 'admin/video_type/' ?>"
                             class="waves-effect waves-light <?php if ($active_menu == 9) {
                                 echo "active";
                             } ?>"><i class="fa fa-tags" aria-hidden="true"></i> VIDEO TYPE </span> </a></li>
                </ul>
            </li>
            <li class="treeview <?php if ($active_menu == 10 || $active_menu == 11) {
                echo "active";
            } ?>"><a href="#" class="waves-effect waves-light"><i class="fa fa-file"
                                                                  aria-hidden="true"></i><span>PAGES</span><i
                            class="fa fa-angle-right"></i> </a>
                <ul class="treeview-menu">
                    <li class="<?php if ($active_menu == 10) {
                        echo "active";
                    } ?>"><a href="<?php echo base_url() . 'admin/pages_add/' ?>"
                             class="waves-effect waves-light <?php if ($active_menu == 10) {
                                 echo "active";
                             } ?>"><i class="fa fa-plus" aria-hidden="true"></i>NEW PAGE</span> </a></li>
                    <li class="<?php if ($active_menu == 11) {
                        echo "active";
                    } ?>"><a href="<?php echo base_url() . 'admin/pages/' ?>"
                             class="waves-effect waves-light <?php if ($active_menu == 11) {
                                 echo "active";
                             } ?>"><i class="fa fa-list" aria-hidden="true"></i> ALL PAGE </span> </a></li>
                </ul>
            </li>
            <li class="treeview <?php if ($active_menu == 12 || $active_menu == 13 || $active_menu == 14) {
                echo "active";
            } ?>"><a href="#" class="waves-effect waves-light"><i class="fa fa-pencil-square-o"
                                                                  aria-hidden="true"></i><span>POST</span> <i
                            class="fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li class="<?php if ($active_menu == 12) {
                        echo "active";
                    } ?>"><a href="<?php echo base_url() . 'admin/posts_add/' ?>"
                             class="waves-effect waves-light <?php if ($active_menu == 12) {
                                 echo "active";
                             } ?>"><i class="fa fa-plus" aria-hidden="true"></i>NEW POST</span> </a></li>
                    <li class="<?php if ($active_menu == 13) {
                        echo "active";
                    } ?>"><a href="<?php echo base_url() . 'admin/posts/' ?>"
                             class="waves-effect waves-light <?php if ($active_menu == 13) {
                                 echo "active";
                             } ?>"><i class="fa fa-list" aria-hidden="true"></i> ALL POST </span> </a></li>
                    <li class="<?php if ($active_menu == 14) {
                        echo "active";
                    } ?>"><a href="<?php echo base_url() . 'admin/post_category/' ?>"
                             class="waves-effect waves-light <?php if ($active_menu == 14) {
                                 echo "active";
                             } ?>"><i class="fa fa-tags" aria-hidden="true"></i> CATEGORY </span> </a></li>
                </ul>
            </li>
            <li class="<?php if ($active_menu == 15) {
                echo "active";
            } ?>"><a href="<?php echo base_url() . 'admin/manage_user' ?>"
                     class="waves-effect waves-light <?php if ($active_menu == 13) {
                         echo "active";
                     } ?>" id="53"><i class="fa fa-user"></i><span>USERS</span></a></li>
            <li class="treeview <?php if ($active_menu == 16 || $active_menu == 17 || $active_menu == 18 || $active_menu == 19 || $active_menu == 20 || $active_menu == 21) {
                echo "active";
            } ?>"><a href="#" class="waves-effect waves-light"><i class="fa fa-gears" aria-hidden="true"></i><span>SETTING</span>
                    <i class="fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li class="<?php if ($active_menu == 16) {
                        echo "active";
                    } ?>"><a href="<?php echo base_url() . 'admin/general_setting/' ?>"
                             class="waves-effect waves-light <?php if ($active_menu == 16) {
                                 echo "active";
                             } ?>"><i class="fa fa-gear" aria-hidden="true"></i>GENERAL SETTING</span> </a></li>
                    <li class="<?php if ($active_menu == 17) {
                        echo "active";
                    } ?>"><a href="<?php echo base_url() . 'admin/email_setting/' ?>"
                             class="waves-effect waves-light <?php if ($active_menu == 17) {
                                 echo "active";
                             } ?>"><i class="fa fa-envelope" aria-hidden="true"></i>EMAIL SETTING</span> </a></li>
                    <li class="<?php if ($active_menu == 18) {
                        echo "active";
                    } ?>"><a href="<?php echo base_url() . 'admin/logo_setting/' ?>"
                             class="waves-effect waves-light <?php if ($active_menu == 18) {
                                 echo "active";
                             } ?>"><i class="fa fa-picture-o" aria-hidden="true"></i> LOGO &amp; FAVICON</span> </a>
                    </li>
                    <li class="<?php if ($active_menu == 19) {
                        echo "active";
                    } ?>"><a href="<?php echo base_url() . 'admin/footer_setting/' ?>"
                             class="waves-effect waves-light <?php if ($active_menu == 19) {
                                 echo "active";
                             } ?>"><i class="fa fa-list-alt" aria-hidden="true"></i> FOOTER CONTENT </span> </a></li>
                    <li class="<?php if ($active_menu == 20) {
                        echo "active";
                    } ?>"><a href="<?php echo base_url() . 'admin/seo_setting/' ?>"
                             class="waves-effect waves-light <?php if ($active_menu == 20) {
                                 echo "active";
                             } ?>"><i class="fa fa-facebook" aria-hidden="true"></i> SEO &amp; SOCIALS </span> </a></li>
                    <li class="<?php if ($active_menu == 21) {
                        echo "active";
                    } ?>"><a href="<?php echo base_url() . 'admin/ad_setting/' ?>"
                             class="waves-effect waves-light <?php if ($active_menu == 21) {
                                 echo "active";
                             } ?>"><i class="fa fa-dollar" aria-hidden="true"></i> ADS &amp; BANNER </span> </a></li>
                </ul>
            </li>
            <li class="<?php if ($active_menu == 22) {
                echo "active";
            } ?>"><a href="<?php echo base_url() . 'admin/backup_restore' ?>"
                     class="waves-effect waves-light <?php if ($active_menu == 22) {
                         echo "active";
                     } ?>" id="53"><i class="fa fa-database"></i><span>BACKUP</span></a></li>
            <li class="<?php if ($active_menu == 23) {
                echo "active";
            } ?>"><a href="<?php echo base_url() . 'admin/broken_links/' ?>"
                     class="waves-effect waves-light <?php if ($active_menu == 23) {
                         echo "active";
                     } ?>"><i class="fa fa-chain-broken" aria-hidden="true"></i> Broken Links </span> </a></li>
            <li class="<?php if ($active_menu == 24) {
                echo "active";
            } ?>"><a href="<?php echo base_url() . 'admin/thumbnail_setting/' ?>"
                     class="waves-effect waves-light <?php if ($active_menu == 24) {
                         echo "active";
                     } ?>"><i class="fa fa-picture-o" aria-hidden="true"></i> Thumbnail Setting </span> </a></li>
        </ul>
    </section>
</aside>
        