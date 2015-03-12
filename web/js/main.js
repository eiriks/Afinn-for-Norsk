$(document).ready(function () {
    var opts = {userCollapseText: '../', slicePoint: 350,expandText: 'Se mer',};
    $('p.mainText').expander(opts);
    
    updateScreen();
    //$('#myModal').on('show.bs.modal', function () {console.log("show.bs.modal fired");})
        

    $('#loginBtn').click(function(){
        if ($(this).text().substr(0, 7)=="Logg ut") {
            localStorage.removeItem("username"); // unset local storage
            document.getElementById("loginBtn").innerHTML = "Logg inn";
        }
    });
    
    $('#loginFrom').submit(function(e) {
        e.preventDefault();
        console.log( "Handler for .submit() called." );
        var inputName= document.getElementById("username");
        localStorage.setItem("username", inputName.value);
        $('#myModal').modal('toggle');
        updateScreen();
    })
    

    $(".url").click(function() {
        $(this).parent().parent().hide();
        updateScreen();
    });

    $( window ).resize(function() {
        updateScreen();
    });
    

    $('.lang_rater li').click(function() {
        var rater_data = {};
        rater_data['bruker'] = localStorage.getItem("username");
        rater_data['rater_data'] = $(this).attr('class').split("_")[1];
        rater_data['text_id'] = Number($(this).parent().parent().attr('id'));
        // console.log(rater_data);
        $.ajax({
          type: "GET",
          url: "insert.php",
          data: rater_data,
            success: function(data){console.log(rater_data), $("div#" +rater_data['text_id']).hide(); updateScreen();} //,
          //dataType: dataType
        });
    });
    
    
});

function updateScreen() {
    $('.media-body').not(':hidden').first().addClass("current_focus");
    if ($('.media-body').not(':hidden').first().find('.more-link').length){
        $('.media-body .more-link').not(':hidden').first().click();   
        //console.log("click now!")
    }

    // console.log(parseInt(GetURLParameter('antall')),$('.media-body:visible').length);
    updateProgress(parseInt(GetURLParameter('antall')),$('.media-body:visible').length);
    if (localStorage.getItem("username") === null){ $("#myModal").modal('show');} 
    else { document.getElementById("loginBtn").innerHTML = "Logg ut: "+localStorage.getItem("username");}
}



function GetURLParameter(sParam) {
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) {
            return sParameterName[1];
        }
    }
}

function updateProgress(alt,igjen) {
    var valeur = (1-igjen/alt)*100;
    $('.progress-bar').css('width', valeur+'%').attr('aria-valuenow', valeur).text(Math.round(valeur)+'%');
}


// $('#login').submit(function (e) {
//     console.log( "Handler for .submit() called." );
//     //e.preventDefault();
//
//     //console.log(inputName);
//
//     if(localStorage.getItem("username") != null){
//         // vi er logget inn og skal logge ut
//         console.log("vi skal logge ut");
//         localStorage.removeItem("username");
//         document.getElementById("loginBtn").innerHTML = "Sing in";
//         $("#username").show();
//     } else if(localStorage.getItem("username") === null ){
//         // skal logge inn
//         var inputName= document.getElementById("username");
//         localStorage.setItem("username", inputName.value);
//         $("#username").hide();
//
//          document.getElementById("loginBtn").innerHTML = "Sing out, " + localStorage.getItem("username");
//     } else {
//         // vi er logget in
//         console.log("else");
//         $("#username").hide();
//         document.getElementById("loginBtn").innerHTML = "Sing out";
//         //document.getElementById("loginBtn").innerHTML = "You have clicked the button " + localStorage.getItem("usename");
//     }
//
// });


