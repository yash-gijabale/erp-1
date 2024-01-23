<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">New User</h3>
    </div>

    <?php echo form_open('new-user') ?>
    <div class="card-body row">
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Select Developer: <span class="text-danger">*</span></label>
            <select name="developer_id" id="developer_select" class="form-select" required>
                <option value="" selected>Select Developer</option>
                <?php foreach($all_developers as $developer){ ?>
                <option value="<?php echo($developer->developer_id) ?>">
                    <?php echo($developer->developer_name) ?>
                </option>
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
            <label for="exampleInputPassword1">First Name:</label>
            <input type="text" name="first_name" class="form-control" id="exampleInputPassword1"
                placeholder="First name" required>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Last Name:</label>
            <input type="text" name="last_name" class="form-control" id="exampleInputPassword1" placeholder="Last Name"
                required>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Enter Password:</label>
            <input type="Password" name="password" class="form-control" id="exampleInputPassword1"
                placeholder="Password" required>
            <!-- <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">Show</label>
            </div> -->
        </div>

        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Enter Email:</label>
            <input type="email" name="email" class="form-control" id="exampleInputPassword1" placeholder="Email"
                required>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Contact Number:</label>
            <input type="text" name="contact_number" class="form-control" id="exampleInputPassword1"
                placeholder="Contact" required>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Select User Type:</label>
            <?php $roles = get_all_roles(); ?>
            <select name="user_type" class="form-select" require>
                <option value="" selected>Select Type</option>
                <?php foreach($roles as $role){ ?>
                <option value="<?php echo $role->role_id ?>">
                    <?php echo $role->role_title ?>
                </option>
                <?php } ?>
            </select>
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