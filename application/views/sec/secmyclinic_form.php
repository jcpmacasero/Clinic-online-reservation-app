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
  <div class="clinichead-p">
    <p class="dashboard-p">Clinics</p>
 </div>
 <section class="content-header">
    <div class="row">
        <div class="col-md-12">
          <div class="clinic-p">
           <h4> Welcome to your assigned clinics  !</h4>
          </div><!-- clinic-p -->
        </div><!-- col-md-12 -->
      </div><!-- row -->
      <div class="row">
        <div class="col-md-6">
        <div class="container">
        <div class="row">
          <div class="col-md-4">
            Assigned Doctors: &nbsp;
            <select class="form-control" id="user_id">
            <option></option>
            <?php foreach($doctors as $each){ ?>
                <option value="<?php echo $each->user_id; ?>">Dr. &nbsp;<?php echo $each->user_fname; echo " "; echo $each->user_lname; ?></option>';
            <?php } ?> 
            </select>
          </div><!-- col-md-4 -->
        </div><!-- row -->
        <br>
        <div class="row">
          <div class="col-md-4">
            Clinic: &nbsp;
            <select class="form-control" id="myclinic_id">
            </select>
          </div><!-- col-md-4 -->
          <div class="col-md-2">
            Clinic Status: &nbsp;
            <select class="form-control" id="myclinic_stat" name="myclinic_stat">
                <option value="0">-- SELECT OPTION --</option>
                <option value="OPEN">OPEN</option>
                <option value="CLOSE">CLOSE</option>
            </select>
          </div><!--  col-md-4 -->
        </div>

        <div class="row">
        <div class="addnewpatient">
            <div class="col-sm-7">
            <div class="box box-success box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Patient</h3>
                    <div class="box-tools pull-right">
                        
                        <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            <div class="box-body">
                      <div class="row">
                        <div class="col-sm-11">
                          <button onclick="modalpatient()" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Register Patient</button>
                        </div>
                      </div>

                      <div class="mydata">
                        <div class="row">
                          <div class="col-sm-12">
                          <div class="dataTable_wrapper">
                            <table id="dataTables-patients"  class="table table-striped table-hover table-bordered dt-responsive wrap" style="width: 100%;" width="100%">
                                <thead>
                                    <tr>                                         
                                        <th>First Name</th>
                                        <th>Last Name</th>                                               
                                        <th>Middle Name</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                          </div><!-- dataTable_wrapper -->
                          </div>
                        </div>
                      </div>
                  </div><!-- panel-body -->
                  <!-- <div class="box-footer  pull-right">
                      <button onclick="modalpatient()" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add to queue</button>
                  </div> panel-footer -->
              </div><!-- box box-success  -->
              </div><!-- col-sm-6 -->
            </div><!-- addnewpatient -->
        </div><!-- row -->

      </div><!-- container -->
      </div><!-- col-md-6 -->
      <div class="col-md-4 col-md-offset-2">
        <button class="btn btn-primary btn-xs" onclick="resetqueue();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;Reset Queue</button>
          <h4> Patients in Queue </h4>
        <div class="boxqueue" id="boxqueue">

        </div><!-- box -->
      </div>
      </div><!-- row -->
 </section>
</div><!-- content-wrapper -->


<!-- ==============================================================
            MODALS
 ================================================================== -->
