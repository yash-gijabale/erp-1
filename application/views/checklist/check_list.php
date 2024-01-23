<style>
    .kamban-card-body{
        height: 400px;
        overflow-y: auto;
        overflow-x: hidden;
    }
</style>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><a href="<?php echo base_url('index.php/checklist-master') ?>"><i class="fa fa-chevron-left" aria-hidden="true"></i></a> Check List</h3>
    </div>
    <div class="card-body row">

        <?php 
          $attributes = array('id' => 'checklist_form');
         echo form_open('check-list/'.$checklist_id, $attributes) ?>
        <div class="check-list-form row">
                <!-- <div class="form-group col-md-3">
                    <label for="exampleInputEmail1">Select Trade group:</label>
                    <select name="trade_group" id="tradegroup_select" class="form-select" required  >
                        <option value="<?php echo($pre_data['trade_group'] ? $pre_data['trade_group'] : '') ?>" selected><?php echo($pre_data['trade_group'] ? get_tradegroup_by_id($pre_data['trade_group']) : 'Select Trade group') ?></option>
                        <?php foreach($tradegroup as $group){ ?>
                            <option value="<?php echo($group->tradegroup_id)?>"><?php echo($group->tradegroup_name) ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="exampleInputEmail1">Select Trade:</label>
                    <select name="trade_id" id="trade_select" class="form-select" required>
                            <option value="<?php echo($pre_data['trade_id'] ? $pre_data['trade_id'] : '') ?>" selected><?php echo($pre_data['trade_id'] ? get_trade_by_id($pre_data['trade_id']) : 'Select group first') ?></option>
                    </select>
                </div> -->
                <div class="form-group col-md-3">
                    <label for="exampleInputEmail1">Select Subgroup:</label>
                    <select name="subgroup_id" id="subgroup_select" class="form-select" required <?php echo $readonly ?> >
                    <option value="<?php echo($pre_data['subgroup_id'] ? $pre_data['subgroup_id'] : '') ?>" selected ><?php echo($pre_data['subgroup_id'] ? get_subgroup_by_id($pre_data['subgroup_id']) : 'Select Subgroup') ?></option>
                    <?php foreach($subgroups as $group){ ?>
                    <option value="<?php echo($group->subgroup_id) ?>"><?php echo(get_subgroup_by_id($group->subgroup_id)) ?></option>

                    <?php } ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-sm btn-success mt-4">Get list</button>
                </div>
            </div>
            <?php echo form_close() ?>

        <div class="wrapper kanban row mt-5">

            <section class="content pb-3 col-md-5">
                <div class="container-fluid">
                    <div class="card card-row card-primary p-0">
                        <div class="card-header">
                            <h3 class="card-title">
                                Questions
                            </h3>
                        </div>
                        <div class="card-body kamban-card-body" id="all_structure">
                            <?php 
                            $attributes = array('id' => 'check_question_form');
                            echo form_open('check-list/'.$checklist_id, $attributes);
                             ?>
                            <?php if($question_list){ 
                                foreach($question_list as $question){
                                ?>
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h5 class="card-title"><?php echo $question->question_title ?></h5>
                                        <div class="card-tools">
                                        <input class="form-check-input subunit_check" name="question_check[]" type="checkbox" value="<?php echo $question->question_id ?>" id="defaultCheck1">
                                        </div>
                                    </div>
                                </div>
                            <?php } } ?>
                                    <input type="hidden" name="question_form" value="1">
                                    <input type="hidden" name="trade_group" value="<?php echo $pre_data['trade_group']?>">
                                    <input type="hidden" name="trade_id" value="<?php echo $pre_data['trade_id']?>">
                                    <input type="hidden" name="subgroup_id" value="<?php echo $pre_data['subgroup_id']?>">
                            <?php echo form_close() ?>
                        </div>
                        <!-- <div class="card-footer">
                            <div class="row col-md-12 d-flex justify-content-around">
                                <button type="button" class="btn btn-outline-success btn-sm col-md-3 m-1"
                                    data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-plus"
                                        aria-hidden="true"></i></button>
                                <button type="button" class="btn btn-outline-primary btn-sm col-md-3 m-1"
                                    onclick="edit_strucutre()" data-toggle="modal" data-target="#edit_structure"><i
                                        class="fa fa-paint-brush" aria-hidden="true"></i></button>
                                <button type="button" class="btn btn-outline-danger btn-sm col-md-3 m-1"
                                    onclick="remove_structures()"><i class="fa fa-trash"
                                        aria-hidden="true"></i></button>
                            </div>
                        </div> -->
                    </div>
                </div>
            </section>

            <section class="col-md-1">
                <div class="row">
                    <button class="btn btn-sm btn-primary m-1" onclick="check_question_submit()"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
                    <button class="btn btn-sm btn-success m-1" onclick="uncheck_question_submit()"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
                </div>
            </section>

            <section class="content pb-3 col-md-5">
                <div class="container-fluid">
                    <div class="card card-row card-success p-0">
                        <div class="card-header">
                            <h3 class="card-title">
                                CheckList Questions
                            </h3>
                        </div>
                        <div class="card-body kamban-card-body" id="all_stages">
                        <?php 
                            $attributes = array('id' => 'uncheck_question_form');
                            echo form_open('check-list/'.$checklist_id, $attributes);
                             ?>
                            <?php if($checked_question_list){ 
                                foreach($checked_question_list as $question){
                                ?>
                                <div class="card card-success card-outline">
                                    <div class="card-header">
                                        <h5 class="card-title"><?php echo $question->question_title ?></h5>
                                        <div class="card-tools">
                                        <input class="form-check-input subunit_check" name="question_check[]" type="checkbox" value="<?php echo $question->question_id ?>" id="defaultCheck1">
                                        </div>
                                    </div>
                                </div>
                            <?php } } ?>
                                    <input type="hidden" name="uncheck_question_form" value="1">
                                    <input type="hidden" name="trade_group" value="<?php echo $pre_data['trade_group']?>">
                                    <input type="hidden" name="trade_id" value="<?php echo $pre_data['trade_id']?>">
                                    <input type="hidden" name="subgroup_id" value="<?php echo $pre_data['subgroup_id']?>">
                            <?php echo form_close() ?>
                        </div>
                        <!-- <div class="card-footer">
                            <div class="row col-md-12 d-flex justify-content-around">
                                <button type="button" class="btn btn-outline-success btn-sm col-md-3 m-1"
                                    data-toggle="modal" data-target="#add_stage"><i class="fa fa-plus"
                                        aria-hidden="true"></i></button>
                                <button type="button" class="btn btn-outline-primary btn-sm col-md-3 m-1"
                                    data-toggle="modal" data-target="#edit_stage" onclick="edit_stage()"
                                    data-toggle="modal" data-target="#edit_structure"><i class="fa fa-paint-brush"
                                        aria-hidden="true"></i></button>
                                <button type="button" class="btn btn-outline-danger btn-sm col-md-3 m-1"
                                    onclick="remove_stages()"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </div>
                        </div> -->
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-success">Update</button>
    </div>
</div>



<script src="<?php echo base_url() ?>public/admin/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>public/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>


    // $("#tradegroup_select").change(function(){   
    //     var tradegroup = $(this).val();
    //     // $('#structure_select').empty();
    //     // $('#structure_select').append(`<option value="" selected>Select project first</option>`)

    //     $.ajax({
    //         url: "<?php echo base_url().'index.php/trade/get_trade_by_tradegroup';?>",
    //         type: "post",
    //         data: { 'tradegroup_id': tradegroup },
    //         success: function (obj) {
    //             var trades = $.parseJSON(obj);
    //             // console.log(tradegroup)
    //             $('#trade_select').empty();
    //             $('#trade_select').append(`<option value="" selected>Select Trade</option>`)
    //             $.each(trades, function(key, val){
    //                 // console.log(val.project_name);
    //                 $('#trade_select').append(`<option value="${val.trade_id}">${val.trade_name}</option>`)
    //             })
    //         }
    //     })
    
    // });

    // $("#trade_select").change(function(){   
    //     var tradeid = $(this).val();
    //     $.ajax({
    //         url: "<?php echo base_url().'index.php/trade/get_subgruop_by_trade';?>",
    //         type: "post",
    //         data: { 'trade_id': tradeid },
    //         success: function (obj) {
    //             var subgroups = $.parseJSON(obj);
    //             $('#subgroup_select').empty();
    //             $('#subgroup_select').append(`<option value="" selected>Select Trade</option>`)
    //             $.each(subgroups, function(key, val){
    //                 $('#subgroup_select').append(`<option value="${val.subgroup_id}">${val.subgroup_name}</option>`)
    //             })
    //         }
    //     })
    
    // });


    function check_question_submit(){
        $('#check_question_form').submit();
        // $('#checklist_form').submit();
    }

    function uncheck_question_submit(){
        $('#uncheck_question_form').submit();

    }
</script>