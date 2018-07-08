<div class="card">
    <div class="row">
      <div class="col-sm-12">                        

<?php 
$videos   = $this->db->get_where('videos' , array('videos_id' => $param1) )->result_array();
foreach ( $videos as $video):
?>
<?php echo form_open(base_url() . 'admin/videos/update/'.$param1 , array('class' => 'form-horizontal group-border-dashed', 'enctype' => 'multipart/form-data'));?>

<h4 class="text-center"><?php echo tr_wd('video_edit') ?></h4>
<hr>
<div class="form-group">
  <label class=" col-sm-3 control-label"><?php echo tr_wd('title'); ?></label>
  <div class="col-sm-8">
    <input type="text" name="title" id="title" value="<?php echo $video['title'] ?>" class="form-control" required>
  </div>
</div>

<div class="form-group">
  <label class=" col-sm-3 control-label"><?php echo tr_wd('slug'); ?> (<?php echo base_url(); ?>)</label>            
  <div class="col-sm-8">
    <input type="text" id="slug" name="slug" class="form-control input-sm" value="<?php echo $video['slug'] ?>" required>
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3"><?php echo tr_wd('description'); ?></label>
  <div class="col-md-8">
    <textarea class="wysihtml5 form-control" name="description" id="description" rows="10"><?php echo $video['description'] ?></textarea>
  </div>
</div>
<div class="form-group">
  <label class=" col-sm-3 control-label"><?php echo tr_wd('video_download_link'); ?></label>
  <div class="col-sm-8">
    <input type="url" name="downloadable_link" value="<?php echo $video['downloadable_link'] ?>"  class="form-control">
  </div>
</div>
<div class="form-group video-source" id="video-source">
  <label class=" col-sm-3 control-label"><?php echo tr_wd('video_embed_link'); ?></label>
  <div class="col-sm-6 sourch-list">
    <input type="url" name="embed_link_main" value="<?php echo $video['embed_link'] ?>" id="embed_link" class="form-control" placeholder="ex: https://www.youtube.com/embed/IchaTgzimuU" required>
  </div>
  <div class="col-sm-2"><a href="#description" class="btn btn-primary" id="add-sourch"><i class="fa fa-plus"></i> Add Source</a></div>
</div>
<?php $sl=1;
      $sources= $this->db->get_where('video_source', array('videos_id'=>$param1))->result_array();
foreach ($sources as $row) {
  echo '<div class="form-group" id="source'.$sl.'"><label class=" col-sm-3 control-label" id="sourcelabel1"></label><div class="col-sm-2"><input type="text" name="source_name[]" value="'.$row['source_name'].'" id="embed_link" class="form-control" placeholder="Name ex: vimeo" required></div><div class="col-sm-4"><input type="url" name="embed_link[]" value="'.$row['embed_link'].'" id="embed_link" class="form-control" placeholder="Addtional embed link ex: //www.dailymotion.com/embed/video/x5x4vmk" required></div><div class="col-sm-2"><input type="number" min="0" name="order[]" id="order" class="form-control" value="'.$row['order'].'" placeholder="order" required></div><div class="col-sm-1"><button onClick="$(this).parent().parent().remove();" id="remove_btn" class="btn btn-danger" id="add-sourch"><i class="fa fa-close"></i></button></div></div>';
  $sl++;
  
}

 ?>
<div class="form-group">
  <label class=" col-sm-3 control-label"><?php echo tr_wd('runtime'); ?></label>
  <div class="col-sm-8">
    <input type="text" name="runtime" value="<?php echo $video['runtime'] ?>" class="form-control">
  </div>
</div>
<div class="form-group">
  <label class=" col-sm-3 control-label"><?php echo tr_wd('starts'); ?></label>
  
  <div class="col-sm-8">  
    <input type="text" id="stars" name="stars" value="<?php echo $video['stars'] ?>" class="form-control" data-role="tagsinput" placeholder="add stars"/><br>
    <p>use comma(,) to separate starts.</p>
  </div>

</div>
<div class="form-group">
  <label class=" col-sm-3 control-label"><?php echo tr_wd('rating'); ?></label>
  <div class="col-sm-8">
    <input type="text" name="rating" value="<?php echo $video['rating'] ?>" class="form-control">
  </div>
</div>
<div class="form-group">
  <label class=" col-sm-3 control-label"><?php echo tr_wd('director'); ?></label>
  <div class="col-sm-8">
    <input type="text" name="director" value="<?php echo $video['director'] ?>" class="form-control">
  </div>
</div>
<div class="form-group">
  <label class=" col-sm-3 control-label"><?php echo tr_wd('writer'); ?></label>
  <div class="col-sm-8">
    <input type="text" name="writer" value="<?php echo $video['writer'] ?>" class="form-control">
  </div>
