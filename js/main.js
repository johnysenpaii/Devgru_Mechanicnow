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