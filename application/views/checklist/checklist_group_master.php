<div class="card card-primary">
    <div class="card-header">
    <h3 class="card-title">CheckList Group Master</h3>
    <button class="btn btn-sm btn-warning card-tools" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus" aria-hidden="true"></i> New Group</button>
    </div>
    <!-- /.card-header -->
    <!-- form start -->

    <div class="card-body">

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Sr no</th>
                    <th>CheckList Gruop</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $sr_no = 1; 
                foreach($checklist_group as $group){
                ?>
                    <tr>
                        <td><?php echo $sr_no ?></td>
                        <td><?php echo $group->checklist_group_name ?></td>
                        <td>
                           <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit_checklist_group"
                            onclick="edit('<?php echo $group->checklist_group_id ?>')">Edit</button>
                           <button class="btn btn-sm btn-danger" onclick="deleteChecklist('<?php echo $group->checklist_group_id ?>')">Delete</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Create Check List Group</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open('checklist-group-master') ?>
      <div class="modal-body">
        <div class="form-group col-md-12">
            <label>Group Name:</label>
            <input type="text" name="group_name" class="form-control" placeholder="Group name" required>
        </div>
        <div class="form-group col-md-12">
            <label>Sequence:</label>
            <input type="text" name="sequence" class="form-control" placeholder="Sequence" required>
        </div>
        <div class="form-group col-md-12">
            <label>Persentage of cost %:</label>
            <input type="text" name="persentage" class="form-control" placeholder="Percentage of cost %" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Save</button>
      </div>
      <?php echo form_close() ?>

    </div>
  </div>
</div>

<!-- Update CheckList group modal -->
<div class="modal fade" id="edit_checklist_group" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Check List Group</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open('edit-checklist-group') ?>
      <div class="modal-body">
        <div class="form-group col-md-12">
            <label>Group Name:</label>
            <input type="text" name="group_name" id="group_name" class="form-control" placeholder="Group name" required>
        </div>
        <div class="form-group col-md-12">
            <label>Sequence:</label>
            <input type="text" name="sequence" id="sequence" class="form-control" placeholder="Sequence" required>
        </div>
        <div class="form-group col-md-12">
            <label>Persentage of cost %:</label>
            <input type="text" name="persentage" id="persentage" class="form-control" placeholder="Percentage of cost %" required>
        </div>

        <input type="hidden" name="checklist_group_id" id="checklist_group_id">
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
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["excel", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

    function remove_project(id){
        if(id){
            console.log(id)
            is_remove = confirm('Are you sure want to delete this project ?')
            if(is_remove){
                window.location.href = "<?php echo base_url().'index.php/remove-project/' ?>" + id

            }
        }
    }


    function edit(id)
    {
        $('#checklist_group_id').val(id)
        $.ajax({
            url: "<?php echo base_url().'index.php/checklist/get_checklist_data';?>",
            type: "post",
            data: { 'checklist_id': id },
            success: function (obj) {
                var group = $.parseJSON(obj);
                console.log(group);
                $('#group_name').val(group.checklist_group_name)

                $('#sequence').val(group.sequence)

                $('#persentage').val(group.persentage_cost)

                // $('#stage_name').val(stage.stage_name)
            }
        })
    }


    function deleteChecklist(id)
    {
        let isDelete = confirm('Are you sure want to delete ?')
        if(isDelete)
        {
            window.location.href = "<?php echo base_url().'index.php/remove-checklist-group/' ?>" + id
        }
    }
</script>