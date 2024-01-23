<style>
    thead input {
        width: 100%;
    }
</style>

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
                    <th>Developer Name</th>
                    <th>Owner Name</th>
                    <th>Owner Number</th>
                    <th>MR name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Region</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $sr_no = 1; ?>
                <?php foreach($all_developers as $developer){ ?>
                    <tr>
                        <td><?php echo $sr_no ?></td>
                        <td><?php echo $developer->developer_name ?></td>
                        <td><?php echo $developer->owner_name ?></td>
                        <td><?php echo $developer->owner_number ?></td>
                        <td><?php echo $developer->mr_name ?></td>
                        <td><?php echo $developer->email_id ?></td>
                        <td><?php echo $developer->contact_number ?></td>
                        <td><?php echo $developer->region ?></td>
                        <td><?php echo $developer->address ?></td>
                        <td>
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-dev-Modal" onclick="edit_developer('<?php echo $developer->developer_id ?>')">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="remove_developer('<?php echo $developer->developer_id ?>')">Delete</button>
                        
                        </td>
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
            <label for="exampleInputPassword1">Management Representative:</label>
            <input type="text" name="mr_name" class="form-control" id="mr_name" placeholder="Management Representative">
        </div>
        <div class="form-group col-md-12">
            <label for="exampleInputPassword1">Enter Email:</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Email">
        </div>
        <div class="form-group col-md-12">
            <label for="exampleInputPassword1">Office Number:</label>
            <input type="text" name="contact_number" class="form-control" id="contact_number" placeholder="Contact">
        </div>

        <div class="form-group col-md-12">
            <label for="exampleInputPassword1">Owner Name:</label>
            <input type="text" name="owner_name" class="form-control" id="owner_name" placeholder="Name">
        </div>
        <div class="form-group col-md-12">
            <label for="exampleInputPassword1">Owner Number:</label>
            <input type="text" name="owner_number" class="form-control" id="owner_number" placeholder="Number">
        </div>
        <div class="form-group col-md-12">
            <label for="exampleInputPassword1">Select Region:</label>
            <select class="form-select" aria-label="Default select example" name="region" id="region">
                <option value="" selected>All Regions</option>
                <?php foreach(all_city_data() as $city){ ?>
                <option value="<?php echo $city ?>"><?php echo $city ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-12">
            <label for="exampleInputPassword1">Address:</label>
            <textarea  class="form-control" name="address" id="address"></textarea>
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
                    $('#mr_name').val(developer.mr_name);
                    $('#email').val(developer.email_id);
                    $('#contact_number').val(developer.contact_number);
                    $('#developer_id').val(developer.developer_id);
                    $('#owner_name').val(developer.owner_name);
                    $('#owner_number').val(developer.owner_number);
                    $('#address').val(developer.address);
                    $(`select[id^="region"] option[value="${developer.region}"]`).attr("selected","selected");

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


//     $(document).ready(function () {
//     // Setup - add a text input to each footer cell
//     $('#example1 thead tr')
//         .clone(true)
//         .addClass('filters')
//         .appendTo('#example1 thead');
 
//     var table = $('#example1').DataTable({
//         "responsive": true, "lengthChange": false, "autoWidth": false,
//         "buttons": ["excel", "pdf", "print"],
//         orderCellsTop: true,
//         fixedHeader: true,
//         initComplete: function () {
//             var api = this.api();
 
//             // For each column
//             api
//                 .columns()
//                 .eq(0)
//                 .each(function (colIdx) {
//                     // Set the header cell to contain the input element
//                     var cell = $('.filters th').eq(
//                         $(api.column(colIdx).header()).index()
//                     );
//                     var title = $(cell).text();
//                     $(cell).html('<input type="text" placeholder="' + title + '" />');
 
//                     // On every keypress in this input
//                     $(
//                         'input',
//                         $('.filters th').eq($(api.column(colIdx).header()).index())
//                     )
//                         .off('keyup change')
//                         .on('change', function (e) {
//                             // Get the search value
//                             $(this).attr('title', $(this).val());
//                             var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
//                             var cursorPosition = this.selectionStart;
//                             // Search the column for that value
//                             api
//                                 .column(colIdx)
//                                 .search(
//                                     this.value != ''
//                                         ? regexr.replace('{search}', '(((' + this.value + ')))')
//                                         : '',
//                                     this.value != '',
//                                     this.value == ''
//                                 )
//                                 .draw();
//                         })
//                         .on('keyup', function (e) {
//                             e.stopPropagation();
 
//                             $(this).trigger('change');
//                             $(this)
//                                 .focus()[0]
//                                 .setSelectionRange(cursorPosition, cursorPosition);
//                         });
//                 });
//         },
//     });
// });
</script>