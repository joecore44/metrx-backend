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
  <h4><?php echo _SETTINGS; ?></h4> 
</div>
</div>

<div class="col-12 c-col-12">
<button class="btn btn-primary" type="submit" name="save" form="setSettings"><?php echo _SAVECHANGES; ?></button>
</div>


<div class="col-md-12">

<div class="block form-block mb-4" style="margin-top: 20px;">

  <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" id="setSettings">

    <div class="form-row">

      <div class="form-group col-md-12">

        <div class="table-responsive">

          <fieldset>
            <legend><?php echo _SITESETTINGS; ?></legend>

            <table class="display table s-table">

              <tr>  
                <td>
                  <label><?php echo _DATEFORMAT; ?></label>
                  <select class="custom-select form-control" id="date-format" data-selected="<?php echo $settings['st_dateformat']; ?>" name="st_dateformat">
                    <option value="d/m/Y">DD/MM/YYYY</option>
                    <option value="m/d/Y">MM/DD/YYYY</option>
                    <option value="Y/m/d">YYYY/MM/DD</option>
                    <option value="d-m-Y">DD-MM-YYYY</option>
                    <option value="m-d-Y">MM-DD-YYYY</option>
                    <option value="Y-m-d">YYYY-MM-DD</option>
                    <option value="d.m.Y">DD.MM.YYYY</option>
                    <option value="m.d.Y">MM.DD.YYYY</option>
                    <option value="Y.m.d">YYYY.MM.DD</option>
                  </select>
                </td>
              </tr>

              <tr>  
                <td>
                  <label><?php echo _TIMEZONE; ?></label>
                  <select class="custom-select form-control" id="timezone" name="st_timezone">
                  <?php foreach($timezonesArray as $item => $value): ?>
                      <?php if($settings['st_timezone'] == $item): ?>
                      <option value="<?php echo $item; ?>" selected><?php echo $value; ?></option>
                      <?php else: ?>
                      <option value="<?php echo $item; ?>"><?php echo $value; ?></option>
                      <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                </td>
              </tr>

            </table>

          </fieldset>

          <fieldset>
            <legend><?php echo _SMTPEMAILS; ?></legend>

            <table class="display table s-table">

              <tr>  
                <td>
                  <label><?php echo _RECIPIENTEMAIL; ?>  <small style="display: block; margin-bottom: 8px; margin-top: 5px;"><?php echo _MESSAGERECIPIENTEMAIL; ?></small></label>
                  <input class="form-control" value="<?php echo $settings['st_recipientemail']; ?>" name="st_recipientemail" type="text">
                </td>
              </tr>

              <tr>  
                <td>
                  <label><?php echo _SMTPHOST; ?></label>
                  <input class="form-control" value="<?php echo $settings['st_smtphost']; ?>" name="st_smtphost" type="text">
                </td>
              </tr>

              <tr>  
                <td>
                  <label><?php echo _SMTPUSER; ?></label>
                  <input class="form-control" value="<?php echo $settings['st_smtpemail']; ?>" name="st_smtpemail" type="text">
                </td>
              </tr>

              <tr>  
                <td>
                  <label><?php echo _SMTPPASSWORD; ?></label>
                  <input class="form-control" value="<?php echo $settings['st_smtppassword']; ?>" name="st_smtppassword" type="text">
                </td>
              </tr>

              <tr>  
                <td>
                  <label><?php echo _SMTPENCRYPT; ?></label>
                  <input class="form-control" value="<?php echo $settings['st_smtpencrypt']; ?>" name="st_smtpencrypt" type="text">
                </td>
              </tr>

              <tr>  
                <td>
                  <label><?php echo _SMTPPORT; ?></label>
                  <input class="form-control" value="<?php echo $settings['st_smtpport']; ?>" name="st_smtpport" type="text">
                </td>
              </tr>

            </table>

          </fieldset>

          <fieldset>
            <legend><?php echo _STRINGS; ?></legend>

            <table class="display table s-table">

              <tr>  
                <td>
                  <label><?php echo _PAGEABOUTUS; ?></label>
                  <textarea type="text" class="simpletinymce form-control" name="st_aboutus"><?php echo $settings['st_aboutus']; ?></textarea>
                </td>
              </tr>

              <tr>  
                <td>
                  <label><?php echo _PAGEPRIVACYPOLICY; ?></label>
                  <textarea type="text" class="simpletinymce form-control" name="st_privacypolicy"><?php echo $settings['st_privacypolicy']; ?></textarea>
                </td>
              </tr>

              <tr>  
                <td>
                  <label><?php echo _PAGETERMSCONDITIONS; ?></label>
                  <textarea type="text" class="simpletinymce form-control" name="st_termsofservice"><?php echo $settings['st_termsofservice']; ?></textarea>
                </td>
              </tr>

            </table>

          </fieldset>

    </div>

              
    <hr>

<button class="btn btn-primary" type="submit" name="save" form="setSettings"><?php echo _SAVECHANGES; ?></button>

			</div>


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

  <div class="scrollTop">
    <span><a href=""><i class="dripicons-arrow-thin-up"></i></a></span>
  </div>

<?php require 'footer.php'; ?>
