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
  <div class="clinic-chat-p">
    <p class="dashboard-p">Records</p>
 </div>

 <section class="content">
 <div class="search-details">
      <p> Welcome to Search Page, the generated data showed below are the finished patient for today's check-up. 
      To search for the last dates check-up, please click the dropdown and choose for categories by search. </p>
 </div>
 <div class="search-content">
      <div class="row">
      
        </div><!-- row -->

        <div class="row">
          <div class="col-md-4">
            Assigned Doctors: &nbsp;
            <select class="form-control" id="user_id">
            <option value="0"></option>
            <?php foreach($doctors as $each){ ?>
                <option value="<?php echo $each->user_id; ?>">Dr. &nbsp;<?php echo $each->user_fname; echo " "; echo $each->user_lname; ?></option>';
            <?php } ?> 
            </select>
          </div><!-- col-md-4 -->
        </div>

        <div class="searchres" id="mydatasearch">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
              <div class="dataTable_wrapper">
                      <table id="dataTables-records"  class="table table-striped table-bordered table-hover dataTable dtr-inline" role="grid" style="width: 100%;" width="100%" aria-describedby="dataTables-material">
                          <thead>
                              <tr> 
                                  <th>Check-up ID</th>
                                  <th>First Name</th>
                                  <th>Last Name</th>                                               
                                  <th>Middle Name</th>
                                  <th>Check-up Date</th>
                                  <th>Profile</th>
                              </tr>
                          </thead>
                          <tbody>
                          </tbody>
                      </table>
              </div><!-- dataTable_wrapper -->
            </div>
        </div><!-- row -->
        </div><!-- searchres -->

      </div><!-- search-content -->
 </section>   
	</div><!-- content-wrapper -->

  <!-- ==============================================================
            MODALS
 ================================================================== -->
