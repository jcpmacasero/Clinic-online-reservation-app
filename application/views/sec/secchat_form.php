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
  <div class="reports-head-p">
    <p class="dashboard-p">Clinic Chat</p>
 </div>

<section class="content">
  <div class="row">
      <div class="col-md-4">
        Assigned Doctors: &nbsp;
        <select class="form-control" id="doctor_select">
        <option></option>
        <?php foreach($doctors as $each){ ?>
            <option value="<?php echo $each->user_id; ?>">Dr. &nbsp;<?php echo $each->user_fname; echo " "; echo $each->user_lname; ?></option>';
        <?php } ?> 
        </select>
      </div><!-- col-md-4 -->
    </div><!-- row -->

    <div class="row">
      <div class="col-md-11">
          <div class="row">
              <div class="col-md-7">

                <div class="container">
                  <div class="row">
                      <div class="col-md-7">
                        <div class="mychat">
                          <div class="panel panel-primary">
                              <div class="panel-heading">
                                  <span class="glyphicon glyphicon-comment"></span> Chat
                                  <div class="btn-group pull-right">
                                      <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                          <span class="glyphicon glyphicon-chevron-down"></span>
                                      </button>
                                      <ul class="dropdown-menu slidedown">
                                          <li><a onclick="chat_clear()"><span class="glyphicon glyphicon-refresh">
                                          </span>Clear Chat</a></li>
                                      </ul>
                                  </div>
                              </div>
                              <div class="panel-body">
                                <div id="mychatbox">

                                </div> <!-- mychatbox -->
                              </div>
                              <div class="panel-footer">
                                  <div class="input-group">
                                      <input id="btn-input" type="text" class="form-control input-sm" placeholder="Say Something!" />
                                      <span class="input-group-btn">
                                          <button class="btn btn-warning btn-sm" id="btn-chat">
                                              Send</button>
                                      </span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- mychat -->
                        </div>
                    </div>
              </div>
              </div>
              <div class="col-md-2 col-md-offset-3">
                
              </div>
          </div>
      </div>
    </div>
</section>
    
</div><!-- content-wrapper -->
 



  <!-- ==============================================================
            MODALS
 ================================================================== -->



<script type="text/javascript">
var siteurl = "<?php print site_url(); ?>";
var selectedChat;
var chat_id;

$('#doctor_select').change(function(){
    $('div#mychatbox').empty();
    var selectedStat = $(this).val();
    selectedChat = selectedStat
    getchatID(selectedChat);

  setInterval(function() { get_chat_messages(); } , 2500);

  function get_chat_messages() {
    $.ajax({
    url: siteurl+"sec_clinicchat/ajax_get_chat_messages",
    type: "POST",
    data: {chat_id:chat_id},
    dataType: "JSON",
      success: function(data) {
        if(data.status == 'ok') {
            var current_content = $('div#mychatbox').html();
            $('div#mychatbox').html(current_content + data.content);
            objDiv.scrollTop = objDiv.scrollHeight;
        }
        else {

        }

      }
    });  
}
   
});

function getchatID(userID) {
 $.ajax({
        url: siteurl+"sec_clinicchat/getChatID/"+userID,
        type: "POST",
        dataType: "JSON",
        success: function(data) {
          chat_id = data[0]['chat_id'];
        }
  });
}

function chat_clear() {  
  $('div#mychatbox').empty();
}

$('#btn-chat').click(function () {

    var chat_message_content = $('#btn-input').val();
    //alert(chat_message_content);
    if(chat_message_content == "") { return false; }

    $.ajax({
    url: siteurl+"sec_clinicchat/ajax_add_chat_message",
    type: "POST",
    data: {chat_message_content:chat_message_content, chat_id:chat_id},
    dataType: "JSON",
      success: function(data) {
        if(data.status == 'ok') {
            var current_content = $('div#mychatbox').html();
            $('div#mychatbox').html(current_content + data.content);
            objDiv.scrollTop = objDiv.scrollHeight;  
        }
        else {

        }
      }
    });
    $('#btn-input').val("");
    return false;

});

$(document).ready(function() {
  $('#btn-input').keypress(function(e) {
      if(e.which == 13) {
        $('#btn-chat').click();
        return false;
      }
  });

});

</script>
