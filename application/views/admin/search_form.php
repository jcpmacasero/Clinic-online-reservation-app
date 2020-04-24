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
  <div class="search-head-p">
    <p class="dashboard-p">Records</p>
 </div>
    <!-- Content Header (Page header) -->

<section class="content">
        <div class="search-details">
      <p> Welcome to Search Page, the generated data showed below are the finished patient for today's check-up. 
      To search for the last dates check-up, please click the dropdown and choose for categories by search. </p>
    </div>
    <div class="search-content">
      <div class="row">
      
        </div><!-- row -->

        <div class="searchres">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
              <div class="dataTable_wrapper">
                      <table id="dataTables-records" class="table table-striped table-hover table-bordered dt-responsive wrap" style="width: 100%;" width="100%">
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
               <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                                <div class="col-sm-4 moveleft">
                                  <label id="modalfname" name="modalfname" for="modalfname"></label>
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->
                              <div class="row">
                                <label for="fname" class="col-sm-5 view_prof">&nbsp;Middle Name:</label>
                                <div class="col-sm-4 moveleft">
                                  <label id="modalmname" name="modalmname" for="modalmname"></label>
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->
                              <div class="row">
                                <label for="fname" class="col-sm-5 view_prof">&nbsp;Last Name:</label>
                                <div class="col-sm-4 moveleft">
                                  <label id="modallname" name="modallname" for="modallname"></label>
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->
                              <div class="row">
                                <label for="fname" class="col-sm-5 view_prof">&nbsp;Address:</label>
                                <div class="col-sm-6 moveleft">
                                  <label id="modaladd" name="modaladd" for="modaladd"></label>
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->
                              <div class="row">
                                <label for="fname" class="col-sm-5 view_prof">&nbsp;Contact #:</label>
                                <div class="col-sm-4 moveleft">
                                  <label id="modalcontact" name="modalcontact" for="modalcontact"></label>
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->
                              <div class="row">
                                <label for="fname" class="col-sm-5 view_prof">&nbsp;Sex:</label>
                                <div class="col-sm-4 moveleft">
                                  <label id="modalsex" name="modalsex" for="modalsex"></label>
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->             
                              <div class="row">
                                <label for="fname" class="col-sm-5 view_prof">&nbsp;Civil Status:</label>
                                <div class="col-sm-7 moveleft">
                                  <label id="modalcv" name="modalcv" for="modalcv"></label>
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->
                              <div class="row">
                                <label for="fname" class="col-sm-5 view_prof">&nbsp;Birthdate:</label>
                                <div class="col-sm-4 moveleft">
                                  <label id="modalbday" name="modalbday" for="modalbday"></label>
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->
                              <div class="row">
                                <label for="fname" class="col-sm-5 view_prof">&nbsp;Age:</label>
                                <div class="col-sm-4 moveleft">
                                  <label id="modalage" name="modalage" for="modalage"></label>
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->
                              <div class="row">
                                <label for="fname" class="col-sm-5 view_prof">&nbsp;Height:</label>
                                <div class="col-sm-4 moveleft">
                                  <label id="modalheight" name="modalheight" for="modalheight"></label>
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->
                              <div class="row">
                                <label for="fname" class="col-sm-5 view_prof">&nbsp;Weight:</label>
                                <div class="col-sm-4 moveleft">
                                  <label id="modalweight" name="modalweight" for="modalweight"></label>
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->
                              <div class="row">
                                <label for="fname" class="col-sm-5 view_prof">&nbsp;Blood Type:</label>
                                <div class="col-sm-4 moveleft">
                                  <label id="modalblood" name="modalblood" for="modalblood"></label>
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->
                              <div class="row">
                                <label for="fname" class="col-sm-5 view_prof">&nbsp;Complaint:</label>
                                <div class="col-sm-4">
                                  <textarea name="modalcomplaint" id="modalcomplaint" class="form-control dochist"  readonly></textarea>                            
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->
                              <div class="row">
                                <label for="fname" class="col-sm-5 view_prof">&nbsp;Note:</label>
                                <div class="col-sm-4">
                                  <textarea name="modalnote" id="modalnote" class="form-control dochist"  readonly></textarea>                            
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->
                              <div class="row">
                                <label for="fname" class="col-sm-5 view_prof">&nbsp;Prescription:</label>
                                <div class="col-sm-4">
                                  <textarea name="modalfindings" id="modalfindings" class="form-control dochist"  readonly></textarea>                            
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->
                              <div class="row">
                                <label for="fname" class="col-sm-5 view_prof">&nbsp;Diagnosis:</label>
                                <div class="col-sm-4">
                                  <textarea name="modaldiagnosis" id="modaldiagnosis" class="form-control dochist"  readonly></textarea>                            
                                </div><!-- col-sm-4 -->
                              </div><!-- row -->
                          </div><!-- col-md-6 -->
                          <div class="col-md-4">
                              <div class="clicked_patient_pic_hist" style="background-image: url()">
                              </div><!-- clicked_patient_pic -->
                          </div><!-- col-md-4 -->

                        </div><!-- row -->
                      </div><!-- col-md-12 -->
                    </div>
                </div><!-- profile_pat -->
              </form><!-- form-horizontal -->
            </div><!-- modal-body -->
            <div class="modal-footer">
              <button type="button" id="generate_med" onclick="gen_mc()" class="btn btn-primary"><span class="fa fa-certificate"></span> Generate Medical Certificate</button>
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

function show_records() {
    $("#dataTables-records").dataTable().fnDestroy();

    table =  $('#dataTables-records').DataTable({ 
      "ajax": {
              "url": "<?php echo site_url('search_records/viewall')?>",
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

$(document).ready(function() {
$('#dataTables-records').dataTable();
show_records();
$('#pd2').attr("class","treeview active");
});
</script>
