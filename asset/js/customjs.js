

// function get_clinicID() {
//  // $("#clinicID").empty();
//   $.ajax({
//         url: siteurl+"myclinic/get_clinicID",
//         type: "GET",
//         dataType: "JSON",
//         success: function(data) {
//             //$('#clinicID').text(data[0]['clinic_id']);
//             //checkupme();
//         }
//   });
// }

// function search_viewall() {
//     $("#mydatatable").empty();
//     $.ajax({
//       url: siteurl+"search_records/viewall",
//       type: "GET",
//       dataType: "JSON",
//       success: function(data) {
//           if(data.length>0) {
//               for(i=0;i<data.length;i++) {
//                   $("#mydatatable").append('<tr>'+'<td>'+data[i]['check_up_id']+'</td>'+'<td>'+data[i]['patient_fname']+'</td>'+'<td>'+data[i]['patient_lname']+'</td>'+
//                    '<td>'+data[i]['patient_mname']+'</td>'+'<td>'+data[i]['check_up_date']+'</td>'+'<td><button onclick="view_profile('+"'"+data[i]['check_up_date']+"'"+','+"'"+data[i]['check_up_id']+"'"+');" class="btn btn-primary btn-sm">View Profile</button></td>');
//               };
//           }
//           else {
//                   $("#mydatatable").append('<h4> No Records for Today! </h4>');
//           }
//       }
//     })
// }

function view_profile(check_up_date,check_up_id) {
  $('#modaldiagnosis').val("");
  $(".modal-body #check_up_id").val(check_up_id);
  $(".modal-body #check_my_date").text(check_up_date);
  $.ajax({
    url: siteurl+"search_records/view_profbtn",
    type: "POST",
    data: {check_up_id:check_up_id, check_up_date:check_up_date},
    dataType: "JSON",
    success: function(data){
            var newData = data['checkup_diagnosis']        // take the input array,
              .map(function(v) { return v['diagnosis'] })  // map it to get the required values,
              .join(", ")                                  // join the result with commas
            var md = $('#modaldiagnosis')
            md.val(md.val() + newData)

        $('#modalfname').text(data['checkup_profile'][0]['patient_fname']);
        $('#modalmname').text(data['checkup_profile'][0]['patient_mname']);
        $('#modallname').text(data['checkup_profile'][0]['patient_lname']);
        $('#modaladd').text(data['checkup_profile'][0]['patient_address']);
        $('#modalcontact').text(data['checkup_profile'][0]['patient_contact_info']);
        $('#modalsex').text(data['checkup_profile'][0]['patient_sex']);
        $('#modalcv').text(data['checkup_profile'][0]['patient_civil_status']);
        $('#modalbday').text(data['checkup_profile'][0]['patient_bday']);
        $('#modalage').text(data['checkup_profile'][0]['patient_age']);
        $('#modalheight').text(data['checkup_profile'][0]['patient_height']);
        $('#modalweight').text(data['checkup_profile'][0]['patient_weight']);
        $('#modalblood').text(data['checkup_profile'][0]['patient_blood']);
        $('#modalcomplaint').val(data['checkup_profile'][0]['complaint']);
        $('#modalnote').val(data['checkup_profile'][0]['note']);
        $('#modalfindings').val(data['checkup_profile'][0]['finding']);
        $('.clicked_patient_pic').css('background-image', 'url(' + data['checkup_profile'][0]['patient_photo'] + ')');
        $('.clicked_patient_pic_hist').css('background-image', 'url(' + data['checkup_profile'][0]['patient_photo'] + ')');
    }
  });
  $("#view_profile").modal('show');
}

function search_by() {
  $("#mydatatable").empty();
  $.ajax ({
    url: siteurl+"search_records/searchby",
    type:"POST",
    data: $('#frm_search_rec').serialize(),
    dataType: "JSON",
    success: function(data) {
        if(data.length>0) {
              for(i=0;i<data.length;i++) {
                  $("#mydatatable").append('<tr>'+'<td>'+data[i]['check_up_id']+'</td>'+'<td>'+data[i]['patient_fname']+'</td>'+'<td>'+data[i]['patient_lname']+'</td>'+
                   '<td>'+data[i]['patient_mname']+'</td>'+'<td>'+data[i]['check_up_date']+'</td>'+'<td><button onclick="view_profile('+"'"+data[i]['check_up_date']+"'"+','+"'"+data[i]['check_up_id']+"'"+');" class="btn btn-primary btn-sm">View Profile</button></td>');
              };
          }
          else {
                  $("#mydatatable").append('<h4> No Records found! </h4>');
          }
    }
  })
}

