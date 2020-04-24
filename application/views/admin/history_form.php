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
   					<h3> History </h3>
   				</div><!-- page-header -->
   			</div><!-- col-md-12 -->
   		</div><!-- row -->

      <div class="row">
        <div class="addnewpatient">
            <div class="col-sm-7 col-sm-offset-2">
            <div class="box box-success box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Visitors</h3>
                    <div class="box-tools pull-right">
                        <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            <div class="box-body">
                      <div class="row">
                      </div>

                      <div class="mydata">
                        <div class="row">
                          <div class="col-sm-12">
                          <div class="dataTable_wrapper">
                            <table id="dataTables-visitors"  class="table table-striped table-bordered table-hover dataTable dtr-inline" role="grid" style="width: 100%;" width="100%" aria-describedby="dataTables-material">
                                <thead>
                                    <tr> 
                                        <th>Provider</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>                                               
                                        <th>Email</th>
                                        <th>Picture</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                          </div><!-- dataTable_wrapper -->
                          </div>
                        </div>
                      </div>
                  </div><!-- panel-body -->
                  <!-- <div class="box-footer  pull-right">
                      <button onclick="modalpatient()" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add to queue</button>
                  </div> panel-footer -->
              </div><!-- box box-success  -->
              </div><!-- col-sm-6 -->
            </div><!-- addnewpatient -->
        </div><!-- row -->


        <div class="row">
        <div class="addnewpatient">
            <div class="col-sm-7 col-sm-offset-2">
            <div class="box box-success box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Doctors/Secretaries</h3>
                    <div class="box-tools pull-right">
                        <button type="button"  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            <div class="box-body">
                      <div class="row">
                      </div>

                      <div class="mydata">
                        <div class="row">
                          <div class="col-sm-12">
                          <div class="dataTable_wrapper">
                            <table id="dataTables-patients"  class="table table-striped table-bordered table-hover dataTable dtr-inline" role="grid" style="width: 100%;" width="100%" aria-describedby="dataTables-material">
                                <thead>
                                    <tr> 
                                        <th>First Name</th>
                                        <th>Last Name</th>                                               
                                        <th>Email</th>
                                        <th>Picture</th>
                                        <th>IP Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                          </div><!-- dataTable_wrapper -->
                          </div>
                        </div>
                      </div>
                  </div><!-- panel-body -->
                  <!-- <div class="box-footer  pull-right">
                      <button onclick="modalpatient()" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add to queue</button>
                  </div> panel-footer -->
              </div><!-- box box-success  -->
              </div><!-- col-sm-6 -->
            </div><!-- addnewpatient -->
        </div><!-- row -->

   </div><!-- container -->
</div><!-- content-wrapper -->



<script type="text/javascript">
var siteurl = "<?php print site_url(); ?>";

$(document).ready(function() {
  $('#dataTables-visitors').dataTable();
  show_visitors();
});

function show_visitors() {
  $("#dataTables-visitors").dataTable().fnDestroy();
   table =  $('#dataTables-visitors').DataTable({ 
      "ajax": {
              "url": "<?php echo site_url('admin_history/viewall_visitors')?>",
              "type": "POST",
          },
          responsive: true,
          'bInfo': false
});
}


</script>

