
function modifyOffset() {
    var el, newPoint, newPlace, offset, siblings, k;
    width    = this.offsetWidth;
    newPoint = (this.value - this.getAttribute("min")) / (this.getAttribute("max") - this.getAttribute("min"));
    offset   = -1;
    if (newPoint < 0) { newPlace = 0;  }
    else if (newPoint > 1) { newPlace = width; }
    else { newPlace = width * newPoint + offset; offset -= newPoint;}
    siblings = this.parentNode.childNodes;
    for (var i = 0; i < siblings.length; i++) {
        sibling = siblings[i];
        if (sibling.id == this.id) { k = true; }
        if ((k == true) && (sibling.nodeName == "OUTPUT")) {
            outputTag = sibling;
        }
    }
    outputTag.style.left       = newPlace + "px";
    outputTag.style.marginLeft = offset + "%";
    outputTag.innerHTML        = this.value;
}

function modifyInputs() {
    var inputs = document.getElementsByTagName("input");
    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].getAttribute("type") == "range") {
            inputs[i].onchange = modifyOffset;

            // the following taken from http://stackoverflow.com/questions/2856513/trigger-onchange-event-manually
            if ("fireEvent" in inputs[i]) {
                inputs[i].fireEvent("onchange");
            } else {
                var evt = document.createEvent("HTMLEvents");
                evt.initEvent("change", false, true);
                inputs[i].dispatchEvent(evt);
            }
        }
    }
}


$(document).ready(function () {   
    // Hide confirm btn
    
    updateScreen();

    $('form#login').submit(function(e) {
        e.preventDefault();
        console.log( "Handler for .submit() called. knappen sier: ",$("#loginBtn").text() );
        if ($("#loginBtn").text().substr(0, 8)=="Logg inn") {
            console.info("vi logger inn");
            var inputName = $("#username");
            localStorage.setItem("username", inputName.val());
            $(".jumbotron").hide();
            $("#loginBtn").text("Logg ut, "+ localStorage.getItem("username")).toggleClass("btn-danger");
            $("#username").hide();
            $("#confermButn").show();
        } else {
            console.info("vi logger ut");
            localStorage.removeItem("username");
            $(".jumbotron").show();
            $("#loginBtn").text("Logg inn").toggleClass("btn-danger");
            $("#username").show();
            $("#confermButn").hide()
        }
        // updateScreen();
    });

    $("#skip").click(function(){
        // hide current word
        $("."+$("#activeWord").text()).hide();
        // pull out the next
        $("#activeWord").text($(".wordsoup span:visible:first").text());
        $("#rater").val($(".wordsoup span:visible:first").data("target"));
        modifyInputs();
    });

    $("#confermButn").click(function(){
        // sjekk 
        var rater_data = {};
        rater_data['rater'] = localStorage.getItem("username");
        rater_data['word'] = $("#activeWord").text();
        rater_data['rating'] = $("#rater").val();
        //console.log(rater_data);
        // send
        $.ajax({
          type: "GET",
          url: "insert_rating.php",
          data: rater_data,
            success: function(data){
                console.log(rater_data, "set new word", rater_data['word']);
                // get a new word
                $("."+rater_data['word']).hide();
                console.info($(".wordsoup span:visible:first").text());
                $("#activeWord").text($(".wordsoup span:visible:first").text()); // :first-child:not(:hidden)
                $("#rater").val($(".wordsoup span:visible:first").data("target"));
                modifyInputs();
                //$("div#" +rater_data['text_id']).hide(); updateScreen();
            } //,
          //dataType: dataType
        });

    });
    

    $( window ).resize(function() {
        updateScreen();
    });
    

    // $('.lang_rater li').click(function() {
    //     var rater_data = {};
    //     rater_data['bruker'] = localStorage.getItem("username");
    //     rater_data['rater_data'] = $(this).attr('class').split("_")[1];
    //     rater_data['text_id'] = Number($(this).parent().parent().attr('id'));
    //     // console.log(rater_data);
    //     $.ajax({
    //       type: "GET",
    //       url: "insert.php",
    //       data: rater_data,
    //         success: function(data){console.log(rater_data), $("div#" +rater_data['text_id']).hide(); updateScreen();} //,
    //       //dataType: dataType
    //     });
    // });

    console.log("test");
    // set up first word
    $("#activeWord").text($(".wordsoup span:first").text());
    $("#rater").val($(".wordsoup span:first").data("target"));
    modifyInputs();

    $(".wordsoup span").click(function(){
        console.log($(this).text(),$(this).data("target"));
        // set big word to this word
        $("#activeWord").text($(this).text());
        $("#rater").val($(this).data("target"));
        modifyInputs();
    });
    
});

function updateScreen() {
    // $('.media-body').not(':hidden').first().addClass("current_focus");
    // if ($('.media-body').not(':hidden').first().find('.more-link').length){
    //     $('.media-body .more-link').not(':hidden').first().click();   
    //     //console.log("click now!")
    // }

    // console.log(parseInt(GetURLParameter('antall')),$('.media-body:visible').length);
    //updateProgress(parseInt(GetURLParameter('antall')),$('.media-body:visible').length);
    if (localStorage.getItem("username") === null){ 
        //$("#myModal").modal('show');
        $("#confermButn").hide();
    } else {
        console.info("vi er logget in");
    //        $("#loginBtn").text("Logg ut: "+localStorage.getItem("username"));
        $(".jumbotron").hide();
        $("#loginBtn").text("Logg ut, "+ localStorage.getItem("username")).toggleClass("btn-danger").toggleClass("btn-success");
        $("#username").hide();
    }
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



