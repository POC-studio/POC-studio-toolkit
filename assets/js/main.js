
$(document).ready(function() {
	cleanUp();
	$('.featured').show();
});


function cleanUp() {
	$('.tool').hide();
}

$('.list-group-item-action').on('click', function() {
	$('.active').toggleClass('active');
	$(this).toggleClass('active');
	var filter = this.id; 
	cleanUp();
	$('.'+filter).show();
	$('#title').text(this.text); 
	countTools();
})

$('.dropdown-item').on('click', function() {
	$('.active').toggleClass('active');
	var filter = this.id;
	cleanUp(); 
	$('.'+filter).show();
	$('#title').text(this.text); 
	$('#dropdownMenu2').text(this.text);
	countTools();
})

function countTools() {
	//gives node list
	divs = document.querySelectorAll('#tools > .tool');
	//convert to an array
	var divsArray = [].slice.call(divs);
	//so now we can use filter
	//find all divs with display none
	var displayNone = divsArray.filter(function(el) {
	    return getComputedStyle(el).display === "none"
	});
	//and all divs that are not display none
	var displayShow = divsArray.filter(function(el) {
	    return getComputedStyle(el).display !== "none"
	});
	//and use length to count
	var numberOfHiddenDivs = displayNone.length;
	var numberOfVisibleDivs = displayShow.length;
	$('#count').text('('+numberOfVisibleDivs+')');
}