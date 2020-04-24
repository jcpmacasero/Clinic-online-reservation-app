<?php
//$mname = ($this->session->userdata['logged_in']['user_mname']);
    $logged_in = ($this->session->userdata['logged_in']['user_id']); 
    if(empty($logged_in))
    {
        #user not logged in
        $this->session->set_flashdata('error', 'Session has Expired');
        redirect('Authentication');
    }
    else 
    
?>

<div class="content-wrapper" style="background-image: url( '<?= base_url() ?>asset/dist/img/newpattern.jpg' )">
  <div class="clinichead-p">
    <p class="dashboard-p">Backup Settings</p>
 </div>
    <!-- Content Header (Page header) -->
<section class="content">
    <br>
    <div class="editprofile">
            <div class="col-sm-10 col-sm-offset-1">
              <div class="panel-group">
                <div class="panel panel-info">
                  <div class="panel-heading">
                    <h4><a data-toggle="collapse" href="#auto">Backup Setup<span class="fa fa-arrow-circle-o-down pull-right"></span></a></h4>
                  </div><!-- panel-heading -->
                </div><!-- panel-group -->

                  <div id="auto" class="panel-collapse">
                  <div class="panel-body bgprof">
                  <div class="alert" id="switch_status">Switched off.</div>
                    <div class="backcontents">
                      <form class="form-horizontal" id="frm_back">
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="editdescription">Auto Back-up:</label>
                          <div class="col-sm-7">
                            <div class="btn-group" id="toggle_event_editing">
                              <button type="button" class="btn btn-info locked_active">OFF</button>
                              <button type="button" class="btn btn-default unlocked_inactive">ON</button>
                            </div>
                            <!-- <input type="text" class="form-control" id="editdescription" name="editdescription" style="text-transform: capitalize;" placeholder="First name" required> -->
                            <span class="error editdescription"></span>
                          </div>                          
                        </div>
                      

                        <div id="back_on">
                        <div class="form-group">
                          <label class="control-label col-sm-3 col-sm-offset-1" for="backup_time" style="font-weight:normal;">Select method:</label>
                          <div class="col-sm-7">
                            <div class="btn-group" id="toggle_event_editing">
                              <select class="form-control" id="backup_time" name="backup_time">
                                  <option value=""></option>
                                  <option value="Weekly">Weekly</option>
                                  <option value="Monthly">Monthly</option>
                              </select>
                            <span class="error backup_time"></span>
                            </div>                            
                          </div>                          
                        </div>
                        </div>
                        </form>

                    <div id="back_off">
                      <p style="margin-left:90px;">For Manual back-up please click the button back-up now</p>
                      <button onclick="auto_backup();" class="btn btn-default btn-xs" style="margin-left:200px; margin-bottom:4%;">Back-up now</button>
                    </div>

                  </div><!-- panel-body -->
                  <!-- <div class="panel-footer prof-footer" align="right"> -->
                      <!-- <button onclick="add_diagnosis()" class="btn btn-primary btn-sm" id="btnAddDiagnosis"><i class="fa fa-plus"></i> Add Diagnosis </button> -->
                  <!-- </div>panel-footer -->
                  </div><!-- panel-collapse -->
              </div><!-- panel -->
            </div><!-- col-sm-6 -->
  </div><!-- editprofile -->
         
</section>
      
</div><!-- content-wrapper -->

<!-- ==============================================================
            MODALS
 ================================================================== -->

<script type="text/javascript">
var siteurl = "<?php print site_url(); ?>";
var buttonon = 0;


$(document).ready(function() {
  if(buttonon == 1) {
      $('#toggle_event_editing button').toggleClass('locked_inactive locked_active btn-default btn-info');
      $("#switch_status").removeClass("alert-danger").addClass("alert-success");
          $('#switch_status').html('Auto back-up Switched on.');
          $("#back_on").show();
          $("#back_off").hide();
  }
  else {
      $("#switch_status").removeClass("alert-success").addClass("alert-danger");
      $('#switch_status').html('Auto back-up Switched off.');
      $("#back_on").hide();
      $("#back_off").show();
  }

  $('#toggle_event_editing button').click(function(){
    if($(this).hasClass('locked_active') || $(this).hasClass('unlocked_inactive')){
          $("#switch_status").removeClass("alert-danger").addClass("alert-success");
          $('#switch_status').html('Auto back-up Switched on.');
          $("#back_on").show();
          $("#back_off").hide();
    }else{
          $("#switch_status").removeClass("alert-success").addClass("alert-danger");
          $('#switch_status').html('Auto back-up Switched off.');
          $("#back_on").hide();
          $("#back_off").show();
    }
    
    /* reverse locking status */
    $('#toggle_event_editing button').eq(0).toggleClass('locked_inactive locked_active btn-default btn-info');
    $('#toggle_event_editing button').eq(1).toggleClass('unlocked_inactive unlocked_active btn-info btn-default');
  });

});

function auto_backup() {
  window.location.href = siteurl+"admin_backup/backup_db";
}


</script>




