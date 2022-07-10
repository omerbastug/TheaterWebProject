function getQuerystring(key) { 
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split("=");
        if (pair[0] == key) {
            console.log(pair);
            return pair[1];
        }
    }
}

var PlayService = {
    info : function(id){
        var play;
        $.ajax({
            url: `rest/get/play/${id}`,
            type: "GET",
            async: false,
            timeout: 30000,
            beforeSend: function(xhr){
            xhr.setRequestHeader('Authorization', localStorage.getItem("token"));
            },
            success: function(data){
                play = data;
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
            toastr.error(XMLHttpRequest.responseJSON.message);
            toastr.error('AJAX error', 'Inconceivable!');
            console.log("error");
            }
        });
        return play;
    },
    showSeats: function(id,sess){
        $('.showSeat').attr('disabled', true);
        $(".modal-body").html('<div class="spinner-border" role="status"> <span class="visually-hidden">Loading...</span> </div>');
        $("#seatModal").modal("show");
        var html = "";
        jwttokennn = localStorage.getItem('token');
        let sold;
        $.ajax({
            async: false,
            url: `rest/get/ticketsbysess/${sess}`,
            type: "GET",
            beforeSend: function(xhr){
            xhr.setRequestHeader('Authorization', jwttokennn);
            },
            success: function(data){
                sold = data;
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
            toastr.error(XMLHttpRequest.responseJSON.message);
            loginService.logout();
            }
        });
        $.ajax({
            async: false,
            url: `rest/get/theatre/${id}`,
            type: "GET",
            beforeSend: function(xhr){xhr.setRequestHeader('Authorization', jwttokennn);},
            success: function(data){
                for(let i = 0; i < data.numberofrows; i++){
                    html += `<p style="diplay: inline-block;"> ${i+1}</p>`
                    for(let j = 0; j < data.numberofcolumn;j++){
                        var hasMatch =false;
                        for (var index = 0; index < sold.length; ++index) {
                            var item = sold[index];
                            if(item.seat == i+","+j){
                            hasMatch = true;
                            break;
                            }
                        }
                        if(hasMatch){
                            html+= `<button disabled style="diplay: inline-block; margin: 5px;" type="button" class="btn btn-danger" onclick="SelectSeat(${i},${j},${sess})">${j+1}</button>`;
                        } else {
                            html+= `<button style="diplay: inline-block; margin: 5px;" type="button" class="btn btn-primary" onclick="SelectSeat(${i},${j},${sess})">${j+1}</button>`;
                        }
                    }
                    html += `<br>`;
                }
                $(".modal-body").html(html);
                $('.showSeat').attr('disabled',false);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
            toastr.error(XMLHttpRequest.responseJSON.message);
            loginService.logout();
            }
        });
    }
}
function SelectSeat(row, col, session){
    $("#tickets").html(`<h1> Selected seat: Row ${row+1} Column ${col+1} at Session number ${session} `);
    let data = {"session_id": session, "seat_row" : row, "seat_column":col};
    var stored = JSON.parse(localStorage.getItem("selected_seats"));
    if(stored == null){
        var seats = [];
        seats.push(data);
        localStorage.setItem("selected_seats",JSON.stringify(seats));
    } else {
        stored.push(data);
        localStorage.setItem("selected_seats",JSON.stringify(stored));
    }
    // <button type="button" class="btn btn-info" onclick="showPurchaseModal(${row+1},${col+1},${session})">Checkout</button>`);
    $("#seatModal").modal("hide");
    $("#cartToast").toast("show");
}