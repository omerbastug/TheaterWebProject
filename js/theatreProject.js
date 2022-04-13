function showSeats(id,sess){
    $('.showSeat').attr('disabled', true);
    $("#modal-body").html("");
    var html = "";
    $.get("rest/get/theatre/"+id, function(data){
        for(let i = 0; i < data[0].numberofrows; i++){
            html += `<p style="diplay: inline-block;"> ${i+1}</p>`
            for(let j = 0; j < data[0].numberofcolumn;j++){
                html+= `<button id="sr${i}sc${j}" style="diplay: inline-block; margin: 5px;" type="button" class="btn btn-primary">${j+1}</button>`;
            }
            html += `<br>`;
        }
        $.get("rest/get/ticketsbysess/"+sess, function(data){
            for(let k = 0; k < data.length;k++){
                $(`#sr${data[k].seatRow - 1}sc${data[k].seatColumn - 1}`).attr('disabled', true);
            }
        });
        $(".modal-body").html(html);
        $("#seatModal").modal("show");
        $('.showSeat').attr('disabled',false);
    });
    }

var TheatreService = {
    init: function(){
        // var response;
        // $.validator.addMethod(
        //     "emailexists", 
        //     function(value, element) {
        //         $.ajax({
        //             type: "POST",
        //             url: `rest/isaperson/${value.email}`,
        //             dataType:"html",
        //             success: function(msg)
        //             {
        //                 response = ( msg.length != 0 ) ? true : false;
        //             }
        //          });
        //         return response;
        //     },
        //     "Username is Already Taken"
        // );
        // $.validator.addClassRules("email" , {emailexists : true})

        $("#loginForm").validate();
    },

    list : function getSessions(){
        $.get("rest/get/sessions", function(data){
        var html ="";
        for(let i=0;i<data.length;i++){
            html += `<div style="border: 3px solid red; display: block; width:100%;">
            <p>${data[i].name} at ${data[i].time}, ${data[i].durationMinutes}minutes long. 
            tickets available: ${data[i].ticketsAvailable}</p>
            <button class="button1 showSeat" style="display: block;" onclick="showSeats(${data[i].theatre_id},${data[i].id})">Show Seats</button>
            </div>`;
        };
        $("#sessions").html(html);
        }); 
    }
}


