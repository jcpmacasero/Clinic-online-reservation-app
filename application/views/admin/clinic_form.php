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
  <div class="clinichead-p">
    <p class="dashboard-p">Clinics</p>
 </div>
 
  <section class="content">
    <div class="container">
      
      <div class="row">
        <div class="col-md-12">
          <div class="clinic-p">
            <h4> Doc. <?php echo $fname ?>, Welcome to Clinic page  !</h4>
            <p> In this page, you can create a clinic to be opened for patients. Create a clinic now by just clicking the button below "Create Clinic" </p>
          </div><!-- clinic-p -->
          <!-- <div class="create-clinic">
            <button onclick="add_clinic()" class="btn btn-success btn-lg">Create Clinic</button>
            
          </div> -->
        </div><!-- col-md-12 -->
      </div><!-- row -->

      <div class="editprofile">
            <div class="col-sm-10 col-sm-offset-1">
              <div class="panel-group">
                <div class="panel panel-info">
                  <div class="panel-heading">
                    <h4><a data-toggle="collapse" href="#myclinics">Clinics<span class="fa fa-arrow-circle-o-down pull-right"></span></a></h4>
                  </div><!-- panel-heading -->
                </div><!-- panel-group -->

                  <div id="myclinics" class="panel-collapse collapse">
                  <div class="panel-body">                                                              
                    <div class="table-responsive">                                  
                      <table id="dataTables-clinics" class="table table-striped table-hover table-bordered dt-responsive wrap" style="width: 100%;" width="100%">
                          <thead>
                              <tr> 
                                  <th>Clinic Name</th>
                                  <th>Address</th>
                                  <th>Logo</th>                                               
                                  <th>Status</th>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody>
                          </tbody>
                      </table>     
                    </div>                                                     
                  </div><!-- panel-body -->

                  <div class="panel-footer prof-footer" align="right">
                      <button onclick="add_clinic()" class="btn btn-primary btn-sm">Create Clinic</button>
                  </div><!-- panel-footer -->
                  </div><!-- panel-collapse -->
              </div><!-- panel -->
            </div><!-- col-sm-6 -->
        </div><!-- editprofile -->

        <div class="editprofile">
            <div class="col-sm-10 col-sm-offset-1">
              <div class="panel-group">
                <div class="panel panel-info">
                  <div class="panel-heading">
                    <h4><a data-toggle="collapse" href="#mysec">Secretary<span class="fa fa-arrow-circle-o-down pull-right"></span></a></h4>
                  </div><!-- panel-heading -->
                </div><!-- panel-group -->

                  <div id="mysec" class="panel-collapse collapse">
                  <div class="panel-body">
                     <div class="row">
                        <div class="col-xs-12">
                          <div class="yourprofile">
                            <div class="showhide">
                            <div class="row">
                            <div class="col-sm-12">
                            <div class="dataclinics">
                              <div class="table-responsive">
                                <table id="dataTables-secretary"  class="table table-striped table-hover table-bordered dt-responsive wrap" style="width: 100%;" width="100%">
                                    <thead>
                                        <tr> 
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Last Name</th>                                               
                                            <th>Address</th>
                                            <th>Contact #</th>
                                            <th>Picture</th>                                            
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                              </div><!-- dataTable_wrapper -->
                            </div><!-- searchres -->
                            </div>
                          </div>
                         </div><!-- showhide -->
                          </div><!-- yourprofile -->
                        </div><!-- col-xs-12 -->
                     </div><!-- row -->
                  </div><!-- panel-body -->

                  <div class="panel-footer prof-footer" align="right">
                      <button onclick="add_sec()" class="btn btn-primary btn-sm">Create Secretary</button>
                  </div><!-- panel-footer -->
                  </div><!-- panel-collapse -->
              </div><!-- panel -->
            </div><!-- col-sm-6 -->
        </div><!-- editprofile -->

    </div>
  </section>
    
</div><!-- content-wrapper -->


<!-- ==============================================================
						MODALS
 ================================================================== -->