<div class="modal fade" id="modalregpatient" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header  btn-success">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h3 class="modal-title">Register Patient</h3>
      </div><!-- modal-header -->
            <div class="modal-body">
                <form class="form-horizontal" id="frm_patientreg">
                <div class="up-image">
                    <input type="file" name="file" id="files" required>
                    <span class="error 0"></span>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3" for="pafname">First Name:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control" id="pafname" name="pafname" style="text-transform: capitalize;" placeholder="First name" required>
                    <span class="error pafname"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3" for="pamname">Middle Name:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control" id="pamname" name="pamname" style="text-transform: capitalize;" placeholder="Middle name" required>
                    <span class="error pamname"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3" for="palname">Last Name:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control" id="palname" name="palname" style="text-transform: capitalize;" placeholder="Last name" required>
                    <span class="error palname"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3" for="paaddress">Address:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control" id="paaddress" name="paaddress" style="text-transform: capitalize;" placeholder="Address" required>
                    <span class="error paaddress"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3" for="pacontact">Contact #:</label>
                  <div class="col-sm-7">
                    <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control" id="pacontact" name="pacontact" placeholder="Contact number" maxlength="11" required>
                    <span class="error pacontact"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3" for="pabdate">Birthdate:</label>
                  <div class="col-sm-5">
                    <div class="input-group date" data-provide="datepicker">
                        <input type="text" class="form-control" id="pabdate" name="pabdate" placeholder="Birthdate" required>
                        <span class="error pabdate"></span>
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                    </div>
                  </div>
                </div>          
                <div class="form-group">
                  <label class="control-label col-sm-3" for="psex">Blood type:</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="bloodtype" name="bloodtype" style="text-transform: capitalize;" placeholder="Blood type (optional)" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3" for="psex">Gender:</label>
                  <div class="col-sm-5">
                    <select class="form-control" id="psex" name="psex">                                          
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <span class="error psex"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3" for="pmartialstat">Civil Status:</label>
                  <div class="col-sm-5">
                    <select class="form-control" id="pmartialstat" name="pmartialstat">                        
                        <option value="Single">Single</option>
                        <option value="Living common law">Living common law</option>
                        <option value="Married">Married</option>
                        <option value="Widowed">Widowed</option>
                        <option value="Separated">Separated</option>
                        <option value="Divorced">Divorced</option>
                    </select>
                    <span class="error pmartialstat"></span>
                  </div>
                </div>
                </form>
            </div><!-- modal-body -->
            <div class="modal-footer">
              <button onclick="regpatient()" id="SecRegPatient" class="btn btn-primary">Register Patient</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div><!-- modal-footer -->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modalregpatient -->

<div class="modal fade" id="modaleditpatient" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header  btn-success">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h3 class="modal-title">Edit Patient</h3>
      </div><!-- modal-header -->
            <div class="modal-body">
                <div class="row">
                  <div class="image-container">
                    <div class="profile-picpatient" id="picpatient">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3 col-md-offset-3">
                  <form id="form-upload">            
                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                      <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                      <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new"><i class="glyphicon glyphicon-paperclip"></i> Select file</span><input type="file" name="file"></span>
                      <a href="#" id="upload-btnpatient" class="input-group-addon btn btn-success fileinput-exists"><i class="glyphicon glyphicon-open"></i> Upload</a>
                    </div>
                  </form>
                  </div>
                </div>
                <br>
                <form class="form-horizontal" id="frm_patientedit">
                <div class="form-group">
                  <label class="control-label col-sm-3" for="paeditfname">First Name:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control" id="paeditfname" name="paeditfname" style="text-transform: capitalize;" placeholder="First name" required>
                    <span class="error paeditfname"></span>
                  </div>
                </div> 
                <input type="hidden" class="form-control" id="pid" name="pid" style="text-transform: capitalize;" placeholder="Middle name" required>
                <div class="form-group">
                  <label class="control-label col-sm-3" for="paeditmname">Middle Name:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control" id="paeditmname" name="paeditmname" style="text-transform: capitalize;" placeholder="Middle name" required>
                    <span class="error paeditmname"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3" for="paeditlname">Last Name:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control" id="paeditlname" name="paeditlname" style="text-transform: capitalize;" placeholder="Last name" required>
                    <span class="error paeditlname"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3" for="paeditaddress">Address:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control" id="paeditaddress" name="paeditaddress" style="text-transform: capitalize;" placeholder="Address" required>
                    <span class="error paeditaddress"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3" for="paeditcontact">Contact #:</label>
                  <div class="col-sm-7">
                    <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control" id="paeditcontact" name="paeditcontact" placeholder="Contact number" maxlength="11" required>
                    <span class="error paeditcontact"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3" for="paeditbdate">Birthdate:</label>
                  <div class="col-sm-5">
                    <div class="input-group date" data-provide="datepicker">
                        <input type="text" class="form-control" id="paeditbdate" name="paeditbdate" placeholder="Birthdate" required>
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                        <span class="error paeditbdate"></span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3" for="paeditage">Age:</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="paeditage" name="paeditage" placeholder="Age" readonly>
                    <span class="error paeditage"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3" for="paeditblood">Blood type:</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="paeditblood" name="paeditblood" placeholder="Blood type">
                    <span class="error paeditblood"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3" for="peditsex">Gender:</label>
                  <div class="col-sm-5">
                    <select class="form-control" id="peditsex" name="peditsex">
                        <option value=""></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <span class="error peditsex"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3" for="paeditmartialstat">Civil Status:</label>
                  <div class="col-sm-5">
                    <select class="form-control" id="paeditmartialstat" name="paeditmartialstat">
                        <option value=""></option>
                        <option value="Single">Single</option>
                        <option value="Living common law">Living common law</option>
                        <option value="Married">Married</option>
                        <option value="Widowed">Widowed</option>
                        <option value="Separated">Separated</option>
                        <option value="Divorced">Divorced</option>
                    </select>
                    <span class="error paeditmartialstat"></span>
                  </div>
                </div>
                </form>
            </div><!-- modal-body -->
            <div class="modal-footer">
              <button onclick="editmypatient()" id="EditSecPatientBtn" class="btn btn-primary"><i class="fa fa-refresh"></i> Update Patient</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div><!-- modal-footer -->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modaleditpatient -->

