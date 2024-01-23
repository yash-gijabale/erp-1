
<?php 

date_default_timezone_set('Australia/Melbourne');
$date = date('m/d/Y h:i:s a', time());
$defalut_Date = date('Y-m-d',time())
?>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Generate Report</h3>
    </div>

    <?php echo form_open('generate-report') ?>
    <div class="card-body row">
        <div class="form-group col-md-3">
            <label for="exampleInputPassword1">Select Developer:</label>
            <?php $developer = get_all_developers(); ?>
            <select name="developer_id" id="developer_select" class="form-select" require>
                <option value="" selected>Select Developer</option>
                <?php foreach($developer as $developer){ ?>
                    <option value="<?php echo $developer->developer_id ?>" <?php echo($form_data['developer_id'] == $developer->developer_id ? 'selected' : '') ?> ><?php echo $developer->developer_name ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group col-md-3">
            <label for="exampleInputEmail1">Select Project:</label>
            <select name="project_id" id="project_select" class="form-select project_select" required>
                <?php if($form_data){ ?>
                    <option value="<?php echo $form_data['project_id'] ?>" selected><?php echo get_projectname_by_id($form_data['project_id']) ?></option>
                    <?php } else { ?>
                        <option value="" selected class="text-danger">Select Developer First</option>
                <?php }  ?>
               
            </select>
        </div>

        <div class="form-group col-md-3">
            <label for="exampleInputPassword1">Select Trade Group:</label>
            <select name="tradegroup_id" id="developer_select" class="form-select" require>
                <option value="" selected>Select Developer</option>
                <?php foreach($all_tradegroup as $tradegroup){ ?>
                    <option value="<?php echo $tradegroup->tradegroup_id ?>" <?php echo($form_data['tradegroup_id'] == $tradegroup->tradegroup_id ? 'selected' : '') ?>><?php echo $tradegroup->tradegroup_name ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group col-md-3">
            <label for="exampleInputPassword1">Select Date:</label>
            <input type="date" name="attempt_date" class="form-control" value="<?php echo ( $form_data['attempt_date'] ? date('Y-m-d', strtotime($form_data['attempt_date'])) : $defalut_Date) ?>">
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-secondary"><i class="fa fa-cog" aria-hidden="true"></i> Generate</button>
    </div>
    <?php echo form_close() ?>
</div>


<div class="card card-success mb-5">
    <div class="card-header">
        <h3 class="card-title">Your Report</h3>
    </div>
    <?php if($report_data){ ?>
    <div class="card-body row" id="printableArea">
        
            <div class="col-md-12 mb-4">
                <h3 class="card-heding">Observation Status</h3>
                <span class="cart-title"><b>Date of Report: </b><?php echo $date ?></span>
            </div>
            <table class="table table-bordered">
        <thead>
            <tr>
            <th width="5%">Sr No</th>
            <th>Observation number</th>
            <th width="25%">Desc</th>
            <th>image</th>
            <th>image 2</th>
            <th>date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($report_data as $report) { ?>
                <tr>
                    <td rowspan="2">1</td>
                    <td rowspan="2">
                        <?php echo $report['obj_number'] ?>
                    </td>
                    <td>
                        <div class="col-md-12">
                            <span class="text-dark"><b>Developer: </b></span>
                            <span class="text-secondary"><?php echo $report['developer'] ?></span>
                        </div>
                        <div class="col-md-12">
                            <span class="text-dark"><b>Project: </b></span>
                            <span class="text-secondary"><?php echo $report['project'] ?></span>
                        </div>
                        <div class="col-md-12">
                            <span class="text-dark"><b>Trade group: </b></span>
                            <span class="text-secondary"><?php echo $report['trade_group'] ?></span>
                        </div><br>
                        <div class="col-md-12">
                            <span class="text-secondary"><?php echo $report['description'] ?></span>
                        </div>
                        <div class="col-md-12">
                            <span class="text-dark"><b>Remark: </b></span>
                            <span class="text-secondary"><?php echo $report['remark'] ?></span>
                        </div>
                        <div class="col-md-12">
                            <span class="text-dark"><b>Location: </b></span>
                            <span class="text-secondary"><?php echo $report['location'] ?></span>
                        </div>
                        <div class="col-md-12">
                            <span class="text-dark"><b>Responsible: </b></span>
                            <span class="text-secondary"><?php echo $report['site_representative'] ?></span>
                        </div>
                    </td>
                    <td>
                        <?php if($report['images']['obserservation_image'][0]) { ?>
                        <div>
                            <span class="text-dark">Observation Image 1: </span>
                            <img src="<?php echo base_url().$report['images']['obserservation_image'][0]->image_path ?>" width="90%" height="250px" alt="" srcset="">
                        </div>
                        <?php } ?>
                    </td>
                    <td>
                    <?php if($report['images']['obserservation_image'][1]) { ?>
                        <div>
                            <span class="text-dark">Observation Image 2: </span>
                            <img src="<?php echo base_url().$report['images']['obserservation_image'][1]->image_path ?>" width="90%" height="250px" alt="" srcset="">
                        </div>
                        <?php } ?>
                    </td>
                    <td rowspan="2">
                        <div class="col-md-12">
                            <span class="text-dark"><b>Attempt Date: </b></span>
                            <span class="text-secondary"><?php echo date('Y-m-d',strtotime($report['attempt_date'])) ?></span>
                        </div>
                        <div class="col-md-12">
                            <span class="text-dark"><b>Target Date: </b></span>
                            <span class="text-secondary"><?php echo date('Y-m-d',strtotime($report['target_date'])) ?></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="col-md-12">
                            <span class="text-dark"><b>Remark: </b></span>
                            <span class="text-secondary"><?php echo $report['site_representative'] ?></span>
                        </div>
                        <div class="col-md-12">
                            <span class="text-dark"><b>Verified by: </b></span>
                            <span class="text-secondary"><?php echo $report['site_representative'] ?></span>
                        </div>
                    </td>
                    <td>
                    <?php if($report['images']['recommended_image'][0]) { ?>
                        <div>
                            <span class="text-dark">Recommemded Image 1: </span>
                            <img src="<?php echo base_url().$report['images']['recommended_image'][0]->image_path ?>" width="90%" height="250px" alt="" srcset="">
                        </div>
                    <?php } ?>
                    </td>
                    <td>
                    <?php if($report['images']['recommended_image'][1]) { ?>
                        <div>
                            <span class="text-dark">Recommemded Image 2: </span>
                            <img src="<?php echo base_url().$report['images']['recommended_image'][1]->image_path ?>" width="90%" height="250px" alt="" srcset="">
                        </div>
                    <?php } ?>
                    </td>
                </tr>
            <?php } ?>

        </tbody>
        </table>

    </div>
    <div class="cart-footet d-flex justify-content-end p-2">
        <button class="btn btn-primary" onclick="printDiv()"><i class="fa fa-file" aria-hidden="true"></i> Download PDF</button>
    </div>
<?php }else{?> 
    <div class="card-body row">
        <h3>Data Not Found !</h3>
    </div>

<?php }?> 
    
</div>

   
<script src="<?php echo base_url() ?>public/admin/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>public/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<script>


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

    function printDiv() {
    console.log('click')
     var printContents = document.getElementById('printableArea').innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}

    </script>