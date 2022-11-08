<?php 
?>
<html>

<script> 
    $(document).ready(function () {  
       
        $("nav #logout").click(function(){
            $(".wrapper").show();
            $(".modal_box").addClass("active");
        });

        $(".modal_close").click(function(){
            $(".modal_box").removeClass("active");$(".wrapper").hide();
        });
        
        cancel = ()=>{
             window.location.href = 'logout.php';     
        };
        
        confirm = ()=>{
             save();
             window.location.href = 'logout.php';
        };
});
</script>

    
</html>