<div class="modal fade" id="modalhistory" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header  btn-success">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h3 class="modal-title">Patient History</h3>
      </div><!-- modal-header -->
            <div class="modal-body">
                <div class="mydata">
                        <div class="row">
                          <div class="col-sm-10 col-sm-offset-1">
                          <div class="dataTable_wrapper">
                            <table id="dataTables-patienthist"  class="table table-striped table-bordered table-hover dataTable dtr-inline" role="grid" style="width: 100%;" width="100%" aria-describedby="dataTables-material">
                                <thead>
                                    <tr> 
                                        <th>Check-up ID</th>
                                        <th>Check-up Date</th>
                                        <th></th>                                               
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                          </div><!-- dataTable_wrapper -->
                          </div>
                        </div>
                      </div>
            </div><!-- modal-body -->
            <div class="modal-footer">
              <button type="button" id="btn_printhistory" class="btn btn-primary"><span class="fa fa-print"></span> Print</button>                            
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div><!-- modal-footer -->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modaleditpatient -->

<div class="modal fade" id="modalmyhist" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header  btn-success">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h3 class="modal-title">Check-up Info</h3>
      </div><!-- modal-header -->
            <div class="modal-body">
                <div class="client-form" id="print-client-form">
                  <div class="row">
                  &nbsp; &nbsp; &nbsp;Check-up Date: <label for="histcheckdate" id="histcheckdate"></label>
                  </div>
                <h3> &nbsp; Patients Information </h3>
                  <table class="table-borderless">
                      <tr>
                          <td width="130"><label for="fname" class="patientinfo">&nbsp;First Name:</label></td>
                          <td><label class="lblforprint" id="histfname" name="histfname" for="histfname"></label></td>
                      <tr>
                      <tr>
                          <td><label for="mname" class=" patientinfo">&nbsp;Middle Name:</label></td>
                          <td><label class="lblforprint" id="histmname" name="histmname" for="histmname"></label></td>
                      </tr>
                      <tr>
                          <td><label for="lname" class="patientinfo">&nbsp;Last Name:</label></td>
                          <td><label class="lblforprint" id="histlname" name="histlname" for="histlname"></label></td>
                      </tr>
                      <tr>
                          <td><label for="address" class="patientinfo">&nbsp;Address:</label></td>
                          <td><label class="lblforprint" id="histadd" name="histadd" for="histadd"></label></td>
                      </tr>
                      <tr>
                          <td><label for="contact" class="patientinfo">&nbsp;Contact #:</label></td>
                          <td><label class="lblforprint" id="histcont" name="histcont" for="histcont"></label></td>
                      </tr>
                      <tr>
                          <td><label for="sex" class="patientinfo">&nbsp;Gender:</label></td>
                          <td><label class="lblforprint" id="histsex" name="histsex" for="histsex"></label></td>
                      </tr>
                      <tr>
                          <td><label for="cvilstat" class="patientinfo">&nbsp;Civil Status:</label></td>
                          <td><label class="lblforprint" id="histcvstat" name="histcvstat" for="histcvstat"></label></td>
                      </tr>
                      <tr>
                          <td><label for="bday" class="patientinfo">&nbsp;Birthdate:</label></td>
                          <td><label class="lblforprint" id="histbday" name="histbday" for="histbday"></label></td>
                      </tr>
                      <tr>
                          <td><label for="age" class="patientinfo">&nbsp;Age:</label></td>
                          <td><label class="lblforprint" id="histage" name="histage" for="histage"></label></td>
                      </tr>
                      <tr>
                          <td><label for="height" class="patientinfo">&nbsp;Height:</label></td>
                          <td><label class="lblforprint" id="histheight" name="histheight" for="histheight"></label></td>
                      </tr>
                      <tr>
                          <td><label for="weight" class="patientinfo">&nbsp;Weight:</label></td>
                          <td><label class="lblforprint" id="histweight" name="histweight" for="histweight"></label></td>
                      </tr>
                      <tr>
                          <td><label for="bloodtype" class="patientinfo">&nbsp;Blood Type:</label></td>
                          <td><label class="lblforprint" id="histblood" name="histblood" for="histblood"></label></td>
                      </tr>
                      <tr>
                          <td><label for="complaint" class="red">&nbsp; Complaint:</label></td>
                          <td><label class="lblforprint" name="tcomplaint" id="histcomplaint" for="tcomplaint"></td>
                      </tr>
                      <tr>
                          <td><label for="note" class="red">&nbsp; Note:</label></td>
                          <td><label class="lblforprint" name="tnote" id="histnote" for="tnote"></td>
                      </tr>
                      <tr>
                          <td><label for="findings" id="lblpres" class="red">&nbsp; Prescription:</label></td>
                          <td><label class="lblforprint" name="tfindings" id="histfindings" for="tfindings"></td>
                      </tr>
                      <tr>
                          <td><label for="findings" class="red">&nbsp; Diagnosis:</label></td>
                          <td><label class="lblforprint" name="tdiagnosis" id="histdiagnosis" for="tdiagnosis"></td>
                      </tr>
                  </table>
                        <div class="clicked_patient_pic" style="background-image: url()">
                        </div><!-- clicked_patient_pic -->
                </div><!-- client-form -->

            </div><!-- modal-body -->
            <div class="modal-footer">
              <button type="button" id="btn_printhist" onclick="printcheckinfo()" class="btn btn-primary"><span class="fa fa-print"></span> Print</button>              
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div><!-- modal-footer -->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modaleditpatient -->


