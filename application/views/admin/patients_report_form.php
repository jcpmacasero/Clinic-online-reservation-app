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
  <div class="reports-head-p">
    <p class="dashboard-p">Reports</p>
 </div>
    <!-- Content Header (Page header) -->

<section class="content" id="topmarg">    
      <div class="row">
        <div class="col-md-6">

          <!-- DONUT CHART -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Patients per clinic</h3>

              <div class="box-tools pull-left">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <canvas id="pieChart" style="height:250px"></canvas>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (LEFT) -->
        <div class="col-md-6">

          <!-- BAR CHART -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Overall Patients</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div id="container" style="min-width: 310px; max-width: 800px; height: 400px; margin: 0 auto"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (RIGHT) -->
      </div>
      <!-- /.row -->

      <!-- vs -->
      <div class="row" id="hide_me">        
      <div class="col-md-10 col-md-offset-1">
        <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Data report for Patient's diagnose</h3>

              <div class="box-tools pull-left">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
                <div class="row">
                  <div class="col-md-11">
                    <form id="frm_diagnosis_graph">
                    <label for="findings" class="col-sm-2">&nbsp; Diagnosis:</label>
                    <select name="selectdiagnosis[]" id="selectdiagnosis" class="form-control select2"  multiple="multiple" data-placeholder="Select diagnosis" style="width: 65%;">
                      <?php foreach($diagnosis_id as $each){ ?>
                        <option value="<?php echo $each->diagnosis_id; ?>" title="<?php echo $each->description; ?>"><?php echo $each->diagnosis; ?></option>
                      <?php } ?>
                    </select>
                    </form>
                    <button class="btn btn-default btn-sm" onclick="graph()" style="margin-top:-110px; margin-left:675px;">Graph me!</button>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-11">
                    <div id="versus" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                  </div>
                </div>
            </div>
          </div>
      </div>
      </div>

   <!-- vs -->

      <div class="row">        
      <div class="col-md-10 col-md-offset-1">
        <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Fetch Data Report per Clinics</h3>

              <div class="box-tools pull-left">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
                <div class="yourprofile">
                    <div class="table-responsive">     
                      <table id="dataTables-summary"  class="table table-striped table-hover dt-responsive display nowrap">
                                    <thead>
                                            <th>Clinic Name</th>
                                            <th>Total Patients Served</th>
                                            <th>Total Fees Earned</th>
                                            <th></th>
                                    </thead>
                                    <tfoot>
                                            <tr>
                                            <td><label id="foottitle">Overall :</label> <label id="footclinics"></label></td>
                                            <td><label id="foottitle">Overall :</label> <label id="footpatients"></label></td>
                                            <td><label id="foottitle">Overall :</label> <label id="footearn"></label></td>
                                            </tr>
                                    </tfoot>

                                    <tbody>
                                    </tbody>
                        </table>
                      </div>

                          </div><!-- yourprofile -->
            </div>
            <!-- /.box-body -->
          </div>
      </div>
   </div>

  </div>
</section>
<div id="printmeee"></div>
</div><!-- content-wrapper -->

