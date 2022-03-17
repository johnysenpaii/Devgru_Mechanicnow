
var x = document.getElementById("latitude");
var y = document.getElementById("longitude");



function getLocation() {
if (navigator.geolocation) {
navigator.geolocation.getCurrentPosition(showPosition);
} else { 
x.value = "Geolocation is not supported by this browser.";
y.value = "Geolocation is not supported by this browser.";

}
}

function showPosition(position) {
x.value = position.coords.latitude;
y.value = position.coords.longitude;
}
// let myvar = ""; 
// function myfunction () { 
//     myvar = document.getElementById("partialID").value;
//     document.getElementById("idnum").innerHTML = myvar;
// }
$(function () {
    $(".mybutton").click(function () {
        var my_row_value = $(this).attr('data-row-val');
        $("#detail-modal").attr('data-row-value',my_row_value );
    //    alert('My Row Value '+my_row_value );
       document.getElementById("idnum").innerHTML =  my_row_value;
    })
});
