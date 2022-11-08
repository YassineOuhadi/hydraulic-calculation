<?php 
?>
<html>

<script> 
    $(document).ready(function () {  
                
        $("nav #logout").attr("href","logout.php");
        
        $(".DeleteProjet").on("click", function(){
           var id=$(this).find('#delete_projet_id').val();
           var page=$('#page').val();
           var id_projet=$('#id_projet').val();
	       if(id!=0){
               var res = confirm("Êtes-vous sûr de vouloir supprimer?");
               if(res){
               var s="#li_projet"+id;
               $('#sidebar .side-menu').find(s).remove();
               document.getElementById("context-menu").classList.remove("active");
               $.ajax({
                         url:'delete.php',
                         type:'post',
                         data:{'idProjet':id},
                         cache: false,
                         success:function(dataResult){}
               });
               if(((page==2)||(page==3))&&(id_projet==id)){
               window.location.href = 'index.php';   
               }
               else{
               window.location.reload();
               };
               };
           };
        });
        
        $(".EditProjet").on("click", function(){
           var id=$(this).find('#edit_projet_id').val();
           var text;
	       if(id!=0){
               var s="#sidebar .side-menu #li_projet"+id;
               $(s).find("#projet_name").css('display','none');
               $(s).find("#rename").css('display','block');
               text=$(s).find("#rename").val();
               $(s).find("#rename").select();
               document.getElementById("context-menu").classList.remove("active");
               
               $(s).find("#rename").on('input', function() {
                 text = $(s).find("#rename").val();
               });
               
               $(s).find("#rename").keypress(function(event){
                 var keycode = (event.keyCode ? event.keyCode : event.which);
                 if(keycode == '13'){
                   $.ajax({
                         url:'edit.php',
                         type:'post',
                         data:{'idProjet':id,'titre':text},
                         cache: false,
                         success:function(dataResult){}
                   });
                   window.location.reload();  
                 };
               });
               
           };
        });
        
        
        
        add = ()=>{
            $(".nv_projet").find("#new_projet").hide();
            $(".nv_projet").find("#input_new_projet").show();
            $(".nv_projet").find("#input_new_projet input").select();
        }; 
        
        move = ()=>{
            $("#costum-data").animate({scrollLeft: $("tbody").offset().left},'slow');
        };
        
        check = ()=>{
           var k=0;
           $.each($("input[type='checkbox']:checked"), function() {
               k=1;
           });
           if(k==0)
           {
               $("#edit").hide();
               $("#new").show();
           }
           else
           {
               $("#new").hide();
               $("#edit").show();               
           };
        };        
        
        $("#edit").find("#annuler").click(function() {
            $.each($("input[type='checkbox']:checked"), function() {
                $(this).prop('checked', false);
                $("#edit").hide();
                $("#new").show();
            });
        });
        
        
        $("#edit").find("#supprimer").click(function() {
            var check = [];
            $.each($("input[type='checkbox']:checked"), function() {
                check.push($(this).val());
            });
            check.forEach(k => {
                ByJson={'idTrajet':k};
                $.ajax({
                url:'delete.php',
                type:'post',
                data:ByJson,
                cache: false,
                success:function(){}
                });
            });
            window.location.reload();
        });
        
});
</script>

    
</html>