<div class="modal fade" id="view_profile" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header  btn-success">
               <h3 class="modal-title">Patient Profile</h3>
      </div>
            <div class="modal-body">
            <label for="checkdate">Check Up Date: &nbsp;<label id="check_my_date"></label></label>
              <form class="form-horizontal" id="frm_create_clinic">
                <div class="profile_pat">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-6">
                              <input type="hidden" name="check_up_id" id="check_up_id">
                              <div class="row">
                                <label for="fname" class="col-sm-5 view_prof">&nbsp;First Name:</label>
                                <div class="col-sm-2 moveleft">
                                  <label id="modalfname_sec" name="modalfname" for="modalfname"></label>
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->
                              <div class="row">
                                <label for="fname" class="col-sm-5 view_prof">&nbsp;Middle Name:</label>
                                <div class="col-sm-2 moveleft">
                                  <label id="modalmname_sec" name="modalmname" for="modalmname"></label>
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->
                              <div class="row">
                                <label for="fname" class="col-sm-5 view_prof">&nbsp;Last Name:</label>
                                <div class="col-sm-2 moveleft">
                                  <label id="modallname_sec" name="modallname" for="modallname"></label>
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->
                              <div class="row">
                                <label for="fname" class="col-sm-5 view_prof">&nbsp;Address:</label>
                                <div class="col-sm-6 moveleft">
                                  <label id="modaladd_sec" name="modaladd" for="modaladd"></label>
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->
                              <div class="row">
                                <label for="fname" class="col-sm-5 view_prof">&nbsp;Contact #:</label>
                                <div class="col-sm-2 moveleft">
                                  <label id="modalcontact_sec" name="modalcontact" for="modalcontact"></label>
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->
                              <div class="row">
                                <label for="fname" class="col-sm-5 view_prof">&nbsp;Sex:</label>
                                <div class="col-sm-2 moveleft">
                                  <label id="modalsex_sec" name="modalsex" for="modalsex"></label>
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->             
                              <div class="row">
                                <label for="fname" class="col-sm-5 view_prof">&nbsp;Civil Status:</label>
                                <div class="col-sm-7 moveleft">
                                  <label id="modalcv_sec" name="modalcv" for="modalcv"></label>
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->
                              <div class="row">
                                <label for="fname" class="col-sm-5 view_prof">&nbsp;Birthdate:</label>
                                <div class="col-sm-4 moveleft">
                                  <label id="modalbday_sec" name="modalbday" for="modalbday"></label>
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->
                              <div class="row">
                                <label for="fname" class="col-sm-5 view_prof">&nbsp;Age:</label>
                                <div class="col-sm-2 moveleft">
                                  <label id="modalage_sec" name="modalage" for="modalage"></label>
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->
                              <div class="row">
                                <label for="fname" class="col-sm-5 view_prof">&nbsp;Height:</label>
                                <div class="col-sm-4 moveleft">
                                  <label id="modalheight_sec" name="modalheight" for="modalheight"></label>
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->
                              <div class="row">
                                <label for="fname" class="col-sm-5 view_prof">&nbsp;Weight:</label>
                                <div class="col-sm-4 moveleft">
                                  <label id="modalweight_sec" name="modalweight" for="modalweight"></label>
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->
                              <div class="row">
                                <label for="fname" class="col-sm-5 view_prof">&nbsp;Blood Type:</label>
                                <div class="col-sm-4 moveleft">
                                  <label id="modalblood_sec" name="modalblood" for="modalblood"></label>
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->
                              <div class="row">
                                <label for="fname" class="col-sm-5 view_prof">&nbsp;Complaint:</label>
                                <div class="col-sm-4">
                                  <textarea name="modalcomplaint" id="modalcomplaint_sec" class="form-control dochist"  readonly></textarea>                            
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->
                              <div class="row">
                                <label for="fname" class="col-sm-5 view_prof">&nbsp;Note:</label>
                                <div class="col-sm-4">
                                  <textarea name="modalnote" id="modalnote_sec" class="form-control dochist"  readonly></textarea>                            
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->
                              <div class="row">
                                <label for="fname" class="col-sm-5 view_prof">&nbsp;Findings:</label>
                                <div class="col-sm-4">
                                  <textarea name="modalfindings" id="modalfindings_sec" class="form-control dochist"  readonly></textarea>                            
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->
                              <div class="row">
                                <label for="fname" class="col-sm-5 view_prof">&nbsp;Diagnosis:</label>
                                <div class="col-sm-4">
                                  <textarea name="modaldiagnosis" id="modaldiagnosis_sec" class="form-control dochist"  readonly></textarea>                            
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->
                          </div><!-- col-md-6 -->
                          <div class="col-md-4">
                              <div class="clicked_patient_pic_sec" style="background-image: url()">
                              </div><!-- clicked_patient_pic -->
                          </div><!-- col-md-4 -->

                        </div><!-- row -->
                      </div><!-- col-md-12 -->
                    </div>
                </div><!-- profile_pat -->
              </form><!-- form-horizontal -->
            </div><!-- modal-body -->
            <div class="modal-footer">
              <button type="button" id="generate_med" onclick="gen_mc_sec()" class="btn btn-primary"><span class="fa fa-certificate"></span> Generate Medical Certificate</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div><!-- modal-footer -->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- view_profile -->

<div class="modal fade large" id="generate_cert" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header  btn-success">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h3 class="modal-title">Print Certificate</h3>
            </div>
            <div class="modal-body">
                <div id="printme">
                  <div class="border">
                    <div class="row">
                        <div class="cliniclogo">
                          <img id="thecliniclogo">
                        </div>
                        <div class="col-md-12 text-center">
                          <div class="header-cert">
                          <p class="certheader">Republic of the Philippines</p>
                          <p class="certheader" id="clinic_name"></p>
                          <p class="certheader"><label id="clinic_address"></label>, &nbsp; <label id="city_name"></label> </p>
                          <p class="certheader"><label id="province_name"></label>, &nbsp; <label id="zipcode"></label> </p>
                          </div><!-- header-cert -->
                        </div>
                        <div class="col-md-12 text-center">
                          <p class="medcert">MEDICAL CERTIFICATE</p>
                        </div>
                    </div><!-- row -->
                    <div class="row">
                      <div class="col-md-4 col-md-offset-10">
                        <p class="printingdate">Date: <u><?php echo "".date(' M j, Y'); ?></u></p>
                      </div>
                    </div><!-- row -->
                    <div class="row">
                      <div class="col-md-4">
                        <p class="certmarg">To Whom It May Concern:</p>
                      </div><!-- col-md-4 -->
                    </div><!-- row -->
                    <div class="row">
                      <div class="col-md-12 justifypar">
                        <p class="startindent">THIS IS TO CERTIFY that &nbsp; <label id="cert_name"></label> &nbsp; of &nbsp; <label id="cert_address"></label>
                         &nbsp; was examined and treated at the &nbsp; <label id="cert_clinic_name"></label> &nbsp; on <label id="cert_check_up_date"></label>
                        with the following diagnosis: &nbsp; <label id="cert_diagnosis"></label> &nbsp; and would need medical attention for 
                        &nbsp; <label id="cert_physician"></label> &nbsp; days barring complication.</p>
                      </div>
                    </div><!-- row -->
                    <div class="signatory">
                        <div class="row">
                            <div class="col-md-4 col-md-offset-8">
                              <u><p id="cert_physician_signatory"><label id="cert_physician_sig"></label>, M.D.</p></u>
                            </div>
                        </div>
                    </div><!-- signatory -->
                  </div><!-- border -->
                </div><!-- printme -->
            </div><!-- modal-body -->
            <div class="modal-footer">
              <button type="button" id="btn_printcert" onclick="printDiv()" class="btn btn-primary"><span class="fa fa-print"></span> Print</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div><!-- modal-footer -->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- generate_cert -->



