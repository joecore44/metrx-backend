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

              <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?id=<?php echo $user->uid; ?>" method="post">
                <div class="form-row">

                  <div class="form-group col-md-12">

                   <input type="hidden" value="<?php echo $user->uid; ?>" name="user_id">
                   
                   <label class="required"><?php echo _TABLEFIELDUSERNAME; ?></label>
                   <input type="text" value="<?php echo $user->displayName; ?>" name="user_name" autocomplete="off" class="form-control" required="">

                   <br/>

                   <label class="required"><?php echo _TABLEFIELDUSEREMAIL; ?></label>
                   <input type="email" value="<?php echo $user->email; ?>" name="user_email" autocomplete="off" class="form-control" required="">

                   <br/>

                   <label><?php echo _TABLEFIELDPASSWORD; ?></label>
                   <input type="hidden" value="<?php echo $user->passwordHash; ?>" name="user_password_save">
                   <input type="password" value="" placeholder="" name="user_password" autocomplete="off" class="form-control" id="password-field">
                   <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>

                  <br/>

                  <hr>

                  <button class="btn btn-primary" type="submit" name="save"><?php echo _UPDATEITEM; ?></button>
                  <?php if($user->disabled == true): ?>
                  <a class="btn btn-success" href="../controller/enable_user.php?id=<?php echo $user->uid; ?>"><?php echo _ENABLEITEM; ?></a>
                  <?php else: ?>
                  <a class="btn btn-warning" href="../controller/disable_user.php?id=<?php echo $user->uid; ?>"><?php echo _DISABLEITEM; ?></a>
                  <?php endif; ?>

                  <?php if($user->emailVerified == false): ?>
                  <?php if($user->emailVerified == false): ?>
                    <a class="btn btn-primary text-white verify_email" id="submit-send" data-email="<?php echo $user->email; ?>"><?php echo _VERIFYITEM; ?></a>
                  <?php endif; ?>
                  <?php endif; ?>

                  <div id="showresults" style="margin-top: 15px;margin-bottom: 10px;"></div>

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
