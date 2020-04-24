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
    <p class="dashboard-p">Diagnosis Control</p>
 </div>
    <!-- Content Header (Page header) -->
    <section class="content">
    <br>
    <div class="editprofile">
            <div class="col-sm-10 col-sm-offset-1">
              <div class="panel-group">
                <div class="panel panel-info">
                  <div class="panel-heading">
                    <h4><a data-toggle="collapse" href="#active">Diagnosis Active/Pending<span class="fa fa-arrow-circle-o-down pull-right"></span></a></h4>
                  </div><!-- panel-heading -->
                </div><!-- panel-group -->

                  <div id="active" class="panel-collapse">
                  <div class="panel-body bgprof">
                     <div class="row">
                        <div class="col-xs-12">
                          <div class="yourprofile">
                             
                          <div class="row">
                              <div class="col-md-12">
                                <div class="dataTable_wrapper">
                                        <table id="dataTables-diagnosis"  class="table table-striped table-bordered table-hover dataTable dtr-inline" role="grid" style="width: 100%;" width="100%" aria-describedby="dataTables-material">
                                            <thead>
                                                <tr> 
                                                    <th>Diagnosis ID</th>
                                                    <th>Diagnosis</th>
                                                    <th>Description</th>
                                                    <th>Status</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                </div><!-- dataTable_wrapper -->
                              </div>
                          </div><!-- row -->

                          </div><!-- yourprofile -->
                        </div><!-- col-xs-12 -->
                     </div><!-- row -->
                  </div><!-- panel-body -->

                  <div class="panel-footer prof-footer" align="right">
                      <button onclick="add_diagnosis()" class="btn btn-primary btn-sm" id="btnAddDiagnosis"><i class="fa fa-plus"></i> Add Diagnosis </button>
                  </div><!-- panel-footer -->
                  </div><!-- panel-collapse -->
              </div><!-- panel -->
            </div><!-- col-sm-6 -->
  </div><!-- editprofile -->
         
    </section>
      
</div><!-- content-wrapper -->

<!-- ==============================================================
            MODALS
 ================================================================== -->

 <div class="modal fade" id="modal_add_diagnosis" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header  btn-success">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h3 class="modal-title">Add Diagnosis</h3>
      </div><!-- modal-header -->
            <div class="modal-body">
                <form class="form-horizontal" id="frm_diagnosis">
                  <div class="form-group">
                    <label class="control-label col-sm-3" for="diagnosis_in">Diagnosis:</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="diagnosis_in" name="diagnosis_in" style="text-transform: capitalize;" placeholder="Disease" required>
                      <span class="error diagnosis_in"></span>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-sm-3" for="description_in">Description:</label>
                    <div class="col-sm-7">
                      <textarea class="form-control custom-control" rows="2" id="description_in" name="description_in" style="text-transform: capitalize;" style="resize:none"></textarea>
                      <!-- <input type="text" class="form-control" id="description_in" name="description_in" style="text-transform: capitalize;" placeholder="Description" required> -->
                      <span class="error description_in"></span>
                    </div>
                  </div>

                  <div class="form-group">
                  <label class="control-label col-sm-3" for="status_in">Status:</label>
                  <div class="col-sm-5">
                    <select class="form-control" id="status_in" name="status_in">
                        <option value=""></option>
                        <option value="ACCEPTED">ACCEPTED</option>
                        <option value="PENDING">PENDING</option>
                    </select>
                    <span class="error status_in"></span>
                  </div>
                </div> 
                </form>
            </div><!-- modal-body -->
            <div class="modal-footer">
              <button type="button" onclick="add_diagnosis_db();" id="btnAddtoDB" class="btn btn-primary">Add Diagnosis</button>                            
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div><!-- modal-footer -->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modaleditpatient -->


