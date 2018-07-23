$(document).ready(function(){
$("#upLoadUnitBasicAttr").click(function(){
	$("#basicAttr").slideUp();
	$("#basicAttrAccordion").removeClass("active");
});
$("#upLoadTransmitter").click(function(){
	$("#transmitter").slideUp();
	$("#transmitterAccordion").removeClass("active");
});
$("#upLoadPrimaryElement").click(function(){
	$("#primaryElement").slideUp();
	$("#primaryElementAccordion").removeClass("active");
});
$("#upLoadOperatingParameters").click(function(){
	$("#operatingParameters").slideUp();
	$("#operatingParametersAccordion").removeClass("active");
});
$("#upLoadCommunicationParameters").click(function(){
	$("#communicationParameters").slideUp();
	$("#communicationParametersAccordion").removeClass("active");
});




});