<script type="text/javascript">
var siteurl = "<?php print site_url(); ?>";
var userID;

$('#user_id').change(function(){
    var selectedUserid = $(this).val();
    userID = selectedUserid;

    if(selectedUserid != "0") {
     show_records(userID);   
    }
});

function gen_mc_sec() {
  var check_up_id = $('.modal-body #check_up_id').val();
  get_clinic_name_sec(check_up_id,userID);
  var fname = $('.modal-body #modalfname_sec').html();
  var mname = $('.modal-body #modalmname_sec').html();
  var lname = $('.modal-body #modallname_sec').html();
  var fullname = fname +"  "+ mname +".  "+lname;

  $('.modal-body #cert_name').text(fullname);
  $('.modal-body #cert_address').text($('.modal-body #modaladd_sec').html());
  $('.modal-body #cert_diagnosis').text($('.modal-body #modaldiagnosis_sec').val());
   $('#generate_cert').modal('show');
}

function get_clinic_name_sec(check_up_id,userID) {
var userfname = "";
var usermname = "";
var userlname = "";
  $.ajax({
    url: siteurl+"sec_searchrecords/get_clinicID/"+check_up_id+"/"+userID,
    type: "GET",
    dataType: "JSON",
    success: function(data) {
       $('.modal-body #clinic_name').text(data[0]['clinic_name']);
       $('.modal-body #clinic_address').text(data[0]['clinic_address']);
       $('.modal-body #city_name').text(data[0]['city_name']);
       $('.modal-body #province_name').text(data[0]['province_name']);
       $('.modal-body #zipcode').text(data[0]['zip_code']);
       $("#thecliniclogo").attr('src',''+ data[0]['clinic_logo'] +'');
       $('.cliniclogo').css('background-image', 'url(' + data[0]['clinic_logo'] + ')');
       $('.modal-body #cert_clinic_name').text(data[0]['clinic_name']);
       $('.modal-body #cert_physician').text(data[0]['user_fname']+'  '+data[0]['user_mname']+'  '+data[0]['user_lname']);
       $('.modal-body #cert_physician_sig').text(data[0]['user_fname']+'  '+data[0]['user_mname']+'  '+data[0]['user_lname']);
    }
  })
}

function printDiv() {
    var divToPrint = document.getElementById('printme');
    var htmlToPrint = '' +
    '<style >' +
    '@page {' +
        'size: landscape;' +
        '}' +
    'body {' +
        'font-family: arial, sans-serif ;' +
        'font-size: 12px ;' +
        'border-style: double;' +
        '}' +
    '.header-cert{' +
        'text-align: center;' +
        'margin-top: 28px; ' +
        'padding: 0px; ' +
        '}' +
     '.certheader { ' +
          'font-size:20px;' +
          'margin:0px;' +
          'padding:0px;' +
      '}' +
      '.medcert { ' +
          'font-size:38px;' +
          'font-weight: bold;' +
          'text-align: center;' +
          'margin: 58px 58px;' +
          'word-spacing: 12px;' +
      '}' +
      '.printingdate { ' +
          'font-size:19px;' +
          'text-align: left;' +
          'margin-left: 22px;' +
          'margin-bottom: 53px;' +
      '}' +
      '.certmarg { ' +
          'font-size:19px;' +
          'text-align: left;' +
          'margin-left: 22px;' +
      '}' +
      '.startindent { ' +
          'font-size:19px;' +
          'text-align: left;' +
          'margin-left: 22px;' +
          'margin-right: 14px;' +
      '}' +
      '#cert_physician_signatory { ' +          
          'font-size:21px;' +
          'margin-right: 18px;' +
          'font-weight: bold;' +
          'text-align: right;' +          
      '}' +
      '.justifypar { ' +
          'text-align: justify;' +
          'text-justify: inter-word;' +
      '}' +
      '#thecliniclogo { ' +
          'width: 120px;' +
          'height: 120px;' +
          'position: absolute;' +
          'margin-left: 80px;' +
          'display: block;' +
      '}' +

    '</style>';
  
    htmlToPrint += divToPrint.outerHTML;
    newWin = window.open("");
    newWin.document.write(htmlToPrint);
    newWin.print();
    newWin.close();
}