<script type="text/javascript">
var siteurl = "<?php print site_url(); ?>";
var userID;
var clinicID;
var clinicStat;
var lastQueueID = null;
var patient_ID;
var lastcountQueue = null;
var interval = 0;
var table_patients_sec;
var countinsec = 0;

var lastCon = [];


$(document).ready(function() {
table_patients_sec = $('#dataTables-patients').dataTable();
$('#dataTables-patienthist').dataTable();
$('#btnR').tooltip({html:true});
$('#btnR2').tooltip({html:true});
});

function reload_patients_sec(){
    table_patients_sec.ajax.reload(null,false);  
}

function printcheckinfo() {
    var divToPrint = document.getElementById('print-client-form');
    var htmlToPrint = '' +
    '<style >' +    
    '</style>';
  
    htmlToPrint += divToPrint.outerHTML;
    newWin = window.open("");
    newWin.document.write(htmlToPrint);
    newWin.print();
    newWin.close();
}

function show_allpatient(userID) {
    table_patients_sec = $("#dataTables-patients").dataTable().fnDestroy();

    table_patients_sec =  $('#dataTables-patients').DataTable({ 
      "ajax": {
              "url": "<?php echo site_url('sec_myclinic/viewall_patients/')?>"+userID,
              "type": "POST",
          },
          responsive: true,
          dom: 'Bfrtip',
          buttons: [
                  {
                    extend: "csv",
                    className: "btn-sm"
                  },
                  {
                    extend: "excel",
                    className: "btn-sm"
                  },
                  {
                    extend: "pdfHtml5",
                    className: "btn-sm"
                  },
                  {
                    extend: "print",
                    className: "btn-sm"
                  },
                ],
});
}

