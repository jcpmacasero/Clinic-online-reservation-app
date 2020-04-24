<?php

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
  <div class="create-acct">
    <p class="dashboard-p">Create Account</p>
 </div>
    <!-- Content Header (Page header) -->
    <section class="content">
    <br>
    <div class="col-lg-10 col-lg-offset-1">
        <div class="panel-group">
             <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#profile"> Account Control <span class="fa fa-arrow-circle-o-down pull-right"></a>
                    </h4>
                </div><!-- panel-heading -->
                <div id="profile" class="panel-collapse collapse">
                  <div class="panel-body">
                    <div class="dataTable_wrapper">
                      <table id="dataTables-users"  class="table table-striped table-bordered table-hover dataTable dtr-inline" role="grid" style="width: 100%;" width="100%" aria-describedby="dataTables-material">
                          <thead>
                              <tr> 
                                  <th>First Name</th>
                                  <th>Middle Name</th>
                                  <th>Last Name</th>                                               
                                  <th>User ID</th>
                                  <th>Position</th>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody>
                          </tbody>
                      </table>
                    </div><!-- dataTable_wrapper -->
                  </div><!-- panel-body -->
                  <div class = "panel-footer" align="right">
                      <button onclick="admin_btnCreate();" class="btn btn-danger btn-sm">Create Account</button>
                  </div><!-- panel-footer -->
                </div><!-- profile -->
            </div><!-- panel panel-info -->
         </div><!-- panel-group -->
    </div><!-- col-lg-10 -->
    </section>
      
</div><!-- content-wrapper -->

  <!-- ==============================================================
            MODALS
 ================================================================== -->
