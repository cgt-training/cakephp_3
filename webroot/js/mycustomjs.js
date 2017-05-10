$(document).ready(function(){
        $("#commeditid").click(function(){
            var url1 = "<?= $this->Url->build([ 'controller' => 'Comments', 'action' => 'comment' ]);?>";
            $.ajax({

                type: 'POST',

                url: url1,    

                data:$('#commaddform').serialize(), 

                success: function(result){
    
                    alert(result);

                }
            });   
    //         $('.commdiv').hide();
    //         $("#commaddform").show();
    //     });
    //     $('#commsubmit').click(function(){
 			// $('.commdiv').show();
 			// $("#commaddform").show();
    //         $("#commaddform").submit();
        });
    });