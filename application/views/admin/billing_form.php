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
    <p class="dashboard-p">Clinics</p>
 </div>
    <!-- Content Header (Page header) -->
    <section class="content">
      <div class="row">
        <div class="col-md-11 text-center">
            <h3> Patients to be Billed </h3>
        </div><!-- col-md-11 -->
      </div><!-- row -->

      <div class="row">
        <div class="col-md-12">
          <div class="dataTable_wrapper">
            <table id="dataTables-patienthist" class="table table-striped table-hover table-bordered dt-responsive wrap" style="width: 100%;" width="100%">
                <thead>
                    <tr>
                        <th>Check-up ID</th> 
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Middle Name</th>
                        <th>Clinic</th>
                        <th></th>                                               
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
          </div><!-- dataTable_wrapper -->
        </div>
      </div>

      <br>
      <hr>
      <br>
      <div class="or-reprint">
        <div class="row">
          <div class="col-md-11 text-center">
              <h3> Reprint OR </h3>
          </div><!-- col-md-11 -->
        </div><!-- row -->

        <div class="row">
        <div class="col-md-12">
          <div class="dataTable_wrapper">
            <table id="dataTables-reprint" class="table table-striped table-hover table-bordered dt-responsive wrap" style="width: 100%;" width="100%">
                <thead>
                    <tr>
                        <th>Receipt #</th>
                        <th>Bill Amount</th>
                        <th>Check-up ID</th> 
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
      


      
    </section>
      
</div><!-- content-wrapper -->

<!-- ==============================================================
            MODALS
 ================================================================== -->
<div class="modal fade" id="modal_add_bill" role="dialog">
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
                    <input type="number" id="display">
                    <input type="hidden" id="patient_id">
                    <input type="hidden" id="check_up_id">
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
                            <img id="orthecliniclogo">
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
                      <div class="col-md-4 col-md-offset-5 receiptdate">
                        <p class="rdate">Date: <u><?php echo "".date(' M j, Y'); ?></u></p>
                      </div>
                    </div><!-- row -->
                    <div class="margrec">
                    <div class="row">
                      <div class="col-md-11">
                        <p class="recieve">Received from <label id="rpatientlname"></label> , <label id="rpatientfname"></label></p>
                      </div>
                    </div>
                    <!-- <div class="row">
                      <div class="col-md-11">
                        <p class="recieve">The sum of (amount in words): <label id="ramtwords"></label></p>
                      </div>
                    </div> -->
                    </div>

                    <div class="margrec">
                    <div class="row">
                      <div class="col-md-5 totalpaid">
                      <p class="totalmt">Total Amount paid: <label id="totalamt"></label></p>
                      </div>
                      <div class="col-md-4 col-md-offset-2">
                      <!-- <p class="underline">_________________</p> -->
                      </div>
                    </div>
                    </div>
                    
                </div><!-- border -->
            </div><!-- printme -->
            </div><!-- modal-body -->
            <div class="modal-footer">
              <button type="button" id="btnPay" onclick="printDiv()" class="btn btn-primary"><span class="fa fa-print"></span> Print</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div><!-- modal-footer -->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- generate_cert -->


<script type="text/javascript">
var siteurl = "<?php print site_url(); ?>";
var table_bill;
// var th = ['', 'thousand', 'million', 'billion', 'trillion'];

// var dg = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];

// var tn = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];

// var tw = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

// function toWords(s) {
//     s = s.toString();
//     s = s.replace(/[\, ]/g, '');
//     if (s != parseFloat(s)) return 'not a number';
//     var x = s.indexOf('.');
//     if (x == -1) x = s.length;
//     if (x > 15) return 'too big';
//     var n = s.split('');
//     var str = '';
//     var sk = 0;
//     for (var i = 0; i < x; i++) {
//         if ((x - i) % 3 == 2) {
//             if (n[i] == '1') {
//                 str += tn[Number(n[i + 1])] + ' ';
//                 i++;
//                 sk = 1;
//             } else if (n[i] != 0) {
//                 str += tw[n[i] - 2] + ' ';
//                 sk = 1;
//             }
//         } else if (n[i] != 0) {
//             str += dg[n[i]] + ' ';
//             if ((x - i) % 3 == 0) str += 'hundred ';
//             sk = 1;
//         }
//         if ((x - i) % 3 == 1) {
//             if (sk) str += th[(x - i - 1) / 3] + ' ';
//             sk = 0;
//         }
//     }
//     if (x != s.length) {
//         var y = s.length;
//         str += '& ';
//         for (var i = x + 1; i < y; i++) str += dg[n[i]] + ' ';
//     }
//     return str.replace(/\s+/g, ' ');

// }

document.getElementById("bill_amt").onblur =function (){    
    this.value = parseFloat(this.value.replace(/,/g, ""))
                    .toFixed(2)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    
    document.getElementById("display").value = this.value.replace(/,/g, "")
    
}

$(document).ready(function() {
   table_bill = $('#dataTables-patienthist').dataTable();
   show_finished_check_up();
   reprint_receipt();
});

