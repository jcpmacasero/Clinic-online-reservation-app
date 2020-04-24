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
  <div class="dashboard-header">
    <p class="dashboard-p">Overview</p>
 </div>

    <!-- Content Header (Page header) -->
    <section class="content-header">
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Overview</li>
    </ol> -->
      <div class="withbg">
        <p class="datenow pull-right">as of <?php echo date("F j, Y, g:i a"); ?></p>
      </div>

    <div class="row">
      <div class="col-md-7">
        <div class="info-queues">
            <p class="info-header">Clinic Queues</p>
            <div id="thequeue">

            </div>
        </div>
      </div>
    
      <div class="col-md-5">
        <div class="info-calendar">
           <div class="box box-solid bg-green-gradient ">
                <!-- <div class="box-header">
                    <i class="fa fa-calendar"></i>
                    <h3 class="box-title">Calendar</h3>
                    <div class="pull-right box-tools">
                        <button type="button" class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div> -->
                <div class="box-body no-padding">
                    <div id="calendar" style="width: 100%"  ></div>
                </div>
            </div>
        </div>
      </div>
    </div>

    <div class="row belowdash">
      <div class="col-md-7">
        <div class="info-fees">
            <p class="info-header">Fees earned (Monthly)</p>
            <div id="thefee">

            </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="info-total">
            <p class="info-header">Total Patients (Monthly)</p>
            <div id="thetotal">
            </div>            
        </div>
      </div>
    </div>
      
    </section> 
    
  </div>

<script type="text/javascript">
var siteurl = "<?php print site_url(); ?>";

$(document).ready(function() {
   countDiagnose();
   countQueue();
   sumEarningsToday();
   $('#pd').attr("class","treeview active");
   summaryQueue();
   summaryFees();
   myTotalearn();
});

function summaryQueue() {
  $.ajax({
    url: siteurl+"dashboard_admin/getSummaryQueue/",
    type: "GET",
    dataType: "JSON",
        success: function(data) {
          if(data.length>0) {
            for(i=0;i<data.length;i++) {
              $('#thequeue').append('<p class="queuelist">'+data[i]['clinic_name']+' '+'('+data[i]['clinic_count']+')'+'</p>');
            };            
          }
          else {
            //$('#queue').append('<h4> No Patients in queue </h4>');
          }
        }
  });
}

function summaryFees() {
  $.ajax({
    url: siteurl+"dashboard_admin/getSummaryFees/",
    type: "GET",
    dataType: "JSON",
        success: function(data) {
          if(data.length>0) {
            for(i=0;i<data.length;i++) {
              $('#thefee').append('<p class="queuelist">'+data[i]['clinic_name']+' '+'(P'+data[i]['clinic_tot']+')'+'</p>');
            };            
          }
          else {
            //$('#queue').append('<h4> No Patients in queue </h4>');
          }
        }
  });
}

function myTotalearn() {
  $.ajax({
    url: siteurl+"dashboard_admin/getTotalFees/",
    type: "GET",
    dataType: "JSON",
        success: function(data) {
          if(data.length>0) {
              $('#thetotal').append('<p class="total-list">'+data[0]['total_earn']+'</p>');
          }
          else {
            //$('#queue').append('<h4> No Patients in queue </h4>');
          }
        }
  });
}
</script>

