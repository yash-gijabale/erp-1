<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title">Edit Ouestions</h3>
    </div>
    <?php echo form_open('edit-question/'.$question->question_id) ?>
    <div class="card-body row">
        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Select Subgroup :</label>
            <select name="subgroup_id" class="form-select" required>
                <option value="" selected >Select subgroup</option>
                <?php if($subgroups){ 
                    foreach($subgroups as $subgroup){
                    ?>
                <option value="<?php echo $subgroup->subgroup_id ?>" <?php echo($question->subgroup_id == $subgroup->subgroup_id ? 'selected' : '' ) ?> ><?php echo $subgroup->subgroup_name ?></option>

                <?php }} ?>
               
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Ouestion Title:</label>
            <input type="text" name="question_title" class="form-control" id="exampleInputPassword1" placeholder="Ouestion" value="<?php echo $question->question_title ?>" required>
        </div>
        <div class="form-group col-md-4">
            <label for="exampleInputPassword1">Question Description:</label>
            <textarea name="question_desc" class="form-control" id="exampleInputPassword1" placeholder="Description" required><?php echo $question->description?></textarea>
        </div>

        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Question Type :</label>
            <select name="type_id" id="project_id" class="form-select project_select" required>
                <option value="" selected >Select subgroup</option>
                <?php $types = get_all_types(); ?>
                <?php if($types){ 
                    foreach($types as $type){
                    ?>
                <option value="<?php echo $type->type_id ?>" <?php echo($question->question_type == $type->type_id  ? 'selected' : '' ) ?> ><?php echo $type->type_name ?></option>

                <?php }} ?>
               
            </select>
        </div>

        <div class="form-group col-md-4">
            <label for="exampleInputEmail1">Question severity :</label>
            <select name="severity_id" id="project_id" class="form-select project_select" required>
                <option value="" selected >Select subgroup</option>
                <?php $severity = get_all_severity(); ?>
                <?php if($severity){ 
                    foreach($severity as $severity){
                    ?>
                <option value="<?php echo $severity->severity_id ?>" <?php echo($question->question_impact == $severity->severity_id  ? 'selected' : '' ) ?>><?php echo $severity->severity_name ?></option>

                <?php }} ?>
               
            </select>
        </div>
    
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-secondary">update</button>
    </div>
    <?php echo form_close() ?>
</div>