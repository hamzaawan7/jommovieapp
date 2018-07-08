<div class="card">
    <div class="row">
        <?php echo form_open(base_url() . 'admin/thumbnail_setting/update/', array('class' => 'form-horizontal group-border-dashed', 'enctype' => 'multipart/form-data')); ?>
        <!-- panel  -->
        <div class="col-md-12">
            <div class="panel panel-border panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Thumbnail Setting
                    </h3>
                </div>
                <div class="panel-body">

                    <div id="total_cols">
                        <div class="form-group">
                            <div class="row">
                                <label class=" col-sm-3 control-label">Thumbnail Columns</label>
                                <div class="col-sm-6">
                                    <?php
                                    $num = 2;
                                    $col = 6;
                                    $col = $this->db->get_where('thumbnail', array('id' => 1))->row()->cols;
                                    if ($col == 6) {
                                        $num = 2;
                                    } else if ($col == 4) {
                                        $num = 3;
                                    } else if ($col == 3) {
                                        $num = 4;
                                    } else if ($col == 2) {
                                        $num = 6;
                                    }
                                    ?>
                                    <select name="cols" class="form-control" required>
                                        <option value="<?= $col ?>"><?= $num ?></option>
                                        <option value="6">2</option>
                                        <option value="4">3</option>
                                        <option value="3">4</option>
                                        <option value="2">6</option>
                                    </select>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <label class=" col-sm-3 control-label">Thumbnail Rows</label>
                                <div class="col-sm-6">
                                    <input name="rows"
                                           value="<?= $this->db->get_where('thumbnail', array('id' => 1))->row()->rows ?>"
                                           class="form-control" required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-offset-3 col-sm-9 m-t-15">
                            <button type="submit" class="btn btn-sm btn-primary"><span class="btn-label"><i
                                            class="fa fa-floppy-o"></i></span><?php echo tr_wd('save_changes'); ?>
                            </button>
                        </div>
                    </div>
                    <!--end panel body -->
                </div>
                <!--end panel -->
            </div>

            </form>
            <!--end col-6 -->
        </div>
    </div>