</div>
<div class="form-group">
  <label class=" col-sm-3 control-label"><?php echo tr_wd('release_date'); ?></label>
  <div class="col-sm-8">
    <div class="input-group">
      <input type="text" name="release" value="<?php echo $video['release'] ?>" id="release_date"  class="form-control" >
      <span class="input-group-addon bg-custom b-0 text-white"><i class="fa fa-calendar" aria-hidden="true"></i></span> </div>
    <!-- input-group --> 
  </div>
</div>
<div class="form-group">
  <label class="control-label col-md-3"><?php echo tr_wd('country'); ?></label>
  <div class="col-sm-8">
    <select class="select2" name="country">
      <?php $country = $this->db->get('country')->result_array();
                                foreach ($country as $v_country):?>
      <option value="<?php echo $v_country['country_id']; ?>" <?php if($video['country']==$v_country['country_id']){ echo 'selected';} ?>><?php echo $v_country['name']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>
</div>
<div class="form-group">
  <label class="control-label col-md-3"><?php echo tr_wd('genre'); ?></label>
  <div class="col-sm-8">
    <select class="genre-select2 select2" name="genre[]", multiple>
      <?php $genre = $this->db->get('genre')->result_array();
                                foreach ($genre as $v_genre):?>
      <option value="<?php echo $v_genre['genre_id']; ?>" <?php if($video['genre']==$v_genre['genre_id']){ echo 'selected';} ?>><?php echo $v_genre['name']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>
</div>
<div class="form-group">
  <label class="control-label col-sm-3"><?php echo tr_wd('thumbnail'); ?></label>
  <div class="col-sm-6" >
    <div class="profile-info-name text-center"> <img id="thumb_image" src="<?php echo $video['thumb_link']; ?>" class="img-thumbnail" alt="" > </div>
    <br>
    <div id="thumbnail_content">
    <input type="text" name="thumb_link" value="<?php echo $video['thumb_link']; ?>" class="form-control">
    </div><br>
    <p class="btn btn-white" id="thumb_link" href="#"><span class="btn-label"><i class="fa fa-link"></i></span><?php echo tr_wd('link') ?></p>
    <p class="btn btn-white" id="thumb_file" href="#"><span class="btn-label"><i class="fa fa-file-o"></i></span><?php echo tr_wd('file') ?></p>
  </div>
</div>
<div class="form-group">
  <label class="control-label col-md-3"><?php echo tr_wd('video_type'); ?></label>
  <div class="col-sm-8">
  <?php $video_types = $this->db->get('video_type')->result_array();
  $video_type_ids =explode(',', $video['video_type']);
        foreach ($video_types as $video_type):?>
     <div class="checkbox checkbox-inline">
  <input type="checkbox" name='video_type[]' id="<?php echo $video_type['video_type_id']; ?>" value="<?php echo $video_type['video_type_id']; ?>" required <?php if(in_array($video_type['video_type_id'], $video_type_ids)){ echo 'checked';} ?>>
  <label for="inlineCheckbox1"> <?php echo $video_type['video_type']; ?> </label>
    </div>
      <?php endforeach; ?>

  </div>
</div>
<div class="form-group">
  <label class="control-label col-md-3"><?php echo tr_wd('publication'); ?></label>
  <div class="col-sm-8">
    <select class="form-control m-bot15" name="publication">
      <option value="1" <?php if($video['publication']=='1'){ echo 'selected';} ?>><?php echo tr_wd('published'); ?></option>
      <option value="0" <?php if($video['publication']=='0'){ echo 'selected';} ?>><?php echo tr_wd('unpublished'); ?></option>
    </select>
  </div>
</div>
<h4 class="text-center"><?php echo tr_wd('seo_setting') ?></h4>
<hr>
<div class="form-group">
  <label class=" col-sm-3 control-label"><?php echo tr_wd('focus_keyword'); ?></label>
  <div class="col-sm-8">
    <input type="text" name="focus_keyword" value="<?php echo $video['focus_keyword'] ?>" id="focus_keyword" class="form-control" ><br>
    <p>use comma(,) to separate keyword.</p>
  </div>
</div>
<div class="form-group">
  <label class="control-label col-md-3"><?php echo tr_wd('meta_description'); ?></label>
  <div class="col-md-8">
    <textarea class="wysihtml5 form-control" name="meta_description"  id="meta_description" rows="5"><?php echo $video['meta_description'] ?></textarea>
  </div>
</div>
<?php endforeach; ?>
<div class="form-group">
  <div class="col-sm-offset-3 col-sm-9 m-t-15">
    <button type="submit" class="btn btn-sm btn-primary waves-effect"> <span class="btn-label"><i class="fa fa-floppy-o"></i></span>SAVE </button>
   
  </div>
  <!-- End col-6 --> 
