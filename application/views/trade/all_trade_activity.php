<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Trade Group List</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->

    <div class="card-body">

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Sr no</th>
                    <th>Project Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $sr_no = 1; 
                foreach($trade_groups as $trade_group){
                ?>
                    <tr>
                        <td><?php echo $sr_no ?></td>
                        <td><?php echo $trade_group->tradegroup_name ?></td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit_tradegroup" onclick="get_tradegroup_by_id('<?php echo $trade_group->tradegroup_id ?>')">Edit</button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="remove_teadegroup('<?php echo $trade_group->tradegroup_id ?>')">Delete</button>
                        </td>
                       
                    </tr>

                <?php $sr_no++; } ?>
                

            </tbody>
        </table>

    </div>

</div>
<!-- edit trade group modal -->
<div class="modal fade" id="edit_tradegroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Trade Group</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open('edit-tradegroup') ?>
      <div class="modal-body">
      <div class="form-group col-md-12">
            <label for="exampleInputPassword1">Trade-group Name:</label>
            <input type="text" name="tradegroup_name" id="edit_tradegroup_name" class="form-control" id="exampleInputPassword1" placeholder="Trade Group name" required>
            <input type="hidden" name="tradegroup_id" id="edit_tradegroup_id">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Update</button>
      </div>
      <?php echo form_close() ?>

    </div>
  </div>
</div>
<!-- /edit trade group modal -->






<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Trade List</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->

    <div class="card-body">

    <div class="form-group col-md-3">
            <label for="exampleInputEmail1">Select Trade Group :</label>
            <select id="trade_group_select" class="form-select project_select" required>
                <option value="" selected >All Trades</option>
                <?php if($trade_groups){ 
                    foreach($trade_groups as $trade_group){
                    ?>
                <option value="<?php echo $trade_group->tradegroup_id ?>" ><?php echo $trade_group->tradegroup_name ?></option>

                <?php }} ?>
               
            </select>
        </div>

        <table id="trade" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Sr no</th>
                    <th>Trade Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="trade-table-body">
                <?php $sr_no = 1; 
                foreach($trades as $trade){
                ?>
                    <tr>
                        <td><?php echo $sr_no ?></td>
                        <td><?php echo $trade->trade_name ?></td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" onclick="get_trade_by_id('<?php echo $trade->trade_id ?>')" data-target="#edit_trade">Edit</button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="remove_trade('<?php echo $trade->trade_id ?>')" >Delete</button>
                        </td>
                       
                    </tr>

                <?php $sr_no++; } ?>
                

            </tbody>
        </table>

    </div>

</div>
<!-- edit trade modal -->
<div class="modal fade" id="edit_trade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Trade Group</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open('edit-trade') ?>
        <div class="modal-body">
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1">Select Trade Group:</label>
                        <select name="tradegroup_id" id="project_id" class="form-select project_select" required>
                            <option value="" selected id="selected_trade" >Select Trade group</option>
                            <?php if($trade_groups){ 
                                foreach($trade_groups as $trade_group){
                                ?>
                            <option value="<?php echo $trade_group->tradegroup_id ?>" ><?php echo $trade_group->tradegroup_name ?></option>

                            <?php }} ?>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputPassword1">Trade Name:</label>
                        <input type="text" name="trade_name" class="form-control" id="edit_trade_name" placeholder="Trade name" required>
                        <input type="hidden" name="trade_id" id="edit_trade_id">
                    </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Update</button>
      </div>
      <?php echo form_close() ?>

    </div>
  </div>
</div>
<!-- /edit trade modal -->




<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Subgroup List</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <div class="form-group col-md-3">
            <label for="exampleInputEmail1">Select Trade Group :</label>
            <select id="trade_select" class="form-select project_select" required>
                <option value="" selected >All Subgroups</option>
                <?php if($trades){ 
                    foreach($trades as $trade){
                    ?>
                <option value="<?php echo $trade->trade_id ?>" ><?php echo $trade->trade_name ?></option>

                <?php }} ?>
               
            </select>
        </div>

    <div class="card-body">

        <table id="subgroup" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Sr no</th>
                    <th>Subgroup Name</th>
                    <th>Subgroup Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="subgruop_table">
                <?php $sr_no = 1; 
                foreach($subgroup as $sub){
                ?>
                    <tr>
                        <td><?php echo $sr_no ?></td>
                        <td><?php echo $sub->subgroup_name ?></td>
                        <td><?php echo $sub->subgroup_desc ?></td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" onclick="get_subgroup_by_id('<?php echo $sub->subgroup_id ?>')" data-target="#edit_subgroup">Edit</button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="remove_subgroup('<?php echo $sub->subgroup_id ?>')" >Delete</button>
                        </td>
                       
                    </tr>

                <?php $sr_no++; } ?>
                

            </tbody>
        </table>

    </div>

