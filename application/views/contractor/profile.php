<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="<?php echo base_url().$user_data->user_image ?>" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">
                            <?php echo $user_data->worker_name ?>
                        </h3>

                        <div class="row">
                            <span class="text-muted text-center col-md-12"><?php echo 'Contact: '.$user_data->contact_number ?></span>
                            <span class="text-muted text-center col-md-12"><?php echo 'DOB: '. date('d-M-Y',strtotime($user_data->birth_date)) ?></span>
                            <span class="text-muted text-center col-md-12"><?php echo 'Address: '.$user_data->address ?></span>
                        </div>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Monthly Presenty:</b> <span class="float-right text-primary"><b><?php echo $att_data['att_details']['presenty_percentage'].'%' ?></b></span>
                            </li>
                            <li class="list-group-item">
                                <b>Total Absenty:</b> <span class="float-right text-primary"><b><?php echo $att_data['att_details']['total_absenty']?></b></span>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity"
                                    data-toggle="tab">Attendence</a></li>
                            <li class="nav-item"><a class="nav-link" href="#docs" data-toggle="tab">Documents</a></li>
                            <!-- <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li> -->
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <!-- Post -->
                                <div class="post">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Sr no.</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Presenty Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $srno = 1;
                                            foreach($att_data as $att) { ?>
                                            <tr>
                                                <th scope="row"><?php echo $srno ?></th>
                                                <td><?php echo date('d-m-Y', strtotime($att['date'])) ?></td>
                                                <td class="<?php echo($att['presenty_status']=='1'? 'text-primary':'text-danger'); ?>"><?php echo get_presenty_status($att['presenty_status']); ?></td>
                                            </tr>
                                            <?php $srno++; } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane" id="docs">
                                <div class="row">
                                    <?php foreach($user_documents as $doc){ ?>
                                        <div class="col-md-6 border border-dark">
                                            <span class="card-title"><b><?php echo $doc->document_name ?> :</b></span>
                                            <img src="<?php echo base_url().$doc->document_path ?>" class="border" width="100%" alt="" srcset="">
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>

                            <div class="tab-pane" id="settings">
                                <?php echo form_open('profile/'.$user_data->worker_id) ?>
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" class="form-control" id="inputName"
                                                placeholder="Name" value="<?php echo $user_data->worker_name ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Contact no</label>
                                        <div class="col-sm-10">
                                            <input type="text" name='contact' class="form-control" id="inputEmail"
                                                placeholder="Contact no."
                                                value="<?php echo $user_data->contact_number ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">Address</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="address" class="form-control" id="inputName2"
                                                placeholder="Address" value="<?php echo $user_data->address ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputExperience" class="col-sm-2 col-form-label">DOB</label>
                                        <div class="col-sm-10">
                                            <input type="date" name="birth_date" class="form-control" id="inputName2"
                                                value="<?php echo date('Y-m-d',strtotime( $user_data->birth_date)) ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputSkills" class="col-sm-2 col-form-label">Age</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="age" class="form-control" id="inputSkills"
                                                placeholder="Age" value="<?php echo $user_data->age ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                                <?php echo form_close() ?>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->