<div class="modal fade" id="add_clinic" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header  btn-success">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h3 class="modal-title">Create Clinic</h3>
      </div>
            <div class="modal-body">
            	<form class="form-horizontal" id="frm_create_clinic">
                <div class="row">
                <div class="col-sm-7 col-sm-offset-2">
                <div class="form-group">
                  <label for="clinic-id" class="col-sm-4">Clinic ID:</label>
                  <div class="col-sm-1">
                    <label for="myclinicID" id="clinic_id"></label>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                </div>
                </div>
                <div class="form-group">
                  <label for="clinic_name" class="control-label col-sm-4">Clinic Name:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="clinic_name" id="clinic_name" style="text-transform: capitalize;" placeholder="Name">
                    <span class="error clinic_name"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                <div class="form-group">
                  <label for="clinic_address" class="control-label col-sm-4">Clinic Address:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="clinic_address" style="text-transform: capitalize;" id="clinic_address" placeholder="Address">
                    <span class="error clinic_address"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                <div class="form-group">
                  <label for="clinic_province" class="control-label col-sm-4">Province:</label>
                  <div class="col-sm-6">
                    <select class="form-control" name="clinic_province" id="clinic_province">
                       <option value="0"> -------------  SELECT OPTION  -------------</option>
                      <?php foreach($province_id as $each){ ?>
                      <option value="<?php echo $each->province_id; ?>"><?php echo $each->province_name; ?></option>';
                      <?php } ?>
                    </select>
                    <span class="error clinic_province"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                <div class="form-group">
                  <label for="clinic_city" class="control-label col-sm-4">City:</label>
                  <div class="col-sm-6">
                    <select class="form-control" name="clinic_city" id="clinic_city">
                    </select>
                    <span class="error clinic_city"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
            	</form><!-- form-horizontal -->
            </div><!-- modal-body -->
            <div class="modal-footer">
            	<button type="button" id="btnCreateClinic" onclick="create_clinic()" class="btn btn-primary">Save</button>
            	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div><!-- modal-footer -->
		</div><!-- modal-content -->
	</div><!-- modal-dialog -->
</div><!-- add_clinic -->


<div class="modal fade" id="edit_clinic" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header  btn-success">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h3 class="modal-title">Edit Clinic</h3>
      </div>
            <div class="modal-body">
               <div class="row">
                  <div class="image-container">
                    <div class="profile-picclinic" id="logoclinic">
                    </div>
                  </div>
                </div>
               <div class="row">
                  <div class="col-md-3 col-md-offset-3">
                  <form id="form-uploadclinic">            
                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                      <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                      <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new"><i class="glyphicon glyphicon-paperclip"></i> Select file</span><input type="file" name="file"></span>
                      <a href="#" id="upload-btnpic" class="input-group-addon btn btn-success fileinput-exists"><i class="glyphicon glyphicon-open"></i> Upload</a>
                    </div>
                  </form>
                  </div>
                </div>
                <br>
              <form class="form-horizontal" id="frm_edit_clinic">
                <div class="row">
                <div class="col-sm-7 col-sm-offset-2">
                <div class="form-group">
                  <label for="clinic-id" class="col-sm-4">Clinic ID:</label>
                  <div class="col-sm-1">
                    <label for="myclinicID" id="modalclinic_id"></label>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                </div>
                </div>
                <div class="form-group">
                  <label for="editclinic_name" class="control-label col-sm-4">Clinic Name:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="editclinic_name" id="editclinic_name" style="text-transform: capitalize;" placeholder="Name">
                    <span class="error editclinic_name"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                <div class="form-group">
                  <label for="editclinic_address" class="control-label col-sm-4">Clinic Address:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="editclinic_address" id="editclinic_address" style="text-transform: capitalize;" placeholder="Address">
                    <span class="error editclinic_address"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                <div class="form-group">
                  <label for="clinic_province" class="control-label col-sm-4">Province:</label>
                  <div class="col-sm-6">
                    <select class="form-control" name="clinic_province" id="clinic_province">
                       <option value="0"> -------------  SELECT OPTION  -------------</option>
                      <?php foreach($province_id as $each){ ?>
                      <option value="<?php echo $each->province_id; ?>"><?php echo $each->province_name; ?></option>';
                      <?php } ?> 
                    </select>
                    <span class="error clinic_province"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                <div class="form-group">
                  <label for="clinic_city" class="control-label col-sm-4">City:</label>
                  <div class="col-sm-6">
                    <select class="form-control" name="clinic_city" id="clinic_city">
                    </select>
                    <span class="error clinic_city"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
              </form><!-- form-horizontal -->
            </div><!-- modal-body -->
            <div class="modal-footer">
              <button type="button" id="btnEditClinic" onclick="edit_clinic()" class="btn btn-primary">Update</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div><!-- modal-footer -->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- edit_clinic -->


