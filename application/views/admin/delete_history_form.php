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
    <p class="dashboard-p">Delete History</p>
 </div>
    <!-- Content Header (Page header) -->
    <section class="content">
    <br>
         <div class="row">
            <div class="col-md-11">
              <div class="dataTable_wrapper">
                      <table id="dataTables-dpatients"  class="table table-striped table-bordered table-hover dataTable dtr-inline" role="grid" style="width: 100%;" width="100%" aria-describedby="dataTables-material">
                          <thead>
                              <tr> 
                                  <th>Patient ID</th>
                                  <th>First Name</th>
                                  <th>Last Name</th>
                                  <th>Clinic Name</th>
                                  <th>Remover User ID</th>                                               
                                  <th>Time Removed</th>
                              </tr>
                          </thead>
                          <tbody>
                          </tbody>
                      </table>
              </div><!-- dataTable_wrapper -->
            </div>
        </div><!-- row -->
    </section>
      
</div><!-- content-wrapper -->

<!-- ==============================================================
            MODALS
 ================================================================== -->


<script type="text/javascript">

$(document).ready(function() {
  show_deleted_patients();
});

var siteurl = "<?php print site_url(); ?>";

function show_deleted_patients() {
    $("#dataTables-dpatients").dataTable().fnDestroy();

    table =  $('#dataTables-dpatients').DataTable({ 
      "ajax": {
              "url": "<?php echo site_url('admin_delete_history/data_table_deleted')?>",
              "type": "POST",
          },
          responsive: true
      });
}

</script>




