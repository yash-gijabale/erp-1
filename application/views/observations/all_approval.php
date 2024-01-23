<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Developer List</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->

    <div class="card-body">

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Sr no</th>
                    <th>Observation number</th>
                    <th>Comment</th>
                </tr>
            </thead>
            <tbody>
                <?php $sr_no = 1; ?>
                <?php foreach($all_approval as $approval){ ?>
                    <tr>
                        <td><?php echo $sr_no ?></td>
                        <td><?php echo $approval->observation_number ?></td>
                        <td><?php echo $approval->comment ?></td>
                    </tr>
                <?php $sr_no++; } ?>

            </tbody>
        </table>

    </div>

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="edit-dev-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Developer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open('edit-developer') ?>
      <div class="modal-body">
      <div class="form-group col-md-12">
            <label for="exampleInputEmail1">Developer Name:</label>
            <input type="text" name="developer_name" id="developer_name" class="form-control" id="exampleInputEmail1" placeholder="Developer">
        </div>
        <div class="form-group col-md-12">
            <label for="exampleInputPassword1">GST Number:</label>
            <input type="text" name="developer_gst" id="developer_gst" class="form-control" id="exampleInputPassword1" placeholder="GST">
        </div>
        <div class="form-group col-md-12">
            <label for="exampleInputPassword1">Management Representative:</label>
            <input type="text" name="mr_name" class="form-control" id="mr_name" placeholder="Management Representative">
        </div>
        <div class="form-group col-md-12">
            <label for="exampleInputPassword1">Enter Email:</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Email">
        </div>
        <div class="form-group col-md-12">
            <label for="exampleInputPassword1">Contact Number:</label>
            <input type="text" name="contact_number" class="form-control" id="contact_number" placeholder="Contact">
        </div>
        <input type="hidden" name="developer_id" id="developer_id" value="">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Update</button>
      </div>
      <?php echo form_close() ?>

    </div>
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


    function edit_developer(id){
        console.log(id);
        $developer_id = id;
        $.ajax({
            url:"<?php echo base_url().'index.php/developers/get_developer_by_id' ?>",
            type: "post",
            data:{'developer_id' : $developer_id},
            success: function (obj){
                developer = $.parseJSON(obj)
                if(developer){
                    $('#developer_name').val(developer.developer_name);
                    $('#developer_gst').val(developer.gst_number);
                    $('#mr_name').val(developer.mr_name);
                    $('#email').val(developer.email_id);
                    $('#contact_number').val(developer.contact_number);
                    $('#developer_id').val(developer.developer_id);
                }
            }

        })
    }

    function remove_developer(id){
        if(id){
            is_remove = confirm('Are you sure want to delete this developer ?')
            if(is_remove){
                window.location.href = "<?php echo base_url().'index.php/remove-developer/' ?>" + id
            }
        }
    }
</script>