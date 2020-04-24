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

<div class="content-wrapper">
   <div class="container">   	 
   		<div class="row">
   			<div class="col-md-12 profile-header">
   				<div class="page-header">
   					<h3> View Reports </h3>
   				</div><!-- page-header -->
   			</div><!-- col-md-12 -->
   		</div><!-- row -->
      <br>
      <div class="col-lg-10 col-lg-offset-1">
        <div class="panel-group">
             <div class="panel panel-info">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#profile"> Doctors List <span class="fa fa-arrow-circle-o-down pull-right"></a>
                    </h4>
                </div><!-- panel-heading -->
                <div id="profile" class="panel-collapse collapse">
                  <div class="panel-body">
                    <div class="dataTable_wrapper">
                      <table id="dataTables-repdocs"  class="table table-striped table-bordered table-hover dataTable dtr-inline" role="grid" style="width: 100%;" width="100%" aria-describedby="dataTables-material">
                          <thead>
                              <tr> 
                                  <th>First Name</th>
                                  <th>Middle Name</th>
                                  <th>Last Name</th>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody>
                          </tbody>
                      </table>
                    </div><!-- dataTable_wrapper -->
                  </div><!-- panel-body -->
                  <div class = "panel-footer" align="right">
                      <!-- <button onclick="admin_btnCreate();" class="btn btn-danger btn-sm">Create Account</button> -->
                  </div><!-- panel-footer -->
                </div><!-- profile -->
            </div><!-- panel panel-info -->
         </div><!-- panel-group -->
    </div><!-- col-lg-10 -->

     
   </div><!-- container -->
</div><!-- content-wrapper -->

<div id="printme"></div>

<!-- ==============================================================
            MODALS
 ================================================================== -->
<div class="modal fade" id="reportadmin" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header  btn-success">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h3 class="modal-title">View Report</h3>
      </div><!-- modal-header -->
          <div class="modal-body">
            <div class="row">
              <div class="col-md-3">
                <div class="reports-admin">
                  <input type="hidden" name="myuser_id" id="myuser_id">
                  <div class="rep-title">Select report type:</div>
                  <select name="patient-rep" id="patient-rep">
                    <option value="0"></option>
                    <option value="1">Daily</option>
                    <option value="2">Custom</option>
                  </select>
                </div>
              </div><!-- col-md-11 -->
              <div class="col-md-8">
                <div class="rep-type" id="rep-content">
                    
                </div><!-- rep-content -->
              </div><!-- col-md-8 -->
            </div>

            <div class="forprint" id="forprint">
            
            </div><!-- forprint -->
          </div><!-- modal-body -->
            <div class="modal-footer">
              <button type="button" id="btnPay" onclick="printDivReport()" class="btn btn-primary"><span class="fa fa-print"></span> Print</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div><!-- modal-footer -->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- add_bill -->

<script type="text/javascript">
var siteurl = "<?php print site_url(); ?>";

function printDivReport() {
    var divToPrint = document.getElementById('forprint');
    var htmlToPrint = '' +
    '<style >' +    
    'body {' +
        'font-family: arial, sans-serif ;' +
        'font-size: 12px ;' +
        'border-style: double;' +
        '}' +    
    '</style>';
  
    htmlToPrint += divToPrint.outerHTML;
    newWin = window.open("");
    newWin.document.write(htmlToPrint);
    newWin.print();
    newWin.close();
}

