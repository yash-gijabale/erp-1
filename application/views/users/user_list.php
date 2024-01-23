<?php

$user_projects = array();

?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">User List</h3>
        <div class="card-tools">
            <a href="<?php  echo base_url().'index.php/new-user'?>" class="btn btn-sm btn-success mx-1">Add new</a>
        </div>
    </div>

    <div class="card-body row">
        <table id="users" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Sr no</th>
                    <th>User Name</th>
                    <th>Contact</th>
                    <th>Email Id</th>
                    <th>Role</th>
                    <th>Join Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="subgruop_table">
                <?php $sr_no = 1; 
                foreach($users as $user){
                ?>
                <tr>
                    <td>
                        <?php echo $sr_no ?>
                    </td>
                    <td>
                        <?php echo $user->first_name.' '.$user->last_name ?>
                    </td>
                    <td>
                        <?php echo $user->contact ?>
                    </td>
                    <td>
                        <?php echo $user->email ?>
                    </td>
                    <td>
                        <?php echo get_role_name_by_role_id($user->user_type) ?>
                    </td>
                    <td>
                        <?php echo date('Y-m-d', strtotime($user->created_date)) ?>
                    </td>
                    <td>
                        <a href="<?php echo base_url().'index.php/edit-user/'.$user->user_id ?>"
                            class="btn btn-sm btn-primary">Edit</a>
                        <a href="#" onclick="delete_user(<?php echo $user->user_id ?>)"
                            class="btn btn-sm btn-danger">Delete</a>
                        <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Access
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo base_url().'index.php/user_access/'.$user->user_id ?>">Module Access</a></li>
                            <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal" onClick = "adduser('<?php echo $user->user_id ?>')">Project Access</a></li>
                            <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#checklist" onClick = "addchecklist('<?php echo $user->user_id ?>')" >User List</a></li>
                        </ul>
                       
                    </td>

                </tr>

                <?php $sr_no++; } ?>


            </tbody>
        </table>

    </div>
</div>
<!-- yash g -->

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
      <?php echo form_open('assing-project') ?>
      <div class="modal-body">
            <select class="form-control" name='project_ids[]' id="projects" multiple>
                <!-- <?php foreach($projects as $project){ ?>
                    <option value="<?php echo $project->project_id ?>"><?php echo $project->project_name ?></option>
                <?php } ?> -->
            </select>
            <input type="hidden" id='user_id' name="user_id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      <?php echo form_close() ?>

    </div>
  </div>
</div>

<!-- Modal1 -->
<div class="modal fade" id="checklist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal chec lsistitle</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open('assing-project') ?>
      <div class="modal-body">
            <select class="form-control" name='chhecklist_ids[]' id="checklists" multiple>
            </select>
            <input type="hidden" id='user_id' name="user_id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      <?php echo form_close() ?>

    </div>
  </div>
</div>

<script src="<?php echo base_url() ?>public/admin/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url() ?>public/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
    $(function () {
        $("#users").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["excel", "pdf", "print"]
        }).buttons().container().appendTo('#users_wrapper .col-md-6:eq(0)');
    });


    function delete_user(id) {
        yes = confirm('Are sure want to delete this user ?')
        console.log(id)
        if (yes) {
            window.location.href = "<?php echo base_url().'index.php/delete-user/'?>" + id
        }
    }

    function adduser(id)
    {
        let filed = document.getElementById('user_id')
        filed.value = id;
        $.ajax({
            url: "<?php echo base_url().'index.php/Users/get_all_projects';?>",
            type: "post",
            data: { 'user_id': id },
            success: function (obj) {
                var projects = $.parseJSON(obj);
                console.log(projects)
                $('#projects').empty();
                $.each(projects, function(key, val){
                    if(val.assigned)
                    {
                    $('#projects').append(`<option value="${val.project_id}" selected>${val.project_name}</option>`)

                    }else{

                        $('#projects').append(`<option value="${val.project_id}">${val.project_name}</option>`)
                    }
                })
            }
        })
    }

    function addchecklist(id)
    {
        let filed = document.getElementById('user_id')
        filed.value = id;
        $.ajax({
            url: "<?php echo base_url().'index.php/Checklist/get_all_checklistdata'; ?>",
            type: "get",
            success:function(obj){
                var checklist = $.parseJSON(obj);
                console.log(checklist)
                $('#checklists').empty();
                $.each(checklist, function(key,val){
                    // if(val.assigned)
                    // {
                    //     $('#checklists').append(`<option value="${val.checklist_id}" selected>${val.checklist_name}</option>`)
                    // }else{
                        $('#checklists').append(`<option value="${val.checklist_id}">${val.checklist_name}</option>`)
                    // }
                }) 
            }
        })
    }
</script>