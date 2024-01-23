<style>
    .kamban-card-body {
        height: 400px;
        overflow-y: auto;
        overflow-x: hidden;
    }
    .role-kamban-card-body{
        height: 200px;
        overflow-y: auto;
        overflow-x: hidden;
    }
</style>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add Developer</h3>
    </div>

    <?php echo form_open('wbs-allocation') ?>
    <div class="card-body row">
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Select Developer:</label>
            <select name="developer_id" id="developer" class="form-select" required>
                <option value="" selected>Select Developer</option>
                <?php foreach($all_developers as $developer){ ?>
                <option value="<?php echo($developer->developer_id) ?>">
                    <?php echo($developer->developer_name) ?>
                </option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Select Project:</label>
            <select name="project_id" id="project_id" class="form-select project_select" required>
                <option value="" selected class="text-danger">Select Developer First</option>

            </select>
        </div>


    </div>

    <!-- <?php echo form_close() ?> -->


    <div class="wrapper kanban row">

        <section class="content pb-3 col-md-3">
            <div class="container-fluid">
                <div class="card card-row card-primary p-0">
                    <div class="card-header">
                        <h3 class="card-title">
                            Structures
                        </h3>
                    </div>
                    <div class="card-body kamban-card-body" id="all_structure">

                    </div>
                    <div class="card-footer">
                        <div class="row col-md-12 d-flex justify-content-around">
                            <button type="button" class="btn btn-outline-success btn-sm col-md-3 m-1"
                                data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-plus"
                                    aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-outline-primary btn-sm col-md-3 m-1"
                                onclick="getStrucutreData()" data-toggle="modal" data-target="#edit_structure"><i
                                    class="fa fa-paint-brush" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-outline-danger btn-sm col-md-3 m-1"
                                onclick="remove_structures()"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="content pb-3 col-md-3">
            <div class="container-fluid">
                <div class="card card-row card-success p-0">
                    <div class="card-header">
                        <h3 class="card-title">
                            Stages
                        </h3>
                    </div>
                    <div class="card-body kamban-card-body" id="all_stages">

                    </div>
                    <div class="card-footer">
                        <div class="row col-md-12 d-flex justify-content-around">
                            <button type="button" class="btn btn-outline-success btn-sm col-md-3 m-1"
                                data-toggle="modal" data-target="#add_stage"><i class="fa fa-plus"
                                    aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-outline-primary btn-sm col-md-3 m-1"
                                data-toggle="modal" data-target="#edit_stage" onclick="getStageData()"
                                data-toggle="modal" data-target="#edit_structure"><i class="fa fa-paint-brush"
                                    aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-outline-danger btn-sm col-md-3 m-1"
                                onclick="remove_stages()"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="content pb-3 col-md-3">
            <div class="container-fluid">
                <div class="card card-row card-info p-0">
                    <div class="card-header">
                        <h3 class="card-title">
                            Units
                        </h3>
                    </div>
                    <div class="card-body kamban-card-body" id="all_units">

                    </div>
                    <div class="card-footer">
                        <div class="row col-md-12 d-flex justify-content-around">
                            <button type="button" class="btn btn-outline-success btn-sm col-md-3 m-1"
                                data-toggle="modal" data-target="#add_unit"><i class="fa fa-plus"
                                    aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-outline-primary btn-sm col-md-3 m-1"
                                onclick="editUnitData()" data-toggle="modal" data-target="#edit_unit"><i
                                    class="fa fa-paint-brush" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-outline-danger btn-sm col-md-3 m-1"
                                onclick="remove_units()"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="content pb-3 col-md-3">
            <div class="container-fluid">
                <div class="card card-row card-secondary p-0">
                    <div class="card-header">
                        <h3 class="card-title">
                            Subunits
                        </h3>
                    </div>
                    <div class="card-body kamban-card-body" id="all_subunits">

                    </div>
                    <div class="card-footer">
                        <div class="row col-md-12 d-flex justify-content-around">
                            <button type="button" class="btn btn-outline-success btn-sm col-md-3 m-1"
                                data-toggle="modal" data-target="#add_subunit"><i class="fa fa-plus"
                                    aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-outline-primary btn-sm col-md-3 m-1"
                                onclick="edit_subunit()" data-toggle="modal" data-target="#edit_subunit"><i
                                    class="fa fa-paint-brush" aria-hidden="true"></i></button>
                            <button type="button" class="btn btn-outline-danger btn-sm col-md-3 m-1"
                                onclick="remove_subunits()"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="row m-2">
        <label class="bg-warning">WBS user allocation:</label>
        <div class="row">
            <div class="form-group col-md-4">
                <label for="exampleInputEmail1">Select TradeGroup:</label>
                <select name="tradegroup_id" id="tradegroup_id" class="form-select" required>
                <option value="" selected class="text-danger">Select trade group</option>

                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="exampleInputEmail1">Select Trade:</label>
                <select name="trade_id" id="trade_id" class="form-select" required>
                    <option value="" selected class="text-danger">Select trade</option>

                </select>
            </div>
        </div>
        <div class="row">
            <section class="content pb-3 col-md-3">
                <div class="container-fluid">
                    <div class="card card-row card-info p-0">
                        <div class="card-header">
                            <h3 class="card-title">
                                Site Enginners
                            </h3>
                        </div>
                        <div class="card-body role-kamban-card-body" id="site-enginner-list">

                        </div>
                    </div>
                </div>
            </section>
            <section class="content pb-3 col-md-3">
                <div class="container-fluid">
                    <div class="card card-row card-info p-0">
                        <div class="card-header">
                            <h3 class="card-title">
                                Responsible
                            </h3>
                        </div>
                        <div class="card-body role-kamban-card-body" id="responsible-list">

                        </div>
                    </div>
                </div>
            </section>
            <section class="content pb-3 col-md-3">
                <div class="container-fluid">
                    <div class="card card-row card-info p-0">
                        <div class="card-header">
                            <h3 class="card-title">
                                Reviewers
                            </h3>
                        </div>
                        <div class="card-body role-kamban-card-body" id="reviewer-list">

                        </div>
                    </div>
                </div>
            </section>
            <section class="content pb-3 col-md-3">
                <div class="container-fluid">
                    <div class="card card-row card-info p-0">
                        <div class="card-header">
                            <h3 class="card-title">
                                Approvals
                            </h3>
                        </div>
                        <div class="card-body role-kamban-card-body" id="approval-list">

                        </div>
                    </div>
                </div>
            </section>
        </div>

        <button type="submit" class="btn btn-sm btn-success col-md-2 mb-4">Save</button>
    </div>
</div>
    <?php echo form_close() ?>



<!-- Add Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add new structure</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php 
                $attributes = array('id' => 'add-structure');
                //echo form_open('#') ?>
                <!-- <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Select Project:</label>
                    <select name="project_id" class="form-select project_select" required>
                        <option value="" selected>Select Project</option>
                    
                    </select>
                </div> -->
                <div class="form-group col-md-12">
                    <span id="success-msg" class="text-success"></span>
                </div>
                <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Structure Name:</label>
                    <input type="text" name="structure_name" id="add-structure-name" class="form-control"
                        placeholder="Strucute">
                </div>
                <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Structure Area:</label>
                    <input type="text" name="structure_area" id="add-structure-area" class="form-control"
                        placeholder="Eg. 50,000 sq.">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onClick="addStructure()">Save</button>
                </div>

                <input type="hidden" name="project_id" value="" class="project-id-hidden">
                <?php //echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<!-- /Add Modal -->

<!-- Edit Modal -->
<div class="modal fade" id="edit_structure" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit structure</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php //echo form_open('edit-structure') ?>
                <div class="form-group col-md-12">
                    <span class="success-msg" class="text-success"></span>
                </div>
                <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Structure Name:</label>
                    <input type="text" name="structure_name" id="structure_name" class="form-control"
                        placeholder="Strucute">
                </div>
                <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Structure Area:</label>
                    <input type="text" name="structure_area" id="structure_area" class="form-control"
                        placeholder="Eg. 50,000 sq.">
                </div>
                <input type="hidden" name="project_id" value="" class="project-id-hidden">
                <input type="hidden" name="structure_id" class="structure_id" value="">

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="editStructure()">Save</button>
                </div>
                <?php // echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<!-- /edit Modal -->

<!-- add stage modal -->
<div class="modal fade" id="add_stage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add new stage</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php //echo form_open('add-stage') ?>
                <div class="form-group col-md-12">
                    <span class="success-msg" class="text-success"></span>
                </div>
                <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Stage Name:</label>
                    <input type="text" name="stage_name" class="form-control" id="add-stage" placeholder="Stage">
                </div>

                <input type="hidden" name="structure_id" value="" class="structure_id">

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="addStage()">Save</button>
                </div>

                <?php //echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<!-- /add stage modal -->
<!-- Edit stage Modal -->
<div class="modal fade" id="edit_stage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Stage</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php //echo form_open('edit-stage') ?>
                <div class="form-group col-md-12">
                    <span class="success-msg" class="text-success"></span>
                </div>
                <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Stage Name:</label>
                    <input type="text" name="stage_name" id="stage_name" class="form-control" id="exampleInputEmail1"
                        placeholder="Stage">
                </div>

                <input type="hidden" name="stage_id" value="" class="stage_id">

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="editStage()">Save</button>
                </div>

                <?php //echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<!-- /edit stage Modal -->

<!-- add unit modal -->
<div class="modal fade" id="add_unit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add new Flat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php //echo form_open('add-unit') ?>
                <div class="form-group col-md-12">
                    <span class="success-msg" class="text-success"></span>
                </div>
                <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Flat No.:</label>
                    <input type="text" name="unit_code" class="form-control" id="unit_number" placeholder="Flat no">
                </div>
                <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Unit Area.:</label>
                    <input type="text" name="unit_area" class="form-control" id="unit_area" placeholder="Area">
                </div>
                <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Unit Type.:</label>
                    <select name="unit_type" class="form-select" id="unit_type" required>
                        <option value="" selected class="text-danger">Select Unit type</option>
                        <option value="1">1Rk</option>
                        <option value="2">1BHK</option>
                        <option value="3">2BHK</option>
                        <option value="4">3BHK</option>
                    </select>
                </div>

                <input type="hidden" name="stage_id" value="" class="stage_id">

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="addUnit()">Save</button>
                </div>

                <?php //echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<!-- /add Unit modal -->
<!-- Edit stage Modal -->
<div class="modal fade" id="edit_unit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Unit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php //echo form_open('edit-unit') ?>
                <div class="form-group col-md-12">
                    <span class="success-msg" class="text-success"></span>
                </div>
                <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Flat No.:</label>
                    <input type="text" name="unit_code" id="unit_code" class="form-control" placeholder="Flat no">
                </div>
                <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Unit Area.:</label>
                    <input type="text" name="unit_area" id="edit_unit_area" class="form-control" placeholder="Area">
                </div>
                <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Unit Type.:</label>
                    <select name="unit_type" id="edit_unit_type" class="form-select" required>
                        <option value="1">1Rk</option>
                        <option value="2">1BHK</option>
                        <option value="3">2BHK</option>
                        <option value="4">3BHK</option>
                    </select>
                </div>

                <input type="hidden" name="unit_id" value="" class="unit_id">

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="editUnit()">Save</button>
                </div>

                <?php //echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<!-- /edit steg Modal -->

<!-- add subunit modal -->
<div class="modal fade" id="add_subunit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add new Subunit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open('add-subunit') ?>
                <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Enter Name:</label>
                    <input type="text" name="subunit_name" id="stage_name" class="form-control" id="exampleInputEmail1"
                        placeholder="Flat no">
                </div>

                <input type="hidden" name="unit_id" value="" class="unit_id">

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<!-- /add subUnit modal -->
<!-- Edit stage Modal -->
<div class="modal fade" id="edit_subunit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit subunit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open('edit-subunit') ?>
                <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Subunit Name:</label>
                    <input type="text" name="subunit_name" id="subunit_name" class="form-control"
                        id="exampleInputEmail1" placeholder="Stage">
                </div>

                <input type="hidden" name="subunit_id" value="" class="subunit_id">

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

                <?php echo form_close() ?>
            </div>
        </div>
    </div>

</div>
<!-- /edit steg Modal -->


<!-- WBS USER ALLOCATION -->
<!-- /WBS USER ALLOCATION -->

<script src="<?php echo base_url() ?>public/admin/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>public/admin/plugins/jquery-ui/jquery-ui.min.js"></script>

<script>
    $("#developer").change(function () {
        var developer_id = $(this).val();
        $('#all_structure').empty();

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

    function getAllStructures(projectId) {
        $.ajax({
            url: "<?php echo base_url().'index.php/projects/get_structures_by_project_id';?>",
            type: "post",
            data: { 'project_id': projectId },
            success: function (obj) {
                var structures = $.parseJSON(obj);
                $('#all_structure').empty();
                $.each(structures, function (key, val) {
                    // console.log(val.project_name);
                    $('#all_structure').append(`
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="card-title">${val.structure_name}</h5>
                            <div class="card-tools">
                            <input class="form-check-input structure_check" name="structure_ckeck" onclick="get_structure_Value()" type="checkbox" value="${val.structure_id}" id="defaultCheck1">
                            </div>
                        </div>
                    </div>
                    `)
                })
            }
        })
    }

    $("#project_id").change(function () {
        var project_id = $(this).val();
        $('.project-id-hidden').val(project_id)
        $('#all_structure').html(`
                <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
                </div>
        `)

        getAllStructures(project_id)

    });


    function addStructure() {
        var structureName = $('#add-structure-name').val()
        var structureArea = $('#add-structure-area').val()
        var projectId = $('.project-id-hidden').val()
        $.ajax({
            url: "<?php echo base_url().'index.php/projects/add_structure';?>",
            type: "post",
            data: { 'structure_name': structureName, 'structure_area': structureArea, 'project_id': projectId },
            success: function (obj) {
                var structures = $.parseJSON(obj);
                console.log(structures)
                getAllStructures(structures.project_id)
                // $('#exampleModalCenter').modal('toggle')
                $('#add-structure-name').val('')
                $('#add-structure-area').val('')
                $('#success-msg').html(`<span>Structure Added!</span>`)
                setTimeout(() => {
                    $('#success-msg').empty()

                }, 2000);
            }
        })
        console.log(structureName, structureArea)
    }


    function getStrucutreData() {
        $('input:checkbox[name=structure_ckeck]:checked').each(function () {
            structure_id = $(this).val();
            $('.structure_id').val(structure_id);
            $.ajax({
                url: "<?php echo base_url().'index.php/projects/get_structures_by_structure_id';?>",
                type: "post",
                data: { 'structure_id': structure_id },
                success: function (obj) {
                    var structure = $.parseJSON(obj);
                    // console.log(structures);
                    // getAllStructures(structures.project_id)
                    $('#structure_name').val(structure.structure_name)
                    $('#structure_area').val(structure.structure_area)
                }
            })
        });
    }

    function editStructure() {
        var projectId = $('.project-id-hidden').val()
        var structureId = $('.structure_id').val();
        var structureName = $('#structure_name').val();
        var structureArea = $('#structure_area').val();
        console.log(structureArea, structureId, structureName)
        $.ajax({
            url: "<?php echo base_url().'index.php/projects/edit_structure';?>",
            type: "post",
            data: { 'structure_id': structureId, 'structure_name': structureName, 'structure_area': structureArea },
            success: function (obj) {
                var structure = $.parseJSON(obj);
                // console.log(structures);
                getAllStructures(projectId)
                $('#structure_name').val(structure.structure_name)
                $('#structure_area').val(structure.structure_area)
                $('.success-msg').html(`<span class="text-success">Structure Edited!</span>`)
                setTimeout(() => {
                    $('.success-msg').empty()
                }, 2000);
            }
        })
    }


    //--------------------------------------FUNCTION FOR STAGES/FLOOR----------------------------------------

    function getAllFoorsByStructure(structureId) {
        $.ajax({
            url: "<?php echo base_url().'index.php/projects/get_stages_by_structure_id';?>",
            type: "post",
            data: { 'structure_id': structureId },
            success: function (obj) {
                var stages = $.parseJSON(obj);
                $('#all_stages').empty();
                $.each(stages, function (key, val) {
                    // console.log(val.project_name);
                    $('#all_stages').append(`
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h5 class="card-title">${val.stage_name}</h5>
                            <div class="card-tools">
                            <input class="form-check-input stage_check" name="stage_ckeck" onclick="get_stage_Value()" type="checkbox" value="${val.stage_id}" id="defaultCheck1">
                            </div>
                        </div>
                    </div>
                    `)
                })
            }

        });
    }
    function get_structure_Value() {
        $('input:checkbox[name=structure_ckeck]:checked').each(function () {
            // $('.project-id-hidden').val(project_id)
            structure_id = $(this).val();
            $('.structure_id').val(structure_id);
            getAllFoorsByStructure(structure_id);

        })
    }

    function addStage() {
        var stageName = $('#add-stage').val()
        var structureId = $('.structure_id').val()
        $.ajax({
            url: "<?php echo base_url().'index.php/projects/add_stage';?>",
            type: "post",
            data: { 'stage_name': stageName, 'structure_id': structureId },
            success: function (obj) {
                var stage = $.parseJSON(obj);
                // console.log(structures)
                getAllFoorsByStructure(structureId)
                // $('#exampleModalCenter').modal('toggle')
                $('#add-stage').val('')
                $('.success-msg').html(`<span class='text-success'>Stage Added!</span>`)
                setTimeout(() => {
                    $('.success-msg').empty()

                }, 2000);
            }
        })
        console.log(structureName, structureArea)
    }


    function getStageData() {
        console.log('click')
        $('input:checkbox[name=stage_ckeck]:checked').each(function () {
            stage_id = $(this).val();
            $('.stage_id').val(stage_id);
            // console.log(stage_id)
            $.ajax({
                url: "<?php echo base_url().'index.php/projects/get_stage_by_stage_id';?>",
                type: "post",
                data: { 'stage_id': stage_id },
                success: function (obj) {
                    var stage = $.parseJSON(obj);
                    // console.log(stage);
                    $('#stage_name').val(stage.stage_name)
                }
            })
        });
    }

    function editStage() {
        var stageId = $('.stage_id').val();
        var stageName = $('#stage_name').val();
        var structureId = $('.structure_id').val()

        console.log(stageId, stageName)
        $.ajax({
            url: "<?php echo base_url().'index.php/projects/edit_stage';?>",
            type: "post",
            data: { 'stage_id': stage_id, 'stage_name': stageName },
            success: function (obj) {
                var stage = $.parseJSON(obj);
                // console.log(stage);
                getAllFoorsByStructure(structureId)
                $('#stage_name').val(stage.stage_name)
                $('.success-msg').html(`<span class="text-success">Stage Edited!</span>`)
                setTimeout(() => {
                    $('.success-msg').empty()
                }, 2000);
            }
        })
    }
    //-----------------------------/FUNCTION FOR STAGES---------------------------------------------



    //-----------------------------FUNCTION FOR UNIT OPERATIONS------------------------------------

    function getAllUnitsByStage(stageId) {
        var stageId = $('.stage_id').val();

        $.ajax({
            url: "<?php echo base_url().'index.php/projects/get_units_by_stage_id';?>",
            type: "post",
            data: { 'stage_id': stageId },
            success: function (obj) {
                var units = $.parseJSON(obj);
                $('#all_units').empty();
                $.each(units, function (key, val) {
                    // console.log(val.project_name);
                    $('#all_units').append(`
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <h5 class="card-title">${val.unit_code}</h5>
                            <div class="card-tools">
                            <input class="form-check-input unit_check" name="unit_ckeck" onclick="get_unit_Value()" type="checkbox" value="${val.unit_id}" id="defaultCheck1">
                            </div>
                        </div>
                    </div>
                    `)
                })
            }

        });
    }
    function get_stage_Value() {
        $('input:checkbox[name=stage_ckeck]:checked').each(function () {
            // $('.project-id-hidden').val(project_id)
            stage_id = $(this).val();
            $('.stage_id').val(stage_id);

            getAllUnitsByStage(stage_id);
        })
    }

    function addUnit() {
        var unitNumber = $('#unit_number').val()
        var unitArea = $('#unit_area').val()
        var unitType = $('#unit_type').val()
        var stageId = $('.stage_id').val()
        console.log(unitNumber, unitArea, unitType, stageId);
        $.ajax({
            url: "<?php echo base_url().'index.php/projects/add_unit';?>",
            type: "post",
            data: { 'stage_id': stage_id, 'unit_number': unitNumber, 'unit_area': unitArea, 'unit_type': unitType },
            success: function (obj) {
                var stage = $.parseJSON(obj);
                // console.log(stage);
                getAllUnitsByStage(stageId)
                $('#unit_number').val('')
                $('#unit_type').val('')
                $('#unit_area').val('')
                $('.success-msg').html(`<span class="text-success">Unit Added!</span>`)
                setTimeout(() => {
                    $('.success-msg').empty()
                }, 2000);
            }
        })
    }


    function editUnitData() {
        $('input:checkbox[name=unit_ckeck]:checked').each(function () {
            unit_id = $(this).val();
            $('.unit_id').val(unit_id);
            // console.log(unit_id)
            $.ajax({
                url: "<?php echo base_url().'index.php/projects/get_unit_by_unit_id';?>",
                type: "post",
                data: { 'unit_id': unit_id },
                success: function (obj) {
                    var unitres = $.parseJSON(obj);
                    console.log(unitres);
                    $('#unit_code').val(unitres.unit_code)
                    $('#edit_unit_area').val(unitres.unit_area)
                    $(`#edit_unit_type option[value=${unitres.unit_type}]`).attr('selected', 'selected');
                }
            })
        });
    }

    function editUnit() {
        var unitNumber = $('#unit_code').val()
        var unitArea = $('#edit_unit_area').val()
        var unitType = $('#edit_unit_type').val()
        var unitId = $('.unit_id').val()
        var stageId = $('.stage_id').val()
        console.log(unitNumber, unitArea, unitType, unit_id);
        $.ajax({
            url: "<?php echo base_url().'index.php/projects/edit_unit';?>",
            type: "post",
            data: { 'unit_id': unitId, 'unit_number': unitNumber, 'unit_area': unitArea, 'unit_type': unitType },
            success: function (obj) {
                var unit = $.parseJSON(obj);
                getAllUnitsByStage(stageId)
                $('.success-msg').html(`<span class="text-success">Unit Edited!</span>`)
                setTimeout(() => {
                    $('.success-msg').empty()
                }, 2000);
            }
        })

    }




    function get_unit_Value() {
        $('input:checkbox[name=unit_ckeck]:checked').each(function () {
            // $('.project-id-hidden').val(project_id)
            unit_value = $(this).val();
            $('.unit_id').val(unit_value);
            $.ajax({
                url: "<?php echo base_url().'index.php/projects/get_subunit_by_unit_id';?>",
                type: "post",
                data: { 'unit_id': unit_value },
                success: function (obj) {
                    var subunits = $.parseJSON(obj);
                    // var units = obj;
                    // console.log(units);
                    // $('#structure_name').val(structure.structure_name)
                    // $('#structure_area').val(structure.structure_area)
                    $('#all_subunits').empty();
                    $.each(subunits, function (key, val) {
                        // console.log(val.project_name);
                        $('#all_subunits').append(`
                    <div class="card card-secondary card-outline">
                        <div class="card-header">
                            <h5 class="card-title">${val.subunit_name}</h5>
                            <div class="card-tools">
                            <input class="form-check-input subunit_check" name="subunit_ckeck" type="checkbox" value="${val.subunit_id}" id="defaultCheck1">
                            </div>
                        </div>
                    </div>
                    `)
                    })
                }

            });
        })
    }


    function edit_subunit() {
        $('input:checkbox[name=unit_ckeck]:checked').each(function () {
            subunit_id = $(this).val();
            $('.subunit_id').val(subunit_id);
            // console.log(unit_id)
            $.ajax({
                url: "<?php echo base_url().'index.php/projects/get_subunit_by_subunit_id';?>",
                type: "post",
                data: { 'subunit_id': subunit_id },
                success: function (obj) {
                    var subunit = $.parseJSON(obj);
                    $('#subunit_name').val(subunit.subunit_name)
                    // $('#unit_area').val(unit.unit_area)
                    // $(`#unit_type option[value=${unit.unit_type}]`).attr('selected','selected');
                }
            })
        });
    }
    function remove_structures() {
        var structures_id = {}
        $('input:checkbox[name=structure_ckeck]:checked').each(function (i) {
            structures_id[i] = $(this).val();
        })
        var structures = JSON.stringify(structures_id);
        // console.log(stages);
        $.ajax({
            url: "<?php echo base_url().'index.php/projects/remove_structure';?>",
            type: "post",
            data: { 'structures': structures },
            success: function (obj) {
                console.log(obj);
                location.reload();
                // $('#subunit_name').val(subunit.subunit_name)
                // $('#unit_area').val(unit.unit_area)
                // $(`#unit_type option[value=${unit.unit_type}]`).attr('selected','selected');
            }
        })
    }

    function remove_stages() {
        var stages_id = {}
        $('input:checkbox[name=stage_ckeck]:checked').each(function (i) {
            stages_id[i] = $(this).val();
        })
        var stages = JSON.stringify(stages_id);
        console.log(stages);
        $.ajax({
            url: "<?php echo base_url().'index.php/projects/remove_stages';?>",
            type: "post",
            data: { 'stages': stages },
            success: function (obj) {
                console.log(obj);
                location.reload();
                // $('#subunit_name').val(subunit.subunit_name)
                // $('#unit_area').val(unit.unit_area)
                // $(`#unit_type option[value=${unit.unit_type}]`).attr('selected','selected');
            }
        })
    }

    function remove_units() {
        var units_id = {}
        $('input:checkbox[name=unit_ckeck]:checked').each(function (i) {
            units_id[i] = $(this).val();
        })
        var units = JSON.stringify(units_id);
        console.log(units);
        $.ajax({
            url: "<?php echo base_url().'index.php/projects/remove_units';?>",
            type: "post",
            data: { 'units': units },
            success: function (obj) {
                console.log(obj);
                // $('#subunit_name').val(subunit.subunit_name)
                // $('#unit_area').val(unit.unit_area)
                // $(`#unit_type option[value=${unit.unit_type}]`).attr('selected','selected');
            }
        })
    }
    function remove_subunits() {
        var subunits_id = {}
        $('input:checkbox[name=subunit_ckeck]:checked').each(function (i) {
            subunits_id[i] = $(this).val();
        })
        var subunits = JSON.stringify(subunits_id);
        console.log(subunits);
        $.ajax({
            url: "<?php echo base_url().'index.php/projects/remove_subunits';?>",
            type: "post",
            data: { 'subunits': subunits },
            success: function (obj) {
                console.log(obj);
                // $('#subunit_name').val(subunit.subunit_name)
                // $('#unit_area').val(unit.unit_area)
                // $(`#unit_type option[value=${unit.unit_type}]`).attr('selected','selected');
            }
        })
    }


    $("#project_id").change(function () {
        var project_id = $(this).val();
        $.ajax({
            url: "<?php echo base_url().'index.php/projects/getAllocatedUserByProject';?>",
            type: "post",
            data: { 'project_id': project_id },
            success: function (obj) {
                userlist = JSON.parse(obj)
                console.log(userlist)
                $('#site-enginner-list').empty()
                $('#responsible-list').empty()
                $('#reviewer-list').empty()
                $('#approval-list').empty()
                $('#tradegroup_id').empty()
                $('#trade_id').empty()

                var siteEnginners = userlist.SiteEngineer;
                var responsibles = userlist.Responsible;
                var reviewers = userlist.Reviewer;
                var approvals = userlist.Approvar;
                var tradegroups = userlist.tradeGroups;
                $.each(siteEnginners, function(key, val){
                    $('#site-enginner-list').append(`
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="userlist[]" value="${val.user_id}" id="flexCheckChecked">
                    <label class="form-check-label" for="flexCheckChecked">
                        ${val.first_name} ${val.last_name}
                    </label>
                    </div>`)
                })

                $.each(responsibles, function(key, val){
                    $('#responsible-list').append(`
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="userlist[]" value="${val.user_id}" id="flexCheckChecked">
                    <label class="form-check-label" for="flexCheckChecked">
                        ${val.first_name} ${val.last_name}
                    </label>
                    </div>`)
                })

                $.each(reviewers, function(key, val){
                    $('#reviewer-list').append(`
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="userlist[]" value="${val.user_id}" id="flexCheckChecked">
                    <label class="form-check-label" for="flexCheckChecked">
                        ${val.first_name} ${val.last_name}
                    </label>
                    </div>`)
                })

                $.each(approvals, function(key, val){
                    $('#approval-list').append(`
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="userlist[]" value="${val.user_id}" id="flexCheckChecked">
                    <label class="form-check-label" for="flexCheckChecked">
                        ${val.first_name} ${val.last_name}
                    </label>
                    </div>`)
                })

                $.each(tradegroups, function(key, val){
                    $('#tradegroup_id').append(`
                        <option value="${val.tradegroup_id}">${val.tradegroup_name}</option>
                    `)
                })
            }
        })

    });

    $("#tradegroup_id").change(function(){   
        var tradegroup_id = $(this).val();
        $.ajax({
            url: "<?php echo base_url().'index.php/trade/get_trade_by_tradegroup';?>",
            type: "post",
            data: { 'tradegroup_id': tradegroup_id },
            success: function (obj) {
                var trades = $.parseJSON(obj);
                $('#trade_id').empty();
                $.each(trades, function(key, val){
                    $('#trade_id').append(`<option value="${val.trade_id}">${val.trade_name}</option>`)
                })
            }
        })
    
    });
</script>