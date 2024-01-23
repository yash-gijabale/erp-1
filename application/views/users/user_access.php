<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><a href="<?php echo base_url().'index.php/user-list' ?>"><i class="fa fa-chevron-left mx-2" aria-hidden="true"></i></a>User Access Control</h3>
        <a href="<?php echo base_url().'index.php/remove-user-access/'.$user ?>" class="card-tools btn btn-sm btn-warning">Remove</a>
    </div>

    <?php echo form_open('user_access/'.$user) ?>
    <div class="card-body row">

        <?php foreach($modules as $module){ ?>
            <div class="form-group mb-5">
                <div class="form-check ml-1">
                    <input class="form-check-input" type="checkbox" value="<?php echo $module['module_id']?>"  id="<?php echo 'module_'.$module['module_id'] ?>" onChange="checkSub('<?php echo $module['module_id'] ?>')"  name="<?php echo 'module_'.$module['module_id'] ?>" 
                    <?php echo(checkHasUerModuleAccees($user, $module['module_id']) ? 'checked' : '') ?>>
                    <label class="form-check-label" for="flexCheckDefault">
                        <b><?php echo $module['module'] ?></b>
                    </label>
                </div>
                <div class="row ml-1">
                <?php if(!empty($module['submodule'])){ 
                    foreach($module['submodule'] as $submodule){
                    ?>
                        <div class="form-check col-md-2">
                            <input class="form-check-input <?php echo 'module_'.$module['module_id'] ?>" type="checkbox" value="<?php echo $submodule->submodule_id ?>"  id="flexCheckDefault"  name="<?php echo 'submodule_'.$module['module_id'].'_'. $submodule->submodule_id ?>"
                            <?php echo(checkHasUerSubmoduleAccees($user, $module['module_id'], $submodule->submodule_id) ? 'checked' : '') ?>>
                            <label class="form-check-label" for="flexCheckDefault">
                                <?php echo $submodule->submodule_name ?>
                            </label>
                        </div>
                        
                        <?php }}?>
                        
                    </div>
            </div>

        <?php }?>
        
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="<?php echo base_url().'index.php/remove-user-access/'.$user ?>" class="card-tools btn btn-warning">Remove and Save</a>

    </div>
    <?php echo form_close() ?>
</div>





<script>
    function checkSub(moduleId)
    {
        let module = document.getElementById(`module_${moduleId}`)
        let boxes = document.querySelectorAll(`.module_${moduleId}`);
        let isModuleCheched = module.checked
        boxes.forEach(element => {
            isModuleCheched ? element.checked = true : element.checked = false
        });
    }
</script>