function get_clinic_name_sec(check_up_id) {
var userfname = "";
var usermname = "";
var userlname = "";
  $.ajax({
    url: siteurl+"sec_searchrecords/get_clinicID/"+check_up_id+"/"+userID,
    type: "GET",
    dataType: "JSON",
    success: function(data) {
       $('.modal-body #clinic_name').text(data[0]['clinic_name']);
       $('.modal-body #clinic_address').text(data[0]['clinic_address']);
       $('.modal-body #city_name').text(data[0]['city_name']);
       $('.modal-body #province_name').text(data[0]['province_name']);
       $('.modal-body #zipcode').text(data[0]['zip_code']);
       $('.cliniclogo').css('background-image', 'url(' + data[0]['clinic_logo'] + ')');
       $('.modal-body #cert_clinic_name').text(data[0]['clinic_name']);
       $('.modal-body #cert_physician').text(data[0]['user_fname']+'  '+data[0]['user_mname']+'  '+data[0]['user_lname']);
       $('.modal-body #cert_physician_sig').text(data[0]['user_fname']+'  '+data[0]['user_mname']+'  '+data[0]['user_lname']);
    }
  })
}


function show_records(userID) {
    $("#dataTables-records").dataTable().fnDestroy();

    table =  $('#dataTables-records').DataTable({ 
      "ajax": {
              "url": "<?php echo site_url('sec_searchrecords/viewall/')?>"+userID,
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

function view_profilebutton(check_up_date,check_up_id) {
  $('#modaldiagnosis_sec').val("");
  $(".modal-body #check_up_id").val(check_up_id);
  $(".modal-body #check_my_date").text(check_up_date);
  $.ajax({
    url: siteurl+"sec_searchrecords/view_profbtn",
    type: "POST",
    data: {check_up_id:check_up_id, check_up_date:check_up_date, user_id: userID},
    dataType: "JSON",
    success: function(data){
          var newData = data['checkup_diagnosis']        // take the input array,
              .map(function(v) { return v['diagnosis'] })  // map it to get the required values,
              .join(", ")                                  // join the result with commas
            var md = $('#modaldiagnosis_sec')
            md.val(md.val() + newData)

        $('#modalfname_sec').text(data['checkup_profile'][0]['patient_fname']);
        $('#modalmname_sec').text(data['checkup_profile'][0]['patient_mname']);
        $('#modallname_sec').text(data['checkup_profile'][0]['patient_lname']);
        $('#modaladd_sec').text(data['checkup_profile'][0]['patient_address']);
        $('#modalcontact_sec').text(data['checkup_profile'][0]['patient_contact_info']);
        $('#modalsex_sec').text(data['checkup_profile'][0]['patient_sex']);
        $('#modalcv_sec').text(data['checkup_profile'][0]['patient_civil_status']);
        $('#modalbday_sec').text(data['checkup_profile'][0]['patient_bday']);
        $('#modalage_sec').text(data['checkup_profile'][0]['patient_age']);
        $('#modalheight_sec').text(data['checkup_profile'][0]['patient_height']);
        $('#modalweight_sec').text(data['checkup_profile'][0]['patient_weight']);
        $('#modalblood_sec').text(data['checkup_profile'][0]['patient_blood']);        
        $('#modalcomplaint_sec').val(data['checkup_profile'][0]['complaint']);
        $('#modalnote_sec').val(data['checkup_profile'][0]['note']);
        $('#modalfindings_sec').val(data['checkup_profile'][0]['finding']);
        // $('#modaldiagnosis_sec').val(data[0]['diagnosis']);
        $('.clicked_patient_pic_sec').css('background-image', 'url(' + data['checkup_profile'][0]['patient_photo'] + ')');
    }
  })
  $("#view_profile").modal('show');
}

$(document).ready(function() {
$('#dataTables-records').dataTable();

});
</script>
