<?php require 'header.php'; ?>
<?php require 'sidebar.php'; ?>

<!--Page Container--> 
<section class="page-container">
  <div class="page-content-wrapper">

    <!--Main Content-->

    <div class="content sm-gutter">
      <div class="container-fluid padding-25 sm-padding-10">

      <div class="section-title">
          <h5><?php echo _PROFILE; ?></h5>
        </div>

        <div class="row">

          <div class="col-md-12">
            <div class="block form-block mb-4">

            <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="form-row">

                  <div class="form-group col-md-12">

                   <input type="hidden" value="<?php echo $memberDetails['member_id']; ?>" name="member_id">
                   
                   <label class="required"><?php echo _TABLEFIELDUSERNAME; ?></label>
                   <input type="text" value="<?php echo $memberDetails['member_name']; ?>" name="member_name" class="form-control" required="">

                   <br/>

                   <label class="required"><?php echo _TABLEFIELDUSEREMAIL; ?></label>
                   <input type="text" value="<?php echo $memberDetails['member_email']; ?>" name="member_email" class="form-control" required="">

                   <br/>

                   <label><?php echo _TABLEFIELDPASSWORD; ?></label>
                   <input type="hidden" value="<?php echo $memberDetails['member_password']; ?>" name="member_password_save">
                   <input type="password" value="" placeholder="" name="member_password" class="form-control" id="password-field">
                   <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>

                   <br/>

                    <label><?php echo _TABLEFIELDDESCRIPTION; ?></label>
                    <textarea type="text" class="mceNoEditor form-control" name="member_description"><?php echo $memberDetails['member_description']; ?></textarea>

                    <br/>
                    <br/>
            <p><b><?php echo _TABLEFIELDDATEREGISTER; ?> </b> <?php echo FormatDate($memberDetails['member_created']); ?></p>

            <hr>

            <button class="btn btn-primary" type="submit" name="save"><?php echo _UPDATEITEM; ?></button>
            <button class="btn btn-danger deleteItem" type="button" data-url="../controller/delete_member.php?id=<?php echo $memberDetails['member_id']; ?>" data-redirect="../controller/members.php"><?php echo _DELETEITEM; ?></button>

            </div>
            </form>

            </div>
          </div>
        </div>

      </div>

     </div>
   </div>
 </div>
</div>
</section>
<?php require 'footer.php'; ?>
