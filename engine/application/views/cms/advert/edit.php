<div class="row">
    <div class="col-sm-12">
        <?php if ($this->session->flashdata('message')): ?>
        <?php echo create_alert_box($this->session->flashdata('message'),$this->session->flashdata('message_type')); ?>
        <?php endif; ?>
        
        <form id="MyForm" class="form-validation">
            <input type="hidden" id="id" name="id" value="<?php echo $item->id; ?>">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?php echo $item->id?'Update Data':'Create New'; ?></h3>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <div class="form-group">
                        <label>Advert name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Advert name" value="<?php echo $item->name; ?>">
                    </div>
                    <div class="form-group">
                        <label>Advert type</label>
                        <select name="type" class="form-control">
                            <?php foreach ($advert_types as $type => $type_label): ?>
                            <option value="<?php echo $type; ?>" <?php echo $type==$item->type?'selected':''; ?>><?php echo $type_label; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Link Url</label>
                        <div class="input-group">
                            <input type="text" name="link_url" class="form-control" placeholder="http://" value="<?php echo $item->link_url; ?>">
                            <div class="input-group-addon">
                                <input type="checkbox" name="new_window" value="1" <?php echo $item->new_window==1?'checked':''; ?>> New Window
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">
                            <input type="checkbox" name="all_pages" value="1" <?php echo $item->all_pages==1?'checked':''; ?>> All Pages
                        </label>
                        <label class="control-label">
                            <input type="checkbox" name="active" value="1" <?php echo $item->active==1?'checked':''; ?>> Active
                        </label>
                    </div>
                    <div class="form-group">
                        <img id="image-container" src="<?php echo $item->file_name ? site_url($item->file_name) : '';?>" class="img-responsive">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Upload file</label>
                        <input type="file" id="file-upload" name="userfile" class="form-control">
                    </div>
                </div>
                <div class="box-footer clearfix">
                    <button id="btn-submit" class="btn btn-primary" type="submit" data-loading-text="Wait..."><i class="fa fa-save"></i> Submit</button>
                    <a class="btn btn-default" href="<?php echo $back_url; ?>"><i class="fa fa-backward"></i> Back</a>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="<?php echo site_url(config_item('path_lib').'jquery-validation/jquery.validate.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo site_url(config_item('path_lib').'ajax-form/jquery.form.min.js'); ?>"></script>
<script type="text/javascript">
    var Advert = {
        _Id: 0,
        init: function(){
            var _this = this;
            _this._Id = parseInt($('#id').val());
            
            $('.btn-calender').on('click', function(){
                $(this).parents('.input-group').find('input.datepicker').focus();
            });
        
            $('form.form-validation').validate({
                rules: {
                    "name": {
                        minlength: 2,
                        required: true
                    }
                },
                highlight: function(element) {
                    $(element).closest('.form-group').addClass('has-error');
                },
                unhighlight: function(element) {
                    $(element).closest('.form-group').removeClass('has-error');
                },
                submitHandler: function(form){
                    var $btn = $('#btn-submit');
                    $btn.button('loading');
                    
                    $(form).ajaxSubmit({
                        type: 'POST',
                        url: '<?php echo site_url('service/advert/index'); ?>',
                        dataType: 'json',
                        success: function(data){
                            $btn.button('reset');
                            if (data.status){
                                $('#id').val(data.item.id);
                                $('#image-container').attr('src', data.item.file_name);
                                _this._Id = parseInt(data.item.id);
                                
                                alert('Iklan berhasil disimpan');
                            }else{
                                alert(data.message);
                            }
                        }
                    });
                    
                    return false;
                }
            });
        }
    };
    $(document).ready( function () {
        Advert.init();
    });
</script>