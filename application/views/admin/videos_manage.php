<div class="card">
    <div class="row">
        <div class="col-sm-6">
            <a href="<?php echo base_url() . 'admin/videos_add'; ?>"
               class="btn btn-sm btn-primary waves-effect waves-light"><span class="btn-label"><i
                            class="fa fa-plus"></i></span><?php echo tr_wd('add_video'); ?></a>
        </div>
        <div class="col-sm-6">
            <form method="GET" class="form-horizontal">
                <div class="input-group">
                    <input type="search" name="q" class="form-control" placeholder="Search By Name"
                           value="<?php echo $searchTerm; ?>">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">Search</button>
               </span>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php if ($total_rows > 0): ?>
                <table class="table table-striped" id="datatablessd">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>###</th>
                        <th><?php echo tr_wd('name'); ?></th>
                        <th><?php echo tr_wd('description'); ?></th>
                        <th><?php echo tr_wd('video_type'); ?></th>
                        <th><?php echo tr_wd('status'); ?></th>
                        <th>Added By</th>
                        <th><?php echo tr_wd('actions'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $sl = 1;
                    if ($last_row_num)
                        $sl = $last_row_num + 1;
                    foreach ($allVideos as $videos):

                        ?>
                        <tr id='row_<?php echo $videos['videos_id']; ?>'>
                            <td><?php echo $sl++; ?></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button"
                                            class="btn btn-white btn-sm dropdown-toggle waves-effect waves-light"
                                            data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"
                                                                                            aria-hidden="true"></i>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a target="_blank"
                                               href="<?php echo base_url() . 'watch/' . $videos['slug']; ?>"><?php echo tr_wd('preview'); ?></a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url() . 'admin/videos_edit/' . $videos['videos_id']; ?>"><?php echo tr_wd('edit_video'); ?></a>
                                        </li>
                                        <li><a title="<?php echo tr_wd('delete'); ?>" href="#"
                                               onclick="delete_row(<?php echo " 'videos' " . ',' . $videos['videos_id']; ?>)"
                                               class="delete"><?php echo tr_wd('delete'); ?></a></li>
                                    </ul>
                                </div>
                            </td>
                            <td><strong><?php echo $videos['title']; ?></strong></td>
                            <td><?php echo $videos['description']; ?></td>
                            <td><?php
                                $videos_types = explode(',', $videos['video_type']);
                                foreach ($videos_types as $videos_type) {
                                    $video_type_name = $this->common_model->get_video_type($videos_type);
                                    echo '<span class="label label-primary label-xs">' . $video_type_name . '</span>&nbsp;';
                                }
                                ?>
                            </td>
                            <td><?php
                                if ($videos['publication'] == '1') {
                                    echo '<span class="label label-primary label-xs">Published</span>';
                                } else {
                                    echo '<span class="label label-warning label-mini">Unublished</span>';
                                }
                                ?>
                            </td>
                            <td>
                                <?php if ($videos['name']) {
                                    echo $videos['name'];
                                } else {
                                    echo 'Unknown';
                                }
                                ?>
                            </td>
                            <td>
                                <a href="<?php echo base_url() . 'admin/videos_edit/' . $videos['videos_id']; ?>"
                                   class="btn btn-success" title="Edit Video"><i class="fa fa-pencil"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="text-center"><h2>No video found..</h2></div>
            <?php endif; ?>
            <?php echo $links; ?>

        </div>
        <!-- end col-12 -->
    </div>
    <!-- end row --> 