function patient_hist(patient_id) {
    $("#dataTables-patienthist").dataTable().fnDestroy();

    table =  $('#dataTables-patienthist').DataTable({ 
      "ajax": {
              "url": "<?php echo site_url('sec_myclinic/check_uphistory/')?>"+patient_id,
              "type": "POST",
          },
          responsive: true,
          dom: 'Bfrtip',
          buttons: [
                  {
                    extend: "csv",
                    className: "btn-sm"
                  },
                  {
                    extend: "excel",
                    className: "btn-sm"
                  },
                  {
                    extend: "pdfHtml5",
                    className: "btn-sm"
                  },
                  {
                    extend: "print",
                    className: "btn-sm"
                  },
                ],
}); 
}


$(function () {
    var inputFile = $('input[name=file]');

    $('#upload-btnpatient').on('click', function(event) {
        var fileToUpload = inputFile[0].files[0];
        if(fileToUpload != 'undefine') {
            var formData = new FormData($('#form-upload')[0]);
            $.ajax({
                type: "POST",
                url: siteurl+"sec_myclinic/patient_picture/"+$('#pid').val(),
                data: formData,
                processData: false,
                contentType: false,
                success: function(msg) {
                    alert("Picture updated!");
                    refreshdiv($('#pid').val());
                }
            });
        }
    });
});

function refreshdiv(patient_id) {
  $("#picpatient").empty();
  $.ajax({
    url: siteurl+"sec_myclinic/getpic/"+patient_id,
    type: "GET",
    dataType: "JSON",
      success: function(data) {
        $("#picpatient").append('<img src="'+data[0]['patient_photo']+'" style="max-height: 192px; max-width: 192px;"/>');
      }
  });
}

$('#user_id').change(function(){
    clearInterval(interval);
    $("#myclinic_id").empty();
    $("#boxqueue").empty();
    var selectedUserid = $(this).val();
    userID = selectedUserid;
    getclinics(userID);
    statusClinic(clinicID, userID);
    show_allpatient(userID);
});

$('#myclinic_id').change(function(){
    clearInterval(interval);
    lastQueueID = 0;
    $("#boxqueue").empty();
    var selectedClinicID = $(this).val();
    clinicID = selectedClinicID; 
    statusClinic(clinicID, userID);
    show_patients(clinicID, userID);
    
    if(selectedClinicID != "0" || selectedClinicID != undefined){
    interval = setInterval(function(){
    check_getqueue(clinicID, userID); 
    }, 4000);  
    }
});

$('#myclinic_stat').change(function(){
    var selectedStat = $(this).val();
    clinicStat = selectedStat
    if(selectedStat != "0") {
        $.ajax({
          url: siteurl+"sec_myclinic/updateClinicStat/"+clinicID+"/"+userID,
          type: "POST",
          data:{clinic_status:selectedStat},
          dataType: "JSON",
            success: function(data) {
              alert("Clinic Status Updated");
            }
        });
    }
});

$('.datepicker').datepicker({
    format: 'yyyy/mm/dd'    // pass here your desired format
 });

function check_getqueue(clinicID, userID) {
var tmpCountQ = [];
  $.ajax({
    url: siteurl+"sec_myclinic/checkingUpdates/"+clinicID+"/"+userID,
    type: "POST",
    dataType: "JSON",
    success: function(data) {
      for(var i=0;i<data.length;i++) {
        tmpCountQ.push(data[i]['queue_id']);
      };
      if(typeof lastCon[0] != "undefined")  {
        for(var j=0;j < tmpCountQ.length;j++) {
          if(tmpCountQ[j] != lastCon[j]) {
            refresh_afterdel(clinicID, userID);
            lastCon[j] = tmpCountQ[j];  
            // console.log("TOP "+tmpCountQ);
          }
          else if(tmpCountQ.length != lastCon.length) {
            refresh_afterdel(clinicID, userID);
            lastCon = tmpCountQ;
      
            // console.log("MID "+tmpCountQ);
          }
          
        } 
      }
      if(tmpCountQ.length < 1) {
          $("#boxqueue").empty();
          lastCon.pop();   
      }
      else {
       lastCon = tmpCountQ;
       
       if(lastCon.length == 1) {
          countinsec = countinsec + 1; 
          if(countinsec == 1) {
           refresh_afterdel(clinicID, userID);
          }
       }
      }
      
      // console.log("tmpCountQ "+tmpCountQ);
      // console.log("lastCon "+lastCon);
    }
  });
}

