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
    <p class="dashboard-p">Manage Secretary</p>
 </div>
    <!-- Content Header (Page header) -->
    <section class="content">
        <div class="row">
          
        </div><!-- row -->

    </section>
      
</div><!-- content-wrapper -->

<!-- ==============================================================
            MODALS
 ================================================================== -->
<div class="modal fade" id="add_bill" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header  btn-success">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h3 class="modal-title">Patient's Bill</h3>
      </div><!-- modal-header -->
            <div class="modal-body">
              <form class="form-horizontal" id="payment">
                <div class="form-group">
                  <input type="hidden" name="patient_id" id="patient_id">
                  <input type="hidden" name="check_up_id" id="check_up_id">
                  <input type="hidden" id="date_save" name="date_save" value="<?php echo date('y/m/d');?>"/>
                  <label for="clinic-address" class="control-label col-sm-4">Bill Amount</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="bill_amt" id="bill_amt" placeholder="Amount">
                    <span class="help-block"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                <div class="form-group">
                  <label for="clinic-address" class="control-label col-sm-4">Patient's Bill</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="p_bill" id="p_bill" placeholder="Amount">
                    <span class="help-block"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
                <div class="form-group" id="sukli">
                  <label for="clinic-address" class="control-label col-sm-4">Patient's Change</label>
                  <div class="col-sm-6">
                    <label class="control-label" id="bill_change"></label>
                    <span class="help-block"></span>
                  </div><!-- col-sm-6 -->
                </div><!-- form-group -->
              </form><!-- form-horizontal -->
            </div><!-- modal-body -->
            <div class="modal-footer">
              <button type="button" id="btnPay" onclick="save_bill()" class="btn btn-primary">Generate O.R.</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div><!-- modal-footer -->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- add_bill -->

<div class="modal fade large" id="generate_or" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header  btn-success">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h3 class="modal-title">Official Receipt</h3>
            </div>
            <div class="modal-body">
                <div id="printmeor">
                  <div class="border">
                    <div class="row">
                        <div class="rcliniclogo" style="background-image: url()">
                        </div>
                        <div class="col-md-12 text-center">
                          <div class="header-cert">
                          <p class="certheader">Republic of the Philippines</p>
                          <p class="certheader" id="rclinic_name"></p>
                          <p class="certheader"><label id="rclinic_address"></label>, &nbsp; <label id="rcity_name"></label> </p>
                          <p class="certheader"><label id="rprovince_name"></label>, &nbsp; <label id="rzipcode"></label> </p>
                          </div><!-- header-cert -->
                        </div>
                        <div class="col-md-12 text-center">
                          <p class="rmedcert">Official Receipt</p>
                        </div>
                    </div><!-- row -->

                    <div class="row">
                      <div class="col-md-3">
                        <p class="receiptno">No. <label id="rno"></label></p>
                      </div>
                      <div class="col-md-4 col-md-offset-5">
                        <p class="rdate">Date: <u><?php echo "".date(' M j, Y'); ?></u></p>
                      </div>
                    </div><!-- row -->
                    <div class="margrec">
                    <div class="row">
                      <div class="col-md-11">
                        <p class="recieve">Received from <label id="rpatient"></label></p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-11">
                        <p class="recieve">The sum of (amount in words): <label id="ramtwords"></label></p>
                      </div>
                    </div>
                    </div>

                    <div class="margrec">
                    <div class="row">
                      <div class="col-md-5">
                      <p class="totalmt">Total Amount paid: <label id="totalamt"></label></p>
                      </div>
                      <div class="col-md-4 col-md-offset-2">
                      <p class="underline">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_________________</p>
                      </div>
                    </div>
                    </div>
                    
                </div><!-- border -->
            </div><!-- printme -->
            </div><!-- modal-body -->
            <div class="modal-footer">
              <button type="button" id="btnPay" onclick="print_cert('printmeor')" class="btn btn-primary"><span class="fa fa-print"></span> Print</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div><!-- modal-footer -->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- generate_cert -->


<script type="text/javascript">
var siteurl = "<?php print site_url(); ?>";
var a = ['','One ','Two ','Three ','Four ', 'Five ','Six ','Seven ','Eight ','Nine ','Ten ','Eleven ','Twelve ','Thirteen ','Fourteen ','Fifteen ','Sixteen ','Seventeen ','Eighteen ','Nineteen '];
var b = ['', '', 'Twenty','Thirty','Forty','Fifty', 'Sixty','Seventy','Eighty','Ninety'];

function inWords (num) {
    if ((num = num.toString()).length > 9) return 'overflow';
    n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
    if (!n) return; var str = '';
    str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'ten million ' : '';
    str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'hundred thousand ' : '';
    str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
    str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
    str += (n[5] != 0) ? ((str != '') ? ' and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + '' : '';
    return str;
}

$(document).ready(function() {
    show_finished_check_up();
});

function save_bill() {
  $('#btnPay').text('Saving...');
  $('#btnPay').attr('disabled',true);
  var change = $('#p_bill').val() - $('#bill_amt').val();
  if(change < 0) {
    alert("Please Check the bill of Patient");
    $('#btnPay').text('Generate O.R');
    $('#btnPay').attr('disabled',false);
  }
  else if($.trim($('#p_bill').val()) == ''){
      alert('Input can not be left blank');
      $('#btnPay').text('Generate O.R');
      $('#btnPay').attr('disabled',false);
  }
  else if($.trim($('#bill_amt').val()) == ''){
      alert('Input can not be left blank');
      $('#btnPay').text('Generate O.R');
      $('#btnPay').attr('disabled',false);
  }
  else {
  $('#sukli').css('visibility','visible');
  $('#bill_change').text("P"+ change);
  $('#generate_or').modal('show');
  var check_up_id = $('.modal-body #check_up_id').val();
  receipt_details(check_up_id);
  
  var p_bill = $('.modal-body #bill_amt').val();
  patient_det(check_up_id);
  var words = inWords(p_bill);
  $('.modal-body #ramtwords').text(words +"pesos only");
  $('.modal-body #totalamt').text(" P"+p_bill+".00"+" ");
    $.ajax({
      url: siteurl+"billing/bill_id",
      type: "POST",
      data: $('#payment').serialize(),
      dataType: "JSON",
        success: function(data) {
          $('#btnPay').text('Generate O.R');
          $('#btnPay').attr('disabled',false);
          alert("Successfully Save!");
          window.location.reload();
        } 
    });

  } 
}

function receipt_details(check_up_id) {
  $.ajax({
    url: siteurl+"billing/receipt_det/"+check_up_id,
    type: "GET",
    dataType: "JSON",
      success: function(data) {
        $('.modal-body #rclinic_name').text(data[0]['clinic_name']);
        $('.modal-body #rclinic_address').text(data[0]['clinic_address']);
        $('.modal-body #rcity_name').text(data[0]['city_name']);
        $('.modal-body #rprovince_name').text(data[0]['province_name']);
        $('.modal-body #rzipcode').text(data[0]['zip_code']);
        $('.rcliniclogo').css('background-image', 'url(' + data[0]['clinic_logo'] + ')');
      }
  });
}

function patient_det(check_up_id) {
  $.ajax({
      url: siteurl+"sec_billing/details_patient/"+check_up_id,
      type: "GET",
      dataType: "JSON",
        success: function(data) {
          $('.modal-body #rpatient').text(data[0]['patient_fname']+'  '+data[0]['patient_mname']+'  '+data[0]['patient_lname'] +' ');
        }
  });
}

</script>