</div>
<!-- edit subgroup modal -->
<div class="modal fade" id="edit_subgroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Subgroup</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open('edit-subgroup') ?>
      <div class="modal-body">

            <div class= <div class="form-group col-md-12">
                <label for="exampleInputEmail1">Select Trade :</label>
                <select name="trade_id" id="project_id" class="form-select project_select" required>
                    <option value="" selected >Select Trade</option>
                    <?php if($trades){ 
                        foreach($trades as $trade){
                        ?>
                    <option value="<?php echo $trade->trade_id ?>" ><?php echo $trade->trade_name ?></option>

                    <?php }} ?>
                
                </select>
            </div>
            <div class="form-group col-md-12">
                <label for="exampleInputPassword1">Subgroup Name:</label>
                <input type="text" name="subgroup_name" id="edit_subgroup_name" class="form-control" id="exampleInputPassword1" placeholder="Subgroup name" required>
            </div>
            <div class="form-group col-md-12">
                <label for="exampleInputPassword1">Subgroup Description:</label>
                <textarea name="subgroup_desc" id="edit_subgroup_desc" class="form-control" id="exampleInputPassword1" placeholder="Subgroup Description" required></textarea>
            </div>
            <input type="hidden" name="subgroup_id" id="edit_subgroup_id">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Update</button>
      </div>
      <?php echo form_close() ?>

    </div>
  </div>
</div>
<!-- /edit subgroup modal -->



