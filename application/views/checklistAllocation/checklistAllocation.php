<style>
    .question-box{
        width: 100vw;
        height: 200px;
        overflow-y: auto;
    }
</style>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">CheckList Allocation</h3>
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
    <?php echo form_open('checklist-allocation') ?>
    <div class="card-body row">
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Select Developer:</label>
            <select name="developer_id" class="form-select" id='developer_id' required>
                <option value="" selected>Select Developer</option>
                <?php foreach($all_developers as $developer){ ?>
                <option value="<?php echo($developer->developer_id) ?>">
                    <?php echo($developer->developer_name) ?>
                </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Projects:</label>
            <select name="project_id" class="form-select" id="project_select" required>
                <option value="" selected>Select Project</option>

            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Structure:</label>
            <select name="structure_id" class="form-select" id="structure_select" required>
                <option value="" selected>Select Structure</option>
                
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">CheckList:</label>
            <select name="checklist_id" class="form-select" required id='checklist_select'>
                <option value="" selected>Select CheckList</option>
                <?php foreach($checkList as $list){ ?>
                <option value="<?php echo($list->checklist_id) ?>">
                    <?php echo($list->checklist_name) ?>
                </option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Subgroup:</label>
            <select name="subgroup_id" class="form-select" required id='subgroup'>
                <option value="" selected>Select Subgroup</option>
               
            </select>
        </div>

        <div class="card m-auto question-box">
         <label for="exampleInputEmail1">Questions:</label>
        <div class=" mx-3" id='questionList'>

        </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    <?php echo form_close() ?>
</div>


<script src="<?php echo base_url() ?>public/admin/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>public/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
    $("#developer_id").change(function () {
        var developer_id = $(this).val();
        $('#all_structure').empty();

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

    $("#project_select").change(function () {
        var project_id = $(this).val();
        $.ajax({
            url: "<?php echo base_url().'index.php/projects/get_structures_by_project_id';?>",
            type: "post",
            data: { 'project_id': project_id },
            success: function (obj) {
                var structures = $.parseJSON(obj);
                $('#structure_select').empty();
                $('#structure_select').append(`<option value="" selected>Select Structure</option>`)
                $.each(structures, function (key, val) {
                    $('#structure_select').append(`<option value="${val.structure_id}">${val.structure_name}</option>`)
                })
            }
        })
    })

    $("#checklist_select").change(function () {
        var id = $(this).val();
        $.ajax({
            url: "<?php echo base_url().'index.php/checklistAllocation/get_subgroup_by_checklist_id';?>",
            type: "post",
            data: { 'checklist_id': id },
            success: function (obj) {
                var subgroups = $.parseJSON(obj);
                // console.log(structures)
                $('#subgroup').empty();
                $('#subgroup').append(`<option value="" selected>Select Subgroup</option>`)
                $.each(subgroups, function (key, val) {
                    $('#subgroup').append(`<option value="${val.subgroup_id}">${val.subgroup_name}</option>`)
                })
            }
        })
    })

    $("#subgroup").change(function () {
        var subgroup_id = $(this).val();
        var checklist_id = $('#checklist_select').val();
        var developer_id = $('#developer_id').val();
        var project_id = $('#project_select').val();
        var structure_id = $('#structure_select').val();
        $.ajax({
            url: "<?php echo base_url().'index.php/checklistAllocation/get_checklist_questions_by_checklist_subgroup';?>",
            type: "post",
            data: { 
                'checklist_id': checklist_id, 
                'subgroup_id': subgroup_id,
                'developer_id' : developer_id,
                'project_id' : project_id,
                'structure_id': structure_id
            },
            success: function (obj) {
                var questions = $.parseJSON(obj);
                console.log(questions)
                $('#questionList').empty();
                // $('#subgroup').append(`<option value="" selected>Select Subgroup</option>`)
                $.each(questions, function (key, val) {
                    $('#questionList').append(`
                    <div class="card card-success card-outline col-md-5 my-1 p-2">
                        <div class="mx-4">
                        <input class="form-check-input" type="checkbox" value="${val.question_id}" name='questions[]' ${val.isAllocated ? 'checked': ''}>
                            <label class="form-check-label" for="flexCheckDefault">
                            ${val.question_title}
                            </label>
                        </div>
                    </div>
                    `)
                })
            }
        })
    })
</script>