<div class="modal fade" id="add_sec" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header  btn-success">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h3 class="modal-title">Add Secretary</h3>
      </div>
            <div class="modal-body">
               
              <form class="form-horizontal" id="frm_addsec">
                <div class="row">
                <div class="col-sm-7 col-sm-offset-2">
                </div>
                </div>
                <input type="hidden" class="form-control" id="dupsec" name="dupsec" placeholder="Middle name" required>
                <div class="form-group">
                  <label for="addsec_fname" class="control-label col-sm-4">First Name:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="addsec_fname" id="addsec_fname" style="text-transform: capitalize;" placeholder="First Name">
                    <span class="error addsec_fname"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                <div class="form-group">
                  <label for="clinic-address" class="control-label col-sm-4">Middle Name:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="addsec_mname" id="addsec_mname" style="text-transform: capitalize;" placeholder="Middle Name">
                    <span class="error addsec_mname"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                <div class="form-group">
                  <label for="addsec_lname" class="control-label col-sm-4">Last Name:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="addsec_lname" id="addsec_lname" style="text-transform: capitalize;" placeholder="Last Name">
                    <span class="error addsec_lname"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                <div class="form-group">
                  <label for="addsec_username" class="control-label col-sm-4">Username:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="addsec_username" id="addsec_username" style="text-transform: capitalize;" placeholder="Username">
                    <span class="error addsec_username"></span>                    
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                <div class="form-group">
                  <label for="addsec_pword" class="control-label col-sm-4">Password:</label>
                  <div class="col-sm-6">
                    <input type="password" class="form-control" name="addsec_pword" id="addsec_pword" style="text-transform: capitalize;" placeholder="Password">
                    <span class="error addsec_pword"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                <div class="form-group">
                  <label for="addsec_address" class="control-label col-sm-4">Address:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="addsec_address" id="addsec_address" style="text-transform: capitalize;" placeholder="Address">
                    <span class="error addsec_address"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                <div class="form-group">
                  <label for="addsec_contact" class="control-label col-sm-4">Contact #:</label>
                  <div class="col-sm-6">
                   <input type="text" class="form-control" name="addsec_contact" id="addsec_contact" placeholder="Contact #">
                    <span class="error addsec_contact"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                <div class="form-group">
                  <label for="addsec_bday" class="control-label col-sm-4">Birthday:</label>
                  <div class="col-sm-6">
                   <div class="input-group date" data-provide="datepicker">
                        <input type="text" class="form-control" id="addsec_bday" name="addsec_bday" placeholder="Birthdate">
                        <span class="error addsec_bday"></span>
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                    </div>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                 <div class="form-group">
                  <label for="addsec_gender" class="control-label col-sm-4">Gender:</label>
                  <div class="col-sm-6">
                    <select class="form-control" name="addsec_gender" id="addsec_gender">
                       <option value="0"> ---------  SELECT OPTION  ---------</option>
                       <option value="MALE">MALE</option>
                       <option value="FEMALE">FEMALE</option>
                    </select>
                      <span class="error addsec_gender"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
              </form><!-- form-horizontal -->
            </div><!-- modal-body -->
            <div class="modal-footer">
              <button type="button" id="btnCreateSec" onclick="createmy_sec()" class="btn btn-primary">Create</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div><!-- modal-footer -->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- edit_clinic -->

