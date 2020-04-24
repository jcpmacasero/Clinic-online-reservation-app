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

  <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="clinic-p">
           <h4> Welcome to your Clinic  !</h4>
          </div><!-- clinic-p -->
        </div><!-- col-md-12 -->
      </div><!-- row -->

            <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="col-title">
          
          <div class="row">
          <div class="col-md-1">
          Clinic:
          </div>
          <div class="col-md-3">
          <select class="form-control" id="myclinic_id">
            <option></option>
            <?php foreach($clinic_id as $each){ ?>
                <option value="<?php echo $each->clinic_id; ?>"><?php echo $each->clinic_name; ?></option>';
            <?php } ?> 
          </select>
          </div>
          <div class="col-md-1">
          Clinic Status:
          </div>
          <div class="col-md-3">
          <select class="form-control" name="clinic_stat" id="clinic_stat">
            <option value="0">--- SELECT OPTION ---</option>
            <option value="OPEN">OPEN</option>
            <option value="CLOSE">CLOSE</option>
          </select>
          </div>
          </div>
            <br>
          </div><!-- col-title -->
          <div class="row">
        <div class="checkuppatient">
            <div class="box box-success box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Check-up</h3>
                    <div class="box-tools pull-right">
                        <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            <div class="box-body">
            <h5 id="checkupID">Check-up ID: &nbsp;<label id="checkID"></label> </h5>
            <div class="patient-face">
                <img src="" id="checkup_pic">
            </div>
                <h3>Patients Information</h3>                
                  <form class="form-horizontal" name="frm_diagnosis" id="frm_diagnosis">
                         <div class="form-group">
                            <label class="control-label col-sm-2" id="labelcheck-up" for="fname">First name:</label>
                            <div class="col-sm-10">                              
                                <label id="valfname" class="form-control" name="valfname" for="valfname"></label>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" id="labelcheck-up" for="fname">Middle Name:</label>
                            <div class="col-sm-10">                              
                                <label id="valmname" class="form-control" name="valmname" for="valmname"></label>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" id="labelcheck-up" for="fname">Last Name:</label>
                            <div class="col-sm-10">                              
                                <label id="vallname" class="form-control" name="vallname" for="vallname"></label>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" id="labelcheck-up" for="fname">Address:</label>
                            <div class="col-sm-10">                              
                                <label id="valad" class="form-control" name="valad" for="valad"></label>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" id="labelcheck-up" for="fname">Contact #:</label>
                            <div class="col-sm-10">                              
                                <label id="valcont" class="form-control" name="valcont" for="valcont"></label>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" id="labelcheck-up" for="fname">Sex:</label>
                            <div class="col-sm-10">                                                              
                                <label id="valsex" class="form-control" name="valsex" for="valsex"></label>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" id="labelcheck-up" for="fname">Civil Status:</label>
                            <div class="col-sm-10">                              
                                <label id="valcvilstat" class="form-control" name="valcvilstat" for="valcvilstat"></label>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" id="labelcheck-up" for="fname">Birthdate:</label>
                            <div class="col-sm-10">                              
                                <label id="valbday" class="form-control" name="valbday" for="valbday"></label>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" id="labelcheck-up" for="fname">Age:</label>
                            <div class="col-sm-10">                              
                                <label id="valage" class="form-control" name="valage" for="valage"></label>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" id="labelcheck-up" for="fname">Blood type:</label>
                            <div class="col-sm-10">                              
                                <label id="valage" class="form-control" name="valblood" for="valblood"></label>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" id="labelcheck-up" for="fname">Height:</label>
                            <div class="col-sm-2">                              
                                <input type="text" name="thepatientheight" id="thepatientheight" class="form-control" placeholder="cm">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" id="labelcheck-up" for="fname">Weight:</label>
                            <div class="col-sm-2">                              
                                <input type="text" name="thepatientweight" id="thepatientweight" class="form-control" placeholder="kg">
                            </div>
                          </div>
                          <input type="hidden" id="queue_id" name="queue_id">
                          <input type="hidden" id="date_save" name="date_save" value="<?php echo date('y/m/d g:i a');?>"/>
                          <input type="hidden" id="patient_id" name="patient_id">
                          <div class="form-group">
                            <label class="control-label col-sm-2" id="labelcheck-up" for="fname">Complaint:</label>
                            <div class="col-sm-2">                              
                                <textarea name="tcomplaint" id="tcomplaint" class="form-control docnote"  placeholder="Please input patients complaint here"></textarea>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" id="labelcheck-up" for="fname">Note:</label>
                            <div class="col-sm-2">                              
                                <textarea name="tnote" id="tnote" class="form-control docnote" placeholder="Please input notes here"></textarea>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" id="labelcheck-up" for="fname">Prescription:</label>
                            <div class="col-sm-2">                              
                                <textarea  name="tfindings" id="tfindings" class="form-control docnote" placeholder="Please input patients prescription here"></textarea>
                                <span class="help-block"></span>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" id="labelcheck-up" for="fname">Diagnosis:</label>
                            <div class="col-sm-2">                              
                                <select name="tdiagnosis[]" id="tdiagnosis" class="form-control select2 diagnote"  multiple="multiple" data-placeholder="Please input diagnosis here">
                                  <?php foreach($diagnosis_id as $each){ ?>
                                    <option value="<?php echo $each->diagnosis_id; ?>" title="<?php echo $each->description; ?>"><?php echo $each->diagnosis; ?></option>
                                  <?php } ?>
                                </select>
                            </div>
                          </div>                      
                    </form>                 
                    <button onclick="pending_diag()" class="btn btn-success btn-xs diagbtn"><span class="fa fa-plus"></span>&nbsp;Add Diagnosis</button>
                <input type="hidden" id="queue_id" name="queue_id">
                <input type="hidden" id="date_save" name="date_save" value="<?php echo date('y/m/d g:i a');?>"/>
                <input type="hidden" id="patient_id" name="patient_id">                
                <div class="row text-center btnfin">
                  <button onclick="finish_check()" class="btn btn-primary btn-md">Finish Check up</button>
                </div>
                     
            </div><!-- panel-body -->      
            </div><!-- box box-success  -->
      </div><!-- checkuppatient -->

        <div class="addnewpatient">
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
                                        <th>Patient ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>                                               
                                        <th>Middle Name</th>
                                        <th>Gender</th>
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
            </div><!-- addnewpatient -->
        

        </div><!-- row -->
        </div><!-- col-md-8 -->
        <div class="col-md-4">
          <div class="col-title">
            <button class="btn btn-primary btn-xs" onclick="resetqueue();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;Reset Queue</button>
          <h4> Patients in Queue </h4>

          <div class="queue" id="queue">
          </div><!-- queue -->

          </div><!-- col-title -->
        </div>
      </div><!-- row -->
      </div><!-- container -->
  </section>
    
