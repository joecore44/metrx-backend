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
              <h5><?php echo _ADDITEM; ?></h5>
            </div>
          </div>

          <div class="col-md-12">

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

              <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="form-row">

                  <div class="form-group col-md-12">

                    <label class="required"><?php echo _TABLEFIELDUSERNAME; ?></label>
                    <input type="text" value="" placeholder="" name="user_name" autocomplete="false" class="form-control" required="">

                    <label class="required"><?php echo _TABLEFIELDUSEREMAIL; ?></label>
                    <input type="email" value="" placeholder="" name="user_email" autocomplete="false" class="form-control" required="">

                    <label class="required"><?php echo _TABLEFIELDPASSWORD; ?></label>
                    <input type="password" value="" placeholder="" name="user_password" class="form-control" id="password-field" required="">
                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>

                  <br/>
                  
                  <hr>

                  <button class="btn btn-primary" type="submit" name="save"><?php echo _SAVECHANGES; ?></button>

                  </div>

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
