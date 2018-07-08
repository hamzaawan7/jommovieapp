<div class="card">
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-12"><?php $message = $this->session->flashdata('message');
                if (isset($message) && $message != '') {
                    echo $message;
                    echo '<div class="alert alert-info"><strong>Note: </strong> Recent scrapped movie not published yet.Please publish manually.</div>';
                } ?>
            </div>
        </div>
        <div class="col-lg-6 col-md-offset-3">
            <div class="panel panel-border panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Import From IMDB</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group m-b-0">
                        <div class="input-group">
                            <input type="text" class="form-control" id="imdb_id" placeholder="Enter IMDB ID"
                                   required="">
                            <span class="input-group-btn">
                <button type="submit" id="import_btn"
                        class="btn btn-primary w-sm waves-effect waves-light"> Import </button>
                
                </span></div>
                        <div id="result"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php echo form_open(base_url() . 'admin/videos/add/', array('class' => 'form-horizontal group-border-dashed', 'enctype' => 'multipart/form-data')); ?>
            <h4 class="text-center"><?php echo tr_wd('add_new_video') ?></h4>
            <hr>
            <div class="form-group">
                <label class=" col-sm-3 control-label"><?php echo tr_wd('title'); ?></label>
                <div class="col-sm-8">
                    <input type="text" name="title" id="title" class="form-control" style="width: 100% !important;" required>
                </div>
            </div>
            <div class="form-group">
                <label class=" col-sm-3 control-label"><?php echo tr_wd('slug'); ?> (<?php echo base_url(); ?>)</label>
                <div class="col-sm-8">
                    <input type="text" id="slug" name="slug" class="form-control input-sm" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3"><?php echo tr_wd('description'); ?></label>
                <div class="col-md-8">
                    <textarea class="wysihtml5 form-control" name="description" id="description" rows="10"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class=" col-sm-3 control-label"><?php echo tr_wd('video_download_link'); ?></label>
                <div class="col-sm-8">
                    <input type="url" name="downloadable_link" id="downloadable_link" class="form-control">
                </div>
            </div>
            <div class="form-group video-source" id="video-source">
                <label class=" col-sm-3 control-label"><?php echo tr_wd('video_embed_link'); ?></label>
                <div class="col-sm-6 sourch-list">
                    <input type="url" name="embed_link_main" id="embed_link" class="form-control"
                           placeholder="ex: https://www.youtube.com/embed/IchaTgzimuU" required>
                </div>
                <div class="col-sm-2"><a href="#description" class="btn btn-primary" id="add-sourch"><i
                                class="fa fa-plus"></i> Add Source</a></div>
            </div>
            <div class="form-group">
                <label class=" col-sm-3 control-label"><?php echo tr_wd('runtime'); ?></label>
                <div class="col-sm-8">
                    <input type="text" name="runtime" id="runtime" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class=" col-sm-3 control-label"><?php echo tr_wd('starts'); ?></label>

                <div class="col-sm-8">
                    <input type="text" id="stars" name="stars" class="form-control" placeholder="add stars"/><br>
                    <p>use comma(,) to separate starts.</p>
                </div>

            </div>
            <div class="form-group">
                <label class=" col-sm-3 control-label"><?php echo tr_wd('rating'); ?></label>
                <div class="col-sm-8">
                    <input type="text" name="rating" id="rating" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class=" col-sm-3 control-label"><?php echo tr_wd('director'); ?></label>
                <div class="col-sm-8">
                    <input type="text" name="director" id="director" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class=" col-sm-3 control-label"><?php echo tr_wd('writer'); ?></label>
                <div class="col-sm-8">
                    <input type="text" name="writer" id="writer" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class=" col-sm-3 control-label"><?php echo tr_wd('release_date'); ?></label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <input type="text" name="release" id="release_date" class="form-control">
                        <span class="input-group-addon bg-custom b-0 text-white"><i class="fa fa-calendar"
                                                                                    aria-hidden="true"></i></span></div>
                    <!-- input-group -->
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3"><?php echo tr_wd('country'); ?></label>
                <div class="col-sm-8">
                    <select class="select2" name="country">
                        <optgroup label="Select Country">
                            <?php $country = $this->db->get('country')->result_array();
                            foreach ($country as $v_country):?>
                                <option value="<?php echo $v_country['country_id']; ?>"><?php echo $v_country['name']; ?></option>
                            <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3"><?php echo tr_wd('genre'); ?></label>
                <div class="col-sm-8">
                    <select id="genre" class="select2" name="genre[]" multiple>
                        <?php $genre = $this->db->get('genre')->result_array();
                        foreach ($genre as $v_genre):?>
                            <option value="<?php echo $v_genre['genre_id']; ?>"><?php echo $v_genre['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3"><?php echo tr_wd('thumbnail'); ?></label>
                <div class="col-sm-6">
                    <div class="profile-info-name text-center"><img id="thumb_image" src="" class="img-thumbnail"
                                                                    alt=""></div>
                    <br>
                    <div id="thumbnail_content">
                        <input type="file" id="thumbnail_file" onchange="showImg(this);" name="thumbnail"
                               class="filestyle" data-input="false" accept="image/*"></div>
                    <br>
                    <p class="btn btn-white" id="thumb_link" href="#"><span class="btn-label"><i class="fa fa-link"></i></span><?php echo tr_wd('link') ?>
                    </p>
                    <p class="btn btn-white" id="thumb_file" href="#"><span class="btn-label"><i
                                    class="fa fa-file-o"></i></span><?php echo tr_wd('file') ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3"><?php echo tr_wd('video_type'); ?></label>
                <div class="col-sm-8">
                    <?php $video_types = $this->db->get('video_type')->result_array();
                    foreach ($video_types as $video_type):?>
                        <div class="animated-checkbox checkbox-inline">
                            <label>
                                <input type="checkbox" name='video_type[]'
                                       value="<?php echo $video_type['video_type_id']; ?>" required><span
                                        class="label-text"><?php echo $video_type['video_type']; ?></span>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3"><?php echo tr_wd('publication'); ?></label>
                <div class="col-sm-8">
                    <select class="form-control m-bot15" name="publication">
                        <option value="1"><?php echo tr_wd('published'); ?></option>
                        <option value="0"><?php echo tr_wd('unpublished'); ?></option>
                    </select>
                </div>
            </div>
            <h4 class="text-center"><?php echo tr_wd('seo_setting') ?></h4>
            <hr>
            <div class="form-group">
                <label class=" col-sm-3 control-label"><?php echo tr_wd('focus_keyword'); ?></label>
                <div class="col-sm-8">
                    <input type="text" name="focus_keyword" id="focus_keyword" class="form-control"><br>
                    <p>use comma(,) to separate keyword.</p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3"><?php echo tr_wd('meta_description'); ?></label>
                <div class="col-md-8">
                    <textarea class="wysihtml5 form-control" name="meta_description" id="meta_description"
                              rows="5"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class=" col-sm-3 control-label"><?php echo tr_wd('tags'); ?></label>
                <div class="col-sm-8">
                    <input type="text" name="tags" id="tags" class="form-control"><br>
                    <p>use comma(,) to separate tags.</p>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9 m-t-15">
                    <button type="submit" class="btn btn-sm btn-primary waves-effect"><span class="btn-label"><i
                                    class="fa fa-plus"></i></span>CREATE
                    </button>

                </div>
            </div>
            </form>
        </div>
    </div>
    <script>
        jQuery(document).ready(function () {
            $(".select2").select2();
            $('form').parsley();
            $('#release_date').datepicker({
                format: 'dd M yyyy',
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

    <script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/parsleyjs/dist/parsley.min.js"></script>


    <!-- Date picker auto-close -->
    <script src="<?php echo base_url() ?>assets/plugins/moment/moment.js"></script>
    <!-- date picker-->
    <script src="<?php echo base_url() ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- date picker-->
    <!-- file select-->
    <script src="<?php echo base_url() ?>assets/plugins/bootstrap-filestyle/src/bootstrap-filestyle.min.js"
            type="text/javascript"></script>
    <!-- file select-->
    <!-- select2-->
    <script src="<?php echo base_url() ?>assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js"
            type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/plugins/select2/select2.min.js" type="text/javascript"></script>
    <!-- select2-->


    <!--form validation init-->
    <script src="<?php echo base_url() ?>assets/plugins/summernote/dist/summernote.min.js"></script>

    <script>

        jQuery(document).ready(function () {
            $('#thumb_link').click(function () {
                $('#thumbnail_content').html('<input type="text" name="thumb_link" class="form-control">');
            });

            $('#thumb_file').click(function () {
                $('#thumbnail_content').html('<input type="file" id="thumbnail_file" onchange="showImg(this);" name="thumbnail" class="filestyle" data-input="false" accept="image/*"></div>');
            });

            $('#description').summernote({
                height: 200,                 // set editor height
                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor
                focus: false                 // set focus to editable area after initializing summernote
            });

            ///$('#stars').tagsinput();
            ///$('#focus_keyword').tagsinput();

        });
    </script>

    <script src="<?php echo base_url() ?>assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>


    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $('#import_btn').click(function () {
                $('#result').html('');
                id = $("#imdb_id").val();
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url() . "admin/import_imdb";?>',
                    data: "id=" + id,
                    dataType: 'json',
                    beforeSend: function () {

                        $("#import_btn").html('Please Wait!!...');


                    },
                    success: function (response) {
                        var imdb_status = response.imdb_status;
                        var title = response.title;
                        var plot = response.plot;
                        var runtime = response.runtime;
                        var stars = response.stars;
                        var rating = response.rating;
                        var director = response.director;
                        var writer = response.writer;
                        var release = response.release;
                        var poster = response.poster;
                        var genre = response.genre;
                        if (imdb_status == 'success') {
                            $('#result').html('<div class="alert alert-success alert-dismissable m-t-15"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Data imported successfully.</div>');
                            $("#title").val(title);
                            $("#description").code('<p>' + plot + '</p>');
                            $("#runtime").val(runtime);
                            $('#stars').val(stars);
                            $("#rating").val(rating);
                            $("#director").val(director);
                            $("#writer").val(writer);
                            $("#release_date").val(release);
                            $("#genre").select2("val", genre);
                            $('#thumbnail_content').html('<input type="text" name="thumb_link" value="' + poster + '" class="form-control">');
                            $('#thumb_image').attr('src', poster);
                            $('#import_btn').html('import');
                        } else {
                            $('#result').html('<div class="alert alert-danger alert-dismissable m-t-15"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>No data found in IMBD database..</div>');
                            $('#import_btn').html('import again');
                        }
                    }
                });
            });
        });

    </script>

    <script>
        $('#demoSelect').select2();
        $("#title").keyup(function () {
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^\w ]+/g, '');
            Text = Text.replace(/ +/g, '-');
            $("#slug").val(Text);
        });
    </script>
    <?php
    $video_title = array();
    $query = $this->db->get('videos');
    foreach ($query->result() as $row)
    {
        array_push($video_title, $row->title);
    }
    $video_title = json_encode($video_title);
    $video_title = str_replace("'","", $video_title);
    ?>
    <style>
        .twitter-typeahead {
            width: 100%;
        }

        .tt-query { /* UPDATE: newer versions use tt-input instead of tt-query */
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        }

        .tt-hint {
            color: #999;
        }

        .tt-menu { /* UPDATE: newer versions use tt-menu instead of tt-dropdown-menu */
            width: 422px;
            margin-top: 12px;
            padding: 8px 0;
            background-color: #fff;
            border: 1px solid #ccc;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            box-shadow: 0 5px 10px rgba(0,0,0,.2);
        }

        .tt-suggestion {
            padding: 3px 20px;
            font-size: 14px;
            line-height: 24px;
        }

        .tt-suggestion.tt-is-under-cursor { /* UPDATE: newer versions use .tt-suggestion.tt-cursor */
            color: #fff;
            background-color: #0097cf;

        }

        .tt-suggestion p {
            margin: 0;
        }
    </style>
    <script>
        $(document).ready(function () {
            // Defining the local dataset
            var videos = $.parseJSON('<?php echo $video_title ?>');
            // Constructing the suggestion engine
            var videos = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                local: videos
            });

            // Initializing the typeahead
            $('input[name=title]').typeahead({
                    hint: true,
                    highlight: true, /* Enable substring highlighting */
                    minLength: 1 /* Specify minimum characters required for showing result */
                },
                {
                    name: 'videos',
                    source: videos,
                });

            $("#add-sourch").click(function () {
                //$(".sourch-list").append($("#embed_link:first").clone(true));

                // get the last DIV which ID starts with ^= "klon"
                if ($('#source1').length > 0) {
                    var main_content = $('div[id^="source"]:last');
                    //alert(main_content);
                    // Read the Number from that DIV's ID (i.e: 3 from "klon3")
                    // And increment that number by 1
                    var num = parseInt(main_content.prop("id").match(/\d+/g), 10) + 1;
                    //alert(num);

                    // Clone it and assign the new ID (i.e: from num 4 to ID "klon4")
                    var clone_content = main_content.clone().prop('id', 'source' + num);
                    clone_content.insertAfter(main_content);

                    // >>> Append $klon wherever you want
                }
                else {
                    $('<div class="form-group" id="source1"><label class=" col-sm-3 control-label" id="sourcelabel1"></label><div class="col-sm-2"><input type="text" name="source_name[]" id="embed_link" class="form-control" placeholder="Name ex: vimeo" required></div><div class="col-sm-4"><input type="url" name="embed_link[]" id="embed_link" class="form-control" placeholder="Addtional embed link ex: //www.dailymotion.com/embed/video/x5x4vmk" required></div><div class="col-sm-2"><input type="number" min="0" name="order[]" id="order" class="form-control" placeholder="order" required></div><div class="col-sm-1"><button onClick="$(this).parent().parent().remove();" id="remove_btn" class="btn btn-danger" id="add-sourch"><i class="fa fa-close"></i></button></div></div>').insertAfter("#video-source");
                }
            });
        });
    </script>