</div><!-- content-wrapper -->


<!-- ==============================================================
            MODALS
 ================================================================== -->

 <div class="modal fade" id="modalhistory" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header  btn-success">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h3 class="modal-title">Patient History</h3>
      </div><!-- modal-header -->
            <div class="modal-body">
                <div class="mydata" id="histprint">
                        <div class="row">
                          <div class="col-sm-12">
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
              <button type="button" onclick="printDiv()" id="btn_printhistory" class="btn btn-primary"><span class="fa fa-print"></span> Print</button>                            
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
                  <label class="control-label col-sm-3" for="pmname">Middle Name:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control" id="pamname" name="pamname" style="text-transform: capitalize;" placeholder="Middle name" required>
                    <span class="error pamname"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3" for="plname">Last Name:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control" id="palname" name="palname" style="text-transform: capitalize;" placeholder="Last name" required>
                    <span class="error palname"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3" for="paddress">Address:</label>
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
              <button onclick="regpatient()" id="myregpatient" class="btn btn-primary">Register Patient</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div><!-- modal-footer -->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modalregpatient -->

<div class="modal fade" id="modaldiagnosis" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header  btn-success">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h3 class="modal-title">Add Diagnosis</h3>
      </div><!-- modal-header -->
            <div class="modal-body">
              <form class="form-horizontal" id="frm_diagnosis_doc">
                <div class="form-group">
                  <label class="control-label col-sm-3" for="docdiag">Diagnosis:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control" id="docdiag" name="docdiag" style="text-transform: capitalize;" placeholder="Diagnosis" required>
                    <span class="error docdiag"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3" for="doc_desc">Description:</label>
                  <div class="col-sm-7">
                    <textarea class="form-control custom-control" rows="2" id="doc_desc" name="doc_desc" style="text-transform: capitalize;" placeholder="Description" style="resize:none"></textarea>
                    <span class="error doc_desc"></span>
                  </div>
                </div>                
              </form>
            </div><!-- modal-body -->
            <div class="modal-footer">
              <button onclick="add_doc_diag()" id="AddDiagBtn" class="btn btn-primary"><i class="fa fa-plus"></i> Add Diagnosis</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div><!-- modal-footer -->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modaldiagnosis -->

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
                    <input type="hidden" id="patient_id_hide" name="patient_id_hide">            
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