<div class="modal fade" id="modaledit_diagnosis" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header  btn-success">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h3 class="modal-title">Edit Diagnosis</h3>
      </div><!-- modal-header -->
            <div class="modal-body">  
              <form class="form-horizontal" id="frm_diagnosistedit">
                <div class="form-group">
                  <label class="control-label col-sm-3" for="editdiagnosis">Diagnosis:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control" id="editdiagnosis" name="editdiagnosis" style="text-transform: capitalize;" placeholder="First name" required>
                    <span class="error editdiagnosis"></span>
                  </div>
                </div> 
                <div class="form-group">
                  <label class="control-label col-sm-3" for="editdescription">Description:</label>
                  <div class="col-sm-7">
                    <textarea class="form-control custom-control" rows="2" id="editdescription" name="editdescription" style="text-transform: capitalize;" style="resize:none"></textarea>
                    <!-- <input type="text" class="form-control" id="editdescription" name="editdescription" style="text-transform: capitalize;" placeholder="First name" required> -->
                    <span class="error editdescription"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-3" for="editstatus">Status:</label>
                  <div class="col-sm-5">
                    <select class="form-control" id="editstatus" name="editstatus">
                        <option value=""></option>
                        <option value="ACCEPTED">ACCEPTED</option>
                        <option value="PENDING">PENDING</option>
                    </select>
                    <span class="error editstatus"></span>
                  </div>
                </div>
                <input type="hidden" class="form-control" id="diagnosis_id_hide" name="diagnosis_id_hide" required> 
              </form>
                
            </div><!-- modal-body -->
            <div class="modal-footer">
              <button onclick="editmy_diagnosis()" id="EditDiagnosisBtn" class="btn btn-primary"><i class="fa fa-refresh"></i> Update Diagnosis</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div><!-- modal-footer -->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modaleditpatient -->

<script type="text/javascript">
var siteurl = "<?php print site_url(); ?>";
var table_diagnosis;

$(document).ready(function() {
  table_diagnosis = $('#dataTables-diagnosis').dataTable();
  show_alldiagnosis();
});

function editmy_diagnosis() {
  var diagnosis_id = $('#diagnosis_id_hide').val();
  $('#EditDiagnosisBtn').text('Saving...');
   $('#EditDiagnosisBtn').attr('disabled',true);
   $.ajax({
          url: siteurl+"admin_diagnosis/diagnosis_edit/"+diagnosis_id,
          type: "POST",
          data: $('#frm_diagnosistedit').serialize(),
          dataType: "JSON",
          success: function(resp) {
                console.log(resp);
                $('.error').html('');
                if(resp.status == false) {
                  $.each(resp.message,function(i,m){
                      $('.'+i).text(m);
                  });
                  $('#EditDiagnosisBtn').text('Update'); //change button text
                  $('#EditDiagnosisBtn').attr('disabled',false); //set button enable 
                }
                else if(resp.status == true) {
                  $('#modaledit_diagnosis').modal('hide');
                  reload_diagnosis();
                  alert("Successfully Updated");
                  $('#EditDiagnosisBtn').text('Update'); //change button text
                  $('#EditDiagnosisBtn').attr('disabled',false); //set button enable 
                }
            }
   });
}

function edit_diagnosis(diagnosis_id) {
  $.ajax({
      url: siteurl+"admin_diagnosis/getdiagnosisdetails/"+diagnosis_id,
      type: "GET",
      dataType: "JSON",
        success: function(data) {
          $('#diagnosis_id_hide').val(diagnosis_id);
          $('#editdiagnosis').val(data[0]['diagnosis']);
          $('#editdescription').val(data[0]['description']);
          $('#editstatus').val(data[0]['status']);
        }
  });
  $('.error').empty();
  $('#modaledit_diagnosis').modal('show');
}

function reload_diagnosis(){
    table_diagnosis.ajax.reload(null,false);  
}

function add_diagnosis_db() {
  $('#btnAddtoDB').text('Saving...');
  $('#btnAddtoDB').attr('disabled',true);

   $.ajax({
      url: siteurl+"admin_diagnosis/add_diagnosis",
      type: "POST",
      data: $('#frm_diagnosis').serialize(),
      dataType: "JSON",
          success: function(resp) {
                console.log(resp);
                $('.error').html('');
                if(resp.status == false) {
                  $.each(resp.message,function(i,m){
                      $('.'+i).text(m);
                  });
                  $('#btnAddtoDB').text('Save'); //change button text
                  $('#btnAddtoDB').attr('disabled',false); //set button enable 
                }
                else if(resp.status == true) {
                  $('#modal_add_diagnosis').modal('hide');
                  $('#frm_diagnosis')[0].reset();
                  reload_diagnosis();
                  alert("Successfully Added");
                  $('#btnAddtoDB').text('Save'); //change button text
                  $('#btnAddtoDB').attr('disabled',false); //set button enable 
                }
            }
   });
}

function add_diagnosis() {
  $('#frm_diagnosis')[0].reset();
  $('.form-group').removeClass('has-error'); 
  $('.error').empty();
  $('#modal_add_diagnosis').modal('show');
}

function show_alldiagnosis() {
    $("#dataTables-diagnosis").dataTable().fnDestroy();

    table_diagnosis =  $('#dataTables-diagnosis').DataTable({ 
      "ajax": {
              "url": "<?php echo site_url('admin_diagnosis/viewall_diagnosis')?>",
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

</script>




