var csrfToken = $('meta[name="csrfToken"]').attr('content');
    $('#modal-form').on('submit',function(e){
        e.preventDefault();
        var data = $('#service').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': csrfToken
              },
            url:'/admin/services/addServices',
            type:'JSON',
            method:'POST',
            data : {'service':data},
            success : function(response){
                if(response == 1){
                    $('#exampleModal').modal('hide');
                    $('#table-hide').load('/admin/services/serviceManagment #table-hide');
                    $('#modal-form')[0].reset();
                    swal({
                        title: "Data insert successful",
                        text: "You clicked the button!",
                        icon: "success",
                        button: "Okk",
                      });
                      
                    }else{
                        $('#service-error').text('Aleardy exits').css('color','red');
                    }
                   


            }
        })
        return false;
    });
    // service edit 
    $('.edit').on('click',function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        $.ajax({
           url:'/admin/services/editDataGet',
            type:'JSON',
            method:'get',
            data : {'id':id},
            success : function(response){
             var data = JSON.parse(response);
            
                $('#edit').modal('show');
                $('#service-id').val(data['id'])
                $('#get-service').val(data['service']);

             }
        })
        return false;
    });

    // service edit 
    $('.edit-form').on('click',function(e){
        e.preventDefault();
        var data = $('#edit-form').serialize();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': csrfToken
              },
            url:'/admin/services/editService',
            type:'JSON',
            method:'POST',
            data :data,
            success : function(response){
                if(response == 1){
                    $('#edit').modal('hide');
                    swal({
                        title: "Data insert successful",
                        text: "You clicked the button!",
                        icon: "success",
                        button: "Okk",
                      });
                      $('#table-hide').load('/admin/services/serviceManagment #table-hide');
                      
                }

            }
        })
        return false;
    });
   
    $('.view').on('click',function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        $.ajax({
           url:'/admin/projects/serviceView',
            type:'JSON',
            method:'get',
            data : {'id':id},
            success : function(response){
             $('#edit').modal('show');
               $('#show').html(response); 
            }
        })
        return false;
    });

    // $('#assigned-form').on('submit',function(e){
    //     e.preventDefault();
        // var user_id = $('#user_id').val();
        // var project_id = $('#project_id').val();
        $("#assigned-form").validate({
            rules: {
                    
                "assigned_userid[]":"required",
          },
          
            messages: {
                "assigned_userid[]":{
                  required:"Please select at least one contractor to assign project",
              },
            },submitHandler: function (form) {
  
                var data = $(form).serialize();
                // alert(data);return false;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    url:'/admin/projects/assign',
                    type:'JSON',
                    method:'POST',

                    data:data,
                    success:function(response){
                        if(response == 1){
                            alert('Project has been assigned');
                        }
                        if(response == 2){
                            alert('This Project Already have assigned');
                        }
                    
                    }
                });
            }
    });

    // $('.assigned-user').on('click',function(){
    //     // alert('wjhefhrw');
    //     var project_id = $(this).attr('data-id');
    //     // alert(project_id);

    //     $.ajax({

    //         url:'/projects/assigned-users',
    //         method:'get',
    //         type:'JSON',
    //         data :{'id':project_id},
    //         success : function(response){
    //             data = $.parseJSON(response);
                   
    //             // $.each(data, function(index) {
    //             //     $('#fname').val(index['user_profile']['first_name'])
    //             //     $('#phone').val(index['user_profile']['phone'])
    //             // });
    //             $.each(data, function(K, v) {
    //                 myHtml = "<li>"+v['assigned_userid'] +"</li>"   ;
    //                 alert(myHtml);                 
    //             });
    //             // $.each(data, function(k, v) { 
    //             //     if (k == 'assigned_users') {
    //             //         $.each($(this), function(index, value) {
    //             //             alert(index);return false;
    //             //             // console.log(index+value);
                           
    //             //             if (value.status != 0) {
    //             //                 countp++;
    //             //                 // myHtml += "<li><span>" + value.assigned_userid[] + "</span></li>";
    //             //                 alert(value);
    //             //                 // console.log(value['product_title']);
    //             //             }
    //             //         });
    //             //     }
    //             // });

    //             $("#response").html(myHtml);
    //             // $('#count').html(countp);
    //         }
    //     })
    //  });
    