function modalpatient() {
  if(userID.length > 0){
    $('#frm_patientreg')[0].reset();
    $('.form-group').removeClass('has-error'); 
    $('.error').empty();
    $('#modalregpatient').modal('show');
  } else {
    alert("Please select Doctor first");
  }
  
}

function regpatient() {
  $('#SecRegPatient').text('Saving...');
  $('#SecRegPatient').attr('disabled',true);
  var formData = new FormData($("#frm_patientreg")[0]);
  formData.append('file', $('#files')[0].files);

   $.ajax({
        url: siteurl+"sec_myclinic/addpatient/"+userID,
        type: "POST",
        data: formData,
        dataType: "JSON",
        processData: false,
        contentType: false,
        cache: false,
          success: function(resp) {
                console.log(resp);
                $('.error').html('');
                if(resp.status == false) {
                  $.each(resp.message,function(i,m){
                      $('.'+i).text(m);
                  });
                  $('#SecRegPatient').text('Save'); //change button text
                  $('#SecRegPatient').attr('disabled',false); //set button enable 
                }
                else if(resp.status == true) {
                  $('#modalregpatient').modal('hide');
                  $('#frm_patientreg')[0].reset();
                  reload_patients_sec();
                  alert("Successfully Added");
                  $('#SecRegPatient').text('Save'); //change button text
                  $('#SecRegPatient').attr('disabled',false); //set button enable 
                }
            }
   });
  
}

function getclinics(userID){
  $.ajax({
      url: siteurl+"sec_myclinic/getclinics/"+userID,
      type: "GET",
      dataType: "JSON",
        success: function(data) {
            $('#myclinic_id').append('<option value=' +0+ '>' + '----------------------- SELECT OPTION -----------------------' + '</option>');
          $.each(data, function(key, value) {
            $('#myclinic_id').append('<option value=' + value['clinic_id'] + '>' + value['clinic_name'] + '</option>');
          });
        }
  })
}

function statusClinic(getClinicID, userID) {
  $.ajax ({
    url: siteurl+"sec_myclinic/myclinic_stat/"+getClinicID+"/"+userID,
    type: "GET",
    dataType: "JSON",
      success: function(data) {
          if(data.length>0) {
            $("#myclinic_stat").val(data[0]['clinic_status']);  
          }
          else {
            $("#myclinic_stat").val('0');  
          }
          
      },
      error: function (textStatus, errorThrown) {
          $("#myclinic_stat").val('0');
      }
  });
}

function show_patients(getClinicID, userID){
  $.ajax({
        url: siteurl+"sec_myclinic/get_patients/"+getClinicID+"/"+lastQueueID+"/"+userID,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          if(data.length>0) {
            for(i=0;i<data.length;i++) {
              lastQueueID = data[i]['order_num'];
              $('#boxqueue').append('<div class="col-sm-10">'+'<div class="panel-group">'+'<div class="panel panel-info">'+
                                  '<div class="panel-heading">'+'<h4><a data-toggle="collapse" href="#patientinfo'+data[i]['patient_id']+'">'+data[i]['order_num']+' '+data[i]['patient_lname']+', '+data[i]['patient_fname']+' <span class="fa fa-arrow-circle-o-down pull-right"></span></a></h4>'+
                                  '</div><!-- panel-heading -->'+'<div id="patientinfo'+data[i]['patient_id']+'" class="panel-collapse collapse">'+'<div class="panel-body">'+'<div class="row">'+
                                  '<div class="col-sm-5">'+'<small>Patient ID: <label id="patientID">'+data[i]['patient_id']+'</label></small>'+''+'<button onclick="checkstatus('+data[i]['patient_id']+');" id="btn'+data[i]['patient_id']+'" class="btn btn-success btn-xs btncustsec">View History</button>'+'<button onclick="removequeue('+data[i]['queue_id']+');this.disabled=true;" id="btn'+data[i]['patient_id']+'" class="btn btn-danger btn-xs btnmarg btncustsec">&nbsp;&nbsp;&nbsp; Remove &nbsp;&nbsp;&nbsp;</button>'+'</div><!-- col-sm-4 -->'+'<div class="col-sm-6">'+
                                  '<div class="img-patient">'+'<div class="patient-pic" style="background-image: url('+data[i]['patient_photo']+')"></div>'+'</div><!-- img-patient -->'+'</div><!-- col-sm-6 -->'+'</div><!-- row -->'+
                                  '</div><!-- panel-body -->'+'</div><!-- panel-collapse -->'+'</div><!-- panel -->'+'</div><!-- panel-group -->'+'</div><!-- col-sm-10 -->');
            };            
          }
          else {
          }
        }
  });
}

