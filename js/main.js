
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
