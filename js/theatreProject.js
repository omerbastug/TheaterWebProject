function showSeats(id,sess){
    $('.showSeat').attr('disabled', true);
    $(".modal-body").html('<div class="spinner-border" role="status"> <span class="visually-hidden">Loading...</span> </div>');
    $("#seatModal").modal("show");
    var html = "";
    $.get("rest/get/theatre/"+id, function(data){
        for(let i = 0; i < data[0].numberofrows; i++){
            html += `<p style="diplay: inline-block;"> ${i+1}</p>`
            for(let j = 0; j < data[0].numberofcolumn;j++){
                html+= `<button id="sr${i}sc${j}" style="diplay: inline-block; margin: 5px;" type="button" class="btn btn-primary" onclick="SelectSeat(${i},${j},${sess})">${j+1}</button>`;
            }
            html += `<br>`;
        }
        $.get("rest/get/ticketsbysess/"+sess, function(data){
            for(let k = 0; k < data.length;k++){
                $(`#sr${data[k].seatRow - 1}sc${data[k].seatColumn - 1}`).attr('disabled', true);
                $(`#sr${data[k].seatRow - 1}sc${data[k].seatColumn - 1}`).css('background-color', "red");
            }
        });
        $(".modal-body").html(html);
        $('.showSeat').attr('disabled',false);
    });
    }

function SelectSeat(row, col, session){
    $("#tickets").html(`<h1> Selected seat: Row ${row+1} Column ${col+1} at Session number ${session}
    <button type="button" class="btn btn-info" onclick="showPurchaseModal(${row+1},${col+1},${session})">Checkout</button>`);
    $("#seatModal").modal("hide");
}

function showPurchaseModal(row,col,sess){
    $("#purchaseModal").modal("show");
    $("#loginForm").validate({
        submitHandler: function(form){
            var entity = Object.fromEntries((new FormData(form)).entries());
            var PersonName;
            var id;
            $.get("rest/get/isaperson/"+entity.email, function(data){
                PersonName = data[0].name;
                id = data[0].id;
                if(PersonName == entity.name){
                    var ticket = {"session_id": sess,"seatRow":row,"seatColumn":col,"personID": id};
                    $.ajax({
                        url: 'rest/add/tickets',
                        type: 'POST',
                        data: JSON.stringify(ticket),
                        contentType: "application/json",
                        dataType: "json",
                        success: function(result) {
                        toastr.success("Purchased!");
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                        toastr.error(XMLHttpRequest.responseJSON.message);
                        alert("Status: " + textStatus); alert("Error: " + errorThrown);
                        }
                    });
                    form.submit();
                }
            });

        }
    });
}
var TheatreService = {
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


