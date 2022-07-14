var TheatreService = {
    list : function(val){
        let id
        if(val){ 
            id = getQuerystring("id");
        }
        if(id == undefined){ // list all sessions
            var html=`<div  id="titlediv" class="d-flex justify-content-between  flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Sessions</h1>
                    </div>
                    <select id="categories" onchange="listcategory(value)" class="form-select" aria-label="Default select example">
                    `;
        
            html += "<option selected>Categories</option>"; 
            for(let i = 0;i<Object.keys(categories).length;i++){
                html+= `<option value="${categories[i].id}">${categories[i].name}</option>`;
            }
            html += `</select>
            <div  class="list-group" id="sessions"> 
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>`
            $("#mainbody").html(html);
            listcategory("Categories");
        } else { // list sessions for the selected play
            var play = PlayService.info(id);
            var html=`<div  id="titlediv" class="d-flex justify-content-between  flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Sessions for ${play.name}</h1>
                    </div>`;
            for(let i=0;i<Object.keys(sessions).length;i++){
                if(play.id == sessions[i].play_id){
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
            $("#mainbody").html(html);
        }
        
    }
}
// function SelectSeat(row, col, session){
//     $("#tickets").html(`<h1> Selected seat: Row ${row+1} Column ${col+1} at Session number ${session}
//     <button type="button" class="btn btn-info" onclick="showPurchaseModal(${row+1},${col+1},${session})">Checkout</button>`);
//     $("#seatModal").modal("hide");
// }
function listcategory(value){
    if(value == "Categories") {
        var html;
        html = "";     
        for(let i=0;i<Object.keys(sessions).length && i<10;i++){
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
        return;
    };
    var html = "";     
    for(let i=0;i<Object.keys(sessions).length && i<10;i++){
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

// function showPurchaseModal(row,col,sess){
//     $("#purchaseModal").modal("show");
//     $("#loginForm").validate({
//         submitHandler: function(form){
//             var entity = Object.fromEntries((new FormData(form)).entries());
//             var PersonName;
//             var id;
//             $.ajax({
//                 url: "rest/get/isaperson/"+entity.email,
//                 type: "GET",
//                 beforeSend: function(xhr){
//                   xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
//                 },
//                 success: function(sessions){
//                     PersonName = sessions[0].name;
//                     id = sessions[0].id;
//                     if(PersonName == entity.name){
//                         var ticket = {"session_id": sess,"seatRow":row,"seatColumn":col,"personID": id};
//                         $.ajax({
//                             url: 'rest/add/tickets',
//                             type: 'POST',
//                             beforeSend: function(xhr){
//                                 xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
//                             },
//                             sessions: JSON.stringify(ticket),
//                             contentType: "application/json",
//                             dataType: "json",
//                             success: function(result) {
//                             toastr.success("Purchased!");
//                             },
//                             error: function(XMLHttpRequest, textStatus, errorThrown) {
//                             toastr.error(XMLHttpRequest.responseJSON.message);
//                             alert("Status: " + textStatus); alert("Error: " + errorThrown);
//                             }
//                         });
//                         form.submit();
//                     }
//                 },
//                 error: function(XMLHttpRequest, textStatus, errorThrown) {
//                   toastr.error(XMLHttpRequest.responseJSON.message);
//                   loginService.logout();
//                 }
//              });
//         }
//     });
// }
var plays;
function listPlays(){
    var loading = `
    <div class="d-flex justify-content-center">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>`;
    $("#mainbody").html(loading);

    var html =` <div class="d-flex justify-content-between  flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Plays</h1>
                </div>`;
    html += `<select id="categories" onchange="categorizePlays(value)" class="form-select" aria-label="Default select example">
                    <option selected>Categories</option>`; 
    for(let i = 0;i<Object.keys(categories).length;i++){
        html+= `<option value="${categories[i].id}">${categories[i].name}</option>`;
    }
    html += `</select> <br>`
    if(plays == undefined){
        $.ajax({
            url: "rest/get/play",
            type: "GET",
            //async: false,
            beforeSend: function(xhr){
              xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
            },
            success: function(data) {
                plays = data;
                html += `<div id="cardgroup" class="row row-cols-1 row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 g-4">`;
                for(let i = 0;i<plays.length; i++){
                    html += `
                        <div class="col">
                            <div class="card h-100 ">
                            <a href="play.html?id=${plays[i].id}">
                            <img src="images/play/${plays[i].id}.jpg" class="card-img-top" alt="...">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">${plays[i].name}</h5>
                                <p class="card-text">${plays[i].author}</p>
                            </div>
                            </div>
                        </div>`;
                }
                html += `</div>`
                $("#mainbody").html(html);
                console.log(plays);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
              toastr.error(XMLHttpRequest.responseJSON.message);
              loginService.logout();
            }
        });
    } else {
        html += `<div id="cardgroup" class="row row-cols-1 row-cols-md-3 g-4">`;
                for(let i = 0;i<plays.length; i++){
                    html += `
                        <div class="col">
                            <div class="card h-100">
                            <a href="play.html?id=${plays[i].id}">
                            <img src="images/play/${plays[i].id}.jpg" class="card-img-top" alt="...">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">${plays[i].name}</h5>
                                <p class="card-text">${plays[i].author}</p>
                            </div>
                            </div>
                        </div>`;
                }
                html += `</div>`
                $("#mainbody").html(html);
    }
    
    
}

function categorizePlays(value){
    var html = "";
    if(value == "Categories"){
        for(let i = 0;i<plays.length; i++){
            html += `
            <div class="col">
                <div class="card h-100">
                <a href="play.html?id=${plays[i].id}">
                <img src="images/play/${plays[i].id}.jpg" class="card-img-top" alt="...">
                </a>
                <div class="card-body">
                    <h5 class="card-title">${plays[i].name}</h5>
                    <p class="card-text">${plays[i].author}</p>
                </div>
                </div>
            </div>`;
        }
    } else {
        for(let i = 0;i<plays.length; i++){
            if(value == plays[i].category){
                html += `
                        <div class="col">
                            <div class="card h-100">
                            <a href="play.html?id=${plays[i].id}">
                            <img src="images/play/${plays[i].id}.jpg" class="card-img-top" alt="...">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">${plays[i].name}</h5>
                                <p class="card-text">${plays[i].author}</p>
                            </div>
                            </div>
                        </div>`;
        }
        } 
    }
    $("#cardgroup").html(html);
}

var actors;
function listActors(){
    var loading = `
    <div class="d-flex justify-content-center">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>`;
    var html = `<div class="d-flex justify-content-between  flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Actors </h1>
</div><br>`;
    $("#mainbody").html(loading);
    if(actors == undefined){
    $.ajax({
        url: `rest/get/person/actor`,
        type: "GET",
        //async: false,
        timeout: 30000,
        beforeSend: function(xhr){
        xhr.setRequestHeader('Authorization', localStorage.getItem("token"));
        },
        success: function(data){
            actors = data;
            console.log(actors);
            html += `<div class="container">
                            <div class="row">`;
            for(let i= 0;i<actors.length;i++){
                html += `<div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="our-team">
                            <div class="picture">
                                <img class="img-fluid" src="https://picsum.photos/130/130">
                            </div>
                            <div class="team-content">
                                <h3 class="name">${actors[i].name + " " + actors[i].surname}</h3>
                                <!-- <h4 class="title">${actors[i].role_id}</h4> -->
                            </div>
                            <ul class="social">
                                <li><a href="mailto:${actors[i].email}" class="fa fa-envelope" aria-hidden="true"></a></li>
                            </ul>
                            </div>
                        </div>`;
            }
            html += `</div></div>`;
            $("#mainbody").html(html);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
        toastr.error(XMLHttpRequest.responseJSON.message);
        toastr.error('AJAX error', 'Inconceivable!');
        console.log("error");
        }
    });} else {
        html += `<div class="container">
                            <div class="row">`;
            for(let i= 0;i<actors.length;i++){
                html += `<div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="our-team">
                            <div class="picture">
                                <img class="img-fluid" src="https://picsum.photos/130/130">
                            </div>
                            <div class="team-content">
                                <h3 class="name">${actors[i].name + " " + actors[i].surname}</h3>
                                <!-- <h4 class="title">${actors[i].role_id}</h4> -->
                            </div>
                            <ul class="social">
                                <li><a href="mailto:${actors[i].email}" class="fa fa-envelope" aria-hidden="true"></a></li>
                            </ul>
                            </div>
                        </div>`;
            }
            html += `</div></div>`;
            $("#mainbody").html(html);
    }
    
}

function showProfile(){
    var loading = `
    <div class="d-flex justify-content-center">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>`;
    $("#mainbody").html(loading);
    $.ajax({
        url: "rest/get/user",
        type: "GET",
        //async: false,
        beforeSend: function(xhr){
          xhr.setRequestHeader('Authorization', localStorage.getItem('token'));
        },
        success: function(data) {
            var html  = ` <div class="container-xl px-4 mt-4">
                            <hr class="mt-0 mb-4">
                            <div class="row">
                                <div class="col-xl-4">
                                    <!-- Profile picture card-->
                                    <div class="card mb-4 mb-xl-0">
                                        <div class="card-header">Profile Picture</div>
                                        <div class="card-body text-center">
                                            <!-- Profile picture image-->
                                            <img class="img-account-profile rounded-circle mb-2" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                                            <!-- Profile picture help block-->
                                            <div class="small font-italic  mb-4">This is BIO</div>
                                            <!-- Profile picture upload button-->
                                        <!-- <button class="btn btn-primary" type="button">Upload new image</button> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-8">
                                    <!-- Account details card-->
                                    <div class="card mb-4">
                                        <div class="card-header">Account Details</div>
                                        <div class="card-body">
                                        <form id="profilePageForm">
      
                                            <div class="row">
                                            <div class="col-md-6 mb-4">
                            
                                                <div class="form-outline">
                                                <input type="text" name="name" id="firstName" class="form-control form-control-lg profileinput" value="${data.name}" />
                                                <label class="form-label" for="firstName">Name</label>
                                                </div>
                            
                                            </div>
                                            <div class="col-md-6 mb-4">
                            
                                                <div class="form-outline">
                                                <input type="text" name="surname" id="lastName" class="form-control form-control-lg profileinput" value="${data.surname}" />
                                                <label class="form-label" for="lastName">Surname</label>
                                                </div>
                            
                                            </div>
                                            </div>
                            
                            
                                            <div class="row">
                                            <div class="col-md-6 mb-4 pb-2">
                            
                                                <div class="form-outline">
                                                <input type="email" name="email" id="emailAddress" class="form-control form-control-lg profileinput" value="${data.email}"/>
                                                <label class="form-label" for="emailAddress">Email</label>
                                                </div>
                            
                                            </div>
                                            <div class="col-md-6 mb-4 pb-2">
                            
                                                <div class="form-outline">
                                                <input type="password" name="password" id="pwdinput" class="form-control form-control-lg profileinput" value="${data.password}"/>
                                                <label class="form-label" for="password">Password</label>
                                                </div>
                            
                                            </div>
                                            </div>
                            
                            
                                            <div id="profilebuttondiv" class="mt-4 pt-2">
                                            <input id="profilebutton" class="btn btn-primary btn-lg" type="button" onclick="updateAccountDetails()" value="Update"/>
                                            </div>
                            
                                        </form>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
            $("#mainbody").html(html);
            $(".profileinput").prop("disabled",true);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
          toastr.error(XMLHttpRequest.responseJSON.message);
          loginService.logout();
        }
    });
    
}
function updateAccountDetails(){
    $(".profileinput").attr("disabled",false);
    $("#profilebutton").hide();
    $("#profilePageForm").append(`<input id="updatebutton" class="btn btn-primary btn-lg" type="submit" value="Save Changes"/>
    `);

    $('#profilePageForm').validate({
        submitHandler: function(formdata){
            var entity = Object.fromEntries((new FormData(formdata)).entries());            
            updateAjax(entity);
        }
    });

}

function updateAjax(entity){
    $("#updatebutton").attr('disabled',true);
    $.ajax({
        url: 'rest/update/user',
        type: 'PUT',
        async: false,
        beforeSend: function(xhr){
            xhr.setRequestHeader('Authorization', localStorage.getItem("token"));
            },
        data: JSON.stringify(entity),
        contentType: "application/json",
        dataType: "json",
        success: function() {
          console.log("done");
          showProfile();
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            $("#profilebutton").attr('disabled',false);
            toastr.error(XMLHttpRequest.responseJSON.message);
        }
    });
    showProfile();

}
