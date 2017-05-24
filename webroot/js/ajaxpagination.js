
$(document).ready(function () {
$(".pagination a").bind("click", function (event) { 
if(!$(this).attr('href')) 
return false;
$.ajax({ 
dataType:"html",
evalScripts:true,
success:function (data, textStatus) {$("body").html(data);},
url:$(this).attr('href')});
return false;
});
});