<div class="modal fade" id="edit_sec" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header  btn-success">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h3 class="modal-title">View/Edit Secretary</h3>
      </div>
            <div class="modal-body">              
                <br>
                <input type="hidden" class="form-control" name="addsec_user_id" id="addsec_user_id" placeholder="First Name">
              <form class="form-horizontal" id="frm_edit_sec">
                <div class="form-group">
                  <label for="secedit_fname" class="control-label col-sm-4">First Name:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="secedit_fname" id="secedit_fname" style="text-transform: capitalize;" placeholder="First Name">
                    <span class="error secedit_fname"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                <div class="form-group">
                  <label for="secedit_mname" class="control-label col-sm-4">Middle Name:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="secedit_mname" id="secedit_mname" style="text-transform: capitalize;" placeholder="Middle Name">
                    <span class="error secedit_mname"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                <div class="form-group">
                  <label for="secedit_lname" class="control-label col-sm-4">Last Name:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="secedit_lname" id="secedit_lname" style="text-transform: capitalize;" placeholder="Last Name">
                    <span class="error secedit_lname"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                <div class="form-group">
                  <label for="secedit_uname" class="control-label col-sm-4">Username:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="secedit_uname" id="secedit_uname" style="text-transform: capitalize;" placeholder="Username">
                    <span class="error secedit_uname"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                <div class="form-group">
                  <label for="secedit_pword" class="control-label col-sm-4">Password:</label>
                  <div class="col-sm-6">
                    <input type="password" class="form-control" name="secedit_pword" id="secedit_pword" style="text-transform: capitalize;" placeholder="Password">
                    <span class="error secedit_pword"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                <div class="form-group">
                  <label for="secedit_address" class="control-label col-sm-4">Address:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="secedit_address" id="secedit_address" style="text-transform: capitalize;" placeholder="Address">
                    <span class="error secedit_address"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                <div class="form-group">
                  <label for="secedit_contact" class="control-label col-sm-4">Contact #:</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="secedit_contact" id="secedit_contact" placeholder="Contact #">
                    <span class="error secedit_contact"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                <div class="form-group">
                  <label for="secedit_gender" class="control-label col-sm-4">Gender:</label>
                  <div class="col-sm-6">
                    <select class="form-control" name="secedit_gender" id="secedit_gender">
                       <option value="0"> ---------  SELECT OPTION  ---------</option>
                       <option value="MALE">MALE</option>
                       <option value="FEMALE">FEMALE</option>
                    </select>
                    <span class="error secedit_gender"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                <div class="form-group">
                  <label for="secedit_stat" class="control-label col-sm-4">Status:</label>
                  <div class="col-sm-6">
                    <select class="form-control" name="secedit_stat" id="secedit_stat">
                       <option value="0"> ---------  SELECT OPTION  ---------</option>
                       <option value="OK">OK</option>
                       <option value="BLOCK">BLOCK</option>
                    </select>
                    <span class="error secedit_stat"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
              </form><!-- form-horizontal -->
            </div><!-- modal-body -->
            <div class="modal-footer">
              <button type="button" id="btnEditSec" onclick="update_sec()" class="btn btn-primary">Update</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div><!-- modal-footer -->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- edit_clinic -->


<script type="text/javascript">
var siteurl = "<?php print site_url(); ?>";
var provinceID;
var cityIDModal;
var table_clinics,table_secretary;

$(document).ready(function() {
table_clinics = $('#dataTables-clinics').dataTable();
table_secretary = $('#dataTables-secretary').dataTable();

  $("input").change(function(){
          $(this).parent().parent().removeClass('has-error');
          $(this).next().empty();
      });

      $("textarea").change(function(){
          $(this).parent().parent().removeClass('has-error');
          $(this).next().empty();
      });

      $("select").change(function(){
          $(this).parent().parent().removeClass('has-error');
          $(this).next().empty();
      });  
  show_clinics();
  show_sec();
  $('#pd1').attr("class","treeview active");
  $('#myP').attr("class","active");
  $('#myP1').attr("class","active");
  $('#myP2').attr("class","active");
});

function reload_clinics(){
    table_clinics.ajax.reload(null,false);  
}

function reload_sec(){
    table_secretary.ajax.reload(null,false);  
}

function add_clinic() {
  $('#frm_create_clinic')[0].reset();
  $('.error').empty();
  showclinicID();
  $('#add_clinic').modal('show');
}

function showclinicID() {
  $.ajax({
    url: siteurl+"clinic_admin/disp_clinic_ID",
    type: "GET",
    dataType: "JSON",
      success: function(data) {
          var id = parseInt(data[0]['clinic_id']);
          $('#clinic_id').text((id+1));
      }
  })
}


$('#clinic_province').change(function(){
    $("#clinic_city").empty();
    var selectedProvince = $(this).val();
    provinceID = selectedProvince;
    getcity(provinceID);
});

$('.modal-body #clinic_province').change(function(){
    $(".modal-body #clinic_city").empty();
    var selectedProvinceModal = $(this).val();
    provinceIDModal = selectedProvinceModal;
    getcitymodal(provinceIDModal);
    //alert(selectedProvinceModal);
});

$('.modal-body #clinic_city').change(function(){
    var selectedcityModal = $(this).val();
    cityIDModal = selectedcityModal;
});

