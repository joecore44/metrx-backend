<?php require 'header.php'; ?>
<?php require 'sidebar.php'; ?>

<!--Page Container--> 
<section class="page-container">
  <div class="page-content-wrapper">

    <!--Main Content-->

    <div class="content sm-gutter">
      <div class="container-fluid padding-25 sm-padding-10">
        <div class="row">
          <div class="col-12">
            <div class="section-title">
              <h5><?php echo _EDITITEM; ?></h5>
            </div>
          </div>

          <div class="col-md-12">

          <?php if(!empty($success)): ?>
          <div class="d-flex align-items-center alert alert-success" role="alert">
          <i class="icon dripicons-checkmark"></i> <?php echo $success; ?>
          </div>
          <?php endif; ?>

          <?php if(!empty($errors)): ?>
          <div class="alert alert-danger" role="alert">
          <ul>
          <?php foreach($errors as $key => $value):?>
          <li><?php echo $value; ?></li>
          <?php endforeach; ?>
          </ul>
          </div>
          <?php endif; ?>
          
            <div class="block form-block mb-4">

              <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?id=<?php echo $trainer['trainer_id']; ?>" method="post">
                <div class="form-row">

                  <div class="form-group col-md-12">

                   <input type="hidden" value="<?php echo $trainer['trainer_id']; ?>" name="trainer_id">
                   
                   <label><?php echo _TABLEFIELDUSEREMAIL; ?></label>
                    <select class="selectDrop form-control" name="trainer_member">
                      <?php foreach($members as $item): ?>

                        <?php if($item['member_id'] == $trainer['trainer_member']): ?>
                          <option value="<?php echo echoOutput($item['member_id']); ?>" selected>ID <?php echo echoOutput($item['member_id']); ?> <?php echo echoOutput($item['member_email']); ?></option>
                        <?php else: ?>
                          <option value="<?php echo echoOutput($item['member_id']); ?>">ID <?php echo echoOutput($item['member_id']); ?> <?php echo echoOutput($item['member_email']); ?></option>
                        <?php endif; ?>

                      <?php endforeach; ?>
                    </select>

                   <label class="required"><?php echo _TABLEFIELDUSERNAME; ?></label>
                   <input type="text" value="<?php echo $trainer['trainer_name']; ?>" name="trainer_name" autocomplete="off" class="form-control" required="">

                   <br/>

                    <label><?php echo _TABLEFIELDDESCRIPTION; ?></label>
                    <textarea type="text" class="mceNoEditor form-control" name="trainer_description"><?php echo $trainer['trainer_description']; ?></textarea>

                   <br/>

                   <label class="control-label"><?php echo _TABLEFIELDSTATUS; ?></label>

                   <select class="custom-select form-control" name="trainer_status">
                    <?php
                    if($trainer['trainer_status'] == 1){
                      echo '<option value="1" selected="selected">'._ACTIVE.'</option>';
                      echo '<option value="0">'._INACTIVE.'</option>';

                    } else{
                      echo '<option value="0" selected="selected">'._INACTIVE.'</option>';
                      echo '<option value="1">'._ACTIVE.'</option>';
                    }
                    ?>
                  </select>

                  <br/>

                  <label><?php echo _TABLEFIELDAVATAR; ?></label>

                  <div class="new-image" id="image-preview" style="background: url(<?php echo $target_dir; ?><?php echo $trainer['trainer_avatar'] ?>);">
                  <label for="image-upload" id="image-label"><?php echo _CHOOSEFILE; ?></label>
                  <input type="hidden" value="<?php echo $trainer['trainer_avatar']; ?>" name="trainer_avatar_save">
                  <input type="file" name="trainer_avatar" accept=".jpg, .jpeg, .png, .gif" id="image-upload" />
                  </div>

                  <span class="text-danger recomendedsize"><?php echo _RECOMMENDEDSIZE; ?> <b>350 x 350</b> </span>


                  <hr>

                  <button class="btn btn-primary" type="submit" name="save"><?php echo _UPDATEITEM; ?></button>
                  <button class="btn btn-danger deleteItem" type="button" data-url="../controller/delete_trainer.php?id=<?php echo $trainer['trainer_id']; ?>" data-redirect="../controller/trainers.php"><?php echo _DELETEITEM; ?></button>

                </div>


              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
<?php require 'footer.php'; ?>
