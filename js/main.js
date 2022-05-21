$(document).ready(function () {
	$("#myModal").modal("show");
});

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
		var my_row_value = $(this).attr("data-row-val");
		$("#detail-modal").attr("data-row-value", my_row_value);
		//    alert('My Row Value '+my_row_value );
		document.getElementById("idnum").innerHTML = my_row_value;
	});
});

//this is for the rogress bar
$(function () {
	$(".progress").each(function () {
		var value = $(this).attr("data-value");
		var left = $(this).find(".progress-left .progress-bar");
		var right = $(this).find(".progress-right .progress-bar");

		if (value > 0) {
			if (value <= 50) {
				right.css("transform", "rotate(" + percentageToDegrees(value) + "deg)");
			} else {
				right.css("transform", "rotate(180deg)");
				left.css(
					"transform",
					"rotate(" + percentageToDegrees(value - 50) + "deg)"
				);
			}
		}
	});

	function percentageToDegrees(percentage) {
		return (percentage / 100) * 360;
	}
});
let progressBar = document.querySelector(".circular-progress");
let valueContainer = document.querySelector(".value-container");

let progressValue = 0;
let progressEndValue = 65;
let speed = 20;

let progress = setInterval(() => {
	progressValue++;
	valueContainer.textContent = `${progressValue}%`;
	progressBar.style.background = `conic-gradient(
    #4d5bf9 ${progressValue * 3.6} deg,
    #cadcff ${progressValue * 3.6} deg
  )`;
	if (progressValue == progressEndValue) {
		clearInterval(progress);
	}
}, speed);