$(function () {
    var inputFile = $('input[name=file]');

    $('#upload-btnpic').on('click', function(event) {
        var fileToUpload = inputFile[0].files[0];
        if(fileToUpload != 'undefine') {
            var formData = new FormData($('#form-uploadclinic')[0]);
            $.ajax({
                type: "POST",
                url: siteurl+"clinic_admin/upclinic_logo/"+$("#modalclinic_id").text(),
                data: formData,
                processData: false,
                contentType: false,
                success: function(msg) {
                    alert("Picture updated!");
                    refreshpic($("#modalclinic_id").text());
                }
            });
        }
    });
});

function clinic_view(clinic_id){
  refreshpic(clinic_id);
  $(".modal-body #modalclinic_id").text(clinic_id);
  $.ajax({
    url: siteurl+"clinic_admin/getClinicDetails/"+clinic_id,
    type: "GET",
    dataType: "JSON",
        success: function(data) {
          $('.modal-body #editclinic_name').val(data[0]['clinic_name']);
          $('.modal-body #editclinic_address').val(data[0]['clinic_address']);
          get_province_id(data[0]['city_id']);
        }
  });
  $('.error').empty();  
  $('#edit_clinic').modal('show');
}



function edit_clinic() {

  var editclinic_id = $("#modalclinic_id").text();
  $('#btnEditClinic').text('Saving...');
  $('#btnEditClinic').attr('disabled',true);
   $.ajax({
      url: siteurl+"clinic_admin/edit_myclinic/"+editclinic_id,
      type: "POST",
      data: $('#frm_edit_clinic').serialize(),
      dataType: "JSON",
          success: function(resp) {
                console.log(resp);
                $('.error').html('');
                if(resp.status == false) {
                  $.each(resp.message,function(i,m){
                      $('.'+i).text(m);
                  });
                  $('#btnEditClinic').text('Update'); //change button text
                  $('#btnEditClinic').attr('disabled',false); //set button enable 
                }
                else if(resp.status == true) {
                  $('#edit_clinic').modal('hide');
                  reload_clinics();
                  alert("Successfully Updated");
                  $('#btnEditClinic').text('Update'); //change button text
                  $('#btnEditClinic').attr('disabled',false); //set button enable 
                }
            }
   });
}

function get_province_id(city_id) {
  $.ajax({
    url: siteurl+"clinic_admin/getmyprovince/"+city_id,
    type: "GET",
    dataType: "JSON",
      success: function(data) {
          $('.modal-body #clinic_province').val(data[0]['province_id']);
          getcitymodal(data[0]['province_id']);
          //$('.modal-body #clinic_city').val(city_id);
          //alert("hello"+city_id);
      }
  })
}

function refreshpic(patient_id) {
  $("#logoclinic").empty();
  $.ajax({
    url: siteurl+"clinic_admin/getpic/"+patient_id,
    type: "GET",
    dataType: "JSON",
      success: function(data) {
        $("#logoclinic").append('<img src="'+data[0]['clinic_logo']+'" style="max-height: 192px; max-width: 192px;"/>');
      }
  });
}

function getcity(province_id){
    $.ajax({
      url: siteurl+"clinic_admin/getcity/"+province_id,
      type: "GET",
      dataType: "JSON",
          success: function(data) {
            $('#clinic_city').append('<option value=' +0+ '>' + '-------------  SELECT OPTION  -------------' + '</option>');
            $.each(data, function(key, value) {
              $('#clinic_city').append('<option value=' + value['city_id'] + '>' + value['city_name'] + '</option>');
            });
        }
    });
}

function getcitymodal(province_id){
    $.ajax({
      url: siteurl+"clinic_admin/getcity/"+province_id,
      type: "GET",
      dataType: "JSON",
          success: function(data) {
            $('.modal-body #clinic_city').append('<option value=' +0+ '>' + '-------------  SELECT OPTION  -------------' + '</option>');
            $.each(data, function(key, value) {
              $('.modal-body #clinic_city').append('<option value=' + value['city_id'] + '>' + value['city_name'] + '</option>');
            });
        }
    });
}

function show_clinics() {
  table_clinics = $("#dataTables-clinics").dataTable().fnDestroy();
  table_clinics =  $('#dataTables-clinics').DataTable({ 
    "ajax": {
            "url": "<?php echo site_url('clinic_admin/myclinics')?>",
            "type": "POST",
        },
        responsive: true,            
        bInfo: false,      
    });
}

function show_sec() {
  $("#dataTables-secretary").dataTable().fnDestroy();
  table_secretary =  $('#dataTables-secretary').DataTable({ 
    "ajax": {
            "url": "<?php echo site_url('clinic_admin/mysecs')?>",
            "type": "POST",
        },
        responsive: true,
        bInfo: false,
    });
}