function checkstatus(patient_id) {
  $('#modalhistory').modal('show');
  patient_hist(patient_id);
}

function refresh_afterdel(getClinicID, userID) {
  $.ajax({
        url: siteurl+"sec_myclinic/get_patients_refresh/"+getClinicID+"/"+userID,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            if(data.length>0) {
            $("#boxqueue").empty();
            for(i=0;i<data.length;i++) {
              $('#boxqueue').append('<div class="col-sm-10">'+'<div class="panel-group">'+'<div class="panel panel-info">'+
                                  '<div class="panel-heading">'+'<h4><a data-toggle="collapse" href="#patientinfo'+data[i]['patient_id']+'">'+data[i]['order_num']+' '+data[i]['patient_lname']+', '+data[i]['patient_fname']+' <span class="fa fa-arrow-circle-o-down pull-right"></span></a></h4>'+
                                  '</div><!-- panel-heading -->'+'<div id="patientinfo'+data[i]['patient_id']+'" class="panel-collapse collapse">'+'<div class="panel-body">'+'<div class="row">'+
                                  '<div class="col-sm-5">'+'<small>Patient ID: <label id="patientID">'+data[i]['patient_id']+'</label></small>'+''+'<button onclick="checkstatus('+data[i]['patient_id']+');" id="btn'+data[i]['patient_id']+'" class="btn btn-success btn-xs btncustsec">View History</button>'+'<button onclick="removequeue('+data[i]['queue_id']+');this.disabled=true;" id="btn'+data[i]['patient_id']+'" class="btn btn-danger btn-xs btnmarg btncustsec">&nbsp;&nbsp;&nbsp;&nbsp; Remove &nbsp;&nbsp;&nbsp;&nbsp;</button>'+'</div><!-- col-sm-4 -->'+'<div class="col-sm-6">'+
                                  '<div class="img-patient">'+'<div class="patient-pic" style="background-image: url('+data[i]['patient_photo']+')"></div>'+'</div><!-- img-patient -->'+'</div><!-- col-sm-6 -->'+'</div><!-- row -->'+
                                  '</div><!-- panel-body -->'+'</div><!-- panel-collapse -->'+'</div><!-- panel -->'+'</div><!-- panel-group -->'+'</div><!-- col-sm-10 -->');
            };            
          }
        }
  });  
}

function addtoqueue(patient_id) {
  if(clinicID != undefined || clinicStat != undefined) {
    if (confirm("Are you sure you want to add this in queue?")) {
      $.ajax({
          url: siteurl+"sec_myclinic/patientaddqueue",
          type: "POST",
          data: {patient_id:patient_id,clinic_id:clinicID,user_id:userID},
          dataType: "JSON",
            success: function(data) {         
              refresh_afterdel(clinicID,userID);
               alert("Patient Successfully Added");
            }
      });
    }
  }
  else{
    alert("There is no clinic selected");
  }
}

function editpatient(patient_id){
  $("#picpatient").empty();
  $.ajax({
      url: siteurl+"sec_myclinic/getmydetails/"+patient_id,
      type: "GET",
      dataType: "JSON",
        success: function(data) {
          $('#paeditfname').val(data[0]['patient_fname']);
          $('#paeditmname').val(data[0]['patient_mname']);
          $('#paeditlname').val(data[0]['patient_lname']);
          $('#paeditaddress').val(data[0]['patient_address']);
          $('#paeditcontact').val(data[0]['patient_contact_info']);
          $('#paeditage').val(data[0]['patient_age']);
          $('#paeditblood').val(data[0]['patient_blood']);
          $('#paeditbdate').val(data[0]['patient_bday']);
          $('#peditsex').val(data[0]['patient_sex']);
          $('#paeditmartialstat').val(data[0]['patient_civil_status']);
          $("#picpatient").append('<img src="'+data[0]['patient_photo']+'" style="max-height: 192px; max-width: 192px;"/>');
          $('#pid').val(patient_id);
        }
  });
  $('.error').empty();
  $('#modaleditpatient').modal('show');
}