<div class="modal fade" id="admin_view_prof" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header  btn-success">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h3 class="modal-title">User Profile</h3>
      </div>
            <div class="modal-body">
              <form class="form-horizontal" id="frmadmin_viewprofile">
                <div class="profile_user">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-7">
                              <div class="form-group">
                                <label class="control-label col-sm-4" for="fname">First Name</label>
                                <div class="col-sm-8">
                                  <input type="hidden" class="form-control" name="usermyID" id="usermyID">
                                  <input type="text" class="form-control" id="admin_fname" placeholder="First Name">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-4" for="mname">Middle Name</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="admin_mname" placeholder="Middle Name">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-4" for="lname">Last Name</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="admin_lname" placeholder="Last Name">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-4" for="addrs">Address</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="admin_address" placeholder="Address">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-4" for="contact">Contact #</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="admin_contact" placeholder="Contact Number">
                                </div>
                              </div>
                               <div class="form-group">
                                <label class="control-label col-sm-4" for="contact">Username</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="admin_username" placeholder="Username">
                                </div>
                              </div>
                               <div class="form-group">
                                <label class="control-label col-sm-4" for="contact">Password</label>
                                <div class="col-sm-8">
                                  <input type="password" class="form-control" id="admin_password" placeholder="Password">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-4" for="gender">Gender</label>
                                <div class="col-sm-8">
                                    <select id = "user_type" name="user_type">
                                      <option value="MALE">MALE</option>
                                      <option value="FEMALE">FEMALE</option>
                                    </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="control-label col-sm-4" for="gender">Position</label>
                                <div class="col-sm-8">
                                    <select id = "position_user" name="position_user">
                                        <option></option>
                                        <?php foreach($user_type as $each){ ?>
                                        <option value="<?php echo $each->user_type; ?>"><?php echo $each->position; ?></option>';
                                        <?php } ?> 
                                    </select>                                    
                                </div>
                              </div>
                               <div class="form-group">
                                <label class="control-label col-sm-4" for="gender">Status</label>
                                <div class="col-sm-8">
                                    <select id = "user_type" name="user_type">
                                      <option value="MALE">OK</option>
                                      <option value="FEMALE">BLOCK</option>
                                    </select>
                                </div>
                              </div>



                          </div><!-- col-md-7 -->
                          <div class="col-md-4">
                              <div class="clicked_patient_pic" style="background-image: url()">
                              </div><!-- clicked_patient_pic -->
                          </div><!-- col-md-4 -->

                        </div><!-- row -->
                      </div><!-- col-md-12 -->
                    </div>
                </div><!-- profile_pat -->
              </form><!-- form-horizontal -->
            </div><!-- modal-body -->
            <div class="modal-footer">
              <button type="button" id="generate_med" onclick="gen_mc()" class="btn btn-danger"></span> Update User</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div><!-- modal-footer -->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- admin_view_prof -->

 <div class="modal fade large" id="admin_create_acct" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header  btn-success">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h3 class="modal-title">Create Account</h3>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" id="frm_create_user">
                <div class="form-group">
                  <label for="userFName" class="control-label col-sm-4">First Name:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="userFName" id="userFName" placeholder="First name">
                     <span class="error userFName"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                <div class="form-group">
                  <label for="userMName" class="control-label col-sm-4">Middle Name:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="userMName" id="userMName" placeholder="Middle name">
                     <span class="error userMName"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                <div class="form-group">
                  <label for="clinic-address" class="control-label col-sm-4">Last Name:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="userLName" id="userLName" placeholder="Last name">
                    <span class="error userLName"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                <div class="form-group">
                  <label class="control-label col-sm-4" for="gender">Gender</label>
                  <div class="col-sm-8">
                      <select id = "user_gender" name="user_gender">
                        <option value=""></option>
                        <option value="MALE">MALE</option>
                        <option value="FEMALE">FEMALE</option>
                      </select>
                      <span class="error user_gender"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="clinic-address" class="control-label col-sm-4">Birthdate:</label>
                  <div class="col-sm-6">
                    <div class="input-group date" data-provide="datepicker">
                    <input type="text" class="form-control" id="user_bday" name="user_bday" placeholder="Birthdate">
                    <span class="error user_bday"></span>
                      <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                      </div>
                  </div>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->

                <div class="form-group">
                  <label for="clinic-address" class="control-label col-sm-4">Address:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="userAddress" id="userAddress" placeholder="Address">
                    <span class="error userAddress"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                <div class="form-group">
                  <label for="clinic-address" class="control-label col-sm-4">Contact #:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="userContact" id="userContact" placeholder="Contact Number">
                    <span class="error userContact"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                <div class="form-group">
                  <label for="clinic-name" class="control-label col-sm-4">Username:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Username">
                    <span class="error user_name"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                <div class="form-group">
                  <label for="clinic-name" class="control-label col-sm-4">Password:</label>
                  <div class="col-sm-6">
                    <input type="password" class="form-control" name="user_password" id="user_password" placeholder="Password">
                    <span class="error user_password"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                <div class="form-group">
                  <label for="clinic-status" class="control-label col-sm-4">User Type</label>
                  <div class="col-sm-6">
                   <select id = "user_type" name="user_type">
                      <option></option>
                      <?php foreach($user_type as $each){ ?>
                      <option value="<?php echo $each->user_type; ?>"><?php echo $each->position; ?></option>';
                    <?php } ?> 
                  </select>
                  <span class="error user_type"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
               
              </form><!-- form-horizontal -->
            </div><!-- modal-body -->
            <div class="modal-footer">
              <button type="button" id="btn_reg" onclick="create_User()" class="btn btn-primary">Create Account</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div><!-- modal-footer -->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- generate_cert -->

 <div class="modal fade large" id="modalassign" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header  btn-success">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h3 class="modal-title">Create Account</h3>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-10">
                  <p>Please check to assign a doctor/s for : <label id="secname"></label></p>
                  <input type="hidden" class="form-control" name="hidemeOK" id="hidemeOK">
                </div>
                <br>
              </div>
              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                <div class="dataTable_wrapper">
                      <table id="dataTables-docs"  class="table table-striped table-bordered table-hover dataTable dtr-inline" role="grid" style="width: 100%;" width="100%" aria-describedby="dataTables-material">
                          <thead>
                              
                                  <th>First Name</th>
                                  <th>Middle Name</th>
                                  <th>Last Name</th>                                               
                                  <th></th>
                              
                          </thead>
                          <tbody>
                          </tbody>
                      </table>
                  </div><!-- dataTable_wrapper -->
                </div>
                </div>
            </div><!-- modal-body -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div><!-- modal-footer -->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- generate_cert -->


