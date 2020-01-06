tinymce.init({selector:'text-area'});

$(document).ready(function(){
    $('#selectAllBoxes').click(function(event){
        if(this.checked) {
            $('.checkBoxes').each(function(){
                this.checked = true;   
            });
        } else {
            $('.checkBoxes').each(function(){
                this.checked = false;
            });
        }
    });

    ///////// EDITOR CKEDITOR //////////////
    /*ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        }); */


           /* 
            var div_box = "<div id='load-screen'><div id='loading'></div></div>";
            
            $("body").prepend(div_box);
            
            $('#load-screen').delay(700).fadeOut(600,function(){
                $(this).remove();
            });
            */
});


/*
function loadUsersOnline() {
    
    $.get("functions.php?onlineusers=result", function(data){
        
        $(".usersonline").text(data);
        
    }); //sending get request to functions.php
}

setInterval(function(){
    
    loadUsersOnline();
    
},500);
*/