<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Add Developer</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <?php if(isset($submit_status)){ 
        if($submit_status){ ?>
            <div class="alert alert-success alert-dismissible fade show m-1" role="alert">
            <?php echo $submit_msg; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
    <?php }else{ ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?php echo $submit_msg;?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
    <?php } } ?>
    <?php echo form_open('add-developers') ?>
    <div class="card-body row">
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Developer Name:</label>
            <input type="text" name="developer_name" class="form-control" id="exampleInputEmail1" placeholder="Developer" required>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Management Representative:</label>
            <input type="text" name="mr_name" class="form-control" id="exampleInputPassword1" placeholder="Management Representative" required>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Enter Email:</label>
            <input type="email" name="email" class="form-control" id="exampleInputPassword1" placeholder="Email" required>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Office Number:</label>
            <input type="text" name="contact_number" class="form-control" id="exampleInputPassword1" placeholder="Contact" required>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Owner Name:</label>
            <input type="text" name="owner_name" class="form-control" id="exampleInputPassword1" placeholder="Name" required>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Owner Number:</label>
            <input type="text" name="owner_number" class="form-control" id="exampleInputPassword1" placeholder="Number" required>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Select Region:</label>
            <select class="form-select" aria-label="Default select example" name="region">
                <option value="" selected>All Regions</option>
                <?php foreach(all_city_data() as $city){ ?>
                <option value="<?php echo $city ?>"><?php echo $city ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Address:</label>
            <textarea  class="form-control" name="address"></textarea>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    <?php echo form_close() ?>
</div>