function sec_details(user_id) {
  $.ajax({
      url: siteurl+"clinic_admin/getsecprofile/"+user_id,
      type: "POST",
      dataType: "JSON",
          success: function(data) {
            $('.modal-body #addsec_user_id').val(data[0]['user_id']);
            $('.modal-body #secedit_fname').val(data[0]['user_fname']);
            $('.modal-body #secedit_mname').val(data[0]['user_mname']);
            $('.modal-body #secedit_lname').val(data[0]['user_lname']);
            $('.modal-body #secedit_uname').val(data[0]['user_name']);
            $('.modal-body #secedit_pword').val(data[0]['user_password']);
            $('.modal-body #secedit_address').val(data[0]['user_address']);
            $('.modal-body #secedit_contact').val(data[0]['user_contact_info']);
            $('.modal-body #secedit_gender').val(data[0]['user_gender']);
            $('.modal-body #secedit_stat').val(data[0]['user_status']);
            $('.profile-sec').css('background-image', 'url(' + data[0]['user_photo'] + ')');
            $('.error').empty();
            $('#edit_sec').modal('show');
        }
    });
}

function update_sec() {
   var editsec_profile = $("#addsec_user_id").val();
   $('#btnEditSec').text('Saving...');
   $('#btnEditSec').attr('disabled',true);
   $.ajax({
      url: siteurl+"clinic_admin/updateSecProfile/"+editsec_profile,
      type: "POST",
      data: $('#frm_edit_sec').serialize(),
      dataType: "JSON",
          success: function(resp) {
                console.log(resp);
                $('.error').html('');
                if(resp.status == false) {
                  $.each(resp.message,function(i,m){
                      $('.'+i).text(m);
                  });
                  $('#btnEditSec').text('Update'); //change button text
                  $('#btnEditSec').attr('disabled',false); //set button enable 
                }
                else if(resp.status == true) {
                  $('#edit_sec').modal('hide');
                  reload_sec();
                  alert("Successfully Updated");
                  $('#btnEditSec').text('Update'); //change button text
                  $('#btnEditSec').attr('disabled',false); //set button enable 
                }
            }
   });
}

function create_clinic() {
  $('#btnCreateClinic').text('Saving...');
  $('#btnCreateClinic').attr('disabled',true);

   $.ajax({
      url : siteurl+"clinic_admin/create_clinic",
      type: "POST",
      data: $('#frm_create_clinic').serialize(),
      dataType: "JSON",
          success: function(resp) {
                console.log(resp);
                $('.error').html('');
                if(resp.status == false) {
                  $.each(resp.message,function(i,m){
                      $('.'+i).text(m);
                  });
                  $('#btnCreateClinic').text('Save'); //change button text
                  $('#btnCreateClinic').attr('disabled',false); //set button enable 
                }
                else if(resp.status == true) {
                  $('#add_clinic').modal('hide');
                  $('#frm_create_clinic')[0].reset();
                  reload_clinics();
                  alert("Successfully Added");
                  $('#btnCreateClinic').text('Save'); //change button text
                  $('#btnCreateClinic').attr('disabled',false); //set button enable 
                }
            }
   });
}

function add_sec() {
  $('#frm_addsec')[0].reset(); 
    $('.form-group').removeClass('has-error');  
    $('.error').empty();
  $('#add_sec').modal('show');
}

function createmy_sec() {
  $('#btnCreateSec').text('Saving...');
  $('#btnCreateSec').attr('disabled',true);

   $.ajax({
      url: siteurl+"clinic_admin/addusersec/",
      type: "POST",
      data: $('#frm_addsec').serialize(),
      dataType: "JSON",
          success: function(resp) {
                console.log(resp);
                $('.error').html('');
                if(resp.status == false) {
                  $.each(resp.message,function(i,m){
                      $('.'+i).text(m);
                  });
                  $('#btnCreateSec').text('Save'); //change button text
                  $('#btnCreateSec').attr('disabled',false); //set button enable 
                }
                else if(resp.status == true) {
                  $('#add_sec').modal('hide');
                  $('#frm_addsec')[0].reset(); 
                  reload_sec();
                  alert("Successfully Added");
                  $('#btnCreateSec').text('Save'); //change button text
                  $('#btnCreateSec').attr('disabled',false); //set button enable 
                }
            }
   });
  }

</script>