</div>
<!-- end form -group -->
</form>
<script>
        jQuery(document).ready(function() {
          $('form').parsley();                            

          });
</script> 
<script>
        jQuery(document).ready(function() {
          var selectedGenre = "<?php echo $video["genre"] ?>";
          $(".select2").select2();
          $(".genre-select2").select2("val", selectedGenre.split(","));
          $('form').parsley();
        $('#release_date').datepicker({
                  autoclose: true,
                  todayHighlight: true
                });        
        $(":file").filestyle({
          input: false
        });

                       
              
            });
</script> 
<!--instant image dispaly--> 
<script type="text/javascript">
   function showImg(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#thumb_image')
                        .attr('src', e.target.result)                        
                };
                reader.readAsDataURL(input.files[0]);
              }
        }
</script> 
<!--end instant image dispaly--> 





                    </div>
                    <!-- end card-box -->
                </div>
                <!-- end col-12 -->
            </div>
            <!-- end row -->            
        </div>
        <!-- container -->
    </div>
    <!-- content -->

    <script>
        var resizefunc = [];
    </script>
    
    <script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/parsleyjs/dist/parsley.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('form').parsley();
        });
    </script>

    <!-- select2-->
    <script src="<?php echo base_url() ?>assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/plugins/select2/select2.min.js" type="text/javascript"></script>
    <!-- select2-->



<!-- Date picker auto-close --> 
<script src="<?php echo base_url() ?>assets/plugins/moment/moment.js"></script> 
<!-- date picker--> 
<script src="<?php echo base_url() ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script> 
<script src="<?php echo base_url() ?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script> 
<!-- date picker--> 
<!-- file select--> 
<script src="<?php echo base_url() ?>assets/plugins/bootstrap-filestyle/src/bootstrap-filestyle.min.js" type="text/javascript"></script> 
<!-- file select--> 
<!-- select2--> 
<script src="<?php echo base_url() ?>assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url() ?>assets/plugins/select2/select2.min.js" type="text/javascript"></script> 
<!-- select2--> 


 <!--form validation init-->
        <script src="<?php echo base_url() ?>assets/plugins/summernote/dist/summernote.min.js"></script>

        <script>

            jQuery(document).ready(function(){
              $('#thumb_link').click(function(){
                $('#thumbnail_content').html('<input type="text" name="thumb_link" value="<?php echo $video['thumb_link']; ?>" class="form-control">');
              });

              $('#thumb_file').click(function(){
                $('#thumbnail_content').html('<input type="file" id="thumbnail_file" onchange="showImg(this);" name="thumbnail" class="filestyle" data-input="false" accept="image/*"></div>');
              });

                $('#description').summernote({
                    height: 200,                 // set editor height
                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                    focus: false                 // set focus to editable area after initializing summernote
                });                
                
                $('#stars').tagsinput();
                $('#focus_keyword').tagsinput();

            });
        </script>

        <script src="<?php echo base_url() ?>assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script> 


<script>
  $("#title").keyup(function(){
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^\w ]+/g,'');
            Text = Text.replace(/ +/g,'-');
            $("#slug").val(Text);  
        });
</script>

<script>
$(document).ready(function(){
    $("#add-sourch").click(function(){
        //$(".sourch-list").append($("#embed_link:first").clone(true));

          // get the last DIV which ID starts with ^= "klon"
          if ($('#source1').length > 0) {
                var main_content = $('div[id^="source"]:last');
                //alert(main_content);
                // Read the Number from that DIV's ID (i.e: 3 from "klon3")
                // And increment that number by 1
                var num = parseInt( main_content.prop("id").match(/\d+/g), 10 ) +1;
                //alert(num);

                // Clone it and assign the new ID (i.e: from num 4 to ID "klon4")
                var clone_content = main_content.clone().prop('id', 'source'+num );
                clone_content.insertAfter(main_content);
                
                // >>> Append $klon wherever you want
            }
            else{
              $('<div class="form-group" id="source1"><label class=" col-sm-3 control-label" id="sourcelabel1"></label><div class="col-sm-2"><input type="text" name="source_name[]" id="embed_link" class="form-control" placeholder="Name ex: vimeo" required></div><div class="col-sm-4"><input type="url" name="embed_link[]" id="embed_link" class="form-control" placeholder="Addtional embed link ex: //www.dailymotion.com/embed/video/x5x4vmk" required></div><div class="col-sm-2"><input type="number" min="0" name="order[]" id="order" class="form-control" placeholder="order" required></div><div class="col-sm-2"><button onClick="$(this).parent().parent().remove();" id="remove_btn" class="btn btn-danger" id="add-sourch"><i class="fa fa-close"></i></button></div></div>').insertAfter("#video-source");
            }         
    });
});
</script>