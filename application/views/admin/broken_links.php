<?php $index = 0; ?>
<div class="card">
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
                        <th><?php echo tr_wd('status'); ?></th>
                        <th>Added By</th>
                        <th>Total Reports</th>
                        <th><?php echo tr_wd('actions'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $sl = 1;
                    if ($last_row_num) {
                        $sl = $last_row_num + 1;
                    }
                    if (!empty($allVideos)) {
                        foreach ($allVideos as $videos):
                            $index++;
                            ?>
                            <tr id='row_<?php echo $videos['videos_id']; ?>'>
                                <td hidden>
                                    <input id="id<?= $index ?>" type="hidden" value="<?= $videos['broken_link_id'] ?>"/>
                                </td>
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
                                    <?php echo $videos['total_reports']; ?>
                                </td>
                                <td>
                                    <a href="<?php echo base_url() . 'admin/videos_edit/' . $videos['videos_id']; ?>"
                                       class="btn btn-success" title="Edit Video"><i class="fa fa-pencil"></i></a>
                                    <input id="delete<?= $index ?>" type="checkbox"/>
                                </td>
                            </tr>
                        <?php endforeach;
                    }
                    ?>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <button class="btn btn-primary" id="checkall" type="button">Select ALL</button>
                        </td>
                        <td>
                            <button class="btn btn-danger" type="button" id="delete_link"><i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="text-center"><h2>No broken video links found..</h2></div>
            <?php endif; ?>
            <?php echo $links; ?>

        </div>
        <!-- end col-12 -->
    </div>
    <!-- end row -->

    <script>
        $(document).ready(function () {
            $('#checkall').click(function () {
                var size = <?= $index?>;
                for (var i = 1; i <= size; i++) {
                    $('#delete' + i).not(this).prop('checked', true);
                }
            });
            $('#delete_link').click(function () {
                var size = <?= $index?>;
                var ids = '';
                for (var i = 1; i <= size; i++) {
                    var checked = $('#delete' + i).prop('checked');
                    if (checked) {
                        var id = $('#id' + i).val();
                        ids = ids + id;
                        if (i != size) {
                            ids = ids + ', ';
                        }
                    }
                }
                $.ajax({
                    url: "<?php  echo site_url('admin/videos_delete'); ?>",
                    type: "POST",
                    data: "ids=" + ids,
                    success: function (result) {
                        location.reload();
                    }
                });
            });

        });

    </script>