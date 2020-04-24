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
<?php
  $user_id = ($this->session->userdata['logged_in']['user_id']);
  $fname = ($this->session->userdata['logged_in']['user_fname']); 
  $lname = ($this->session->userdata['logged_in']['user_lname']); 
  $fullname = $fname ." ". $lname ;
?>

<div class="content-wrapper" style="background-image: url( '<?= base_url() ?>asset/dist/img/newpattern.jpg' )">
   
      <div class="reports-head-p">
        <p class="dashboard-p">Manage Profile</p>
      </div>
    <div class="container">     
      <div class="profile-content">
        <div class="row">
          <div class="col-md-12">
            <div class="image-container">
              <div class="profile-picture" style="background-image: url( <?php echo $profile->user_photo ?> )">
              </div><!-- prof-pic -->
            </div><!-- image-container -->
          </div><!-- col-md-12 -->
        </div><!-- row -->
        <div class="row">
          <div class="col-md-4 col-md-offset-4 text-center">

              <form action="<?php echo site_url("Profile/profile_picture") ?>" id="form-upload">            
              <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new"><i class="glyphicon glyphicon-paperclip"></i> Select file</span><input type="file" name="file"></span>
                <a href="#" id="upload-btn" class="input-group-addon btn btn-success fileinput-exists"><i class="glyphicon glyphicon-open"></i> Upload</a>
              </div>
            </form>
           
          </div><!-- col-md-12 -->
        </div>

        <div class="editprofile">
            <div class="col-sm-6 col-sm-offset-3">
              <div class="panel-group">
                <div class="panel panel-info">
                  <div class="panel-heading">
                    <h4><a data-toggle="collapse" href="#editprof">Edit Profile<span class="fa fa-arrow-circle-o-down pull-right"></span></a></h4>
                  </div><!-- panel-heading -->
                </div><!-- panel-group -->

                  <div id="editprof" class="panel-collapse collapse">
                  <div class="panel-body bgprof">
                     <div class="row">
                        <div class="col-xs-12">
                          <div class="yourprofile">
                              <form class="form-horizontal" name="editpersonalprofile" id="editpersonalprofile">
                                <div class="form-group">
                                    <label class="control-label col-sm-3">First Name</label>
                                    <div class="col-sm-7">
                                      <input type="text" class="form-control" id="editfname" name="editfname" placeholder="First Name">
                                      <span class="help-block"></span>
                                    </div>                                
                                </div><!-- form-group -->

                                <div class="form-group">
                                    <label class="control-label col-sm-3">Middle Name</label>
                                    <div class="col-sm-7">
                                      <input type="text" class="form-control" id="editmname" name="editmname" placeholder="Middle Name">
                                      <span class="help-block"></span>
                                    </div>                                  
                                </div><!-- form-group -->

                                <div class="form-group">
                                    <label class="control-label col-sm-3">Last Name</label>
                                    <div class="col-sm-7">
                                      <input type="text" class="form-control" id="editlname" name="editlname" placeholder="Last Name">
                                      <span class="help-block"></span>
                                    </div>                                    
                                </div><!-- form-group -->

                                <div class="form-group">
                                    <label class="control-label col-sm-3">Address</label>
                                    <div class="col-sm-7">
                                      <input type="text" class="form-control" id="editaddess" name="editaddess" placeholder="Address">
                                      <span class="help-block"></span>
                                    </div>                                    
                                </div><!-- form-group -->

                                <div class="form-group">
                                    <label class="control-label col-sm-3">Contact #</label>
                                    <div class="col-sm-7">
                                      <input type="text" class="form-control" id="editcontact" name="editcontact" placeholder="Contact Number">
                                      <span class="help-block"></span>
                                    </div>                                    
                                </div><!-- form-group -->
                              </form><!-- form-horizontal -->
                          </div><!-- yourprofile -->
                        </div><!-- col-xs-12 -->
                     </div><!-- row -->
                  </div><!-- panel-body -->

                  <div class="panel-footer prof-footer" align="right">
                      <button onclick="editmyprofile();" class="btn btn-primary btn-sm" id="btnUpdatepp"><i class="fa fa-refresh"></i> Update Profile </button>
                  </div><!-- panel-footer -->
                  </div><!-- panel-collapse -->
              </div><!-- panel -->
            </div><!-- col-sm-6 -->
        </div><!-- editprofile -->

        <div class="editpword">
          <div class="col-sm-6 col-sm-offset-3">
              <div class="panel-group">
                <div class="panel panel-info">
                  <div class="panel-heading">
                    <h4><a data-toggle="collapse" href="#changepword">Change Password<span class="fa fa-arrow-circle-o-down pull-right"></span></a></h4>
                  </div><!-- panel-heading -->
                </div><!-- panel-group -->

                  <div id="changepword" class="panel-collapse collapse">
                  <div class="panel-body bgprof">
                     <div class="row">
                        <div class="col-xs-12">
                          <div class="yourprofile">
                              <form class="form-horizontal" id="pass_form">
                                <div class="form-group">
                                    <label class="control-label col-sm-5" for="curPword">Current Password</label>
                                    <div class="col-sm-7">
                                      <input type="password" class="form-control" id="curPword" name="curPword" placeholder="">
                                    </div>
                                </div><!-- form-group -->
                                <div class="form-group">
                                    <label class="control-label col-sm-5" for="newPword">New Password</label>
                                    <div class="col-sm-7">
                                      <input type="password" class="form-control" id="newPword" name="newPword" placeholder="">
                                    </div>
                                </div><!-- form-group -->
                                <div class="form-group">
                                    <label class="control-label col-sm-5" for="confPword">Confirm New Password</label>
                                    <div class="col-sm-7">
                                      <input type="password" class="form-control" id="confPword" name="confPword" placeholder="">
                                    </div>
                                    <div class="col-sm-8 ajax_pass_result"></div>
                                </div><!-- form-group -->
                              </form><!-- form-horizontal -->
                          </div><!-- yourprofile -->
                        </div><!-- col-xs-12 -->
                     </div><!-- row -->
                  </div><!-- panel-body -->
                  <div class="panel-footer prof-footer" align="right">
                      <button onclick="changepass(event)" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i> Update Password </button>
                  </div><!-- panel-footer -->
                  </div><!-- panel-collapse -->
              </div><!-- panel -->
            </div><!-- col-sm-6 -->
        </div><!-- editpword -->

   </div><!-- container -->
</div><!-- content-wrapper -->




  <!-- ==============================================================
            MODALS
 ================================================================== -->


<script type="text/javascript">
var siteurl = "<?php print site_url(); ?>";

$(document).ready(function() {
user_profile();
});

$(function () {
    var inputFile = $('input[name=file]');
    var uploadURI = $('#form-upload').attr('action');

    $('#upload-btn').on('click', function(event) {
        var fileToUpload = inputFile[0].files[0];
        if(fileToUpload != 'undefine') {
            var formData = new FormData($('#form-upload')[0]);
            $.ajax({
                type: "POST",
                url: uploadURI,
                data: formData,
                processData: false,
                contentType: false,
                success: function(msg) {
                    msg = $.parseJSON(msg);
                    if(msg.status == true) {
                      alert("Profile picture updated!");
                      window.location.reload();
                    } else {
                      alert(msg.error);
                    }                    
                }
            });
        }
    });
});

function changepass(e) {
    e.preventDefault();
    $.ajax({
    type: "POST",
    url:  siteurl+"profile/update_password",
    data: $("#pass_form").serialize(),
    success: function(res) {
        $(".ajax_pass_result").html(res);
        window.location.reload();
     }
    });
}
</script>
