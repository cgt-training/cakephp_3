$(document).ready(function(){
        $('.commeditid').hide();
        // var clickbtn = document.getElementsByClassName("edit_btn");
        var globalvar;
        var g = document.getElementById('dynamic-div');
        for (var i = 0, len = g.children.length; i < len; i++)
        {

            // alert(len);   
            (function(index){
                g.children[i].onclick = function(){
                     globalvar = index;
                }    
            })(i);
        }
        $('.edit_btn').click(function()
        {   
            // console.log($(this));
            $(this).parent().parent().parent().children('.comments').hide();
            $(this).parent().parent().parent().children('.commeditid').show();
            
            var count = document.getElementsByClassName("comments");
            // alert(count.length);
            var i;
            var v;
            for (i = 0; i < count.length; i++) {
                
                v=count[i].innerHTML;
               break;
            }
            //alert(v);
             // document.getElementById("inputid").innerHTML = v;
            //alert(document.getElementById("inputid").innerHTML);
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