function gen_mc() {
  var check_up_id = $('.modal-body #check_up_id').val();
  get_clinic_name(check_up_id);
  var fname = $('.modal-body #modalfname').html();
  var mname = $('.modal-body #modalmname').html();
  var lname = $('.modal-body #modallname').html();
  var fullname = fname +"  "+ mname +".  "+lname;

  $('.modal-body #cert_name').text(fullname);
  $('.modal-body #cert_address').text($('.modal-body #modaladd').html());
  $('.modal-body #cert_diagnosis').text($('.modal-body #modaldiagnosis').val());
  
  
  $('#generate_cert').modal('show');
}

function get_clinic_name(check_up_id) {
var userfname = "";
var usermname = "";
var userlname = "";
  $.ajax({
    url: siteurl+"search_records/get_clinicID/"+check_up_id,
    type: "GET",
    dataType: "JSON",
    success: function(data) {
       $('.modal-body #clinic_name').text(data[0]['clinic_name']);
       $('.modal-body #clinic_address').text(data[0]['clinic_address']);
       $('.modal-body #city_name').text(data[0]['city_name']);
       $('.modal-body #province_name').text(data[0]['province_name']);
       $('.modal-body #zipcode').text(data[0]['zip_code']);
       $("#thecliniclogo").attr('src',''+ data[0]['clinic_logo'] +'');
       $('.cliniclogo').css('background-image', 'url(' + data[0]['clinic_logo'] + ')');
       $('.modal-body #cert_clinic_name').text(data[0]['clinic_name']);
       $('.modal-body #cert_physician').text(data[0]['user_fname']+'  '+data[0]['user_mname']+'  '+data[0]['user_lname']);
       $('.modal-body #cert_physician_sig').text(data[0]['user_fname']+'  '+data[0]['user_mname']+'  '+data[0]['user_lname']);
    }
  })
}

function print_cert(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
}

function user_profile() {
  $.ajax({
    url:siteurl+"profile/get_profile",
    type:"GET",
    dataType: "JSON",
      success: function(data) {
        $('#editfname').val(data[0]['user_fname']);
        $('#editmname').val(data[0]['user_mname']);
        $('#editlname').val(data[0]['user_lname']);
        $('#editaddess').val(data[0]['user_address']);
        $('#editcontact').val(data[0]['user_contact_info']);
      }
  })
}

function editmyprofile() {
  $('.form-group').removeClass('has-error'); 
  $('.help-block').empty();
  $('#btnUpdatepp').text('Updating...'); //change button text
  $('#btnUpdatepp').attr('disabled',false); //set button enable 
  $.ajax({
    url:siteurl+"profile/edit_myprofile",
    type: "POST",
    data: $('#editpersonalprofile').serialize(),
    dataType: "JSON",
      success: function(data) {
          if(data.status) {
            alert('Profile already updated!');
            window.location.reload();
          }
          else {
              for (var i = 0; i < data.inputerror.length; i++)  {
                  $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                  $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
              }
          }
          $('#btnUpdatepp').text('Update Profile'); //change button text
          $('#btnUpdatepp').attr('disabled',false); //set button enable 
          },
          error: function (jqXHR, textStatus, errorThrown) {
              alert('Error updating data' + jqXHR+ textStatus +errorThrown);
              $('#btnUpdatepp').text('Update Profile'); 
              $('#btnUpdatepp').attr('disabled',false); 
          }
  });
}



function countDiagnose() {
  $.ajax({
    url: siteurl+"dashboard_admin/count_diagnose",
    type: "GET",
    dataType: "JSON",
      success: function(data) {
          $('#diagnose').text(data[0]['COUNT(tbl_check_up.check_up_id)']);
      }
  });
}

function countQueue() {
  $.ajax({
    url: siteurl+"dashboard_admin/count_queue",
    type: "GET",
    dataType: "JSON",
      success: function(data) {
          $('#queue').text(data[0]['COUNT(tbl_queue.queue_id)']);
      }
  })
}