<script type="text/javascript">
var table;
var siteurl = "<?php print site_url(); ?>";
var table_users;

function admin_btnCreate() {
  $("#frm_create_user")[0].reset();
  $('.error').empty();
  $('#admin_create_acct').modal('show');
}

function show_users() {
    $("#dataTables-users").dataTable().fnDestroy();

    table_users =  $('#dataTables-users').DataTable({ 
      "ajax": {
              "url": "<?php echo site_url('admin_controls/getallusers')?>",
              "type": "POST",
          },
          responsive: true
      });
}

function show_docs(assign_id) {
    $("#dataTables-docs").dataTable().fnDestroy();

    table =  $('#dataTables-docs').DataTable({ 
      "ajax": {
              "url": "<?php echo site_url('admin_controls/getalldocs/')?>"+assign_id,
              "type": "POST",
          },
          responsive: true,
          className: 'select-checkbox',
          'bInfo': false,
          'paging': false 
      });
}

function reload_users(){
    table_users.ajax.reload(null,false);  
}

$('#dataTables-docs tbody').on('change', 'input[type="checkbox"]', function(e){
  var user_id = $(this).val();
  var myassignID = $('.modal-body #hidemeOK').val();

    if($(this).is(":checked")) {
      $.ajax({
         url:siteurl+"admin_controls/assign_to/"+user_id,
         type: "POST",
         data: {assign_id:myassignID},
         dataType: "JSON",
            success: function(data)  {
              alert("Successfully Assigned");
            }
      });
    }
    else {
      $.ajax({
        url:siteurl+"admin_controls/removeassign/"+user_id,
        type: "POST",
        dataType: "JSON",
          success: function(data) {
            alert("Successfully Unassigned");
          }
      });
    }

});

function showassign() {
  var secfullname = $('.modal-body #admin_fname').val() + " " + $('.modal-body #admin_lname').val();
  var myuser_id = $('.modal-body #usermyID').val();
  
  $.ajax({
      url: siteurl+"admin_controls/getassign_id/"+myuser_id,
      type: "POST",
      dataType: "JSON",
        success: function(data) {
          $('#dataTables-docs').dataTable();
          show_docs(data[0]['assign_id']);
          $('#hidemeOK').val(data[0]['assign_id']);
          
        } 
    });

  $('#secname').text(secfullname);
  $('#modalassign').modal('show');
}

function create_User() {  
  $('#btn_reg').text('Saving...');
  $('#btn_reg').attr('disabled',true);

   $.ajax({
      url: siteurl+"admin_controls/reg_user",
      type: "POST",
      data: $("#frm_create_user").serialize(),
      dataType: "JSON",
          success: function(resp) {
                console.log(resp);
                $('.error').html('');
                if(resp.status == false) {
                  $.each(resp.message,function(i,m){
                      $('.'+i).text(m);
                  });
                  $('#btn_reg').text('Save'); //change button text
                  $('#btn_reg').attr('disabled',false); //set button enable 
                }
                else if(resp.status == true) {
                  $('#admin_create_acct').modal('hide');
                  $('#frm_create_user')[0].reset(); 
                  reload_users();
                  alert("Successfully Added");
                  $('#btn_reg').text('Save'); //change button text
                  $('#btn_reg').attr('disabled',false); //set button enable 
                }
            }
   });
}

$(document).ready(function() {
  $('#dataTables-users').dataTable();
  show_users();

});

</script>