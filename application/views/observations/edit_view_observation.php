<?php $user_type = $this->session->userdata('user_data')->user_type;
 $user_id = $this->session->userdata('user_data')->user_id;

// print_r($user_type);exit;
if($user_type == '1' || $user_type == '2' ){
    $readonly = '';
}else{
    $readonly = 'disabled';
}

?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Observation Details</h3>
    </div>

    <?php 
    $attributes = array('id' => 'edit-form');
    echo form_open_multipart('edit-view-observation/'.$observation->observation_id, $attributes) ?>
    <div class="card-body row">
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Select Developer:</label>
            <select name="developer_id" id="developer_select" class="form-select" required <?php echo $readonly ?> >
                <option value="" selected>Select Developer</option>
                <?php foreach($all_developers as $developer){ ?>
                <option value="<?php echo($developer->developer_id)?>" <?php echo($developer->developer_id ==
                    $observation->client_id ? 'selected' : '') ?>>
                    <?php echo($developer->developer_name) ?>
                </option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Select Project:</label>
            <select name="project_id" id="project_select" class="form-select project_select" required <?php echo
                $readonly ?>>
                <option value="<?php echo $observation->project_id ?>" selected>
                    <?php echo get_projectname_by_id($observation->project_id) ?>
                </option>

            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Select Structure:</label>
            <select name="structure_id" id="structure_select" class="form-select" required <?php echo $readonly ?> >
                <option value="<?php echo $observation->structure_id ?>" selected>
                    <?php echo structurename_by_id($observation->structure_id) ?>
                </option>

            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Select Stage:</label>
            <?php $ob_floors = json_decode($observation->floors); ?>
            <select name="stages_id[]" id="stage_select" class="form-select" multiple required <?php echo
                $readonly ?>>
                <?php foreach($floors as $key=>$floor){ ?>
                <option value="<?php echo $floor->stage_id ?>" <?php echo($floor->stage_id == $ob_floors[$key] ? 'selected' : '') ?>>
                    <?php echo $floor->stage_name ?>
                </option>
                <?php } ?>

            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Select Trade Group:</label>
            <select name="trade_group" id="tradegroup_select" class="form-select" required <?php echo $readonly ?> >
                <option value="" selected>Select Trade group</option>
                <?php foreach($all_tradesgroup as $tradegroup){ ?>
                <option value="<?php echo($tradegroup->tradegroup_id) ?>" <?php echo($tradegroup->tradegroup_id ==
                    $observation->tradegroup_id ? 'selected' : '') ?>>
                    <?php echo($tradegroup->tradegroup_name) ?>
                </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Select Activity:</label>
            <select name="activity_id" id="activity_select" class="form-select" required <?php echo $readonly ?> >
                <option value="<?php echo $observation->activity_id ?>" selected>
                    <?php echo get_trade_by_id($observation->activity_id) ?>
                </option>


            </select>
        </div>

        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Observation Number</label>
            <input type="text" name="observation_number" class="form-control" id="exampleInputPassword1"
                value="<?php echo $observation->observation_number ?>" readonly required>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Observation Category:</label>
            <select name="category_id" class="form-select" required <?php echo $readonly ?> >
                <option value="" selected>Select Category</option>
                <?php foreach($observation_category as $category){ ?>
                <option value="<?php echo($category->category_id) ?>" <?php echo($category->category_id ==
                    $observation->observation_category ? 'selected' : '') ?>>
                    <?php echo($category->category_name) ?>
                </option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Observation Type:</label>
            <select name="observation_Type_id" class="form-select" required <?php echo $readonly ?> >
                <option value="" selected class="text-danger">Select Type</option>
                <?php foreach($observation_type as $type){ ?>
                <option value="<?php echo($type->type_id) ?>" <?php echo($type->type_id ==
                    $observation->observation_type ? 'selected' : '') ?>>
                    <?php echo($type->type_name) ?>
                </option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-2">
            <label for="exampleInputPassword1">Location:</label>
            <input type="text" name="location" class="form-control" id="exampleInputPassword1" placeholder="Location"
                value="<?php echo $observation->location ?>" required>
        </div>
        <div class="form-group col-md-2">
            <label for="exampleInputPassword1">Description:</label>
            <textarea name="decsription" class="form-control"><?php echo $observation->description ?></textarea>
        </div>
        <div class="form-group col-md-6">
            <label for="exampleInputPassword1">Remark:</label>
            <input type="text" name="remark" class="form-control" id="exampleInputPassword1" placeholder="Remark"
                value="<?php echo $observation->remark ?>" required>
        </div>
        <div class="form-group col-md-2">
           <button type="button" class="btn btn-secondary mt-4" data-toggle="modal" data-target="#history_modal" onclick="getRemarkHistory('<?php echo $observation->observation_id ?>')">History</button>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Reference:</label>
            <input type="text" name="reference" class="form-control" id="exampleInputPassword1" placeholder="Remark"
                value="<?php echo $observation->reference ?>" required>
        </div>

        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Observation Severity:</label>
            <select name="severity_id" class="form-select" required <?php echo $readonly ?>>
                <option value="" selected>Select Severity</option>
                <?php foreach($observation_severity as $severity){ ?>
                <option value="<?php echo($severity->severity_id) ?>" <?php echo($severity->severity_id ==
                    $observation->observation_severity ? 'selected' : '') ?>>
                    <?php echo($severity->severity_name) ?>
                </option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Observation Status:</label>
            <select name="status" class="form-select" required>
                <option value="<?php echo $observation->status ?>" selected>
                    <?php echo get_opbservation_status($observation->status)['status'] ?>
                </option>
                <option value="0">Open</option>
                <option value="1">Im progress</option>
                <option value="2">Close</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Site Representative:</label>
            <select name="site_representative" id="site_representative_select" class="form-select" required <?php echo
                $readonly ?> >
                <option value="<?php echo $observation->site_representative ?>" selected class="text-danger">
                    <?php echo $observation->site_representative ?>
                </option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Attempt Date:</label>
            <input type="date" name="observation_date" class="form-control" id="exampleInputPassword1"
                value="<?php echo date('Y-m-d',strtotime($observation->observation_date)) ?>" required <?php echo
                $readonly ?>>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Target Date:</label>
            <input type="date" name="target_date" class="form-control" id="exampleInputPassword1"
                value="<?php echo date('Y-m-d', strtotime($observation->target_date)) ?>" required <?php echo $readonly
                ?>>
        </div>
        <div class="form-group col-md-12">
            <label for="exampleInputPassword1">Obvservation Image:</label>
            <input type="file" name="observation_image[]" class="form-control" id="exampleInputPassword1" multiple>
        </div>
        <?php if($user_type == '1') { ?>
        <div class="form-group col-md-12">
            <label for="exampleInputPassword1">Recommended Image:</label>
            <input type="file" name="recommended_image[]" class="form-control" id="exampleInputPassword1" multiple>
        </div>
        <?php } ?>
    </div>

    <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
    <input type="hidden" name="role_id" value="<?php echo $user_type ?>">
    <input type="hidden" name="allocated_to" value="<?php echo $observation->closed_by ?>">
    <?php if($observation->status != '2') { ?>
    <div class="card-footer">
        <button type="submit" class="btn btn-success"><?php echo($is_updated == '1' ? '<i class="fa fa-check" aria-hidden="true"></i>' : 'Update') ?></button>
        <?php echo form_close() ?>

        <?php if($user_type != $observation->closed_by) { ?>
            <span type="button" id="forward-button" class="btn btn-warning" id="aprroval_btn" onclick="sendForApproval('<?php echo $observation->observation_id ?>')">
                Forward
            </span>
        <?php } ?>

        <?php if($user_type != '3'){ ?>
            <button type="button" id="reject-button" class="btn btn-danger" id="aprroval_btn" onclick="rejectApproval('<?php echo $observation->observation_id ?>')">Reject</button>
        <?php } ?>

        <?php if($user_type == $observation->closed_by){ ?>
            <button type="button" class="btn btn-primary" id="aprroval_btn" onclick="closeObservation('<?php echo $observation->observation_id ?>')">Close</button>
        <?php } ?>

    </div>
    <?php }else{ ?>
        <div class="card-footer">
        <button type="button" class="btn btn-secondary disabled">Observation is closed</button>
        <?php echo form_close() ?>
    </div>
    <?php } ?>
</div>

</div>


<div class="card card-info">
    <div class="card-header d-flex justify-content-end">
        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Add More</button>
    </div>
    <div class="card-body">
        <h2 class="card-title col-md-12">Observation Images:</h3>
            <div class="row">
                <?php foreach($observation_image as $image) { ?>
                <div class="col-md-2 card m-1 p-1 h-20">
                    <img class="col-md-12" src="<?php echo base_url().$image->image_path ?>" height="150px" alt=""
                        srcset="">
                    <div class="card-footer">
                        <a href="<?php echo base_url().'index.php/delete-image/'.$image->image_id.'/'.$observation->observation_id ?>"
                            class="col-md-12 btn btn-sm btn-danger">Delete</a>
                    </div>
                </div>

                <?php } ?>

            </div>

            <h2 class="card-title col-md-12">Recommended Images</h3>
                <div class="row">
                    <?php foreach($recommendation_image as $image) { ?>
                    <div class="col-md-2 card m-1 p-1 h-20">
                        <img class="col-md-12" src="<?php echo base_url().$image->image_path?>" height="150px" alt=""
                            srcset="">
                        <div class="card-footer">
                            <a href="<?php echo base_url().'index.php/delete-image/'.$image->image_id.'/'.$observation->observation_id ?>"
                                class="col-md-12 btn btn-sm btn-danger">Delete</a>
                        </div>
                    </div>
                    <?php } ?>

                </div>


    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Images</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo form_open_multipart('edit-view-observation/'.$observation->observation_id) ?>
                    <div class="form-group col-md-12">
                        <label for="exampleInputPassword1">Obvservation Image:</label>
                        <input type="file" name="observation_image[]" class="form-control" id="exampleInputPassword1"
                            multiple>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputPassword1">Recommended Image:</label>
                        <input type="file" name="recommended_image[]" class="form-control" id="exampleInputPassword1"
                            multiple>
                    </div>
                    <button type="submit" class="btn btn-sm btn-success col-md-4">Save</button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>



<!--History Modal -->
<div class="modal fade" id="history_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Remark History</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="history-modal">
                        
      </div>

    </div>
  </div>
</div>
<script src="<?php echo base_url() ?>public/admin/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>public/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>


    $("#developer_select").change(function () {
        var developer_id = $(this).val();
        $('#structure_select').empty();
        $('#structure_select').append(`<option value="" selected>Select project first</option>`)

        $.ajax({
            url: "<?php echo base_url().'index.php/projects/get_projects_by_dev_id';?>",
            type: "post",
            data: { 'developer_id': developer_id },
            success: function (obj) {
                var projects = $.parseJSON(obj);
                $('.project_select').empty();
                $('.project_select').append(`<option value="" selected>Select Project</option>`)
                $.each(projects, function (key, val) {
                    // console.log(val.project_name);
                    $('.project_select').append(`<option value="${val.project_id}">${val.project_name}</option>`)
                })
            }
        })

    });

    $("#project_select").change(function () {
        var project_id = $(this).val();
        $.ajax({
            url: "<?php echo base_url().'index.php/projects/get_structures_by_project_id';?>",
            type: "post",
            data: { 'project_id': project_id },
            success: function (obj) {
                var structures = $.parseJSON(obj);
                $('#structure_select').empty();
                $('#structure_select').append(`<option value="" selected>Select Structure</option>`)
                $.each(structures, function (key, val) {
                    $('#structure_select').append(`<option value="${val.structure_id}">${val.structure_name}</option>`)
                })
            }
        })
        $.ajax({
            url: "<?php echo base_url().'index.php/projects/get_mr_name_by_project_id';?>",
            type: "post",
            data: { 'project_id': project_id },
            success: function (obj) {
                var projects = $.parseJSON(obj);
                console.log(projects)
                $('#site_representative_select').empty();
                $.each(projects, function (key, val) {
                    $('#site_representative_select').append(`<option value="${val.mr_name}">${val.mr_name}</option>`)
                })
            }
        })

    });

    $("#structure_select").change(function () {
        var structure_id = $(this).val();
        $.ajax({
            url: "<?php echo base_url().'index.php/projects/get_stages_by_structure_id';?>",
            type: "post",
            data: { 'structure_id': structure_id },
            success: function (obj) {
                var stages = $.parseJSON(obj);
                $('#stage_select').empty();
                $('#stage_select').append(`<option value="">Select Stages</option>`)
                $.each(stages, function (key, val) {
                    $('#stage_select').append(`<option value="${val.stage_id}">${val.stage_name}</option>`)
                })
            }
        })

    });

    $("#tradegroup_select").change(function () {
        var tradegroup_id = $(this).val();
        $.ajax({
            url: "<?php echo base_url().'index.php/trade/get_trade_by_tradegroup';?>",
            type: "post",
            data: { 'tradegroup_id': tradegroup_id },
            success: function (obj) {
                var trades = $.parseJSON(obj);
                $('#activity_select').empty();
                $.each(trades, function (key, val) {
                    $('#activity_select').append(`<option value="${val.trade_id}">${val.trade_name}</option>`)
                })
            }
        })

    });



    function sendForApproval(id) {
        console.log(id)
        
        $('#forward-button').html(`
                    <div class="spinner-border spinner-border-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                    </div>`)
        $.ajax({
            url: "<?php echo base_url().'index.php/observations/send_for_approval';?>",
            type: "post",
            data: { 'observation_id': id},
            success: function (obj) {
                setTimeout(()=>{
                    $('#forward-button').html(`
                    <i class="fa fa-check" aria-hidden="true"></i>`)
                }, 2000)
            }
        })
       
    }

    function rejectApproval(id)
    {
        console.log(id)
        $('#reject-button').html(`
                    <div class="spinner-border spinner-border-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                    </div>`)
        $.ajax({
            url: "<?php echo base_url().'index.php/observations/reject_approval';?>",
            type: "post",
            data: { 'observation_id': id},
            success: function (obj) {
                setTimeout(()=>{
                    $('#reject-button').html(`
                    <i class="fa fa-check" aria-hidden="true"></i>`)
                }, 2000)
            }
        })
    }

    function closeObservation(id){
        console.log(id)
        $.ajax({
            url: "<?php echo base_url().'index.php/observations/close_observation';?>",
            type: "post",
            data: { 'observation_id': id},
            success: function (obj) {
            console.log(obj)
            }
        })
    }

    function getRemarkHistory(id){
        $.ajax({
            url: "<?php echo base_url().'index.php/observations/get_remark_history';?>",
            type: "post",
            data: { 'observation_id': id},
            success: function (obj) {
                // var history = $.parseJSON(obj);
                // console.log(history)
                $('#history-modal').empty()
                $('#history-modal').html(obj)

                // $.each(history, function (key, val) {
                //     let card = `
                //         <div class="card card-primary">
                //             <div class="card-header">
                //                 <h3 class="card-title">${val.userName}</h3><sub class="mx-1">${val.role}</sub>
                //                 <span class="card-tools">${val.created_date}</span>
                //             </div>
                //             <div class="card-body">
                //             <h3 class="card-title">${val.comment}</h3>
                //             </div>
                //         </div>

                //     `
                //     $('#history-modal').append(card)
                // })

                
    
            }
        })
    }

</script>