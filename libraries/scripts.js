var baseurl = "http://localhost/pollm/index.php/";

$(document).ready(function(){
    $('.delete').on('click', function(e) {
        var uservalue = $(this).val();
        $.get(baseurl+"user/delete/"+uservalue, function(status){
            if(status == 1){
                //show alert
                alert("Successfully deleted");

                //remove row
                $("#user_"+uservalue).remove();

            }else{
                alert("Error in delete");
                
            }
        });
    });
});


$(document).ready(function(){
    $('.opendata').on('click', function(e) {
        var uservalue = $(this).val();
        $(location).prop('href', baseurl+"user/details/"+uservalue);
    });
});

$(document).ready(function(){
    $('#btncreatevote').click(function() {
        
        var votetitle = document.getElementById("votetitle").value;
        var voteobjectives = document.getElementById("voteobjective").value;
        var publishername = document.getElementById("publishername").value;
     
        $.post(baseurl+"/poll/savevote", {title: votetitle, objective:voteobjectives, publisher: publishername}, function(result){
            console.log(result);
        });
 
    });
});



$(document).ready(function(){
    $('#a_createaudince').click(function() {
        
        var audiencetitle = document.getElementById("a_audiencetitle").value;
        var voteid = document.getElementById("a_votetitle").value;
        var keywords = document.getElementById("a_keywords").value;
     
        $.post(baseurl+"/poll/saveaudience", {audiencetitle: audiencetitle, voteid:voteid, keywords: keywords}, function(result){
            console.log(result);
        });
 
    });
});
