<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add Trade Group</h3>
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
    <?php echo form_open('add-tradegroup') ?>
    <div class="card-body row">
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Trade-group Name:</label>
            <input type="text" name="tradegroup_name" class="form-control" id="exampleInputPassword1"
                placeholder="Trade Group name" required>
        </div>

    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    <?php echo form_close() ?>
</div>


<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Add Trade</h3>
    </div>
    <?php echo form_open('add-trade') ?>
    <div class="card-body row">
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Select Trade Group:</label>
            <select name="tradegroup_id" id="project_id" class="form-select project_select" required>
                <option value="" selected>Select Trade Group</option>
                <?php if($trade_groups){ 
                    foreach($trade_groups as $trade_group){
                    ?>
                <option value="<?php echo $trade_group->tradegroup_id ?>">
                    <?php echo $trade_group->tradegroup_name ?>
                </option>

                <?php }} ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Trade Name:</label>
            <input type="text" name="trade_name" class="form-control" id="exampleInputPassword1"
                placeholder="Trade name" required>
        </div>

    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-success">Submit</button>
    </div>
    <?php echo form_close() ?>
</div>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Add Subgroup</h3>
    </div>
    <?php echo form_open('add-subgroup') ?>
    <div class="card-body row">
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Select Trade :</label>
            <select name="trade_id" id="project_id" class="form-select project_select" required>
                <option value="" selected>Select Trade</option>
                <?php if($trades){ 
                    foreach($trades as $trade){
                    ?>
                <option value="<?php echo $trade->trade_id ?>">
                    <?php echo $trade->trade_name ?>
                </option>

                <?php }} ?>

            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Subgroup Name:</label>
            <input type="text" name="subgroup_name" class="form-control" id="exampleInputPassword1"
                placeholder="Subgroup name" required>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Subgroup Description:</label>
            <textarea name="subgroup_desc" class="form-control" id="exampleInputPassword1"
                placeholder="Subgroup Description" required></textarea>
        </div>


    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-info">Submit</button>
    </div>
    <?php echo form_close() ?>
</div>



<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title">Add Ouestions</h3>
        <button class="btn btn-sm btn-warning card-tools"  data-toggle="modal" data-target="#exampleModal">Import</button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <?php echo form_open_multipart('import-questions') ?>
                <input type="file" name="importfile" class="form-control" id="importfile" required accept=".csv">
                <input type="file" name="image" class="form-control">
                <input type="hidden" value="testbhsjdhs" name="test">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </div>
            <?php echo form_close() ?>

        </div>
        </div>
    </div>
    <?php echo form_open('add-questions') ?>
    <div class="card-body row">
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Select Subgroup :</label>
            <select name="subgroup_id" class="form-select" required>
                <option value="" selected>Select subgroup</option>
                <?php if($subgroups){ 
                    foreach($subgroups as $subgroup){
                    ?>
                <option value="<?php echo $subgroup->subgroup_id ?>">
                    <?php echo $subgroup->subgroup_name ?>
                </option>

                <?php }} ?>

            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Ouestion Title:</label>
            <input type="text" name="question_title" class="form-control" id="exampleInputPassword1"
                placeholder="Ouestion" required>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Question Description:</label>
            <textarea name="question_desc" class="form-control" id="exampleInputPassword1" placeholder="Description"
                required></textarea>
        </div>

        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Question Type :</label>
            <select name="type_id" id="project_id" class="form-select project_select" required>
                <option value="" selected>Select subgroup</option>
                <?php $types = get_all_types(); ?>
                <?php if($types){ 
                    foreach($types as $type){
                    ?>
                <option value="<?php echo $type->type_id ?>">
                    <?php echo $type->type_name ?>
                </option>

                <?php }} ?>

            </select>
        </div>

        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Question severity :</label>
            <select name="severity_id" id="project_id" class="form-select project_select" required>
                <option value="" selected>Select subgroup</option>
                <?php $severity = get_all_severity(); ?>
                <?php if($severity){ 
                    foreach($severity as $severity){
                    ?>
                <option value="<?php echo $severity->severity_id ?>">
                    <?php echo $severity->severity_name ?>
                </option>

                <?php }} ?>

            </select>
        </div>

    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-secondary">Submit</button>
    </div>
    <?php echo form_close() ?>
</div>

<script src="<?php echo base_url() ?>public/admin/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>public/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
    $("#developer_select").change(function () {
        var developer_id = $(this).val();
        $('#structure_select').empty();
        $('#structure_select').append(`<option value="" selected>Select project first</option>`)

        $.ajax({
            url: "<?php echo base_url().'index.php/projects/get_projects_by_dev_id';?>",
            type: "post",
            data: { 'developer_id': developer_id },
            success: function (obj) {
                var projects = $.parseJSON(obj);
                $('#project_select').empty();
                $('#project_select').append(`<option value="" selected>Select Project</option>`)
                $.each(projects, function (key, val) {
                    // console.log(val.project_name);
                    $('#project_select').append(`<option value="${val.project_id}">${val.project_name}</option>`)
                })
            }
        })

    });
</script>