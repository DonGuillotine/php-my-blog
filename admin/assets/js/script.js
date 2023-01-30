$(document).ready(function(){
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
});

$(document).ready(function(){
    $('#selectAllBoxes').click(function (event) {
if(this.checked){
    $('.checkBoxes').each(function () {
    this.checked = true;
    })
}
else{
    $('.checkBoxes').each(function () {
        this.checked = false;
    })
}
    })

});



function loadUsersOnline(){
    $.get("functions.php?onlineusers=result", function (data) {
        $(".usersonline").text(data);
    })
}
setInterval(function () {
    loadUsersOnline();
}, 500);