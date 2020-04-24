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

<div class="content-wrapper">
  <div class="container">
      <div class="row">
        <div class="col-md-12 reports-head">
          <div class="page-header">
            <h3> Reports </h3>
          </div><!-- page-header -->
        </div><!-- col-md-12 -->
      </div><!-- row -->

      <div class="row">
        <div class="col-md-12 reports-create">
            <p class="repotsp">Welcome to reports page!</p>
          <div class="row">
             <div class="col-md-2 col-md-offset-1">
                <div class="reports-part">
                  <div class="rep-title">Select report type:</div>
                  <select name="patient-repearn" id="patient-repearn">
                    <option value="0"></option>
                    <option value="1">Daily</option>
                    <option value="2">Monthly</option>
                    <option value="3">Yearly</option>
                  </select>
                </div><!-- col-md-3 -->
             </div>

            <div class="rep-type" id="rep-content">
              
            </div>

              <!-- AREA CHART 
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Earnings Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="areaChart" style="height:250px"></canvas>
              </div>
            </div>
            < /.box-body 
          </div>
          < /.box -->

            </div><!-- col-md-6 -->
          </div><!-- row -->
        </div><!-- col-md-12 -->
      </div><!-- row -->
      

  </div><!-- container -->
</div><!-- content-wrapper -->


<!-- ==============================================================
            MODALS
 ================================================================== -->

 <div class="modal fade large" id="modalreportearnings" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header  btn-success">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h3 class="modal-title">Report</h3>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <p>Report Type: <label id="reptype"></label></p>
                  <p>Report as of <label id="repasof"></label></p>
                  <p>Printed Date: <label id="dateprint"></label></p>
                  <p>Total Earnings: <label id="patientcount"></label></p>
                </div>
                <div class="col-md-6">
                </div>
                <br>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-12">
                <div class="dataTable_report">
                      <table id="dataTables-report"  class="table table-striped table-bordered table-hover dataTable dtr-inline" role="grid" style="width: 100%;" width="100%" aria-describedby="dataTables-material">
                          <thead>
                                  <th>Check-up ID</th>
                                  <th>First Name</th>
                                  <th>Middle Name</th>                                               
                                  <th>Last Name</th>
                                  <th>Amount Paid</th>
                                  <th>Receipt No.</th>
                          </thead>
                          <tbody id="table-report">
                          </tbody>
                      </table>
                  </div><!-- dataTable_wrapper -->
                </div>
                </div>
            </div><!-- modal-body -->
            <div class="modal-footer">
                            <button type="button" id="btn_printrep" onclick="print_report('printme')" class="btn btn-primary"><span class="fa fa-print"></span> Print</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div><!-- modal-footer -->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- generate_cert -->


<script type="text/javascript">
var siteurl = "<?php print site_url(); ?>";


$('#patient-repearn').on('change', function () {
  var selectedReport = $(this).val();
    if(selectedReport == 0) {
      $("#rep-content").empty();
    }
    if(selectedReport == 1) {
      $("#rep-content").empty();
      $("#rep-content").append('<div class="col-md-4">'+'<div class="rep-title">Select report date:</div>'+'<div class="col-sm-6">'+'<div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">'+'<input type="text" class="form-control" id="repdate" name="repdate" placeholder="Report date" required>'
                              +'<div class="input-group-addon">'+'<span class="glyphicon glyphicon-th"></span>'+'</div>'+'</div>'+'</div>'+'</div>'+'<div class="col-md-2 margminus">'+'<button onclick="getReportDet()" class="btn btn-primary btn-sm">Generate Report</button>'+'</div>');
    }
    if(selectedReport == 2) {
      $("#rep-content").empty();
    }
    if(selectedReport == 3) {
      $("#rep-content").empty();
    }
    
});

function getReportDet() {
  var selectedDate = $('#repdate').val();
  if(selectedDate != "") {
    show_daily(selectedDate);
    $('#modalreportearnings').modal('show');
  }
  else {
    alert("Please select date");
  }
}

