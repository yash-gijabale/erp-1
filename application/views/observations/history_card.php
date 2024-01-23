<div>

    <?php foreach($finalData as $history){ ?>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?php echo $history['userName'] ?></h3><sub class="mx-1"><?php echo $history['role'] ?></sub>
                <span class="card-tools"><?php echo $history['created_date'] ?></span>
            </div>
            <div class="card-body">
                <h3 class="card-title col-md-12"><?php echo $history['comment'] ?></h3>
                <div class="imgages row">
                    <?php foreach($history['images'] as $img){ ?>
                        <div class="col-md-6">
                            <img class="col-md-12" src="<?php echo base_url().$img->image_path ?>" alt="" srcset="">
                            <?php if($img->image_type == '0'){ ?>
                                <sub>Observation Image</sub>
                            <?php }else{ ?>
                                <sub>Recommended Image</sub>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

<!-- <div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">title</h3><sub class="mx-1">hellosub>
    </div>
    <div class="card-body">
        <h3 class="card-title">hello</h3>
    </div>
</div> -->