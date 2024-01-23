<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Observation List</h3>
        <button class="btn btn-success card-tools">Approval</button>
    </div>
    <!-- /.card-header -->
    <!-- form start -->

    <div class="card-body">

        <table id="observations" class="table table-bordered">
            <thead >
                <tr>
                    <th>Sr no</th>
                    <th>Observation Number</th>
                    <th>Client Name</th>
                    <th>Project Name</th>
                    <th>Strucute Name</th>
                    <th>Location</th>
                    <th>Progress Status</th>
                    <th>Attempt Date</th>
                    <th>Target Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $sr_no = 1; 
                foreach($all_observations as $observation){
                ?>
                    <tr>
                        <td><?php echo $sr_no ?></td>
                        <td><?php echo $observation->observation_number ?></td>
                        <td><?php echo get_developer_by_id($observation->client_id) ?></td>
                        <td><?php echo get_projectname_by_id($observation->project_id) ?></td>
                        <td><?php echo structurename_by_id($observation->structure_id) ?></td>
                        <td><?php echo $observation->location ?></td>
                        <td><span class="badge <?php echo get_inner_obj_status($observation->observation_id)['color']?>"><?php echo get_inner_obj_status($observation->observation_id)['status'] ?></span></td>
                        <td><?php echo date('d-m-Y',strtotime($observation->observation_date)) ?></td>
                        <td><?php echo date('d-m-Y',strtotime($observation->target_date)) ?></td>
                
                        <td>
                            <div class="btn-group dropleft">
                            <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?php echo base_url().'index.php/edit-view-observation/'.$observation->observation_id ?>">Edit&View</a>
                                <span class="dropdown-item" onclick="remove_observation('<?php echo $observation->observation_id ?>')">Delete</span>
                            </div>
                            </div>
                        </td>
                       
                    </tr>

                <?php $sr_no++; } ?>
                

            </tbody>
        </table>

    </div>

</div>

<script src="<?php echo base_url() ?>public/admin/plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="<?php echo base_url() ?>public/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
    $(function () {
        $("#observations").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["excel", "pdf", "print"]
        }).buttons().container().appendTo('#observations_wrapper .col-md-6:eq(0)');
    });

    function remove_observation(id){
        remove = confirm('Are you want to delete this ?')
        if(remove){
            window.location.href = "<?php echo base_url().'index.php/remove-observation/'?>"+id
        }
    }
</script>