<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add Trade</h3>
        <a class="card-tools btn btn-warning text-dark" href="<?php echo base_url().'index.php/material-list' ?>">List</a>
    </div>
    <?php echo form_open('add-material') ?>
    <div class="card-body row">
    <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Select Developer: <span class="text-danger">*</span></label>
            <select name="developer_id" id="developer_select" class="form-select" required>
                <option value="" selected>Select Developer</option>
                <?php foreach($all_developers as $developer){ ?>
                    <option value="<?php echo($developer->developer_id) ?>"><?php echo($developer->developer_name) ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Select Project: <span class="text-danger">*</span></label>
            <select name="project_id" id="project_select" class="form-select project_select" required>
                <option value="" selected class="text-danger">Select Developer First</option>
               
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Material Name:</label>
            <input type="text" name="material_name" class="form-control" id="exampleInputPassword1" placeholder="Material name" required>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Select Units:</label>
            <select name="material_unit" class="form-control">
                <option value="" selected>Select Units</option>
                <?php foreach($measures as $measure){ ?>
                    <option value="<?php echo $measure->measure_id ?>"><?php echo $measure->measure_name ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Material Qty:</label>
            <input type="text" name="material_qty" class="form-control" id="unit_qty" placeholder="Material Qty" required>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Material Unit Price:</label>
            <input type="text" name="unit_price" class="form-control" id="unit_price" placeholder="Unit Price" required>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Total Amount:</label>
            <input type="text" name="total_amount" class="form-control" id="total_amount" placeholder="Total Amount" required>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Material Type:</label>
            <select name="material_type" class="form-control">
                <option value="" selected>Select Type</option>
                <option value="1">Contruction</option>
                <option value="2">Electric</option>
                <option value="3">Water System</option>
                <option value="4">Interial</option>
                <option value="5">Decoration</option>
            </select>
        </div>
    
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    <?php echo form_close() ?>
</div>

<script src="<?php echo base_url() ?>public/admin/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>public/admin/plugins/jquery-ui/jquery-ui.min.js"></script>

<script>

$('#unit_price').on('input', ()=>{
    var unit_price = $('#unit_price').val()
    var unit_qty = $('#unit_qty').val()
    var total_amount = unit_price*unit_qty
    console.log(total_amount)
    if(isNaN(total_amount)){
        $('#total_amount').val('Enter Number Only !') ;
    }else
    {
        $('#total_amount').val(total_amount) ;
    }
})

$("#developer_select").change(function(){   
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
                $.each(projects, function(key, val){
                    // console.log(val.project_name);
                    $('.project_select').append(`<option value="${val.project_id}">${val.project_name}</option>`)
                })
            }
        })
    
    });
</script>