document.addEventListener("DOMContentLoaded", function () {
    $('.select2').select2();
});

$(document).ready(function () {
	document.getElementById('nota').onload = function () {
		document.getElementById('nota-count').innerHTML = (this.value.length) + '/500';
	};

	document.getElementById('nota').onkeyup = function () {
		document.getElementById('nota-count').innerHTML = (this.value.length) + '/500';
	};

	$(".select2-amenidades").select2({
		placeholder: "Amenidades",
	});
});