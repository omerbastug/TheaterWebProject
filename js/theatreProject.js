var TheatreService = {
    list : function(){
        var html = "<option selected>Categories</option>"; 
        for(let i = 0;i<Object.keys(categories).length;i++){
            html+= `<option value="${categories[i].id}">${categories[i].name}</option>`;
        }
        $("#categories").html(html);
        html = "";     
        for(let i=0;i<Object.keys(sessions).length;i++){
            html += `
            <a  href="play.html?id=${sessions[i].play_id}&sess_date=${sessions[i].time}&t_id=${sessions[i].theatre_id}&sess_id=${sessions[i].id}" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">${sessions[i].name}</h5>
                    <small></small>
                </div>
                <p class="mb-1">Date : ${sessions[i].time}</p>
                <small>${sessions[i].durationMinutes} minutes long.</small>
            </a>`
            ;
        };
        $("#sessions").html(html);
        // $.ajax({
        //     url: "rest/get/sessions",
        //     type: "GET",
        //     beforeSend: function(xhr){
        //       xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
        //     },
        //     success: function(sessions) {
        //         var html = "";
                
        //         for(let i=0;i<sessions.length;i++){
        //             html += `
        //             <a  href="play.html?id=${sessions[i].play_id}&sess_date=${sessions[i].time}&t_id=${sessions[i].theatre_id}&sess_id=${sessions[i].id}" class="list-group-item list-group-item-action">
        //                 <div class="d-flex w-100 justify-content-between">
        //                     <h5 class="mb-1">${sessions[i].name}</h5>
        //                     <small></small>
        //                 </div>
        //                 <p class="mb-1">Date : ${sessions[i].time}</p>
        //                 <small>${sessions[i].durationMinutes} minutes long.</small>
        //             </a>`
        //             ;
        //         };
        //         $("#sessions").html(html);
        //     },
        //     error: function(XMLHttpRequest, textStatus, errorThrown) {
        //       toastr.error(XMLHttpRequest.responseJSON.message);
        //       loginService.logout();
        //     }
        //  });
    }
}
function SelectSeat(row, col, session){
    $("#tickets").html(`<h1> Selected seat: Row ${row+1} Column ${col+1} at Session number ${session}
    <button type="button" class="btn btn-info" onclick="showPurchaseModal(${row+1},${col+1},${session})">Checkout</button>`);
    $("#seatModal").modal("hide");
}
function listcategory(value){
    if(value == "Categories") return;
    var html = "";     
    for(let i=0;i<Object.keys(sessions).length;i++){
            console.log(value+" "+sessions[i].category);
            if(value==sessions[i].category){
                console.log("match")
                html += `
                <a  href="play.html?id=${sessions[i].play_id}&sess_date=${sessions[i].time}&t_id=${sessions[i].theatre_id}&sess_id=${sessions[i].id}" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">${sessions[i].name}</h5>
                        <small></small>
                    </div>
                    <p class="mb-1">Date : ${sessions[i].time}</p>
                    <small>${sessions[i].durationMinutes} minutes long.</small>
                </a>`;
            
            }
    };
    $("#sessions").html(html);
    console.log(value);
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
                success: function(sessions){
                    PersonName = sessions[0].name;
                    id = sessions[0].id;
                    if(PersonName == entity.name){
                        var ticket = {"session_id": sess,"seatRow":row,"seatColumn":col,"personID": id};
                        $.ajax({
                            url: 'rest/add/tickets',
                            type: 'POST',
                            beforeSend: function(xhr){
                                xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
                            },
                            sessions: JSON.stringify(ticket),
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
//                     <p>${sessions[i].name} at ${sessions[i].time}, ${sessions[i].durationMinutes}minutes long. 
//                     tickets available: ${sessions[i].ticketsAvailable}</p>
//                         <div class="btn-group" role="group" aria-label="Basic mixed styles example">
//                             <button type="button" class="btn btn-light" onclick="TheatreService.showSeats(${sessions[i].theatre_id},${sessions[i].id})">Show Seats</button>
//                             <button type="button" class="btn btn-info" onclick=""><a href="play.html?id=${sessions[i].play_id}">Info</a></button>
//                         </div>
//                     </div>
