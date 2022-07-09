var TheatreService = {
    list : function(){
        $.ajax({
            url: "rest/get/sessions",
            type: "GET",
            beforeSend: function(xhr){
              xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
            },
            success: function(data) {
                var html = "";
                for(let i=0;i<data.length;i++){
                    html += `
                    <a  href="play.html?id=${data[i].play_id}&sess_id=${data[i].id}&t_id=${data[i].theatre_id}" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">${data[i].name}</h5>
                            <small></small>
                        </div>
                        <p class="mb-1">Date : ${data[i].time}</p>
                        <small>${data[i].durationMinutes} minutes long.</small>
                    </a>`
                    ;
                };
                $("#sessions").html(html);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
              toastr.error(XMLHttpRequest.responseJSON.message);
              loginService.logout();
            }
         });
    }
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
            $.ajax({
                url: "rest/get/isaperson/"+entity.email,
                type: "GET",
                beforeSend: function(xhr){
                  xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
                },
                success: function(data){
                    PersonName = data[0].name;
                    id = data[0].id;
                    if(PersonName == entity.name){
                        var ticket = {"session_id": sess,"seatRow":row,"seatColumn":col,"personID": id};
                        $.ajax({
                            url: 'rest/add/tickets',
                            type: 'POST',
                            beforeSend: function(xhr){
                                xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
                            },
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
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                  toastr.error(XMLHttpRequest.responseJSON.message);
                  loginService.logout();
                }
             });
        }
    });
}

// <div style="border: 3px solid red; display: block; width:100%;">
//                     <p>${data[i].name} at ${data[i].time}, ${data[i].durationMinutes}minutes long. 
//                     tickets available: ${data[i].ticketsAvailable}</p>
//                         <div class="btn-group" role="group" aria-label="Basic mixed styles example">
//                             <button type="button" class="btn btn-light" onclick="TheatreService.showSeats(${data[i].theatre_id},${data[i].id})">Show Seats</button>
//                             <button type="button" class="btn btn-info" onclick=""><a href="play.html?id=${data[i].play_id}">Info</a></button>
//                         </div>
//                     </div>