<script type="text/javascript">
var siteurl = "<?php print site_url(); ?>";
var getClinicID;
var lastQueueID = null;
var interval = 0;
var lastCon = [];
var table_patients,table_hist;
var countme = 0;

$(document).ready(function() {
  table_hist = $('#dataTables-patienthist').dataTable();
  table_patients = $('#dataTables-patients').dataTable();
  show_allpatient();
  $('#btnR').tooltip({html:true});
  $('#btnR1').tooltip({html:true});
  $('#btnR2').tooltip({html:true});
  $(".select2").select2();
});

$(function () {
    var inputFile = $('input[name=file]');    

    $('#upload-btnpatient').on('click', function(event) {
        var fileToUpload = inputFile[0].files[0];
        if(fileToUpload != 'undefine') {
            var formData = new FormData($('#form-upload')[0]);            
            formData.append('file', fileToUpload);
            $.ajax({
                type: "POST",
                url: siteurl+"myclinic/profile_picture",
                data: formData,
                processData: false,
                contentType: false,
                success: function(msg) {
                    alert("Profile picture updated!");
                    refreshpicdiv($('#patient_id_hide').val());
                }
            });
        }
    });
});

function refreshpicdiv(patient_id) {
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


function reload_patients(){
    table_patients.ajax.reload(null,false);  
}

$('#myclinic_id').change(function(){
    clearInterval(interval);
    lastQueueID = 0;
    $("#queue").empty();
    var selectedClinicID = $(this).val();
    getClinicID = selectedClinicID;
    show_patients(getClinicID);
    $('#concatClinicID').val(getClinicID);
    checkupme(getClinicID);
    statusClinic(getClinicID);
    
    if(selectedClinicID != "0" || selectedClinicID != undefined){
    interval = setInterval(function(){
    check_getqueue(getClinicID); 
    }, 4000);  
    } else {
      clearInterval(interval);
    }

});
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

function check_getqueue(clinicID) {
var tmpCountQ = [];
  $.ajax({
    url: siteurl+"myclinic/checkingUpdates/"+clinicID,
    type: "POST",
    dataType: "JSON",
    success: function(data) {
      for(var i=0;i<data.length;i++) {
        tmpCountQ.push(data[i]['queue_id']);
      };
      if(typeof lastCon[0] != "undefined")  {
        for(var j=0;j < tmpCountQ.length;j++) {
          if(tmpCountQ[j] != lastCon[j]) {
            refresh_afterdel(clinicID);
            lastCon[j] = tmpCountQ[j];  
          }
          else if(tmpCountQ.length != lastCon.length) {
            refresh_afterdel(clinicID); 
          }
        } 
      }

       if(tmpCountQ.length < 1) {
          $("#queue").empty();
          lastCon.pop();   
      }

      else {
       lastCon = tmpCountQ;
       
       if(lastCon.length == 1) {
          countme = countme + 1; 
          if(countme == 1) {
            refresh_afterdel(clinicID);
          }
       }
      }
      
      console.log("tmpCountQ "+tmpCountQ);
      // console.log("lastCon "+lastCon);
    }
  });
}

function addtoqueue(patient_id) {
  if(getClinicID != undefined ) {
    if (confirm("Are you sure you want to add this in queue?")) {
      $.ajax({
          url: siteurl+"myclinic/patientaddqueue",
          type: "POST",
          data: {patient_id:patient_id,clinic_id:getClinicID},
          dataType: "JSON",
            success: function(data) {
              refresh_afterdel(getClinicID);
              alert("Patient Successfully Added");
            }
      });
    }
  }
  else{
    alert("There is no clinic selected");
  }
}

function removequeuedoc(queue_id) {
  if (confirm("Are you sure you want to remove this in queue?")) {
    $.ajax({
      url: siteurl+"myclinic/removetoqueue/"+queue_id,
      type: "POST",
      dataType: "JSON",
        success: function(data){
          refresh_afterdel(getClinicID);
          alert("Patient Successfully Remove")
        }
    });
  } else {

  }
}

function show_patients(getClinicID) {
  $.ajax({
        url: siteurl+"myclinic/get_patients/"+getClinicID+"/"+lastQueueID,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          if(data.length>0) {
            for(i=0;i<data.length;i++) {
              lastQueueID = data[i]['order_num'];
              $('#queue').append('<div class="col-sm-10">'+'<div class="panel-group">'+'<div class="panel panel-info">'+
                                  '<div class="panel-heading">'+'<h4><a data-toggle="collapse" href="#patientinfo'+data[i]['patient_id']+'">'+data[i]['order_num']+' '+data[i]['patient_lname']+', '+data[i]['patient_fname']+' <span class="fa fa-arrow-circle-o-down pull-right"></span></a></h4>'+
                                  '</div><!-- panel-heading -->'+'<div id="patientinfo'+data[i]['patient_id']+'" class="panel-collapse collapse">'+'<div class="panel-body">'+'<div class="row">'+
                                  '<div class="col-sm-5">'+'<small>Patient ID: <label id="patientID">'+data[i]['patient_id']+'</label></small>'+''+'<button onclick="checkstatus('+data[i]['patient_id']+','+data[i]['queue_id']+');this.disabled=true;" id="btn'+data[i]['patient_id']+'" class="btn btn-success btn-sm btncust ">Check me up</button>'+'<button onclick="checkstatus1('+data[i]['patient_id']+');" id="btn'+data[i]['patient_id']+'" class="btn btn-success btn-xs btncust1 ">View History</button>'+
                                  '<button onclick="removequeuedoc('+data[i]['queue_id']+');" id="btn'+data[i]['patient_id']+'" class="btn btn-danger btn-xs btnmarg btncust">&nbsp;&nbsp;&nbsp; Remove &nbsp;&nbsp;&nbsp;</button>'+'</div><!-- col-sm-4 -->'+'<div class="col-sm-6">'+
                                  '<div class="img-patient">'+'<div class="patient-pic" style="background-image: url('+data[i]['patient_photo']+')"></div>'+'</div><!-- img-patient -->'+'</div><!-- col-sm-6 -->'+'</div><!-- row -->'+
                                  '</div><!-- panel-body -->'+'</div><!-- panel-collapse -->'+'</div><!-- panel -->'+'</div><!-- panel-group -->'+'</div><!-- col-sm-10 -->');
            };            
          }
          else {
            //$('#queue').append('<h4> No Patients in queue </h4>');
          }
        }
  });
}