function printDiv() {
    var divToPrint = document.getElementById('printmeor');
    var htmlToPrint = '' +
    '<style >' +
    'body {' +
        'font-family: arial, sans-serif ;' +
        'font-size: 12px ;' +
        '}' +
    
    '.border{' +
        'border-style: double;' +
        '}' +

   '.header-cert{' +
        'text-align: center;' +
        'margin-top: 28px; ' +
        'padding: 0px; ' +
    '}' +
    '.certheader { ' +
        'font-size:12px;' +
        'margin:0px;' +
        'padding:0px;' +
    '}' +
    '.rmedcert{' +
        'font-size:18px;' +
        'font-weight: bold;' +
        'text-align: center;' +
        'margin: 12px 12px;' +
        'word-spacing: 9px;' +
    '}' +
    '.receiptno{' +
        'margin-left: 12px;' + 
        'font-size: 12px;' + 
    '}' +
   '.receiptdate{' +
        'margin-left: 580px;' + 
        'margin-top: -27px;' + 
        'font-size: 14px;' + 
   '}' +
   '.recieve {'+
        'margin-left: 52px;' + 
        'font-size: 15px;' + 
    '}'+
    '.totalpaid {'+
        'margin-left: 12px;' + 
        'font-size: 15px;' + 
    '}'+
    '.rno {'+
        'font-color: red;' + 
    '}'+
    '#orthecliniclogo { ' +
          'width: 70px;' +
          'height: 70px;' +
          'position: absolute;' +
          'margin-left: 75px;' +
          'display: block;' +
     '}' +

    '</style>';
  
    htmlToPrint += divToPrint.outerHTML;
    newWin = window.open("");
    newWin.document.write(htmlToPrint);
    newWin.print();
    newWin.close();
    location.reload();
}

function reprint_bill(patient_id,check_up_id) {
  $.ajax({
    url: siteurl+"billing/reprint_details/"+check_up_id+"/"+patient_id,
    type: "GET",
    dataType: "JSON",
      success: function(data) {
        $('.modal-body #rno').text(data[0]['receipt_no']);
        $('.modal-body #rclinic_name').text(data[0]['clinic_name']);
        $('.modal-body #rpatientlname').text(data[0]['patient_lname']);
        $('.modal-body #rpatientfname').text(data[0]['patient_fname']);
        $('.modal-body #rclinic_address').text(data[0]['clinic_address']);
        $('.modal-body #rcity_name').text(data[0]['city_name']);
        $('.modal-body #rprovince_name').text(data[0]['province_name']);
        $('.modal-body #rzipcode').text(data[0]['zip_code']);
        $('.modal-body #totalamt').text("P" + data[0]['bill_amt']);
        $('.rcliniclogo').css('background-image', 'url(' + data[0]['clinic_logo'] + ')');
        $("#orthecliniclogo").attr('src',''+ data[0]['clinic_logo'] +'');
        $('#generate_or').modal('show');
      }
  });
  
}

function add_bill_patient(check_up_id, patient_id) {
  $('#payment')[0].reset();
  $('#modal_add_bill').modal('show');
  $('.modal-body #patient_id').val(patient_id);
  $('.modal-body #check_up_id').val(check_up_id);
}

function show_finished_check_up() {
   table_bill = $("#dataTables-patienthist").dataTable().fnDestroy();

    table_bill =  $('#dataTables-patienthist').DataTable({ 
      "ajax": {
              "url": "<?php echo site_url('billing/bill_list')?>",
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

function reprint_receipt() {
  
    $("#dataTables-reprint").dataTable().fnDestroy();

    table =  $('#dataTables-reprint').DataTable({ 
      "ajax": {
              "url": "<?php echo site_url('billing/or_printed')?>",
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

function save_bill() {
  $('#btnPay').text('Saving...');
  $('#btnPay').attr('disabled',true);
  var the_bill = $('.modal-body #display').val();
  if(the_bill <= 0) {
    $('#btnPay').text('Generate O.R');
    $('#btnPay').attr('disabled',false);
    alert('Amount is Invalid');
  }
  else {
      var check_up_id = $('.modal-body #check_up_id').val();
      var patient_id = $('.modal-body #patient_id').val();
      receipt_details(check_up_id,the_bill,patient_id);
      $('#generate_or').modal('show');
      // $('#btnPay').attr('disabled',false);
      // $('#btnPay').text('Generate O.R');
  }
}

function receipt_details(check_up_id,bill,patient_id) {
  var p_bill_amt = $('.modal-body #bill_amt').val();
  // var words = toWords(p_bill_amt);
  $.ajax({
    url: siteurl+"billing/receipt_det/"+check_up_id+"/"+bill+"/"+patient_id,
    type: "GET",
    dataType: "JSON",
      success: function(data) {
        // alert(words);
        $('.modal-body #rno').text(data['receipt_no']);
        $('.modal-body #rclinic_name').text(data['receipt'][0]['clinic_name']);
        $('.modal-body #rpatientlname').text(data['receipt'][0]['patient_lname']);
        $('.modal-body #rpatientfname').text(data['receipt'][0]['patient_fname']);
        $('.modal-body #rclinic_address').text(data['receipt'][0]['clinic_address']);
        $('.modal-body #rcity_name').text(data['receipt'][0]['city_name']);
        $('.modal-body #rprovince_name').text(data['receipt'][0]['province_name']);
        $('.modal-body #rzipcode').text(data['receipt'][0]['zip_code']);
        $('.modal-body #totalamt').text("P" + p_bill_amt);
        $('.rcliniclogo').css('background-image', 'url(' + data['receipt'][0]['clinic_logo'] + ')');
        $("#orthecliniclogo").attr('src',''+ data['receipt'][0]['clinic_logo'] +'');
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




