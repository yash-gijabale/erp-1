<div class="card card-primary">
    <div class="card-header">
    <h3 class="card-title">CheckList Master</h3>
    <button class="btn btn-sm btn-warning card-tools" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus" aria-hidden="true"></i> New Contractor</button>
    </div>
    <!-- /.card-header -->
    <!-- form start -->

    <div class="card-body">

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Sr no</th>
                    <th>Company Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>GST Number</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $sr_no = 1; 
                foreach($checklist as $group){
                ?>
                    <tr>
                        <td><?php echo $sr_no ?></td>
                        <td><?php echo $group->checklist_name ?></td>
                        <td><?php echo getChecklistGroupName($group->checklist_group_id) ?></td>
                        <td><?php echo ($group->status? 'True' : 'False') ?></td>
                        <td>
                           <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#updateCheckList" onclick="edit('<?php echo $group->checklist_id ?>')"  data-placement="bottom" title="Edit"><i class="fa fa-address-card" aria-hidden="true"></i></button>
                           <button class="btn btn-sm btn-danger" onclick="deleteChecklist('<?php echo $group->checklist_id ?>')" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></button>
                           <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#group" onclick="addSubgroup('<?php echo $group->checklist_id ?>')">Group</button>
                           <a href="<?php echo base_url().'index.php/check-list/'.$group->checklist_id ?>" class="btn btn-sm btn-warning">Questions</a>
                        </td>
                       
                    </tr>

                <?php $sr_no++; } ?>
                

            </tbody>
        </table>

    </div>

</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Contractor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open('contractors') ?>
      <div class="modal-body">
        <div class="form-group col-md-12">
            <label>Select Developer</label>
            <select name="select_developer" id="select_developer" class="form-select">
                <?php foreach ($developers as $developer) { ?>
                <option value="<?php echo $developer->developer_id?>"><?php echo $developer->developer_name ?></option>
                <?php } ?>
                
            </select>
        </div>
        <div class="form-group col-md-12">
        <label>Select Project</label>
            <select name="select_project" id="select_project" class="form-select">
                <?php foreach ($projects as $project) {?>
                <option value="<?php echo $project->project_id?>"><?php echo $project->project_name ?></option>
                <?php } ?>

            </select>
        </div>
        <div class="form-group col-md-12">
            <label>Company Name:</label>
            <input type="text" name="name" class="form-control" placeholder="Name" required>
        </div>
        <div class="form-group col-md-12">
            <label>Phone:</label>
            <input type="text" name="phone" class="form-control" placeholder="Phone" required>
        </div>
        <div class="form-group col-md-12">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" placeholder="Jhon@gmail.com" required>
        </div>
        <div class="form-group col-md-12">
            <label>Address:</label>
            <textarea name="address" class="form-control" required></textarea>
        </div>
        <div class="form-group col-md-12">
            <label>GST Number:</label>
            <input type="text" name="gst_number" class="form-control" placeholder="GST Number" required>
        </div>

        <div class="form-check mx-2">
          <input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" checked name='status'>
          <label class="form-check-label" for="flexCheckChecked">
            Active Status
          </label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Save</button>
      </div>
      <?php echo form_close() ?>

    </div>
  </div>
</div>

<script src="<?php echo base_url() ?>public/admin/plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="<?php echo base_url() ?>public/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
$('#select_developer').change(function(){
    var selected_developer = $(this).val();
    $.ajax({
            url: "<?php echo base_url().'index.php/projects/get_projects_by_dev_id';?>",
            type: "post",
            data: {'developer_id': selected_developer},
            success: function (obj) {
                console.log($.parseJSON(obj))
                var projects = $.parseJSON(obj);
                $('#select_project').empty();
                $.each(projects, function(key, val){
                    $('#select_project').append(`<option value="${val.project_id}">${val.project_name}</option>`)
                })
            }
        })
}
)

</script>