function editmypatient() {
   var patient_id = $('#pid').val();
   $('#EditSecPatientBtn').text('Saving...');
   $('#EditSecPatientBtn').attr('disabled',true);
   $.ajax({
          url: siteurl+"sec_myclinic/editmypatient/"+patient_id+"/"+userID,
          type: "POST",
          data: $('#frm_patientedit').serialize(),
          dataType: "JSON",
          success: function(resp) {
                console.log(resp);
                $('.error').html('');
                if(resp.status == false) {
                  $.each(resp.message,function(i,m){
                      $('.'+i).text(m);
                  });
                  $('#EditSecPatientBtn').text('Update'); //change button text
                  $('#EditSecPatientBtn').attr('disabled',false); //set button enable 
                }
                else if(resp.status == true) {
                  $('#modaleditpatient').modal('hide');
                  reload_patients_sec();
                  alert("Successfully Updated");
                  $('#EditSecPatientBtn').text('Update'); //change button text
                  $('#EditSecPatientBtn').attr('disabled',false); //set button enable 
                }
            }
   });
}

function removequeue(queue_id) {
  if (confirm("Are you sure you want to remove this in queue?")) {
    $.ajax({
      url: siteurl+"sec_myclinic/removetoqueue/"+queue_id,
      type: "POST",
      dataType: "JSON",
        success: function(data){
          $("#boxqueue").empty();
          refresh_afterdel(clinicID,userID);
          //lastQueueID = lastQueueID - 1;
        }
    });
  }
}

function checkupdetails(checkup_id) {
  $('.modal-body #histdiagnosis').text("");
   $.ajax({
    url: siteurl+"sec_myclinic/myhistdet/"+checkup_id,
    type: "GET",
    dataType: "JSON",
      success: function(data){
        var newData = data['selecthist_diagnosis']        // take the input array,
              .map(function(v) { return v['diagnosis'] })  // map it to get the required values,
              .join(", ")                                  // join the result with commas
            var md = $('#histdiagnosis')
            md.text(md.text() + newData)

          $('.modal-body #histcheckdate').text(data['selecthist'][0]['check_up_date']);
          $('.modal-body #histfname').text(data['selecthist'][0]['patient_fname']);
          $('.modal-body #histmname').text(data['selecthist'][0]['patient_mname']);
          $('.modal-body #histlname').text(data['selecthist'][0]['patient_lname']);
          $('.modal-body #histadd').text(data['selecthist'][0]['patient_address']);
          $('.modal-body #histcont').text(data['selecthist'][0]['patient_contact_info']);
          $('.modal-body #histsex').text(data['selecthist'][0]['patient_sex']);
          $('.modal-body #histcvstat').text(data['selecthist'][0]['patient_civil_status']);
          $('.modal-body #histbday').text(data['selecthist'][0]['patient_bday']);
          $('.modal-body #histage').text(data['selecthist'][0]['patient_age']);
          $('.modal-body #histheight').text(data['selecthist'][0]['patient_height']);
          $('.modal-body #histweight').text(data['selecthist'][0]['patient_weight']);
          $('.modal-body #histblood').text(data['selecthist'][0]['patient_blood']);
          $('.modal-body #histcomplaint').text(data['selecthist'][0]['complaint']);
          $('.modal-body #histnote').text(data['selecthist'][0]['note']);
          $('.modal-body #histfindings').text(data['selecthist'][0]['finding']); 
          $('.clicked_patient_pic').css('background-image', 'url(' + data['selecthist'][0]['patient_photo'] + ')');                
      }
  })
  $('#modalmyhist').modal('show');
}

function resetqueue() {
  if (confirm('Are you sure to reset queue number? \nThe next patient to be added in queue will be labelled as queue number 1.')) {
      $.ajax({
          url: siteurl+"Sec_myclinic/queue_reset",
          type: "GET",
          dataType: "JSON",
            success: function(resp) {
                alert('Queue number successfully reset');
            }
      })
  } else {
      // Do nothing!
  }
}

</script>
