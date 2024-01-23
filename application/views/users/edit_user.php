<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Edit User</h3>
    </div>

    <?php echo form_open('edit-user/'.$user->user_id) ?>
    <div class="card-body row">
    <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Select Developer: <span class="text-danger">*</span></label>
            <select name="developer_id" id="developer_select" class="form-select" required>
                <option value="" selected>Select Developer</option>
                <?php foreach($all_developers as $developer){ ?>
                <option value="<?php echo($developer->developer_id) ?>" <?php echo ($developer->developer_id == $user->developer_id ? 'selected' : '') ?>>
                    <?php echo($developer->developer_name) ?>
                </option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Select Project: <span class="text-danger">*</span></label>
            <select name="project_id" id="project_select" class="form-select project_select" required>
                <option value="<?php echo $user->project_id ?>" selected class="text-danger"><?php echo get_projectname_by_id($user->project_id) ?></option>

            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">First Name:</label>
            <input type="text" name="first_name" class="form-control" id="exampleInputPassword1" placeholder="First name" value="<?php echo $user->first_name ?>" required>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Last Name:</label>
            <input type="text" name="last_name" class="form-control" id="exampleInputPassword1" placeholder="Last Name" value="<?php echo $user->last_name ?>" required>
        </div>
        
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Enter Email:</label>
            <input type="email" name="email" class="form-control" id="exampleInputPassword1" placeholder="Email" value="<?php echo $user->email ?>" required>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Contact Number:</label>
            <input type="text" name="contact_number" class="form-control" id="exampleInputPassword1" placeholder="Contact" value="<?php echo $user->contact ?>" required>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Select User Type:</label>
            <?php $roles = get_all_roles(); ?>
            <select name="user_type" class="form-select" require>
                <?php foreach($roles as $role){ ?>
                    <option value="<?php echo $role->role_id ?>" <?php echo($user->user_type==$role->role_id ? 'selected' : '')?>><?php echo $role->role_title ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-success">Update</button>
    </div>
    <?php echo form_close() ?>
</div>

<script src="<?php echo base_url() ?>public/admin/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>public/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
    $("#developer_select").change(function () {
        var developer_id = $(this).val();
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