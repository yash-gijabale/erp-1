<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Workers List</h3>
        <button class="btn btn-warning card-tools">New Attendence</button>
    </div>
    <!-- /.card-header -->
    <!-- form start -->

    <div class="card-body">

        <div class="form row my-2">
            <?Php echo form_open('workers-list') ?>
            <div class="col-md-6 d-flex">
                <select name="project_id" class="form-control col-md-6">
                    <option value="" selected>select project</option>
                    <?php foreach($projects as $project){ ?>
                    <option value="<?php echo $project->project_id ?>" <?php echo($select_project==$project->project_id
                        ? 'selected' : '') ?> >
                        <?php echo $project->project_name ?>
                    </option>
                    <?php } ?>
                </select>
                <button type="submit" class="btn btn-sm btn-success col-md-2 mx-2">Get List</button>
            </div>
            <?php echo form_close()?>
        </div>

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Sr no</th>
                    <th>Name</th>
                    <th>Contact No.</th>
                    <th>Address</th>
                    <th>Date of Birth</th>
                    <th>Age</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $sr_no = 1; ?>
                <?php foreach($worker_list as $worker){ ?>
                <tr>
                    <td>
                        <?php echo $sr_no ?>
                    </td>
                    <td>
                        <?php echo $worker->worker_name ?>
                    </td>
                    <td>
                        <?php echo $worker->contact_number ?>
                    </td>
                    <td>
                        <?php echo $worker->address ?>
                    </td>
                    <td>
                        <?php echo date('d-M-Y', strtotime($worker->birth_date)) ?>
                    </td>
                    <td>
                        <?php echo $worker->age ?>
                    </td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item"
                                        href="<?php echo base_url().'index.php/profile/'.$worker->worker_id ?>"><i
                                            class="fa fa-info-circle" aria-hidden="true"></i> Profile</a></li>
                                <!-- <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                            data-bs-target="#view-docs" onclick="get_docs(<?php echo $worker->worker_id ?>)"><i class="fa fa-file-image-o" aria-hidden="true"></i> View Docs</a></li> -->
                                <li><a class="dropdown-item" href="#"><i class="fa fa-trash" aria-hidden="true"></i>
                                        Delete</a></li>
                                <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#add-att"
                                        onclick="add_worker_id('<?php echo $worker->worker_id ?>')"><i
                                            class="fa fa-plus-square" aria-hidden="true"></i> Add attendence</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <?php $sr_no++; } ?>

            </tbody>
        </table>

    </div>


    <!-- Document modal -->
    <div class="modal fade" id="view-docs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Developer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" id="docs">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Document modal -->


    <!-- Attendence Modal -->
    <div class="modal fade" id="add-att" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Attendence</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php 
                    $today_date = date('Y-m-d');
                    echo form_open('add-attendance') ?>
                    <div class="form-group col-md-12">
                        <label for="exampleInputPassword1">Select Date:</label>
                        <input type="date" name="att_date" class="form-control" id="exampleInputPassword1"
                            value="<?php echo $today_date ?>">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputPassword1">Select Staus:</label>
                        <select name="att_status" class="form-control">
                            <option value="0">Absent</option>
                            <option value="1" selected>Present</option>
                        </select>
                    </div>
                    <input type="hidden" name="worker_id" id="worker_id_for_att">
                    <input type="hidden" name="project_id" value="<?php echo $select_project ?>">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
    <!-- /Attendence Modal -->

    <!-- Create all workers attendendece model -->
    <div class="modal fade" id="view-docs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Developer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" id="docs">
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Create all workers attendendece model -->

    <script src="<?php echo base_url() ?>public/admin/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo base_url() ?>public/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["excel", "pdf", "print"],
                "language": {
                    "emptyTable": "No Data Found !"
                }
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });



        function edit_developer(id) {
            console.log(id);
            $developer_id = id;
            $.ajax({
                url: "<?php echo base_url().'index.php/developers/get_developer_by_id' ?>",
                type: "post",
                data: { 'developer_id': $developer_id },
                success: function (obj) {
                    developer = $.parseJSON(obj)
                    if (developer) {
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

        function remove_developer(id) {
            if (id) {
                is_remove = confirm('Are you sure want to delete this developer ?')
                if (is_remove) {
                    window.location.href = "<?php echo base_url().'index.php/remove-developer/' ?>" + id
                }
            }
        }

        function get_docs(id) {
            // console.log(id);
            var base_url = "<?php echo base_url() ?>"
            $('#docs').html(`
                    <div class="row w-100 h-100 d-flex align-middle">
                    <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                    </div>
                    </div>

                   `)
            $.ajax({
                url: "<?php echo base_url().'index.php/contractor/get_docs' ?>",
                type: "post",
                data: { 'worker_id': id },
                success: function (obj) {
                    workerData = JSON.parse(obj)
                    console.log(workerData);
                    //    setTimeout(() => {
                    $('#docs').empty()
                    $('#docs').html(`
                            <div class="col-md-12 mb-2">
                                <span class="card-title">Adhar card</span>
                                <img src="${base_url}${workerData.adhaar_card}" width="100%" alt="" srcset="">
                            </div>
                            <div class="col-md-12">
                                <span class="card-title">Pan card</span>
                                <img src="${base_url}${workerData.pan_card}" width="100%" alt="" srcset="">
                            </div>
                       `)
                    //    }, 1000);
                }

            })
        }

        function add_worker_id(id) {
            // console.log(id)
            $('#worker_id_for_att').val(id)

        }
    </script>