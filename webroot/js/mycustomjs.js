$(document).ready(function(){
        $('.commeditid').hide();
        $('#commeditid').click(function()
        { 
            $(this).parent().parent().parent().children('.comments').hide();
            $(this).parent().parent().parent().children('.commeditid').show();
            var x = document.getElementById("comments").innerHTML;
            document.getElementById("inputid").innerHTML = x;
        });
        $('#submitedit').click(function(){
            $(this).parent().parent().parent().children('.comments').show();
            $(this).parent().parent().parent().children('.commeditid').hide();
        });
        $('.cancelid').click(function(){
            $(this).parent().parent().parent().children('.comments').show();
            $(this).parent().parent().parent().children('.commeditid').hide();
        });

});