<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title">Question List</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <div class="form-group col-md-3">
            <label for="exampleInputEmail1">Select Subgroup :</label>
            <select id="trade_select" class="form-select project_select" required>
                <option value="" selected >All Subgroups</option>
                <?php if($subgroup){ 
                    foreach($subgroup as $subgroup){
                    ?>
                <option value="<?php echo $subgroup->subgroup_id ?>" ><?php echo $subgroup->subgroup_name ?></option>

                <?php }} ?>
               
            </select>
        </div>

    <div class="card-body">

        <table id="subgroup" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Sr no</th>
                    <th>Subgroup Name</th>
                    <th>Subgroup Description</th>
                    <th>question Type</th>
                    <th>question Severity</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="subgruop_table">
                <?php $sr_no = 1; 
                foreach($questions as $question){
                ?>
                    <tr>
                        <td><?php echo $sr_no ?></td>
                        <td><?php echo $question->question_title ?></td>
                        <td><?php echo $question->description ?></td>
                        <td><?php echo $question->question_type ?></td>
                        <td><?php echo $question->question_impact ?></td>
                        <td><?php echo 'pending' ?></td>
                        <td>
                            <a type="button" href="<?php echo base_url().'index.php/edit-question/'.$question->question_id ?>" class="btn btn-success btn-sm">Edit</a>
                            <button type="button" class="btn btn-danger btn-sm" onclick="remove_subgroup('<?php echo $sub->subgroup_id ?>')" >Delete</button>
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
    $(function () {
        $("#trade").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["excel", "pdf", "print"]
        }).buttons().container().appendTo('#trade_wrapper .col-md-6:eq(0)');
    });
    $(function () {
        $("#subgroup").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["excel", "pdf", "print"]
        }).buttons().container().appendTo('#subgroup_wrapper .col-md-6:eq(0)');
    });

    $('#trade_group_select').change(function(){
        var trade_group_id = $(this).val()
        $.ajax({
            url: "<?php echo base_url().'index.php/trade/get_trade_by_tradegroup';?>",
            type: "post",
            data: { 'tradegroup_id': trade_group_id },
            success: function (obj) {
                var trades = $.parseJSON(obj);
                // console.log(stages);
                // $('#structure_name').val(structure.structure_name)
                // $('#structure_area').val(structure.structure_area)
                $('#trade-table-body').empty();
            
                $.each(trades, function(key, val){
                    // console.log(val.project_name);
                    $('#trade-table-body').append(`
                    <tr>
                        <td>1</td>
                        <td>${val.trade_name}</td>
                        <td>
                            <div class="btn-group dropleft">
                            <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Edit</a>
                                <a class="dropdown-item" href="#">Delete</a>
                            </div>
                            </div>
                        </td>
                       
                    </tr>
                    `)
                })
            }
         });
    })

    $('#trade_select').change(function(){
        var trade_id = $(this).val()
        $.ajax({
            url: "<?php echo base_url().'index.php/trade/get_subgruop_by_trade';?>",
            type: "post",
            data: { 'trade_id': trade_id },
            success: function (obj) {
                var subgroups = $.parseJSON(obj);
                console.log(subgroups);
                // $('#structure_name').val(structure.structure_name)
                // $('#structure_area').val(structure.structure_area)
                $('#subgruop_table').empty();
            
                $.each(subgroups, function(key, val){
                    // console.log(val.project_name);
                    $('#subgruop_table').append(`
                    <tr>
                        <td>1</td>
                        <td>${val.subgroup_name}</td>
                        <td>${val.subgroup_desc}</td>
                        <td>
                            <div class="btn-group dropleft">
                            <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Edit</a>
                                <a class="dropdown-item" href="#">Delete</a>
                            </div>
                            </div>
                        </td>
                       
                    </tr>

                    `)
                })
            }
         });
    })



    function get_tradegroup_by_id(id){
        console.log(id)
        tradegroup_id = id;
        $.ajax({
            url:"<?php echo base_url().'index.php/trade/get_tradegroup_by_id' ?>",
            type: "post",
            data:{'tradegroup_id' : tradegroup_id},
            success: function (obj){
                tradegroup = $.parseJSON(obj)
                console.log(tradegroup.tradegroup_name)
                if(tradegroup){
                    $('#edit_tradegroup_name').val(tradegroup.tradegroup_name);
                    $('#edit_tradegroup_id').val(tradegroup.tradegroup_id)
                }
            }
        })

    }

    function remove_teadegroup(id){
        if(id){
            is_remove = confirm('Aye sure want to delete this group ?')
            if(is_remove){
                window.location.href = "<?php echo(base_url().'index.php/remove-tradegroup/') ?>"+id;
            }
        }
    }

    function get_trade_by_id(id){
        trade = id;
        $.ajax({
            url:"<?php echo base_url().'index.php/trade/get_trade_by_id' ?>",
            type: "post",
            data:{'trade' : trade},
            success: function (obj){
                trade = $.parseJSON(obj)
                if(trade){
                    $('#edit_trade_name').val(trade.trade_name);
                    $('#edit_trade_id').val(trade.trade_id)
                }
            }
        })
    }
    function remove_trade(id){
        if(id){
            is_remove = confirm('Aye sure want to delete this trade ?')
            if(is_remove){
                window.location.href = "<?php echo(base_url().'index.php/remove-trade/') ?>"+id;
            }
        }
    }

    function get_subgroup_by_id(id){
        subgroup = id;
        console.log(subgroup);
        $.ajax({
            url:"<?php echo base_url().'index.php/trade/get_subgroup_by_id' ?>",
            type: "post",
            data:{'subgroup' : subgroup},
            success: function (obj){
                subgroup = $.parseJSON(obj)
                console.log(subgroup)
                if(subgroup){
                    $('#edit_subgroup_name').val(subgroup.subgroup_name);
                    $('#edit_subgroup_desc').val(subgroup.subgroup_desc);
                    $('#edit_subgroup_id').val(subgroup.subgroup_id);
                }
            }
        })
    }

    function remove_subgroup(id){
        if(id){
            is_remove = confirm('Aye sure want to delete this subgroup ?')
            if(is_remove){
                window.location.href = "<?php echo(base_url().'index.php/remove-subgroup/') ?>"+id;
            }
        }
    }
</script>