function show_daily(specdate) {
var currentdate = new Date(); 
var datetime = " "+ (currentdate.getMonth()+1)  + "/" 
                + currentdate.getDate() + "/"
                + currentdate.getFullYear() + " @ "  
                + currentdate.getHours() + ":"  
                + currentdate.getMinutes() + ":" 
                + currentdate.getSeconds();
var totalpatient = 0;

   $.ajax({
      url: siteurl+"earnings_report/getSpecificDate",
      type: "POST",
      data: {check_up_date:specdate},
      dataType: "JSON",
        success: function(data) {
          $('#table-report').empty();
          if(data.length>0) {
            for(i=0;i<data.length;i++) {
              $('#table-report').append('<tr>'+'<td>'+data[i]['check_up_id']+'</td>'+'<td>'+data[i]['patient_fname']+'</td>'+'<td>'+data[i]['patient_mname']+'</td>'+'<td>'+data[i]['patient_lname']+'</td>'+'<td>'+data[i]['check_up_date']+'</td>'+'<td>'+data[i]['clinic_name']+'</td>'+'</tr>');
              totalpatient = totalpatient + 1;
            };
            $('.modal-body #reptype').text("Daily");
            $('.modal-body #repasof').text(data[0]['datefetch']);
            $('.modal-body #dateprint').text(datetime.toLocaleString());
            $('.modal-body #patientcount').text(totalpatient);
          }
        }
   });
}

$(document).ready(function() {

});
</script>



<!-- //   $(function () {
//     /* ChartJS
//      * 
//      * Here we will create a few charts using ChartJS
//      */

//     //
//     //- AREA CHART -
//     //

//     // Get context with jQuery - using jQuery's .get() method.
//     var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
//     // This will get the first returned node in the jQuery collection.
//     var areaChart = new Chart(areaChartCanvas);

//     var areaChartData = {
//       labels: ["January", "February", "March", "April", "May", "June", "July"],
//       datasets: [
//         {
//           label: "Electronics",
//           fillColor: "rgba(210, 214, 222, 1)",
//           strokeColor: "rgba(210, 214, 222, 1)",
//           pointColor: "rgba(210, 214, 222, 1)",
//           pointStrokeColor: "#c1c7d1",
//           pointHighlightFill: "#fff",
//           pointHighlightStroke: "rgba(220,220,220,1)",
//           data: [65, 59, 80, 81, 56, 55, 40]
//         },
//         {
//           label: "Digital Goods",
//           fillColor: "rgba(60,141,188,0.9)",
//           strokeColor: "rgba(60,141,188,0.8)",
//           pointColor: "#3b8bba",
//           pointStrokeColor: "rgba(60,141,188,1)",
//           pointHighlightFill: "#fff",
//           pointHighlightStroke: "rgba(60,141,188,1)",
//           data: [28, 48, 40, 19, 86, 27, 90]
//         }
//       ]
//     };

//     var areaChartOptions = {
//       //Boolean - If we should show the scale at all
//       showScale: true,
//       //Boolean - Whether grid lines are shown across the chart
//       scaleShowGridLines: false,
//       //String - Colour of the grid lines
//       scaleGridLineColor: "rgba(0,0,0,.05)",
//       //Number - Width of the grid lines
//       scaleGridLineWidth: 1,
//       //Boolean - Whether to show horizontal lines (except X axis)
//       scaleShowHorizontalLines: true,
//       //Boolean - Whether to show vertical lines (except Y axis)
//       scaleShowVerticalLines: true,
//       //Boolean - Whether the line is curved between points
//       bezierCurve: true,
//       //Number - Tension of the bezier curve between points
//       bezierCurveTension: 0.3,
//       //Boolean - Whether to show a dot for each point
//       pointDot: false,
//       //Number - Radius of each point dot in pixels
//       pointDotRadius: 4,
//       //Number - Pixel width of point dot stroke
//       pointDotStrokeWidth: 1,
//       //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
//       pointHitDetectionRadius: 20,
//       //Boolean - Whether to show a stroke for datasets
//       datasetStroke: true,
//       //Number - Pixel width of dataset stroke
//       datasetStrokeWidth: 2,
//       //Boolean - Whether to fill the dataset with a color
//       datasetFill: true,
//       //String - A legend template
//       legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
//       //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
//       maintainAspectRatio: true,
//       //Boolean - whether to make the chart responsive to window resizing
//       responsive: true
//     };

//     //Create the line chart
//     areaChart.Line(areaChartData, areaChartOptions);
// });

 -->