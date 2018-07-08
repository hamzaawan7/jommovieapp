<?php    
    $default_meta_description       =   $this->db->get_where('config' , array('title'=>'meta_description'))->row()->value;
    $default_focus_keyword          =   $this->db->get_where('config' , array('title'=>'focus_keyword'))->row()->value;
    $author                         =   $this->db->get_where('config' , array('title'=>'author'))->row()->value;
    $front_end_theme                =   $this->db->get_where('config' , array('title'=>'front_end_theme'))->row()->value;
    $google_analytics_id            =   $this->db->get_where('config' , array('title'=>'google_analytics_id'))->row()->value;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="canonical" href="<?php echo base_url(); ?>">
<meta charset="UTF-8">
<meta name="description" content="<?php if (isset($meta_description)) { echo $meta_description;} else{ echo $default_meta_description;} ?>">
<meta name="keywords" content="<?php if (isset($focus_keyword)) { echo $focus_keyword;} else{ echo $default_focus_keyword ; } ?>">

<meta name="author" content="<?php echo $author; ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php if($page_name=='watch'){ echo $watch_videos->title;}else{ echo $title; } ?></title>    
<link rel="shortcut icon" href="<?php echo base_url(); ?>uploads/system_logo/favicon.ico">
<!-- Style Sheets -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/front_end/css/bootstrap.min.css">
<!-- Font Icons -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/front_end/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/front_end/css/ionicons.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/front_end/css/socicon-styles.css">
<!-- Font Icons -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front_end/css/hover-min.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front_end/css/animate.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/front_end/css/styles.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/front_end/css/responsive.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/front_end/css/<?php echo $front_end_theme; ?>.css">
<script src="<?php echo base_url(); ?>assets/front_end/js/jquery-1.12.3.min.js"></script>
<?php 
    $slider_type        =   $this->db->get_where('config' , array('title'=>'slider_type'))->row()->value;
    if ($slider_type=="movie"):
 ?>
<!-- owlcarousel -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/front_end/css/owl.carousel.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/front_end/css/owl.theme.default.min.css">
<script src="<?php echo base_url(); ?>assets/front_end/js/owl.carousel.js"></script>
<!-- owlcarousel -->
<?php endif ?>
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
    <div id="wrapper">
        <div id="main-content">
<?php 
    $this->load->view('front_end/header');
    $this->load->view('front_end/nav_bar');
    if ($page_name == 'home') {
        $this->load->view('front_end/slider');
    }
    if ($page_name == 'home') { ?>
        <div class="container">
            <!-- Go to www.addthis.com/dashboard to customize your tools --> <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58d74b9dcfd76af7"></script>  <div class="addthis_inline_share_toolbox m-t-30 m-b-10"></div>
        </div>
<?php } ?>
 

<?php
    $this->load->view('front_end/'.$page_name);
    $this->load->view('front_end/footer');
    $this->load->view('front_end/copyright');
?>
    </div>
    </div>

<?php if($this->session->userdata('login_status') != 1): ?>
    <?php $this->load->view('front_end/login_modal'); ?>
<?php endif; ?>


<!-- Scripts -->    
<script src="<?php echo base_url(); ?>assets/front_end/js/custom.js"></script>    
<script src="<?php echo base_url(); ?>assets/front_end/js/bootstrap.min.js"></script>
    


<!-- ajax subscribtion -->
<script>
    $('#subscribe-btn').click(function() {
        var email = $("#email").val();
        var name = $("#name").val();
        if(name==''){
            name='New Subscriber';
        }
        var hasError = false;
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if (email == '') {
            var hasError = true;
            $("#error").fadeIn();
            $("#error").html('<p class="text-danger"><strong>Opps!&nbsp;</strong>Email must not be blank.</p>');
        } else if (!emailReg.test(email)) {
            var hasError = true;
            $("#error").html('<p class="text-danger">Enter a valid email address.</p>');
        }

        if (hasError != true) {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>user/subscribe',
                data: "name="+name+"&email="+email,
                dataType: 'json',
                beforeSend: function() {
                    //alert(name,email);
                    $("#error").fadeOut();
                    $("#subscribe-btn").html('Subscribing!! &nbsp;Wait...');

                },
                success: function(response) {
                    var subscribe_status = response.subscribe_status;
                    if (subscribe_status == "success") {
                        $("#error").fadeIn();
                        $("#subscribe-btn").html('<i class="fa fa-check" aria-hidden="true"></i> &nbsp;Subscribed');
                        $("#error").html('<p class="text-success"><strong>Well done!</strong> Subscription successful.</p>');
                    }
                    else if (subscribe_status == "exist"){
                        $("#error").fadeIn();
                        $("#subscribe-btn").html('Subscribe');
                        $("#error").html('<p class="text-warning">You already subscribe us earlier.</p>');
                    }
                     else {
                        $("#error").fadeIn();
                        $("#subscribe-btn").html('Subscribe');
                        $("#error").html('<p class="text-danger"><strong>Opps!</strong> Subscription fail please contact with system administrator.</p>');
                    }
                }
            });
        }
    });
</script>
<!-- End ajax subscribtion -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', '<?php echo $google_analytics_id; ?>', 'auto');
  ga('send', 'pageview');

</script>

</body>

</html>