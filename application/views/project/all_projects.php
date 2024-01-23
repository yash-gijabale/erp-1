<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Project List</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->

    <div class="card-body">

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Sr no</th>
                    <th>Project Name</th>
                    <th>Developer Name</th>
                    <th>Location</th>
                    <th>Type</th>
                    <th>MR name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $sr_no = 1; 
                foreach($all_projects as $project){
                ?>
                    <tr>
                        <td><?php echo $sr_no ?></td>
                        <td><?php echo $project->project_name ?></td>
                        <td><?php echo get_developer_by_id($project->developer_id) ?></td>
                        <td><?php echo $project->project_location ?></td>
                        <td><?php echo get_project_type($project->project_type) ?></td>
                        <td><?php echo $project->mr_name ?></td>
                        <td><?php echo $project->email_id ?></td>
                        <td><?php echo $project->contact_number ?></td>
                        <td>
                            <a href="<?php echo base_url().'index.php/edit-project/'.$project->project_id?>" class="btn btn-sm btn-success">Edit</a>
                            <a  onclick="remove_project(<?php echo $project->project_id ?>)" class="btn btn-sm btn-danger">Delete</a>
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
</script>