$('#patient-rep').on('change', function () {
  var selectedReport = $(this).val();
  $('#forprint').empty();
    if(selectedReport == 0) {
      $("#rep-content").empty();
      $("#forprint").empty();
    }
    if(selectedReport == 1) {
      $("#rep-content").empty();
      $("#forprint").empty();
       $("#rep-content").append('<div class="col-md-8">'+'<div class="rep-title">Select report date:</div>'+'<div class="col-sm-6">'+'<div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">'+
                                '<input type="text" class="form-control" id="repdate" name="repdate" placeholder="Report date" required>'+'<div class="input-group-addon">'+'<span class="glyphicon glyphicon-th"></span>'+
                                '</div>'+'</div>'+'</div>'+'</div>'+'<div class="col-md-2 margminus"><button onclick="getReportDet()" class="btn btn-primary btn-sm">Generate Report</button></div>');
    }
    if(selectedReport == 2) {
      $("#rep-content").empty();
      $("#forprint").empty();
        $("#rep-content").append('<div class="col-md-8">'+'<div class="row">'+'<div class="col-sm-6">'+'<div class="rep-title">Start date:</div>'+'</div>'+'<div class="col-sm-6">'+'<div class="rep-title">End date:</div>'+
                                '</div>'+'</div>'+'<div class="row">'+'<div class="col-sm-5">'+'<div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">'+'<input type="text" class="form-control" id="repdatestart" name="repdatestart" placeholder="Report date" required>'+
                                '<div class="input-group-addon"><span class="glyphicon glyphicon-th"></span>'+'</div>'+'</div>'+'</div>'+'<div class="col-sm-1">to</div>'+'<div class="col-sm-5">'+
                                '<div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">'+'<input type="text" class="form-control" id="repdateend" name="repdateend" placeholder="Report date" required>'+
                                '<div class="input-group-addon"><span class="glyphicon glyphicon-th"></span>'+'</div>'+'</div>'+'</div>'+'</div>'+'</div>'+'<div class="col-md-2 customrep"><button onclick="getReportDetCustom()" class="btn btn-primary btn-sm">Generate Report</button></div>');
    }
});

$(document).ready(function() {
  $('#dataTables-repdocs').dataTable();
  show_mydocs();
});

function show_mydocs() {
  $("#dataTables-repdocs").dataTable().fnDestroy();
   table =  $('#dataTables-repdocs').DataTable({ 
      "ajax": {
              "url": "<?php echo site_url('admin_report/view_mydocs')?>",
              "type": "POST",
          },
          responsive: true,
          'bInfo': false
});
}

function getReportDet(){
  var id = $('#myuser_id').val();
  var reportdate = $('#repdate').val();

var currentdate = new Date(); 
var datetime = " "+ (currentdate.getMonth()+1)  + "/" 
                + currentdate.getDate() + "/"
                + currentdate.getFullYear() + " @ "  
                + currentdate.getHours() + ":"  
                + currentdate.getMinutes() + ":" 
                + currentdate.getSeconds();
var totalpatient = 0;
var earn = 0;
  $('#forprint').empty();
  $('#forprint').append('<div class="row">'+'<div class="col-md-6">'+'<p>Report Type: <label id="reptype"></label></p>'+'<p>Report as of <label id="repasof"></label></p>'+'<p>Printed Date: <label id="dateprint"></label></p>'+'<p>Total No. of Patient: <label id="patientcount"></label></p>'+
                        '</div>'+'<div class="col-md-6">'+'</div>'+'</div>'+'<hr>'+'<div class="dataTable_report">'+'<table id="dataTables-report"  class="table table-striped table-bordered table-hover dataTable dtr-inline" role="grid" style="width: 100%;" width="100%" aria-describedby="dataTables-material">'+
                        '<thead>'+'<th>Check-up ID</th>'+'<th>First Name</th>'+'<th>Middle Name</th>'+'<th>Last Name</th>'+'<th>Check-up Date & Time</th>'+'<th>Clinic Name</th>'+'<th>Bill Amount</th>'+'</thead>'+'<tbody id="table-reportcustom">'+'</tbody>'+'</table>'+'</div>');
  $.ajax({              
      url: siteurl+"admin_report/getSpecificDate/"+id,
      type: "POST",
      data: {reportdate:reportdate},
      dataType: "JSON",
        success:function(data) {
          $('#table-reportcustom').empty();
          for(i=0;i<data.length;i++) {
              $('#table-reportcustom').append('<tr>'+'<td>'+data[i]['check_up_id']+'</td>'+'<td>'+data[i]['patient_fname']+'</td>'+'<td>'+data[i]['patient_mname']+'</td>'+'<td>'+data[i]['patient_lname']+'</td>'+'<td>'+data[i]['check_up_date']+'</td>'+'<td>'+data[i]['clinic_name']+'</td>'+'<td>'+data[i]['bill_amt']+'</td>'+'</tr>');
              earn = parseFloat(data[i]['bill_amt']) + earn;
              totalpatient = totalpatient + 1;
            };
            $('#forprint').append('<hr>'+'<label class="pull-right" id="eatotal">'+'</label>');
            $('.modal-body #reptype').text("Daily");
            $('.modal-body #repasof').text(data[0]['datefetch']);
            $('.modal-body #dateprint').text(datetime.toLocaleString());
            $('.modal-body #patientcount').text(totalpatient);
            // $('.modal-body #eatotal').text(formatter.format(earn));
            $('#eatotal').text(earn);
        }
  });  

}