function sumEarningsToday(){
  $.ajax({
    url: siteurl+"dashboard_admin/count_earnings",
    type: "GET",
    dataType: "JSON",
      success: function(data) {
        if(data[0]['SUM(tbl_bill.bill_amt)'] == null) {
        $('#earn').text("P"+" "+"0");     
        }
        else {
        var a = data[0]['SUM(tbl_bill.bill_amt)'];
        var b = numberWithCommas(a);
        $('#earn').text("P"+" "+b);     
        } 
      }
  })
}

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function adminview_profile(user_id){
  $('.modal-body #usermyID').val(user_id);
  $.ajax({
    url: siteurl+"admin_controls/getuser/"+user_id,
    type: "GET",
    dataType: "JSON",
      success: function(data){
        $('.modal-body #admin_fname').val(data[0]['user_fname']);
        $('.modal-body #admin_mname').val(data[0]['user_mname']);
        $('.modal-body #admin_lname').val(data[0]['user_lname']);
        $('.modal-body #admin_address').val(data[0]['user_address']);
        $('.modal-body #admin_contact').val(data[0]['user_contact_info']);
        $('.modal-body #admin_username').val(data[0]['user_name']);
        $('.modal-body #admin_password').val(data[0]['user_password']);
        $('.modal-body .clicked_patient_pic').css('background-image', 'url(' + data[0]['user_photo'] + ')');
        if(data[0]['user_type'] == 'ut2') {
          $("#position_user").val("ut2");
          document.getElementById('assigndocs').style.visibility = 'hidden';
        }
        else if (data[0]['user_type'] == 'ut3') {
          $("#position_user").val("ut3"); 
          document.getElementById('assigndocs').style.visibility = 'visible';
        }
        $('#admin_view_prof').modal('show');
      }
  });
  

}

// function adminview_profile() {
//   $.ajax({
//     url:siteurl+"admin_controls/",
//     type: "GET",
//     dataType: "JSON",
//       success: function(data) {

//       }
//   })
// }

// function changepass(e) {
//     e.preventDefault();
//     jQuery.ajax({
//     type: "POST",
//     url:  siteurl+"profile/update_password",
//     data: $("#pass_form").serialize(),
//     success: function(res) {
//         $(".ajax_pass_result").html(res);
//      }
//     });
// }

                    /*                
               </tr> */

/*
function create_clinic() {
  $('#btnCreateClinic').text('Saving...');
  $('#btnCreateClinic').attr('disabled',true);
  
  
  $.ajax({
          url : siteurl+"clinic_admin/create_clinic",
          type: "POST",
          data: $('#frm_create_clinic').serialize(),
          dataType: "JSON",
          success: function(data)
          {
          if(data.status) {
            alert('Added Sucessfuly');
          }
          else
          {
              for (var i = 0; i < data.inputerror.length; i++) 
              {
                  $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                  $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); 
              }
          }
          $('#btnCreateClinic').text('Save'); //change button text
          $('#btnCreateClinic').attr('disabled',false); //set button enable 


          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error adding data' + jqXHR+ textStatus +errorThrown);
              $('#btnCreateClinic').text('Save'); 
              $('#btnCreateClinic').attr('disabled',false); 

          }
      }); 
}         
         
*/
/*
<div class="col-sm-10">
            <div class="panel-group">
              <div class="panel panel-info">
                <div class="panel-heading">
                  <h4><a data-toggle="collapse" href="#patientinfo">#1 Taguro <span class="fa fa-arrow-circle-o-down pull-right"></span></a></h4>
                </div><!-- panel-heading -->
                <div id="patientinfo" class="panel-collapse collapse">
                  <div class="panel-body">
                     <div class="row">
                        <div class="col-sm-4">
                        <button class="btn btn-success btn-sm">Check me up</button>
                        </div><!-- col-sm-4 -->
                        <div class="col-sm-6">
                          <div class="img-patient">
                            <div class="patient-pic"></div>
                          </div><!-- img-patient -->
                        </div><!-- col-sm-6 -->
                     </div><!-- row -->
                  </div><!-- panel-body -->
                </div><!-- panel-collapse -->
              </div><!-- panel -->
            </div><!-- panel-group -->
          </div><!-- col-sm-10 -->
*/