<div class="modal fade large" id="report_transactions" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header  btn-success">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h3 class="modal-title">Transactions</h3>
            </div>
            <div class="modal-body">

            <div class="row">
                <div class="col-md-11">
                  <label for="repz">Report type</label>
                  <select class="form-control" id="selectedrep">
                      <option value="0">--- SELECT OPTION ---</option>
                      <option value="1">Daily</option>
                      <option value="2">Custom</option>
                  </select>
                </div>
            </div>

            <br>
              
                <div class="row">
                  <div id="daily-report">
                    <div class="col-md-3 bgsidebarmodal">
                      <br>
                      <div class="row">
                        <div class="col-sm-12">
                          <p>Date: </p>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group date" id="dateto" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                            <input type="text" class="form-control" id="dailyslected" name="dailyslected" placeholder="Report date" required>
                              <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                              </div>
                            </div>
                        </div>
                      </div>
                      <br>
                      <div class="row margbottonsidebar">
                        <div class="col-sm-4 col-sm-offset-3"> 
                          <button class="btn btn-primary btn-xs" onclick="fetchclinicdaily()">Generate</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div id="custom-report">
                    <div class="col-md-3 bgsidebarmodal">
                      <br>
                      <div class="row">
                          <div class="col-sm-12">
                            <p>From: (Starting Date)</p>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group date" id="datefrom" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                            <input type="text" class="form-control" id="fromrepdate" name="fromrepdate" placeholder="Report date" required>
                              <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                              </div>
                            </div>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col-sm-12">
                          <p>To: (Date End)</p>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group date" id="dateto" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                            <input type="text" class="form-control" id="torepdate" name="torepdate" placeholder="Report date" required>
                              <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                              </div>
                            </div>
                        </div>
                      </div>
                      <br>
                      <div class="row margbottonsidebar">
                        <div class="col-sm-4 col-sm-offset-3"> 
                          <button class="btn btn-primary btn-xs" onclick="fetchclinic()">Generate</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                <div class="col-md-9">
                  
                  <input type="hidden" name="clinic_idhid" id="clinic_idhid">
                    <div class="table_transactions" id="table_transactions">
                    <div class="headerforprint">
                        <p>Date Covered: <label id="startd"></label> &nbsp; - &nbsp; <label id="enddate"></label></p>
                    </div>
                        <table id="mytransactions"  class="table table-striped table-bordered table-hover dataTable dtr-inline" role="grid" style="width: 100%;" width="100%" aria-describedby="dataTables-material">
                            <thead>
                                    <th>Check-up ID</th>
                                    <th>First Name</th>                                               
                                    <th>Last Name</th>
                                    <th>Check-up Date & Time</th>
                                    <th>Bill Amount</th>
                                    <th>OR #</th>
                            <tbody id="alltransactsdaily">
                            </tbody>
                        </table>
                    </div>                   
                </div>
              </div>

            </div><!-- modal-body -->
            <div class="modal-footer">
              <button type="button" id="btn_printdiv" onclick="printDiv()" class="btn btn-primary"><span class="fa fa-print"></span> Print</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div><!-- modal-footer -->
    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- generate_cert -->


                                
<!-- ==============================================================
            MODALS
 ================================================================== -->
              
<script type="text/javascript">
var siteurl = "<?php print site_url(); ?>";
var d1 = new Date();
var d2 = new Date();
var chart;
var diagchart;
var categories1 = new Array();
var DiagSeries = new Array();

$(document).ready(function() {
  data_table_summary();
  data_table_summary1();
  $(".select2").select2();
});

$('#selectedrep').change(function(){
    var selectedReport = $(this).val();
    if(selectedReport == 1) {
      $('#alltransactsdaily').empty();
      document.getElementById('daily-report').style.display = "block";
      document.getElementById('custom-report').style.display = 'none';
      document.getElementById('table_transactions').style.display = "block";
      
    }
    else if(selectedReport == 2) {
      $('#alltransactsdaily').empty();
      document.getElementById('custom-report').style.display = "block";
      document.getElementById('daily-report').style.display = 'none';
      document.getElementById('table_transactions').style.display = "block";
    }
    else {
      document.getElementById('custom-report').style.display = "none"; 
      document.getElementById('daily-report').style.display = "none";
      document.getElementById('table_transactions').style.display = "none";
    }
});

function printDiv() {
    var divToPrint = document.getElementById('table_transactions');
    var htmlToPrint = '' +
    '<style >' +
    'body {' +
        'font-family: arial, sans-serif ;' +
        'font-size: 12px ;' +
        '}' +
    
    'th{' +
        'padding: 4px 4px 4px 4px ;' +
        'text-align: center;' +
        'text-decoration: underline;' +
        '}' +
    'td{' +
        'font-size: 15px;' +
        'border-top: 1px solid black;' +
        'text-align: center;'  +
    '}' +
    '.headerforprint{' +
        'display: block;' +
    '}' +
    '</style>';
  
    htmlToPrint += divToPrint.outerHTML;
    newWin = window.open("");
    newWin.document.write(htmlToPrint);
    newWin.print();
    newWin.close();
}

