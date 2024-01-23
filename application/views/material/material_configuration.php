<div class="row">
<div class="card card-success col-md-4 m-0 p-0">
    <div class="card-header">
        <h3 class="card-title">Add Measurement</h3>
    </div>
    <?php echo form_open('add-measurement') ?>
    <div class="card-body row">
        <div class="form-group col-md-12">
            <label for="exampleInputPassword1">Mesurement Name:</label>
            <input type="text" name="measurement_name" class="form-control" id="exampleInputPassword1" placeholder="Add multiple by coma separate" required>
        </div>
    
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-success">Submit</button>
    </div>
    <?php echo form_close() ?>
</div>
</div>
