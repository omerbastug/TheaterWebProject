var registrationService = {
    init : function(){
        $('#registration_form').validate({
            submitHandler: function(formdata){
                var entity = Object.fromEntries((new FormData(formdata)).entries());
                entity.role_id = 2;
                registrationService.register(entity);
            }
        })
    },
    register : function(entity){
        $("#register_submit").attr('disabled',true);
        $.ajax({
            url: 'rest/register',
            type: 'POST',
            data: JSON.stringify(entity),
            contentType: "application/json",
            dataType: "json",
            success: function(result) {
              console.log(result);
              window.location.replace("login.html");
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                $("#register_submit").attr('disabled',false);
                toastr.error(XMLHttpRequest.responseJSON.message);
            }
        });

    }
}