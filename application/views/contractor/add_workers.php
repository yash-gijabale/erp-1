<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add Workers</h3>
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
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?php echo $submit_msg;?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
    <?php } } ?>
    <?php echo form_open_multipart('add-workers') ?>
    <div class="card-body row">
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Select Developer:</label>
            <select name="developer_id" id="developer_select" class="form-select" required>
                <option value="" selected>Select Developer</option>
                <?php foreach($all_developers as $developer){ ?>
                    <option value="<?php echo($developer->developer_id) ?>"><?php echo($developer->developer_name) ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Select Project:</label>
            <select name="project_id" id="project_select" class="form-control">
                <option value="" selected>Select Project</option>
            </select>
        </div>

        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Enter Name:</label>
            <input type="text" name="name" class="form-control" id="exampleInputPassword1" placeholder="Enter Name">
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Contact No.:</label>
            <input type="text" name="contact" class="form-control" id="exampleInputPassword1" placeholder="Enter number">
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Address:</label>
            <input type="text" name="address" class="form-control" id="exampleInputPassword1" placeholder="Address">
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Date of Birth:</label>
            <input type="date" name="birth_date" class="form-control" id="exampleInputPassword1" placeholder="">
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Enter Age:</label>
            <input type="text" name="age" class="form-control" id="exampleInputPassword1" placeholder="Enter age">
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">User Photo:</label>
            <input type="file" name="user_image" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="row m-1 mt-5">
            <div>
                <button type="button" class="btn btn-primary btn-sm" onclick="add_doc_filed()">Add Documents</button>
            </div>
            <div class="col-md-12" id="doc-container">

            </div>
        </div>
        <!-- <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Adhaar Card:</label>
            <input type="file" name="adhaar_card" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Pan Card:</label>
            <input type="file" name="pan_card" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">User Photo:</label>
            <input type="file" name="user_image" class="form-control" id="exampleInputPassword1">
        </div> -->
        
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-success">Submit</button>
    </div>
    <?php echo form_close() ?>
</div>


<script src="<?php echo base_url() ?>public/admin/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>public/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
$("#developer_select").change(function(){   
        var developer_id = $(this).val();
        $.ajax({
            url: "<?php echo base_url().'index.php/projects/get_projects_by_dev_id';?>",
            type: "post",
            data: { 'developer_id': developer_id },
            success: function (obj) {
                var projects = $.parseJSON(obj);
                $('#project_select').empty();
                $.each(projects, function(key, val){
                    // console.log(val.project_name);
                    $('#project_select').append(`<option value="${val.project_id}">${val.project_name}</option>`)
                })
            }
        })
    
    });


var ind = 0;
function add_doc_filed()
{
    console.log(ind)
    $('#doc-container').append(`
        <div class="row" id='filed-${ind}'>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Document Name</label>
            <input type="text" name="doc_name[]" class="form-control" id="exampleInputPassword1" placeholder="Enter Doc Name">
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Choose File:</label>
            <input type="file" name="doc_file[]" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="form-group col-md-4">
        <a href="#"><i class="fa fa-times" aria-hidden="true" onclick="remove_filed('${ind}')"></i></a>
        </div>
        </div>
    `)
    ind++;
}

function remove_filed(inx)
{
    console.log(inx)
    $(`#filed-${inx}`).remove()
}
</script>