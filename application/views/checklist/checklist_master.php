<div class="card card-primary">
    <div class="card-header">
    <h3 class="card-title">CheckList Master</h3>
    <button class="btn btn-sm btn-warning card-tools" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus" aria-hidden="true"></i> New Checklist</button>
    </div>
    <!-- /.card-header -->
    <!-- form start -->

    <div class="card-body">

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Sr no</th>
                    <th>CheckList Name</th>
                    <th>CheckList group</th>
                    <th>Active Status</th>
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
        <h5 class="modal-title" id="exampleModalLabel">Create Check List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open('checklist-master') ?>
      <div class="modal-body">
        <div class="form-group col-md-12">
            <label>Checklist Name:</label>
            <input type="text" name="checklist_name" class="form-control" placeholder="Group name" required>
        </div>
        <div class="form-group col-md-12">
            <label>Checklist group:</label>
            <select name="checklist_group" class="form-control">
              <option value="" selected>Select Checklist Group</option>
              <?php foreach($checklist_group as $group){ ?>
                <option value="<?php echo $group->checklist_group_id ?>"><?php echo $group->checklist_group_name ?></option>
              <?php } ?>
            </select>
        </div>
        <div class="form-check mx-2">
          <input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" checked name='checklist_status'>
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

<!-- Update checkList modal -->
<div class="modal fade" id="updateCheckList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Check List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open('edit-checklist-master') ?>
      <div class="modal-body">
        <div class="form-group col-md-12">
            <label>Checklist Name:</label>
            <input type="text" name="checklist_name" id="checklist_name" class="form-control" placeholder="Group name" required>
        </div>
        <div class="form-group col-md-12">
            <label>Checklist group:</label>
            <select name="checklist_group" class="form-control" id="checklist_group">
              <option value="" selected>Select Checklist Group</option>
              <?php foreach($checklist_group as $group){ ?>
                <option value="<?php echo $group->checklist_group_id ?>"><?php echo $group->checklist_group_name ?></option>
              <?php } ?>
            </select>
        </div>
        <div class="form-check mx-2">
          <input class="form-check-input" type="checkbox" id="checklist_status" name='checklist_status'>
          <label class="form-check-label" for="flexCheckChecked">
            Active Status
          </label>
        </div>

        <input type="hidden" name="checklist_id" id="checklist_id">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Save</button>
      </div>
      <?php echo form_close() ?>

    </div>
  </div>
</div>

<!-- Question modal -->
<div class="modal fade bd-example-modal-lg" id="question" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
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


<!-- Group modal -->
<div class="modal fade bd-example" id="group" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Group</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open('add-checklist-subgroup') ?>
      <div class="modal-body">
        <div class="form-group col-md-12">
            <label>Subgroups:</label>
            <select name="subgroup_id" class="form-control" id="subgroups">
              <option value="0" selected>Add new</option>
              <?php foreach($subgroups as $subgroup) { ?>
                <option value="<?php echo  $subgroup->subgroup_id?>"><?php echo $subgroup->subgroup_name ?></option>
              <?php  } ?>
            </select>

            <input type="hidden" name="checklist_id" class="checklist_id">
        </div>
        <div class="row mx-1 ">
          <p class="card-title col-md-12">Subgroup List</p>
          <div class="row" id="subgrouplist">
          </div>
          
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

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

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
      console.log(id)
        $('#checklist_id').val(id)
        $.ajax({
            url: "<?php echo base_url().'index.php/checklist/get_checklist';?>",
            type: "post",
            data: { 'checklist_id': id },
            success: function (obj) {
                var group = $.parseJSON(obj);
                console.log(group);
                $('#checklist_name').val(group.checklist_name)

                // $('#checklist_status').val(group.status)
                
                group.status === '1' ? $('#checklist_status').prop('checked', true) :  $('#checklist_status').prop('checked', false)

                $(`select[id^="checklist_group"] option[value="${group.checklist_group_id}"]`).attr("selected","selected");
                // $('#persentage').val(group.persentage_cost)

                // $('#stage_name').val(stage.stage_name)
            }
        })
    }


    function deleteChecklist(id)
    {
        let isDelete = confirm('Are you sure want to delete ?')
        if(isDelete)
        {
            window.location.href = "<?php echo base_url().'index.php/remove-checklist/' ?>" + id
        }
    }

    function addSubgroup(id)
    {
      $('.checklist_id').val(id)
      $('#subgrouplist').empty()
      $('#subgroups').empty()
      $.ajax({
            url: "<?php echo base_url().'index.php/checklist/get_checklist_subgroups';?>",
            type: "post",
            data: { 'checklist_id': id },
            success: function (obj) {
                var group = $.parseJSON(obj);
                console.log(group);
        
                $('#subgroups').append(`
                <option value="">Add new</option>`)
                $.each(group.subgroups, function(key, value){
                    $("#subgroups").append(`
                    <option value="${value.subgroup_id}">${value.subgroup_name}</option>
                    `)
                })

                $.each(group.subgroupList, function(key, value){
                    $("#subgrouplist").append(`
                        <button type="button" class="btn btn-sm btn-outline-primary col-md-3 m-1">${value.subgroup_name}</button>
                    
                    `)
                })
              
            }
        })

    }
</script>