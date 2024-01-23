<?php $user_type = $this->session->userdata('user_data')->user_type;
 $user_id = $this->session->userdata('user_data')->user_id; ?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">New Observation</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <?php if(isset($submit_status)){ 
        if($submit_status){ ?>
            <div class="alert alert-success alert-dismissible fade show m-1" role="alert">
            <?php echo $submit_msg; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
    <?php }else{ ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $submit_msg;?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
    <?php } } ?>
    <?php echo form_open_multipart('new-observation') ?>
    <div class="card-body row">
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Select Developer: <span class="text-danger">*</span></label>
            <select name="developer_id" id="developer_select" class="form-select" required>
                <option value="" selected>Select Developer</option>
                <?php foreach($all_developers as $developer){ ?>
                    <option value="<?php echo($developer->developer_id) ?>"><?php echo($developer->developer_name) ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Select Project: <span class="text-danger">*</span></label>
            <select name="project_id" id="project_select" class="form-select project_select" required>
                <option value="" selected class="text-danger">Select Developer First</option>
               
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Select Structure: <span class="text-danger">*</span></label>
            <select name="structure_id" id="structure_select" class="form-select" required>
                <option value="" selected class="text-danger">Select Project First</option>
               
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Select Stage: <span class="text-danger">*</span></label>
            <select name="stages_id[]" id="stage_select" class="form-select"  multiple="multiple" required>
                <option value="">Select Stage</option>
               
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Select Trade Group: <span class="text-danger">*</span></label>
            <select name="trade_group" id="tradegroup_select" class="form-select" required>
                <option value="" selected>Select Trade group</option>
                <?php foreach($all_tradesgroup as $tradegroup){ ?>
                    <option value="<?php echo($tradegroup->tradegroup_id) ?>"><?php echo($tradegroup->tradegroup_name) ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Select Activity: <span class="text-danger">*</span></label>
            <select name="activity_id" id="activity_select" class="form-select" required>
                <option value="" selected>Select Trade Group First</option>
                
               
            </select>
        </div>

        <div class="form-group col-md-4">
            <?php $no = mt_rand(1000,99999); ?>
            <label for="exampleInputPassword1">Observation Number</label>
            <input type="text" name="observation_number" class="form-control" id="exampleInputPassword1" value="<?php echo $no ?>" readonly required>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Observation Category: <span class="text-danger">*</span></label>
            <select name="category_id" class="form-select" required>
                <option value="" selected>Select Category</option>
                <?php foreach($observation_category as $category){ ?>
                    <option value="<?php echo($category->category_id) ?>"><?php echo($category->category_name) ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Observation Type: <span class="text-danger">*</span></label>
            <select name="observation_Type_id" class="form-select" required>
                <option value="" selected class="text-danger">Select Type</option>
                <?php foreach($observation_type as $type){ ?>
                    <option value="<?php echo($type->type_id) ?>"><?php echo($type->type_name) ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Location: <span class="text-danger">*</span></label>
            <input type="text" name="location" class="form-control" id="exampleInputPassword1" placeholder="Location" required>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Description:</label>
            <textarea name="decsription" class="form-control"></textarea>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Remark: <span class="text-danger">*</span></label>
            <input type="text" name="remark" class="form-control" id="exampleInputPassword1" placeholder="Remark" required>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Reference:</label>
            <input type="text" name="reference" class="form-control" id="exampleInputPassword1" placeholder="Remark">
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Obvservation Image: <span class="text-danger">*</span></label>
            <input type="file" name="observation_image[]" class="form-control" id="exampleInputPassword1" multiple required>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Recommended Image:</label>
            <input type="file" name="recommended_image[]" class="form-control" id="exampleInputPassword1" multiple>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Observation Severity: <span class="text-danger">*</span></label>
            <select name="severity_id" class="form-select" required>
                <option value="" selected>Select Severity</option>
                <?php foreach($observation_severity as $severity){ ?>
                    <option value="<?php echo($severity->severity_id) ?>"><?php echo($severity->severity_name) ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Site Representative: <span class="text-danger">*</span></label>
            <input type="text" name="site_representative" class="form-control" id="exampleInputPassword1" required>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Observation Status:</label>
            <select name="status" class="form-select" required>
                <option value="0" selected >Open</option>
                <option value="1" >Im progress</option>
                <option value="2" >Close</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Allocate To: <span class="text-danger">*</span></label>
            <?php $roles = get_all_roles(); ?>
            <select name="allocate_to" class="form-select" require>
                <option value="" selected>Select Type</option>
                <?php foreach($roles as $role){ ?>
                    <option value="<?php echo $role->role_id ?>"><?php echo $role->role_title ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Observation Date: <span class="text-danger">*</span></label>
            <input type="date" name="observation_date" class="form-control" id="exampleInputPassword1" required>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Target Date For Closure: <span class="text-danger">*</span></label>
            <input type="date" name="target_date" class="form-control" id="exampleInputPassword1" required>
        </div>

        <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
        <input type="hidden" name="role_id" value="<?php echo $user_type ?>">
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    <?php echo form_close() ?>
</div>



<script src="<?php echo base_url() ?>public/admin/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>public/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>


    $("#developer_select").change(function(){   
        var developer_id = $(this).val();
        $('#structure_select').empty();
        $('#structure_select').append(`<option value="" selected>Select project first</option>`)

        $.ajax({
            url: "<?php echo base_url().'index.php/projects/get_projects_by_dev_id';?>",
            type: "post",
            data: { 'developer_id': developer_id },
            success: function (obj) {
                var projects = $.parseJSON(obj);
                $('.project_select').empty();
                $('.project_select').append(`<option value="" selected>Select Project</option>`)
                $.each(projects, function(key, val){
                    // console.log(val.project_name);
                    $('.project_select').append(`<option value="${val.project_id}">${val.project_name}</option>`)
                })
            }
        })
    
    });

    $("#project_select").change(function(){   
        var project_id = $(this).val();
        $.ajax({
            url: "<?php echo base_url().'index.php/projects/get_structures_by_project_id';?>",
            type: "post",
            data: { 'project_id': project_id },
            success: function (obj) {
                var structures = $.parseJSON(obj);
                $('#structure_select').empty();
                $('#structure_select').append(`<option value="" selected>Select Structure</option>`)
                $.each(structures, function(key, val){
                    $('#structure_select').append(`<option value="${val.structure_id}">${val.structure_name}</option>`)
                })
            }
        })
        $.ajax({
            url: "<?php echo base_url().'index.php/projects/get_mr_name_by_project_id';?>",
            type: "post",
            data: { 'project_id': project_id },
            success: function (obj) {
                var projects = $.parseJSON(obj);
                console.log(projects)
                $('#site_representative_select').empty();
                $.each(projects, function(key, val){
                    $('#site_representative_select').append(`<option value="${val.mr_name}">${val.mr_name}</option>`)
                })
            }
        })
    
    });

    $("#structure_select").change(function(){   
        var structure_id = $(this).val();
        $.ajax({
            url: "<?php echo base_url().'index.php/projects/get_stages_by_structure_id';?>",
            type: "post",
            data: { 'structure_id': structure_id },
            success: function (obj) {
                var stages = $.parseJSON(obj);
                $('#stage_select').empty();
                $('#stage_select').append(`<option value="">Select Stages</option>`)
                $.each(stages, function(key, val){
                    $('#stage_select').append(`<option value="${val.stage_id}">${val.stage_name}</option>`)
                })
            }
        })
    
    });

    $("#tradegroup_select").change(function(){   
        var tradegroup_id = $(this).val();
        $.ajax({
            url: "<?php echo base_url().'index.php/trade/get_trade_by_tradegroup';?>",
            type: "post",
            data: { 'tradegroup_id': tradegroup_id },
            success: function (obj) {
                var trades = $.parseJSON(obj);
                $('#activity_select').empty();
                $.each(trades, function(key, val){
                    $('#activity_select').append(`<option value="${val.trade_id}">${val.trade_name}</option>`)
                })
            }
        })
    
    });

</script>