function refresh_afterdel(getClinicID) {
$("#queue").empty();
  $.ajax({
        url: siteurl+"myclinic/get_patients_refresh/"+getClinicID,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            if(data.length>0) {
              $("#queue").empty();
            for(i=0;i<data.length;i++) {
              $('#queue').append('<div class="col-sm-10">'+'<div class="panel-group">'+'<div class="panel panel-info">'+
                                  '<div class="panel-heading">'+'<h4><a data-toggle="collapse" href="#patientinfo'+data[i]['patient_id']+'">'+data[i]['order_num']+' '+data[i]['patient_lname']+', '+data[i]['patient_fname']+' <span class="fa fa-arrow-circle-o-down pull-right"></span></a></h4>'+
                                  '</div><!-- panel-heading -->'+'<div id="patientinfo'+data[i]['patient_id']+'" class="panel-collapse collapse">'+'<div class="panel-body">'+'<div class="row">'+
                                  '<div class="col-sm-5">'+'<small>Patient ID: <label id="patientID">'+data[i]['patient_id']+'</label></small>'+''+'<button onclick="checkstatus('+data[i]['patient_id']+','+data[i]['queue_id']+');this.disabled=true;" id="btn'+data[i]['patient_id']+'" class="btn btn-success btn-sm btncust ">Check me up</button>'+'<button onclick="checkstatus1('+data[i]['patient_id']+');" id="btn'+data[i]['patient_id']+'" class="btn btn-success btn-xs btncust1">View History</button>'+
                                  '<button onclick="removequeuedoc('+data[i]['queue_id']+');" id="btn'+data[i]['patient_id']+'" class="btn btn-danger btn-xs btnmarg btncust1">&nbsp;&nbsp;&nbsp; Remove &nbsp;&nbsp;&nbsp;</button>'+'</div><!-- col-sm-4 -->'+'<div class="col-sm-6">'+
                                  '<div class="img-patient">'+'<div class="patient-pic" style="background-image: url('+data[i]['patient_photo']+')"></div>'+'</div><!-- img-patient -->'+'</div><!-- col-sm-6 -->'+'</div><!-- row -->'+
                                  '</div><!-- panel-body -->'+'</div><!-- panel-collapse -->'+'</div><!-- panel -->'+'</div><!-- panel-group -->'+'</div><!-- col-sm-10 -->');
            };            
          }
        }
  });  
}