function getReportDetCustom(){
  var id = $('#myuser_id').val();
  var startdate = $('#repdatestart').val();
  var enddate = $('#repdateend').val();

  var currentdate = new Date(); 
  var datetime = " "+ (currentdate.getMonth()+1)  + "/" 
                  + currentdate.getDate() + "/"
                  + currentdate.getFullYear() + " @ "  
                  + currentdate.getHours() + ":"  
                  + currentdate.getMinutes() + ":" 
                  + currentdate.getSeconds();
  var totalpatient = 0;
  var earn = 0;

  $('#forprint').empty();
  $('#forprint').append('<div class="row">'+'<div class="col-md-6">'+'<p>Report Type: <label id="reptype"></label></p>'+'<p>Report as of <label id="repasof"></label></p>'+'<p>Printed Date: <label id="dateprint"></label></p>'+'<p>Total No. of Patient: <label id="patientcount"></label></p>'+
                        '</div>'+'<div class="col-md-6">'+'</div>'+'</div>'+'<hr>'+'<div class="dataTable_report">'+'<table id="dataTables-report"  class="table table-striped table-bordered table-hover dataTable dtr-inline" role="grid" style="width: 100%;" width="100%" aria-describedby="dataTables-material">'+
                        '<thead>'+'<th>Check-up ID</th>'+'<th>First Name</th>'+'<th>Middle Name</th>'+'<th>Last Name</th>'+'<th>Check-up Date & Time</th>'+'<th>Clinic Name</th>'+'<th>Bill Amount</th>'+'</thead>'+'<tbody id="table-reportcustom">'+'</tbody>'+'</table>'+'</div>');
  $.ajax({              
      url: siteurl+"admin_report/getCustomDate/"+id,
      type: "POST",
      data: {startdate:startdate, enddate:enddate},
      dataType: "JSON",
        success:function(data) {
          $('#table-reportcustom').empty();
          for(i=0;i<data.length;i++) {
              $('#table-reportcustom').append('<tr>'+'<td>'+data[i]['check_up_id']+'</td>'+'<td>'+data[i]['patient_fname']+'</td>'+'<td>'+data[i]['patient_mname']+'</td>'+'<td>'+data[i]['patient_lname']+'</td>'+'<td>'+data[i]['check_up_date']+'</td>'+'<td>'+data[i]['clinic_name']+'</td>'+'<td>'+data[i]['bill_amt']+'</td>'+'</tr>');
              earn = parseFloat(data[i]['bill_amt']) + earn;
              totalpatient = totalpatient + 1;
            };
            $('#forprint').append('<hr>'+'<label class="pull-right" id="eatotal">'+'</label>');
            $('.modal-body #reptype').text("Custom");
            $('.modal-body #repasof').text(data[0]['datefetch']+" to "+data[totalpatient - 1]['datefetch']);
            $('.modal-body #dateprint').text(datetime.toLocaleString());
            $('.modal-body #patientcount').text(totalpatient);
            // $('.modal-body #eatotal').text(formatter.format(earn));
            $('#eatotal').text(earn);
        }
  });
}

function viewrep(user_id) {
  $('#myuser_id').val(user_id);
  $('#reportadmin').modal('show');
}

Number.prototype.format = function(n, x, s, c) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
        num = this.toFixed(Math.max(0, ~~n));
    
    return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
}  

</script>

                <!-- dataTable_wrapper -->
                 <!-- <tbody id="table-report"> -->

<!--  <div class="col-md-8">
                    <div class="row">
                      <div class="col-sm-6">
                      <div class="rep-title">Start date:</div>
                      </div>
                      <div class="col-sm-6">
                      <div class="rep-title">End date:</div>
                      </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-5">
                      <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                          <input type="text" class="form-control" id="repdate" name="repdate" placeholder="Report date" required>
                            <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span>
                      </div>
                      </div>
                    </div>
                    <div class="col-sm-1">to</div>
                      <div class="col-sm-5">
                        <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                          <input type="text" class="form-control" id="repdate" name="repdate" placeholder="Report date" required>
                            <div class="input-group-addon"><span class="glyphicon glyphicon-th"></span>
                          </div>
                        </div>
                      </div>
                    </div>
                </div> -->