function data_table_summary(){
        $("#dataTables-summary").dataTable().fnDestroy();

        table =  $('#dataTables-summary').DataTable({
            "ajax": {
                "url": "<?php echo site_url('patients_report/data_report_summary')?>",
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

function data_table_summary1(dateselected) {
    $.ajax ({
          url: siteurl+"patients_report/data_report_summary",
          type: "POST",
          dataType: "JSON",
          success: function(data) {
            $('#footclinics').text(data.oclinics);
            $('#footpatients').text(data.opatients);
            $('#footearn').text(data.oearn);
          }
          });
}

function viewOnDetails(clinicID) {
  $('#clinic_idhid').val(clinicID);
  $('#report_transactions').modal('show');
}

function fetchclinic() {
  var clinic_id = $('#clinic_idhid').val();
  var fromdate = $('#fromrepdate').val();
  var todate = $('#torepdate').val();

  if(fromdate == "" || todate == "") {
    alert("No Date Selected");
  }
  else {
    $('#startd').text(fromdate);
    $('#enddate').text(todate);
    $.ajax({
      url: siteurl+"patients_report/fetchclinicsummary/"+clinic_id,
      type: "POST",
      data: {from:fromdate, to:todate},
      dataType: "JSON",
        success:function(data) {
          $('#alltransactsdaily').empty();
          for(i=0;i<data.length;i++) {
              $('#alltransactsdaily').append('<tr>'+'<td>'+data[i]['check_up_id']+'</td>'+'<td>'+data[i]['patient_fname']+'</td>'+'<td>'+data[i]['patient_lname']+'</td>'+'<td>'+data[i]['check_up_date']+'</td>'+'<td>'+data[i]['bill_amt']+'</td>'+'<td>'+data[i]['receipt_no']+'</td>'+'</tr>');
              
            };
        }
    });
  }
}

function fetchclinicdaily() {
  var clinic_id = $('#clinic_idhid').val();
  var pickdate = $('#dailyslected').val();
  
  if(pickdate == "") {
    alert("No Date Selected");
  }
  else {
    $('#startd').text(pickdate);
    $.ajax({
      url: siteurl+"patients_report/fetchclinicdaily/"+clinic_id,
      type: "POST",
      data: {pickrepdate:pickdate},
      dataType: "JSON",
        success:function(data) {
          $('#alltransactsdaily').empty();
          for(i=0;i<data.length;i++) {
              $('#alltransactsdaily').append('<tr>'+'<td>'+data[i]['check_up_id']+'</td>'+'<td>'+data[i]['patient_fname']+'</td>'+'<td>'+data[i]['patient_lname']+'</td>'+'<td>'+data[i]['check_up_date']+'</td>'+'<td>'+data[i]['bill_amt']+'</td>'+'<td>'+data[i]['receipt_no']+'</td>'+'</tr>');
            };
        }
    });
  }
}

function getpieclinic() {
    $.ajax({
            type: "POST",
            url: siteurl+"patients_report/piedataclinic",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: OnSuccess_,
            error: OnErrorCall_
    });

          function OnSuccess_(response) {
            
          var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
          var pieChart = new Chart(pieChartCanvas);
          var PieData = [];
          
          // create PieData dynamically
          response.forEach(function(e) {
              var random_color = '#' + Math.floor(Math.random() * 16777215).toString(16);
              PieData.push({
                  value: e.total_checked_up,
                  color: random_color,
                  highlight: random_color,
                  label: e.clinic_name
              });
          });
          var pieOptions = {
              //Boolean - Whether we should show a stroke on each segment
              segmentShowStroke: true,
              //String - The colour of each segment stroke
              segmentStrokeColor: "#fff",
              //Number - The width of each segment stroke
              segmentStrokeWidth: 2,
              //Number - The percentage of the chart that we cut out of the middle
              percentageInnerCutout: 0, // This is 0 for Pie charts
              //Number - Amount of animation steps
              animationSteps: 100,
              //String - Animation easing effect
              animationEasing: "easeOutBounce",
              //Boolean - Whether we animate the rotation of the Doughnut
              animateRotate: true,
              //Boolean - Whether we animate scaling the Doughnut from the centre
              animateScale: false,
              //Boolean - whether to make the chart responsive to window resizing
              responsive: true,
              // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
              maintainAspectRatio: true,
              //String - A legend template
              legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
          };
        
          //Create pie or douhnut chart
          // You can switch between pie and douhnut using the method below.
          pieChart.Doughnut(PieData, pieOptions);

        }

          function OnErrorCall_(response) {}
}

function getbarxAxis() {
 $.ajax({
   url: siteurl+"patients_report/bardata_date",
   type: "POST",
   dataType: "JSON",
   success: function(data) {
     var categories = new Array();
     for (var i in data) {
       categories.push(data[i]["datemonths"]);
     }
    loadChart(categories);
    getallclinics();
    var arrayLength = categories.length;
    for(var loop = 0;loop<arrayLength;loop++) {
        getbarseries(categories[loop]);
    }
   }
 });
}

function getbarseries(month) {
    $.ajax({
      url: siteurl+"patients_report/bardataclinic/"+month,
      type: "POST",
      dataType: "JSON",
      async: false,
        success: function(data) {
           for(var i in data) {        
              chart.series[i].addPoint(Number(data[i]['total_check']));
           }
        }
    });
}

function getallclinics() {
   $.ajax ({
          url: siteurl+"patients_report/seriesclinics",
          type: "POST",
          async: false,
          dataType: "JSON",
          success: function(data) {
            for(var i in data) {
              chart.addSeries({
                  name: data[i]['clinic_name']
              });
            }
          }
   });
}

function loadChart(categories) {
   chart = Highcharts.chart('container', {
    chart: {
        type: 'bar'
    },
    title: {
        text: ''
    },
    xAxis: {
        categories: categories
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Detailed patient per clinic'
        }
    },
    legend: {
        reversed: true
    },
    plotOptions: {
        series: {
            stacking: 'normal'
        }
    }
});
}

function loadChartDiagnosis(diagcat) {
  diagchart = Highcharts.chart('versus', {
    chart: {
        type: 'area'
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: diagcat,
        tickmarkPlacement: 'on',
        title: {
            enabled: false
        }
    },
    yAxis: {
        title: {
            text: 'Number of Patient/s'
        },
        labels: {
            formatter: function () {
                return this.value / 1;
            }
        }
    },
    tooltip: {
        split: true,
        valueSuffix: ' patient/s'
    },
    plotOptions: {
        area: {
            stacking: 'normal',
            lineColor: '#666666',
            lineWidth: 1,
            marker: {
                lineWidth: 1,
                lineColor: '#666666'
            }
        }
    }
    // series: [{
    //     name: 'Asia',
    //     data: [502, 635, 809, 947, 1402, 3634, 5268]
    // }, {
    //     name: 'Africa',
    //     data: [106, 107, 111, 133, 221, 767, 1766]
    // }, {
    //     name: 'Europe',
    //     data: [163, 203, 276, 408, 547, 729, 628]
    // }, {
    //     name: 'America',
    //     data: [18, 31, 54, 156, 339, 818, 1201]
    // }, {
    //     name: 'Oceania',
    //     data: [2, 2, 2, 6, 13, 30, 46]
    // }]
});
}

function getdiagxAxis() {
 $.ajax({
   url: siteurl+"patients_report/bardata_date",
   type: "POST",
   dataType: "JSON",
   async: false,
   success: function(data) {
     for (var i in data) {
       categories1.push(data[i]["datemonths"]);
     }
     loadChartDiagnosis(categories1);
   }
 });
}

function getDataforDiag(month, diagnosis_id) { 
  $.ajax({
    url: siteurl+"patients_report/dataforSeries/"+month+"/"+diagnosis_id,
    type: "POST",
    dataType: "JSON",
    async: false,
      success: function(data) {
        DiagSeries.push(data[0]['totdiag']);
      }
  });
}

function graph() {
  DiagSeries = [];
  categories1 = [];
  var l = 0;
  $.ajax({
    url: siteurl+"patients_report/graph_diagnose",
    type: "POST",
    data: $('#frm_diagnosis_graph').serialize(),
    dataType: "JSON",
      success: function(data) {
        getdiagxAxis();
        var arrDiag = categories1.length;
        for(var i in data) {
          diagchart.addSeries({
            name: data[i]['diagnosis']
          });       
        }
        for(var k = 0;k < arrDiag; k++) {
          for(var j in data) {

            getDataforDiag(categories1[k],data[j]['diagnosis_id']);
            diagchart.series[j].addPoint(Number(DiagSeries[l]));
            l++;
          }
        }
      }
  });
}

$(function () {
    getpieclinic();
    getbarxAxis();    
  });
</script>
