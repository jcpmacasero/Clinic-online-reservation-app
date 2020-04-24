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
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h4 id="diagnose"></h4>

              <p>Diagnosed</p>
            </div>
            <div class="icon">
              <i class="ion-ios-pulse-strong"></i>
            </div>
            <a href="<?= base_url('Sec_searchrecords') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h4 id="queue"></h4>

              <p>Queued Patients</p>
            </div>
            <div class="icon">
              <i class="ion-android-contacts"></i>
            </div>
            <a href="<?= base_url('Sec_myclinic') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <!-- /.row -->
      <!-- Main row -->
     </section>
     </div>
     
  </div>

<script type="text/javascript">
var siteurl = "<?php print site_url(); ?>";

$(document).ready(function() {
   countQueuedSec();
   countDiagnosedSec();
});

function countQueuedSec() {
  $.ajax({
    url: siteurl+"dashboard_sec/count_queue",
    type: "GET",
    dataType: "JSON",
      success: function(data) {
          $('#queue').text(data[0]['COUNT(tbl_queue.queue_id)']);
      }
  });
}

function countDiagnosedSec() {
   $.ajax({
    url: siteurl+"dashboard_sec/count_diagnose",
    type: "GET",
    dataType: "JSON",
      success: function(data) {
          $('#diagnose').text(data[0]['diagnose']);
      }
  });
}

</script>

