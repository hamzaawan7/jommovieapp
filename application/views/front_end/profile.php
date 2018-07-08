<!-- Breadcrumb -->
<div id="title-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-9 col-sm-8 col-xs-12">
                <div class="page-title">
                    <h1 class="text-uppercase">
                        Profile Information
                    </h1>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-12 text-right">
                <ul class="breadcrumb">
                    <li>
                        <a href="<?php echo base_url();?>"><i class="fi ion-ios-home"></i>Home</a>
                    </li>
                    <li class="active">Profile</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumb -->


<!-- Profile Section -->
<div id="section-opt">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="profiles-wrap">
                    <div class="sidebar">
                        <div class="sidebar-menu">
                            <div class="sb-title"><i class="fa fa-navicon mr5"></i> Menu</div>
                            <ul>
                                <li class="active">
                                    <a href="<?php echo base_url('user/profile'); ?>">
                                        <i class="fa fa-user mr5"></i> Profile
                                    </a>
                                </li>
                                <li class="">
                                    <a href="<?php echo base_url('user/update_profile'); ?>">
                                        <i class="fa fa-pencil mr5"></i> Update profile
                                    </a>
                                </li>
                                <li class="">
                                    <a href="<?php echo base_url('user/change_password'); ?>">
                                        <i class="fa fa-key mr5"></i> Change Password
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="pp-main">
                        <div class="ppm-head">
                            <div class="ppmh-title"><i class="fa fa-user mr5"></i> Profile</div>
                        </div>
                        <div class="ppm-content user-content">
                            <div class="uct-avatar">
                                <img src="<?php echo $this->common_model->get_img('user', $profile_info->user_id).'?'.time(); ?>" title="<?php echo $profile_info->name; ?>" alt="<?php echo $profile_info->name; ?>">
                            </div>
                            <div class="uct-info">
                                <div class="block">
                                    <label>Full name:</label> <?php echo $profile_info->name; ?></div>
                                <div class="block">
                                    <label>Username:</label> <?php echo $profile_info->username; ?> </div>
                                <div class="block">
                                    <label>Account ID:</label> <?php echo $profile_info->user_id; ?> </div>
                                <div class="block">
                                    <label>Email:</label> <?php echo $profile_info->email; ?> </div>
                                <div class="block">
                                    <label>Gender:</label> <?php if($profile_info->gender=='1'){echo 'Male';}elseif($profile_info->gender=='2'){echo 'Female';}else{ echo 'N/a';} ?> </div>
                                <div class="block">
                                    <label>Join date:</label> <?php echo date('d M Y',strtotime($profile_info->join_date)); ?></div>
                                <div class="block">
                                    <label>Last login:</label> <?php echo date('Y-m-d H:i:s',strtotime($profile_info->last_login)); ?> </div>
                                <div class="mt20">
                                    <a href="<?php echo base_url('user/update_profile'); ?>" class="btn btn-success" title="">Edit
                                    account info</a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Profile Section -->