function checkstatus1(patient_id) {
  $('#modalhistory').modal('show');
  patient_hist(patient_id);
}

function patient_hist(patient_id) {
    $("#dataTables-patienthist").dataTable().fnDestroy();

    table_hist =  $('#dataTables-patienthist').DataTable({ 
      "ajax": {
              "url": "<?php echo site_url('myclinic/check_uphistory/')?>"+patient_id,
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

function checkupdetails(checkup_id) {
  $('.modal-body #histdiagnosis').text("");
  $.ajax({
    url: siteurl+"myclinic/myhistdet/"+checkup_id,
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

function checkstatus(id,queue_id) {

var newid = id;
    $.ajax ({
      url: siteurl+"myclinic/checkstatus",
      type: "GET",
      dataType: "JSON",
      success: function(data) {
        if(data.length>0) {
          oldstat(data[0]['patient_id'],data[0]['queue_id']);
          upstat(newid,queue_id);
          
        }
        else {
          upstat(newid,queue_id);
          
        }

      }
    })
}

function oldstat(patient_id,queue_id) {
  var old = patient_id;

  $.ajax({
    url: siteurl+"myclinic/update_old/"+old+"/"+queue_id,
    type: "POST",
    dataType: "JSON",
    success: function(data) {

    }
  })
}

function upstat(id,queue_id) {
  var upid = id;
  
  $.ajax({
    url: siteurl+"myclinic/get_checkup/"+upid+"/"+queue_id,
    type: "POST",
    dataType: "JSON",
    success: function(data) {
      checkupme(getClinicID);
      getcheckupID(getClinicID);
      refresh_afterdel(getClinicID);
    }
  })

}

function checkupme(getClinicID) {
  $('#valfname').empty();
  $('#valmname').empty();
  $('#vallname').empty();
  $('#valad').empty();
  $('#valcont').empty();
  $('#valsex').empty();
  $('#valcvilstat').empty();
  $('#valbday').empty();
  $('#valage').empty();
  $('#valblood').empty();
  $("#checkup_pic").empty();
  $('#queue_id').empty();
  $('#patient_id').empty();
  document.getElementById('thepatientweight').style.display = "block";
  document.getElementById('thepatientheight').style.display = "block";
  $.ajax({
    url: siteurl+"myclinic/checkupinfo/"+getClinicID,
    type: "GET",
    dataType: "JSON",
    success: function(data) {
        $('#valfname').text(data[0]['patient_fname']);
        $('#valmname').text(data[0]['patient_mname']);
        $('#vallname').text(data[0]['patient_lname']);
        $('#valad').text(data[0]['patient_address']);
        $('#valcont').text(data[0]['patient_contact_info']);
        $('#valsex').text(data[0]['patient_sex']);
        $('#valcvilstat').text(data[0]['patient_civil_status']);
        $('#valbday').text(data[0]['patient_bday']);
        $('#valage').text(data[0]['patient_age']);
        $('#valblood').text(data[0]['patient_blood']);
        $("#checkup_pic").attr('src', data[0]['patient_photo']);
        $('#queue_id').val(data[0]['queue_id']);
        $('#patient_id').val(data[0]['patient_id']);
        getcheckupID(getClinicID);
    }
  })
}

function getcheckupID(getClinicID) {
var init = 0;
var value = getClinicID;
var concat;

  $.ajax ({
    url: siteurl+"myclinic/getcheckID",
    type: "GET",
    dataType: "JSON",
      success: function(data) {
          $('#checkID').text(data['check_up_id'] + "-" + value);
          $("#checkID").css('visibility','visible');  
    }
  }) 
}

function statusClinic(getClinicID) {
  $.ajax ({
    url: siteurl+"myclinic/myclinic_stat/"+getClinicID,
    type: "GET",
    dataType: "JSON",
      success: function(data) {
          $("#clinic_stat").val(data[0]['clinic_status']);
      },
      error: function (textStatus, errorThrown) {
          $("#clinic_stat").val('0');
      }
  });
}

function finish_check() {
  if (typeof(getClinicID) == "undefined") {
    alert("No clinic selected! ");
  }
  else {
    var checkupid = $('#checkID').html();
    var queue_id = $('#queue_id').val();
    var clinic_id = getClinicID;
    var patient_id = $('#patient_id').val();
    var validateselect = $('#tdiagnosis > option:selected');

    if(patient_id == "") {
      alert("No patient selected");
    }
    else {
      if($('#thepatientheight').val() == "") {
        alert("Height is empty!");
      }
      else if($('#thepatientweight').val() == "") {
        alert("Weight is empty!");
      }
      else if($('#tcomplaint').val() == "") {
        alert("Complaint is empty!");
      }
      else if($('#tnote').val() == "") {
        alert("Note is empty!");
      }
      else if($('#tfindings').val() == "") {
        alert("Findings is empty!");
      }
      else if(validateselect.length == 0) {
        alert("Diagnosis is empty!");
      }
      else {
        $.ajax({
        url: siteurl+"myclinic/finish_checkup/"+patient_id+"/"+queue_id+"/"+checkupid+"/"+clinic_id,
        type: "POST",
        data: $('#frm_diagnosis').serialize(),
        dataType: "JSON",
        success: function(data) {
          if (confirm('Check up finished, Proceed to billing?')) {
              window.location.href = '<?php echo base_url(); ?>Billing';
          } else {
            refresh_afterdel(getClinicID);
            checkupme(getClinicID);
            getcheckupID(getClinicID);
            $("#frm_diagnosis")[0].reset();
            var myselect = document.getElementById("tdiagnosis");
            var length = myselect.options.length;
            for (i = 0; i < length; i++) {
              myselect.options[i] = null;
            }
          }          
        }
        });  
      }
    }
  }
}

$('#clinic_stat').change(function(){
    var selectedStat = $(this).val();
    if(!!getClinicID) {
        $.ajax({
          url: siteurl+"myclinic/updateClinicStat/"+getClinicID,
          type: "POST",
          data:{clinic_status:selectedStat},
          dataType: "JSON",
            success: function(data) {
              alert("Clinic Status Updated");
            }
        });
    }

});

function show_allpatient() {
    $("#dataTables-patients").dataTable().fnDestroy();

    table_patients =  $('#dataTables-patients').DataTable({ 
      "ajax": {
              "url": "<?php echo site_url('myclinic/viewall_patients')?>",
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

function modalpatient() {
  $('#frm_patientreg')[0].reset();
  $('.form-group').removeClass('has-error'); 
  $('.error').empty();
  $('#modalregpatient').modal('show');  
}

function regpatient() {
  $('#myregpatient').text('Saving...');
  $('#myregpatient').attr('disabled',true);   
  var formData = new FormData($("#frm_patientreg")[0]);
  formData.append('file', $('#files')[0].files);

   $.ajax({
      url: siteurl+"myclinic/addpatient",
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
                  $('#myregpatient').text('Save'); //change button text
                  $('#myregpatient').attr('disabled',false); //set button enable 
                }
                else if(resp.status == true) {
                  $('#modalregpatient').modal('hide');
                  $('#frm_patientreg')[0].reset();
                  reload_patients();
                  alert("Successfully Added");
                  $('#myregpatient').text('Save'); //change button text
                  $('#myregpatient').attr('disabled',false); //set button enable 
                }
            }
   });
}

function editpatient(patient_id){
  $("#picpatient").empty();
  $.ajax({
      url: siteurl+"myclinic/getmydetails/"+patient_id,
      type: "GET",
      dataType: "JSON",
        success: function(data) {
          $('#patient_id_hide').val(patient_id);
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
   $('#EditPatientBtn').text('Saving...');
   $('#EditPatientBtn').attr('disabled',true);
   $.ajax({
          url: siteurl+"myclinic/editmypatient/"+patient_id,
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
                  $('#EditPatientBtn').text('Update'); //change button text
                  $('#EditPatientBtn').attr('disabled',false); //set button enable 
                }
                else if(resp.status == true) {
                  $('#modaleditpatient').modal('hide');
                  reload_patients();
                  alert("Successfully Updated");
                  $('#EditPatientBtn').text('Update'); //change button text
                  $('#EditPatientBtn').attr('disabled',false); //set button enable 
                }
            }
   });
}

function pending_diag() {
  $('#frm_diagnosis_doc')[0].reset();
  $('.form-group').removeClass('has-error'); 
  $('.error').empty();
  $('#modaldiagnosis').modal('show');
}

function add_doc_diag() {
  $('#AddDiagBtn').text('Saving...');
  $('#AddDiagBtn').attr('disabled',true);

   $.ajax({
      url: siteurl+"myclinic/add_doc_diagnosis",
      type: "POST",
      data: $('#frm_diagnosis_doc').serialize(),
      dataType: "JSON",
          success: function(resp) {
                console.log(resp);
                $('.error').html('');
                if(resp.status == false) {
                  $.each(resp.message,function(i,m){
                      $('.'+i).text(m);
                  });
                  $('#AddDiagBtn').text('Save'); //change button text
                  $('#AddDiagBtn').attr('disabled',false); //set button enable 
                }
                else if(resp.status == true) {
                  $('#modaldiagnosis').modal('hide');
                  $('#frm_diagnosis_doc')[0].reset();
                  alert("Success!. Your request is in pending");
                  $('#AddDiagBtn').text('Save'); //change button text
                  $('#AddDiagBtn').attr('disabled',false); //set button enable 
                }
            }
   });
}

function resetqueue() {
  if (confirm('Are you sure to reset queue number? \nThe next patient to be added in queue will be labelled as queue number 1.')) {
      $.ajax({
          url: siteurl+"myclinic/queue_reset",
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


