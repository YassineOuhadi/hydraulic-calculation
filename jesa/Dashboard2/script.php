<?php
$count=25;
?>
<html>
<head>
<script>
    $(document).ready(function () {
        
/*       
// Fonction executée lors de l'utilisation du clic droit.
$(document).bind("contextmenu",function()
{
// Si vous voulez ajouter un message d'alerte
alert('Merci de respecter le travail du webmaster en ne copiant pas le contenu sans autorisation');
// On indique au navigateur de ne pas réagir en cas de clic droit.
return false;
});
*/        
        $(".DeleteProjet").on("click", function(){
           var id=$(this).find('#edit_projet_id').val();
	       if(id!=0){
               var s="#li_projet"+id;
               $('#sidebar .side-menu').find(s).remove();
               document.getElementById("context-menu").classList.remove("active");
               window.location.reload();
           };
        });
        
         /*window.onbeforeunload = function(event){
             return functions.block_alert("Are you sure you want to leave?");;
         };*/
        
        
        idTrajet = <?php echo $trajet->idTrajet ; ?> ;
        
        var ligne;
                      
        i = <?php echo $p ; ?> ;
                     
        count = <?php echo $count ; ?> ;
                      
        trajet = [] ;
        
        sTable= ``;
        
        var cas="all";
        
        const functions = {

        alertFunction: function(s) {
                $(document).scrollTop($("main").height());
                $('#box2 .body').html(s);
                const box = $(".data_nav.box");
                box.show();
                setTimeout(() => {
                    box.hide();
                },1000);  
        },
            
        alert: function(s) {
                $('#box1 .body').html(s);
                document.getElementById('box1').style.display = 'block';
        },
            
        block_alert: function(s) {
                $(".modal_body").text(s);
                $(".wrapper").show();
			    $(".modal_box").addClass("active");
        },
            
        actualiser: function(s) {
                setTimeout(function(){
                    window.location.reload();
                },100);
        }, 
            
        scrollFunction: function(x, y) {
                var position = y.offset().top - x.offset().top + x.scrollTop();
	            x.animate({
		            scrollTop: position
	            });
        },
        MaincSrollFunction: function(x, y) {
                var position =y.offset().top;
                x.scrollTop(position); 	            
        },    
        Valider: function() {
            var nb = 0;
            trajet.forEach(piece => {
               if(piece.etat==0)
               {
                  nb=nb+1;
               };
            });
            return nb;
        },
            
        Function: function() {
                var perte_charge=0;
                trajet.forEach(piece => {
                    perte_charge=perte_charge+Number(piece.perte_charge);
                });
                ligne.perte_charge=perte_charge;
                if(ligne.type=='Gravitaire'){
                if(ligne.sens=="Amont-Aval"){
                    ligne.cote_arrivee=Number(ligne.cote_depart)-ligne.perte_charge;
                }
                else if(ligne.sens=="Aval-Amont"){
                    ligne.cote_arrivee=Number(ligne.cote_depart)+ligne.perte_charge;
                }; 
                $('.content-data .pricing-wrapper').find('#cote_arrivee').val(ligne.cote_arrivee);
                }
                else if(ligne.type=='Refoulement'){
                    
                     ligne.hauteur=Number(ligne.cote_arrivee)-Number(ligne.cote_depart);
                     var p=1000;
                     var debit=Number(ligne.debit);
                     var g=9.81;
                     var hmt=Number(ligne.hauteur)+Number(ligne.perte_charge);
                     var puissance_utile=hmt*debit*p*g;
                     var rendement=0.7;
                     ligne.puissance=(puissance_utile/rendement).toFixed(2);
                    
                     $('.content-data .pricing-wrapper').find('#hauteur').val(ligne.hauteur);
                     $('.content-data .pricing-wrapper').find('#puissance').val(ligne.puissance);
                };
                
                $('.content-data .pricing-wrapper').find('#perte_charge').val(ligne.perte_charge);
                
                $(".btn-download").css('pointer-events','auto');
                $(".button").addClass("save");
        },
            
        Rayon_de_courbure:function (a,diam){
                var Angle=Number(a);
                var DN=Number(diam);
                var Deviation_angulaire=Number(functions.Deviation_angulaire(DN));
                var Rayon_de_courbure;
                if(Angle < 11.5 - 2 * Deviation_angulaire)
                {
                    Rayon_de_courbure = 9999;
                }
                else if((Angle >=11.5-2*Deviation_angulaire)&&(Angle<(22.5+11.5)/2))
                {
                     if( DN <= 65)
                     {
                        Rayon_de_courbure = 187;
                     }
                     else if(DN <= 80)
                     {
                        Rayon_de_courbure = 233;     
                     }
                     else if(DN <= 100)
                     {
                        Rayon_de_courbure = 228;     
                     }
                     else if(DN <= 150)
                     {
                         Rayon_de_courbure = 274;    
                     }else if(DN <= 200)
                     {
                         Rayon_de_courbure = 324;   
                     }else if(DN <= 250)
                     {
                         Rayon_de_courbure = 238;    
                     }else if(DN <= 300)
                     {
                         Rayon_de_courbure = 264;    
                     }else if(DN <= 350)
                     {
                         Rayon_de_courbure = 290;   
                     }else if(DN <= 400)
                     {
                         Rayon_de_courbure = 316;  
                     }else if(DN <= 450)
                     {
                         Rayon_de_courbure = 391; 
                     }else if(DN <= 500)
                     {
                         Rayon_de_courbure = 417;
                     }else if(DN <= 600)
                     {
                         Rayon_de_courbure = 588;
                     }else if(DN <= 700)
                     {
                         Rayon_de_courbure = 533;
                     }else if(DN <= 800)
                     {
                         Rayon_de_courbure = 624;
                     }else if(DN <= 900)
                     {
                         Rayon_de_courbure = 705;
                     }else if(DN <= 1000)
                     {
                         Rayon_de_courbure = 837;
                     }else if(DN <= 1100)
                     {
                         Rayon_de_courbure = 847;
                     }else if(DN <= 1200)
                     {
                         Rayon_de_courbure = 857;
                     }else if(DN <= 1500)
                     {
                         Rayon_de_courbure = 1200;
                     }else if(DN <= 1600)
                     {
                         Rayon_de_courbure = 1300;
                     }else if(DN <= 1800)
                     {
                         Rayon_de_courbure = 1400;
                     }else
                     {
                         Rayon_de_courbure = 0.542 * DN + 420;
                     };
                }
                else if((Angle >=(22.5+11.5)/2)&&(Angle<(45+22.5)/2))
                {
                     if( DN <= 65)
                     {
                        Rayon_de_courbure = 67;
                     }
                     else if(DN <= 80)
                     {
                        Rayon_de_courbure = 75;     
                     }
                     else if(DN <= 100)
                     {
                        Rayon_de_courbure = 87;     
                     }else if(DN <= 125)
                     {
                        Rayon_de_courbure = 100;     
                     }
                     else if(DN <= 150)
                     {
                         Rayon_de_courbure = 115;    
                     }else if(DN <= 200)
                     {
                         Rayon_de_courbure = 155;   
                     }else if(DN <= 250)
                     {
                         Rayon_de_courbure = 191;    
                     }else if(DN <= 300)
                     {
                         Rayon_de_courbure = 226;    
                     }else if(DN <= 350)
                     {
                         Rayon_de_courbure = 266;   
                     }else if(DN <= 400)
                     {
                         Rayon_de_courbure = 326;  
                     }else if(DN <= 450)
                     {
                         Rayon_de_courbure = 361; 
                     }else if(DN <= 500)
                     {
                         Rayon_de_courbure = 402;
                     }else if(DN <= 600)
                     {
                         Rayon_de_courbure = 522;
                     }else if(DN <= 700)
                     {
                         Rayon_de_courbure = 615;
                     }else if(DN <= 800)
                     {
                         Rayon_de_courbure = 711;
                     }else if(DN <= 900)
                     {
                         Rayon_de_courbure = 827;
                     }else if(DN <= 1000)
                     {
                         Rayon_de_courbure = 917;
                     }else if(DN <= 1100)
                     {
                         Rayon_de_courbure = 1005;
                     }else if(DN <= 1200)
                     {
                         Rayon_de_courbure = 1093;
                     }else if(DN <= 1500)
                     {
                         Rayon_de_courbure = 1200;
                     }else if(DN <= 1600)
                     {
                         Rayon_de_courbure = 1300;
                     }else if(DN <= 1800)
                     {
                         Rayon_de_courbure = 1400;
                     }else
                     {
                         Rayon_de_courbure = 0.542 * DN + 420;
                     };   
                }
                else if((Angle>=(45+22.5)/2)&&(Angle<(90+45)/2))
                {
                     if( DN <= 65)
                     {
                        Rayon_de_courbure = 143;
                     }
                     else if(DN <= 80)
                     {
                        Rayon_de_courbure = 95;     
                     }
                     else if(DN <= 100)
                     {
                        Rayon_de_courbure = 115;     
                     }else if(DN <= 125)
                     {
                        Rayon_de_courbure = 158;     
                     }
                     else if(DN <= 150)
                     {
                         Rayon_de_courbure = 177;    
                     }else if(DN <= 200)
                     {
                         Rayon_de_courbure = 193;   
                     }else if(DN <= 250)
                     {
                         Rayon_de_courbure = 197;    
                     }else if(DN <= 350)
                     {
                         Rayon_de_courbure = 346;   
                     }else if(DN <= 400)
                     {
                         Rayon_de_courbure =392;  
                     }else if(DN <= 450)
                     {
                         Rayon_de_courbure = 452; 
                     }else if(DN <= 500)
                     {
                         Rayon_de_courbure = 501;
                     }else if(DN <= 600)
                     {
                         Rayon_de_courbure = 595;
                     }else if(DN <= 700)
                     {
                         Rayon_de_courbure = 725;
                     }else if(DN <= 800)
                     {
                         Rayon_de_courbure = 809;
                     }else if(DN <= 900)
                     {
                         Rayon_de_courbure = 894;
                     }else if(DN <= 1000)
                     {
                         Rayon_de_courbure = 976;
                     }else if(DN <= 1100)
                     {
                         Rayon_de_courbure = 1090;
                     }else if(DN <= 1500)
                     {
                         Rayon_de_courbure = 1200;
                     }else if(DN <= 1600)
                     {
                         Rayon_de_courbure = 1300;
                     }else if(DN <= 1800)
                     {
                         Rayon_de_courbure = 1400;
                     }else
                     {
                         Rayon_de_courbure = 0.542 * DN + 420;
                     };
                }
                else if((Angle>=(90+45)/2)&&(Angle<=90+2*Deviation_angulaire)){
                     if( DN <= 65)
                     {
                        Rayon_de_courbure = 58;
                     }
                     else if(DN <= 80)
                     {
                        Rayon_de_courbure = 74;     
                     }
                     else if(DN <= 100)
                     {
                        Rayon_de_courbure = 87;     
                     }else if(DN <= 125)
                     {
                        Rayon_de_courbure = 115;     
                     }
                     else if(DN <= 150)
                     {
                         Rayon_de_courbure = 133;    
                     }else if(DN <= 200)
                     {
                         Rayon_de_courbure = 160;   
                     }else if(DN <= 250)
                     {
                         Rayon_de_courbure = 240;    
                     }else if(DN <= 350)
                     {
                         Rayon_de_courbure = 366;   
                     }else if(DN <= 400)
                     {
                         Rayon_de_courbure =409;  
                     }else if(DN <= 450)
                     {
                         Rayon_de_courbure = 452; 
                     }else if(DN <= 500)
                     {
                         Rayon_de_courbure = 495;
                     }else if(DN <= 600)
                     {
                         Rayon_de_courbure = 581;
                     }else if(DN <= 700)
                     {
                         Rayon_de_courbure = 695;
                     }else if(DN <= 800)
                     {
                         Rayon_de_courbure = 785;
                     }else if(DN <= 900)
                     {
                         Rayon_de_courbure = 875;
                     }else if(DN <= 1000)
                     {
                         Rayon_de_courbure = 965;
                     }else if(DN <= 1100)
                     {
                         Rayon_de_courbure = 1080;
                     }else if(DN <= 1200)
                     {
                         Rayon_de_courbure = 1200;
                     }else
                     {
                         Rayon_de_courbure = 0.542 * DN + 420;
                     };
                }
                else
                {
                    Rayon_de_courbure = -9999;    
                };
                return Rayon_de_courbure;
        },
            
        Deviation_angulaire:function(diam){
                var DN=Number(diam);
                if(DN<= 150){return 5;}
                else if(DN <= 300){return 4;}
                else if(DN <= 600){return 3;}
                else if(DN <= 800){return 2;}
                else{return 1.5;}; 
        },
         
        k:function(diam,a,r){
                var DN=(Number(diam))*0.001;
                var Rayon=(Number(r))*0.001;
                var Angle=Number(a);
                var x=Math.pow(DN/(2*Rayon),3.5);
                var k=(0.131+1.847*x)*(Angle/90);
                return k.toFixed(2);
        },
            
        PeteChargeSinguliere: function(cte_k,vitesse) {
                var k=Number(cte_k);
                var vitesse=Number(vitesse);
                var perte_charge=(k*(Math.pow(vitesse,2)))/(2*9.81);
                return perte_charge.toFixed(4);
        },
            
        perte_charge: function(debit,diametre,k,temp) {
                var Debit=Number(debit);
                var Diam=Number(diametre);
                var Rug=Number(k);
                var Temp=Number(temp);
                var Pertes_Charge;
                var Mu,Toler,lambd0,Un_sur_racine_lambda0,Un_sur_racine_lambda,Re,I,Vit,Err1,ppi,Surf,Viscosite;
                var NombreIter= 0;
                Mu = 0.00000131;
                Toler = 0.0000000000001;
                Err1 = 999;
                lambd0 = 0.018993;
                ppi=Math.PI;
                Surf = 0.25 * ppi * Diam * Diam;
                Vit = Debit / Surf;
                Viscosite = 0.00000178 / (1 + 0.0337 * Temp + 0.00022 * Temp * Temp);
                Re = (Vit * Diam) / Viscosite;
                Un_sur_racine_lambda0 = -2 * Math.log10(Rug / (3.7 * Diam) + 2.51 / (Re *Math.sqrt(lambd0)));
                do {
                NombreIter = NombreIter + 1;
                Un_sur_racine_lambda = -2 * Math.log10(Rug / (3.7 * Diam) + (2.51 / Re) * Un_sur_racine_lambda0);
                Err1 = Math.abs(Un_sur_racine_lambda - Un_sur_racine_lambda0);
                Un_sur_racine_lambda0 = Un_sur_racine_lambda;
                }while((Err1 > Toler)||(NombreIter <= 250));
                Lambd = Math.pow(Un_sur_racine_lambda,-2);
                Pertes_Charge = Lambd / Diam * 1000 * Vit * Vit / 2 / 9.81;
                return Pertes_Charge*0.001;
        },
        droits: function(debit,diametre,k,langueur) {
                var debit=(Number(debit))*0.001;
                var diametre=(Number(diametre))*0.001;
                var k=(Number(k))*0.001;
                var temperature=Number(ligne.temperature);
                var langueur=Number(langueur);
                var perte_charge=Number(functions.perte_charge(debit,diametre,k,temperature));
                var resultat=(perte_charge*langueur).toFixed(4);
                return resultat;
        },
        cones: function(debit,D,d,k,angle) {
                var debit=(Number(debit))*0.001;
                var D=(Number(D))*0.001;
                var d=(Number(d))*0.001;
                var Angle=Number(angle);
                var teta=Angle/2;
                var k=(Number(k))*0.001;
                var temperature=Number(ligne.temperature);
                var langueur,phi;
                var x=4*(D-d)*(Math.pow((D*d),4));
                var y=Math.pow(D,4)-Math.pow(d,4);
                phi=Math.pow((x/y),1/5);
                langueur=(D-d)/(2*Math.tan(teta));
                var perte_charge=Number(functions.perte_charge(debit,phi,k,temperature));
                var resultat=(perte_charge*langueur).toFixed(4);
                return resultat;
        }
                            
        };
        
        $("nav #logout").click(function(){
            functions.block_alert("Vous voulez enregistrer votre travail avant deconnecter ?");
        });
        
        $(".modal_close").click(function(){
             $(".modal_box").removeClass("active");$(".wrapper").hide();
        });
        
        $('.content-data').find('.cache').on("input", function(){
            Edit();
        });
        
        Edit = ()=>{
        $('.content-data').find('.btn').css('pointer-events','auto');
        $('.content-data').find('.btn').addClass("edit");
        ligne.etat=1;
        };
        


    
     
  
        
        $("#edit").find("#supprimer").click(function() {
            var check = [];
            $.each($("input[name='check']:checked"), function() {
                check.push($(this).val());
            });
            check.forEach(k => {
                trajet.forEach(piece => {
                    if(piece.table==k){
                        if(piece.etat==2){
                            var id=piece.indice;
                            ByJson={'id':id};
                            $.ajax({
                            url:'delete.php',
                            type:'post',
                            data:ByJson,
                            cache: false,
                            success:function(){}
                            });
                        };
                    };
                });
                trajet = $.grep(trajet, function(e){ 
                return e.table != k; 
                });
            });
            showData();
            showTable();
            $("#edit").hide();
            functions.Function();
        });
        
        
        $("#edit").find("#annuler").click(function() {
            $.each($("input[name='check']:checked"), function() {
                $(this).prop('checked', false);
                $("#edit").hide();
            });
        });
        
        <?php for ( $k = 0 ; $k <= $total_pieces ; $k++ ){ ?>
        /*$("#card<?php echo $k;?>").css("background-color", getRandomColor());*/
        <?php ;}; ?>
        
        <?php for ( $k = 0 ; $k <= $total_pieces ; $k++ ){ ?> 
        $("#card<?php echo $k;?>").submit((e)=>{
                e.preventDefault();
                if ( functions.Valider() >= 1)
                {
                   functions.alertFunction("Validez d'abbord l'équipement sélectionné !");                  
                }
                else
                {
                   if(count==i){
                       functions.alertFunction("Vous voulez enregistrer votre travail ,vous avez depasser le maximmum d'equipements ?");   
                   }
                   else
                   {
                      piece = {};
                    
                      piece.name =$('#card<?php echo $k;?>').find('h2').text();
                      piece.id_piece=$('#card<?php echo $k;?>').find('#id_piece').val();
                       
                      piece.categorie=$('#card<?php echo $k;?>').find('#categorie').val(); 
                    
                      piece.indice=0;
                    
                      piece.table = i;
                      piece.etat =0 ;
                    
                      if(piece.categorie=="VANNES ET ROBINETS")
                      {
                          piece.d =600;
                          piece.k =0.24;  
                      }
                      else if(piece.categorie=="ELEMENTS DROITS")
                      {
                          piece.d =504;
                          piece.l =7.6;
                          piece.k =ligne.rugosite;
                      }
                      else if(piece.categorie=="COUDES")
                      {
                          piece.d =500;
                          piece.k =0; 
                          if(piece.name=="COUDE BRUSQUE"){
                             piece.angle=22.5; 
                          }
                          else if(piece.name=="COUDE ARRONDI"){
                             piece.angle=0;
                             piece.rayon=functions.Rayon_de_courbure(piece.angle,piece.d);
                          };
                          
                      }
                      else if(piece.categorie=="CONES"){
                          if(piece.name=="CONE CONVERGENT"){
                             piece.d =300;
                             piece._D =300;
                             piece.angle =0;
                             piece.k =ligne.rugosite;
                          }
                          else if(piece.name=="CONE DIVERGENT"){
                             piece.D1 =300;
                             piece.D2 =300;
                             piece.angle =0; 
                             piece.k =0;
                          };
                      }
                      else if(piece.categorie=="CHANGEMENTS"){
                          piece.D1 =300;
                          piece.D2 =300;
                          piece.k =0;
                          if(piece.name=="ÉLARGISSEMENT BRUSQUE"){
                          }
                          else if(piece.name=="RÉTRÉCISSEMENT BRUSQUE"){
                          };
                      }
                      else if(piece.categorie=="TÉS"){
                          piece.d =300;
                          piece._D =300;
                          if(piece.name=="BRANCHEMENT DE PRISE"){
                              piece.k=0.88;   
                          }
                          else if(piece.name=="BRANCHEMENT D'AMENÉE"){
                              piece.k=-0.40;
                          };
                      }
                      else if(piece.categorie=="Autres")
                      {
                          piece.d =500;
                          if(piece.name=="Départ"){
                              piece.k =0.5; 
                              piece.type=1;
                          }
                          else if(piece.name=="Arrivée"){
                              piece.k =1;    
                          }
                          else if(piece.name=="Crépine"){
                              piece.k=ligne.rugosite;
                          }
                          else if(piece.name=="Débitmètre"){
                              piece.k=ligne.rugosite;
                              piece.l=0;
                          };
                      };                      
                       
                      piece.debit=Number(ligne.debit);
                      piece.cote_depart = 0;
                      piece.perte_charge = 0;
                      piece.cote_arrivee = 0;

                      var div='.div'+i;
                      var form='#form'+i;
                      var plus='.plus'+i;
                      var table="#table"+i;
                      var check="#check"+i;
                 
                      trajet.push(piece);
                      i=i+1;
                    
                      $("#myForm").get(0).reset();
                    
                      showData();
                       
                      $("#edit").hide();   
                      $('#infosWithTable').find(".table").hide();
                      $('#infosWithTable').find(table).show();
                      $('#infosWithTable').find(".div").removeClass("costum_li");
                      $('#infosWithTable').find(div).addClass("costum_li");
                      
                    
                      var container = $(document);
	                  var scrollTo = $('#infosWithTable');
                      functions.MaincSrollFunction(container,scrollTo);
                       
                      container = $('#infosWithTable');
	                  scrollTo = $(div);
                      functions.scrollFunction(container,scrollTo);
                       
                   };
                };
        });
        <?php ;}; ?>
        
        
        $( ".content-data .btn" ).click(function() {
                if ( functions.Valider() >= 1)
                {
                   functions.alertFunction("Vous dever dabord valider ou annuler");                  
                }
                else{
                $('.content-data').find('.btn').css('pointer-events','none');
                $('.content-data').find('.btn').removeClass("edit");
                ligne.debit=$('.content-data .pricing-wrapper').find('#debit').val();                    
                ligne.rugosite=$('.content-data .pricing-wrapper').find('#rugosite').val();
                ligne.temperature=$('.content-data .pricing-wrapper').find('#temperature').val();
                ligne.type=$('.head-title #left').find('#type').val();
                ligne.sens=$('.head-title .first').find('select').val();
                ligne.cote_depart = $('.content-data .pricing-wrapper').find('#cote_depart').val();
                if(ligne.type=='Refoulement'){
                ligne.cote_arrivee = $('.content-data .pricing-wrapper').find('#cote_arrivee').val();  
                
                };
                <?php for($nb=0;$nb<$count;$nb=$nb+1){ ?>
                 al<?php echo $nb ; ?>()   ;
                <?php ;}; ?>
                if(ligne.type=='Refoulement')
                {    
                    $("#refoulement").show();
                    $('#cote_arrivee').attr('readonly', false);
                    type();
                }
                else
                {
                    $('#cote_arrivee').attr('readonly', true);
                    $("#refoulement").hide();
                };
                ligne.etat=0;
                };
        });
        
        
       <?php for ($k = 0; $k < $count; $k++){ ?> 
        
        li_hover<?php echo $k ; ?> = ()=>{
           $('#second_content-data').find('#tr<?php echo $k ; ?>').addClass("active_tr");
            
            var container = $('tbody');
	                  var scrollTo = $('#tr<?php echo $k ; ?>');
                      functions.scrollFunction(container,scrollTo);
        };
        
        li_normale<?php echo $k ; ?> = ()=>{
           $('#second_content-data').find('#tr<?php echo $k ; ?>').removeClass("active_tr");
        };
    
        myFunction<?php echo $k ; ?> = ()=>{  
        j = <?php echo $k ; ?> ;
        table='#table'+j;
        form='#form'+j;
        div='.div'+j;
        check='#check'+j;
        if($('#infosWithTable').find(table).css('display') == 'none'){
            
                $('#infosWithTable').find(".table").hide();
                $('#infosWithTable').find(table).show();
               
                
                $('#infosWithTable').find('.div').removeClass("costum_li");
                $('#infosWithTable').find(div).addClass("costum_li");
            
                /*$('#infosWithTable').find('.check').show();
                $('#infosWithTable').find(check).hide();*/
            
               
                $('#infosWithTable').find('.div').css('height','45px');
                $('#infosWithTable').find(div).css('height','auto');
            
            
                var container = $(document);
	            var scrollTo = $('#infosWithTable');
                functions.MaincSrollFunction(container,scrollTo);
            
                container = $('#infosWithTable');
	            scrollTo = $(".div<?php echo $k;?>");
                functions.scrollFunction(container,scrollTo);                
                
                container = $('tbody');
	            scrollTo = $('#tr<?php echo $k ; ?>');
                functions.scrollFunction(container,scrollTo);
            
                $('#second_content-data').find('tr').removeClass("active_tr");
                $('#second_content-data').find('#tr<?php echo $k ; ?>').addClass("active_tr");
                
        }
        else
        {
                $('#infosWithTable').find(table).hide();
                
                $('#infosWithTable').find(div).css('height','45px');
            
                /*$('#infosWithTable').find(check).show();*/
            
                $('#infosWithTable').find(div).removeClass("costum_li");
            
                $('#second_content-data').find('#tr<?php echo $k ; ?>').removeClass("active_tr");
        };
        };
        
        check<?php echo $k;?> = ()=>{
           var k=0;
           $.each($("input[name='check']:checked"), function() {
               k=1;
           });
           if(k==0)
           {
               $("#edit").hide();
           }
           else
           {
               $("#edit").show();
               var container = $(document);
	           var scrollTo = $('#infosWithTable');
               functions.MaincSrollFunction(container,scrollTo);
           };
        };
        
        annuler<?php echo $k; ?> = ()=>{
            j=<?php echo $k; ?>;
            div='.div'+j;
            trajet.pop();
            i=i-1;
            $('.todo').find(div).hide();
            /*functions.alertFunction("annuler");*/
        };
        
        
        al<?php echo $k; ?> = ()=>{ 
        var j=<?php echo $k; ?>;

        trajet.forEach(piece => {
            if(piece.table==j)
            {
                var idPiece=piece.id_piece;
                var type=piece.type;
                var cote_depart=$('#formulaire<?php echo $k; ?>').find('#cote_depart').val();
                piece.cote_depart=cote_depart;
                if(ligne.etat==1){piece.debit=ligne.debit;}
                else if(ligne.etat==0){piece.debit=$('#formulaire<?php echo $k; ?>').find('#debit').val();};
                
                if(piece.categorie=="VANNES ET ROBINETS")
                {
                     var d=$('#formulaire<?php echo $k; ?>').find('#diametre').val();
                     var k=$('#formulaire<?php echo $k; ?>').find('#k').val();   
                     piece.d=d;
                     piece.k=k;
                     var rayon=(piece.d*0.001)/2;
                     var surface=3.14*Math.pow(rayon,2);
                     var debit=piece.debit*0.001;
                     var vitesse=debit/surface;
                     piece.perte_charge=functions.PeteChargeSinguliere(piece.k,vitesse);
                }
                else if(piece.categorie=="ELEMENTS DROITS"){
                     var d=$('#formulaire<?php echo $k; ?>').find('#diametre').val();
                     var l=$('#formulaire<?php echo $k; ?>').find('#langueur').val();   
                     piece.d=d;
                     piece.l=l;
                     if(ligne.etat==1){piece.k=ligne.rugosite;}
                     else if(ligne.etat==0){piece.k=$('#formulaire<?php echo $k; ?>').find('#k').val();};
                     piece.perte_charge=functions.droits(piece.debit,d,piece.k,l);
                }
                else if(piece.categorie=="COUDES"){
                     var d=$('#formulaire<?php echo $k; ?>').find('#diametre').val();
                     var angle=$('#formulaire<?php echo $k; ?>').find('#angle').val();
                     
                     var k=$('#formulaire<?php echo $k; ?>').find('#k').val();
                     piece.d=d;
                     piece.angle=angle;
                     piece.k=k;
                     if(piece.name=="COUDE ARRONDI"){
                        var rayon=$('#formulaire<?php echo $k; ?>').find('#rayon').val();
                        piece.rayon=rayon;
                     };
                     var rayon=(piece.d*0.001)/2;
                     var surface=3.14*Math.pow(rayon,2);
                     var debit=piece.debit*0.001;
                     var vitesse=debit/surface;
                     piece.perte_charge=functions.PeteChargeSinguliere(piece.k,vitesse);
                }
                else if(piece.categorie=="CONES"){
                    if(piece.name=="CONE CONVERGENT"){
                       var d=$('#formulaire<?php echo $k; ?>').find('#d').val();
                       var _D=$('#formulaire<?php echo $k; ?>').find('#_D').val();
                       var angle=$('#formulaire<?php echo $k; ?>').find('#angle').val();
                       piece.d=d;
                       piece._D=_D;
                       piece.angle=angle;
                       if(ligne.etat==1){piece.k=ligne.rugosite;}
                       else if(ligne.etat==0){piece.k=$('#formulaire<?php echo $k; ?>').find('#k').val();}; 
                       piece.perte_charge=functions.cones(piece.debit,_D,d,piece.k,angle);
                    }
                    else if(piece.name=="CONE DIVERGENT"){
                       var D1=$('#formulaire<?php echo $k; ?>').find('#D1').val();
                       var D2=$('#formulaire<?php echo $k; ?>').find('#D2').val();
                       var k=$('#formulaire<?php echo $k; ?>').find('#k').val();
                       var angle=$('#formulaire<?php echo $k; ?>').find('#angle').val();
                       piece.D1=D1;
                       piece.D2=D2;
                       piece.k=k;
                       piece.angle=angle;
                       if(ligne.etat==1){piece.k=ligne.rugosite;}
                       else if(ligne.etat==0){piece.k=$('#formulaire<?php echo $k; ?>').find('#k').val();}; 
                       var rayon=(piece.D1*0.001)/2;
                       var surface=3.14*Math.pow(rayon,2);
                       var debit=piece.debit*0.001;
                       var vitesse=debit/surface;
                       piece.perte_charge=functions.PeteChargeSinguliere(k,vitesse);
                    };
                }
                else if(piece.categorie=="CHANGEMENTS"){
                    var D1=$('#formulaire<?php echo $k; ?>').find('#D1').val();
                    var D2=$('#formulaire<?php echo $k; ?>').find('#D2').val();
                    var k=$('#formulaire<?php echo $k; ?>').find('#k').val(); 
                    piece.D1=D1;
                    piece.D2=D2;
                    piece.k=k;
                    var rayon=(piece.D1*0.001)/2;
                    var surface=3.14*Math.pow(rayon,2);
                    var debit=piece.debit*0.001;
                    var vitesse=debit/surface;
                    piece.perte_charge=functions.PeteChargeSinguliere(k,vitesse);
                }
                else if(piece.categorie=="TÉS"){
                    var _D=$('#formulaire<?php echo $k; ?>').find('#_D').val();
                    var d=$('#formulaire<?php echo $k; ?>').find('#d').val();
                    var k=$('#formulaire<?php echo $k; ?>').find('#k').val(); 
                    piece._D=_D;
                    piece.d=d;
                    piece.k=k;
                    var rayon=(piece._D*0.001)/2;
                    var surface=3.14*Math.pow(rayon,2);
                    var debit=piece.debit*0.001;
                    var vitesse=debit/surface;
                    piece.perte_charge=functions.PeteChargeSinguliere(k,vitesse);
                }
                else if(piece.categorie=="Autres"){
                    if((piece.name=="Départ")||(piece.name=="Arrivée")||(piece.name=="Crépine")){
                    var d=$('#formulaire<?php echo $k; ?>').find('#d').val();
                    var k=$('#formulaire<?php echo $k; ?>').find('#k').val();
                    piece.d=d;
                    piece.k=k;
                    var rayon=(piece.d*0.001)/2;
                    var surface=3.14*Math.pow(rayon,2);
                    var debit=piece.debit*0.001;
                    var vitesse=debit/surface;
                    piece.perte_charge=functions.PeteChargeSinguliere(k,vitesse);
                    }
                    else if(piece.name=="Débitmètre"){
                    var d=$('#formulaire<?php echo $k; ?>').find('#d').val();
                    var l=$('#formulaire<?php echo $k; ?>').find('#l').val();
                    piece.d=d;
                    piece.l=l;
                    if(ligne.etat==1){piece.k=ligne.rugosite;}
                    else if(ligne.etat==0){piece.k=$('#formulaire<?php echo $k; ?>').find('#k').val();}; 
                    var rayon=(piece.d*0.001)/2;
                    var surface=3.14*Math.pow(rayon,2);
                    var debit=piece.debit*0.001;
                    var vitesse=debit/surface;
                    piece.perte_charge=functions.droits(piece.debit,d,piece.k,l);
                    };
                }
                else
                {
                     
                };
                
                if(ligne.sens=="Amont-Aval"){
                    piece.cote_arrivee=Number(piece.cote_depart)-Number(piece.perte_charge);
                }
                else if(ligne.sens=="Aval-Amont"){
                     piece.cote_arrivee=Number(piece.cote_depart)+Number(piece.perte_charge);   
                };
                
                if(piece.etat==0)
                {
                 $('#table<?php echo $k; ?>').find('.annuler').remove();
                 piece.etat=1;
                 
                functions.alert("N'oubliez pas de vous enregistrer !");
            
                }
                else if((piece.etat==1)||(piece.etat==2)){
                    
                    
                    
                    /*functions.alertFunction("Modification réussie");*/
                };
                
                
                
                /*myFunction<?php echo $k ; ?>();*/
                
                
            };
        }); 
        showData();
        showTable();
        functions.Function();
        functions.alert("N'oubliez pas de vous enregistrer !");
        return false;
        };
        
        <?php ;}; ?>
 
        
<?php for ($k = 0; $k < $count; $k++){ ?> 
angle<?php echo $k;?> = ()=>{
       var Angle=$('.div<?php echo $k;?>').find('#angle').val();
       var DN=$('.div<?php echo $k;?>').find('#diametre').val();
       var Rayon=functions.Rayon_de_courbure(Angle,DN);
       var k=functions.k(DN,Angle,Rayon);
       $('.div<?php echo $k;?>').find('#rayon').val(Rayon);
       $('.div<?php echo $k;?>').find('#k').val(k);
};
kb<?php echo $k;?> = ()=>{
       var Angle=$('.div<?php echo $k;?>').find('#angle').val();
       var D1=$('.div<?php echo $k;?>').find('#D1').val();
       var D2=$('.div<?php echo $k;?>').find('#D2').val();
       var k=3.2*Math.pow(Math.tan(Angle/2),1.25)*Math.pow((1-Math.pow(D1/D2,2)),2);
       $('.div<?php echo $k;?>').find('#k').val(k);
};
        
k<?php echo $k;?> = ()=>{
       var D1=$('.div<?php echo $k;?>').find('#D1').val();
       var D2=$('.div<?php echo $k;?>').find('#D2').val();
       var piece_name=$('.div<?php echo $k;?>').find('#piece_name').val();
       var k;
       if(piece_name=="ÉLARGISSEMENT BRUSQUE"){
            k=Math.pow((1-Math.pow((D1/D2),2)),2); 
       }
       else if(piece_name=="RÉTRÉCISSEMENT BRUSQUE"){
            k=0.5*(1-Math.pow((D2/D1),2));
       };
       $('.div<?php echo $k;?>').find('#k').val(k);
};
        
select<?php echo $k;?> = ()=>{
       var Angle=$('.div<?php echo $k;?>').find('#angle').val();
       var k;
       if(Angle==22.5){k=0.07;}
       else if(Angle==30){k=0.11;}
       else if(Angle==45){k=0.24;}
       else if(Angle==60){k=0.47;}
       else if(Angle==90){k=1.13;};
    
       $('.div<?php echo $k;?>').find('#k').val(k);
};
        
type<?php echo $k;?> = ()=>{
       var type=$('.div<?php echo $k;?>').find('#type').val();
       var k;
       if(type==1){k=0.5;}
       else if(type==2){k=1;}
       else if(type==3){k=0.05;}
       else if(type==4){k=1;};
    
       $('.div<?php echo $k;?>').find('#k').val(k);
};
<?php ;}; ?>   
  
function trajet_length(categorie){
       var k=0;
       var l=0;
       trajet.forEach(piece => {
           if(piece.categorie==categorie){
              k=k+1; 
           };
           l=l+1;
       });
       if(categorie=="all"){
           return l;
       }
       else{
           return k;
       };
};
        
cones_input = (k)=>{
    var div="#infosWithTable .div"+k;
    var d=$(div).find('#d');
    var _D=$(div).find('#_D');
    let obj = trajet.find(obj => obj.table == k);
    if(d.val()==0){d.val(obj.d);}
    if(_D.val()==0){_D.val(obj._D);};
    if(d.val()==_D.val()){
        d.val(Number(d.val())+1);
    };
    
}  

/* Function showTable() */
showTable = ()=>{
    sTable= ``;
    trajet.forEach(piece => {
        
    if(trajet_length(cas)!=0){
        $('table thead').show();
    }
    else{
        $('table thead').hide();
    };
        
    if((piece.categorie==cas)||(cas=="all")){ 
     sTable+=` 
                            <tr id="tr${piece.table}" onclick="myFunction${piece.table}();" >
                            <td style="text-align: center;">${piece.name}</td>
                            <td style="text-align: center;" id="cote_depart">${piece.cote_depart}</td>
                            <td style="text-align: center;" id="perte_charge">${piece.perte_charge}</td>
                            <td style="text-align:  center;" id="cote_arrivee">${piece.cote_arrivee}</td>
                            </tr>
     `
     };
    });
    $(".content-data tbody").html(sTable);
    $(".content-data tbody").show();
    $(".content-data tbody").scrollTop($(".content-data tbody").height());
}; 
/* End function showTable() */ 
        
        
/* Function showData() */ 
showData = ()=>{        
sTable= ``;  
trajet.forEach(piece => {
if((piece.categorie==cas)||(cas=="all")){                
sTable+=` 
<div class="div div${piece.table}">
<form action="#" id="form${piece.table}" class="form">
   <div class="form-group">
      <li class="list li${piece.table}" onclick="myFunction${piece.table}();">
         <p>${piece.name}</p>
      </li>
`
if(piece.etat!=0){
sTable+=
`
      <li class="li">
         <div onchange="check${piece.table}();" style="width: 15px;height:15px;position:relative;right:-25px;" id="check${piece.table}" class"check" >
            <input type="checkbox" value="${piece.table}" name="check"  style="width:100%;height:100%;" >
         </div>
      </li>	
`};
sTable+=`
   </div>
</form>
<div class="table" id="table${piece.table}">
   <form id="formulaire${piece.table}">
      <input type="hidden" value="${piece.name}" id="name" name="name">
      <input type="hidden" value="${piece.id_piece}" id="id_piece" name="id_piece">
      <input type="hidden" value="${piece.categorie}" id="categorie_piece" name="categorie_piece">
       <div id="div"> 
        <div class="form-group">
		    <input id="label"  placeholder="Dèbit (mm)" readonly>
            <input type="number" id="debit" value="${piece.debit}" min="0" step="any" 
                                 oninput="this.value = !!this.value && this.value > 0 ? this.value : ${piece.debit}">
       </div>
       </div>
`
if(piece.categorie=="VANNES ET ROBINETS")
{ 
    sTable+=`
            <div id="div"> 
            <div class="form-group">
		          <input id="label"  placeholder="Diamètre (mm)" readonly>
                  <input type="number" id="diametre" value="${piece.d}" min="0" step="any">
            </div>
            </div>
            <div id="div">
            <div class="form-group">
		          <input id="label"  placeholder="k" readonly>
                  <select id="k">
                  `;
                   var array ;
                   var i;
                   if(piece.name=="VANNE A PAPILLON"){
                      array = [0.24,0.52,0.90,1.5,3.9,11,19,33,120,750];
                   ;}
                   else if(piece.name=="ROBINETS VANNES"){
                      array = [0.07,0.26,0.81,2.1,5.5,17,98];                      
                   ;}
                   else if(piece.name=="ROBINETS A TOURNANT"){
                      array = [0.05,0.29,0.75,3.1,9.7,31,110,490];
                   ;}else if(piece.name=="VANNE DE RÉGLAGE"){
                      array = [0.07,0.24,0.26,0.81,2.1,5.5,17,98];
                   ;};
            for (i = 0; i < array.length; ++i) {
                 sTable+=`<option value="`;
                 sTable+=array[i];
                 sTable+=`"`;
                 if(piece.k==array[i]){ sTable+=`selected`; };
                 sTable+=`>`;
                 sTable+=array[i];
                 sTable+=`</option>`;
            };  
            sTable+=`
                  </select>
            </div>
            </div>
            <div id="div">
            <div class="form-group">
		          <input id="label"  placeholder="Cote de départ (m)" readonly>
                  <input id="cote_depart" value="${piece.cote_depart}"  type="number" min="0" step="any">
            </div>
            </div>
            `
;}
else if(piece.categorie=="ELEMENTS DROITS"){
     sTable+=`
            <div id="div"> 
            <div class="form-group">
		          <input id="label"  placeholder="Diamètre (mm)" readonly>
                  <input type="number" id="diametre" value="${piece.d}" min="0" step="any"
                  oninput="this.value = !!this.value && this.value > 0 ? this.value : ${piece.d}"
                  >
            </div>
            </div>
            <div id="div"> 
            <div class="form-group">
		          <input id="label"  placeholder="k" readonly>
                  <input type="number" id="k" value="${piece.k}" min="0" step="any">
            </div>
            </div>
            <div id="div"> 
            <div class="form-group">
		          <input id="label"  placeholder="Langueur (m)" readonly>
                  <input type="number" id="langueur" value="${piece.l}" min="0" step="any">
            </div>
            </div>
            <div id="div">
            <div class="form-group">
		          <input id="label"  placeholder="Cote de départ (m)" readonly>
                  <input id="cote_depart" value="${piece.cote_depart}"  type="number" min="0" step="any">
            </div>
            </div>
     `
;}
else if(piece.categorie=="COUDES"){
    sTable+=` 
           <div id="div"> 
            <div class="form-group">
		          <input id="label"  placeholder="Diamètre (mm)" readonly>
                  <input type="number" id="diametre" value="${piece.d}" min="0" step="any">
            </div>
            </div>
    `;
    if(piece.name=="COUDE BRUSQUE"){
    var array= [22.5,30,45,60,90];
     var i;
    sTable+=`
            <div id="div"> 
            <div class="form-group">
		          <input id="label"  placeholder="Angle (Deg)" readonly>
                  <select id="angle" onchange="select${piece.table}();">
                  `;
                   for (i = 0; i < array.length; ++i) {
                        sTable+=`<option value="`;
                        sTable+=array[i];
                        sTable+=`"`;
                        if(piece.angle==array[i]){ sTable+=`selected`; };
                        sTable+=`>`;
                        sTable+=array[i];
                        sTable+=`</option>`;
                   };  
     sTable+=`
                  </select>
            </div>
            </div>
     `;}
     else if(piece.name=="COUDE ARRONDI"){
     sTable+=` 
             <div id="div"> 
            <div class="form-group">
		          <input id="label"  placeholder="Angle (Deg)" readonly>
                  <input type="number" id="angle" value="${piece.angle}" min="0" max="180" step="any" oninput="angle${piece.table}();">
            </div>
            </div>
            <div id="div"> 
            <div class="form-group">
		          <input id="label"  placeholder="Rayon (mm)" readonly>
                  <input type="number" id="rayon" value="${piece.rayon}" readonly>
            </div>
            </div>
     ` 
     ;};
     sTable+=` 
           <div id="div"> 
            <div class="form-group">
		          <input id="label"  placeholder="k" readonly>
                  <input type="number" id="k" value="${piece.k}" readonly>
            </div>
            </div>
           <div id="div">
            <div class="form-group">
		          <input id="label"  placeholder="Cote de départ (m)" readonly>
                  <input id="cote_depart" value="${piece.cote_depart}"  type="number" min="0" step="any">
            </div>
            </div>
    `;
;}
else if(piece.categorie=="CONES"){
    if(piece.name=="CONE CONVERGENT"){
           sTable+=` 
            <div id="div"> 
            <div class="form-group">
		          <input id="label"  placeholder="D (mm)" readonly>
                  <input type="number" id="_D" value="${piece._D}"  min="0" step="any" oninput="cones_input(${piece.table});">
            </div>
            </div>
            <div id="div"> 
            <div class="form-group">
		          <input id="label"  placeholder="d (mm)" readonly>
                  <input type="number" id="d" value="${piece.d}" min="0" step="any" oninput="cones_input(${piece.table});">
            </div>
            </div>
            <div id="div"> 
            <div class="form-group">
		          <input id="label"  placeholder="Angle (Rad)" readonly>
                  <input type="number" id="angle" value="${piece.angle}">
            </div>
            </div>
            <div id="div"> 
            <div class="form-group">
		          <input id="label"  placeholder="k" readonly>
                  <input type="number" id="k" value="${piece.k}" readonly>
            </div>
            </div>
            `;   
    }
    else if(piece.name=="CONE DIVERGENT"){
            sTable+=` 
           <div id="div"> 
            <div class="form-group">
		          <input id="label"  placeholder="D1 (mm)" readonly>
                  <input type="number" id="D1" value="${piece.D1}" oninput="kb${piece.table}();">
            </div>
            </div>
            <div id="div"> 
            <div class="form-group">
		          <input id="label"  placeholder="D2 (mm)" readonly>
                  <input type="number" id="D2" value="${piece.D2}" oninput="kb${piece.table}();">
            </div>
            </div>
            <div id="div"> 
            <div class="form-group">
		          <input id="label"  placeholder="Angle (Rad)" readonly>
                  <input type="number" id="angle" value="${piece.angle}" oninput="kb${piece.table}();">
            </div>
            </div>
            <div id="div"> 
            <div class="form-group">
		          <input id="label"  placeholder="kb" readonly>
                  <input type="number" id="k" value="${piece.k}" readonly>
            </div>
            </div>
            `;
    };
            sTable+=`
            <div id="div">
            <div class="form-group">
		          <input id="label"  placeholder="Cote de départ (m)" readonly>
                  <input id="cote_depart" value="${piece.cote_depart}"  type="number" min="0" step="any">
            </div>
            </div>
            `;
}
else if(piece.categorie=="CHANGEMENTS"){
     sTable+=` 
           <input type="hidden" value="${piece.name}" id="piece_name">
           <div id="div"> 
            <div class="form-group">
		          <input id="label"  placeholder="D1 (mm)" readonly>
                  <input type="number" id="D1" value="${piece.D1}" oninput="k${piece.table}();">
            </div>
            </div>
            <div id="div"> 
            <div class="form-group">
		          <input id="label"  placeholder="D2 (mm)" readonly>
                  <input type="number" id="D2" value="${piece.D2}" oninput="k${piece.table}();">
            </div>
            </div>
            <div id="div"> 
            <div class="form-group">
		          <input id="label"  placeholder="k" readonly>
                  <input type="number" id="k" value="${piece.k}" readonly>
            </div>
            </div>
            <div id="div">
            <div class="form-group">
		          <input id="label"  placeholder="Cote de départ (m)" readonly>
                  <input id="cote_depart" value="${piece.cote_depart}"  type="number" min="0" step="any">
            </div>
            </div>
            `;   
}
else if(piece.categorie=="TÉS"){
      var array= [22.5,30,45,60,90];
      var i; 
      sTable+=` 
           <div id="div"> 
            <div class="form-group">
		          <input id="label"  placeholder="D (mm)" readonly>
                  <input type="number" id="_D" value="${piece._D}">
            </div>
            </div>
            <div id="div"> 
            <div class="form-group">
		          <input id="label"  placeholder="d (mm)" readonly>
                  <input type="number" id="d" value="${piece.d}">
            </div>
            </div>
            <div id="div"> 
            <div class="form-group">		          
                  <input id="label"  placeholder="k" readonly>
                  <select id="k">
            `;
            if(piece.name=="BRANCHEMENT DE PRISE"){
                  array= [0.04,0.88,0.89,0.95,1.10,1.28];
            }
            else if(piece.name=="BRANCHEMENT D'AMENÉE"){
                  array= [-0.40,0.08,0.47,0.72,0.91];
            };
            for (i = 0; i < array.length; ++i) {
                sTable+=`<option value="`;
                sTable+=array[i];
                sTable+=`"`;
                if(piece.k==array[i]){ sTable+=`selected`; };
                sTable+=`>`;
                sTable+=array[i];
                sTable+=`</option>`;
            };
            sTable+=`
                  </select>
            </div>

            </div>
            <div id="div">
            <div class="form-group">
		          <input id="label"  placeholder="Cote de départ (m)" readonly>
                  <input id="cote_depart" value="${piece.cote_depart}"  type="number" min="0" step="any">
            </div>
            </div>
            `;
}
else if(piece.categorie=="Autres"){
    sTable+=` 
           <div id="div"> 
            <div class="form-group">
		          <input id="label"  placeholder="Diamètre (mm)" readonly>
                  <input type="number" id="d" value="${piece.d}" min="0" step="any" 
                        oninput="this.value = !!this.value && this.value > 0 ? this.value : ${piece.d}">
            </div>
            </div>
            `;
    if(piece.name=="Départ"){
    var array = [
                         { "libelle": "Sans saillie à l’intérieur du réservoir, avec raccordement à angles vifs", "index": 1},
                         { "libelle": "Avec saillie à l’intérieur du réservoir", "index": 2},
                         { "libelle": "Sans saillie à l’intérieur du réservoir, avec raccordement de profil arrondi", "index": 3},
                         { "libelle": "Sans saillie à l’intérieur du réservoir, avec raccordement à angles vifs, ajutage débitant à gueule bée", "index": 4},
    ];
    var i;
    sTable+=` 
            <div id="div"> 
            <div class="form-group">
                  <input id="label"  placeholder="Type" readonly>
                  <select id="type" style="padding-right:10px;" onchange="type${piece.table}();">
                  `;
                   for (i = 0; i < array.length; ++i) {
                        sTable+=`<option value="`;
                        sTable+=array[i].index;
                        sTable+=`"`;
                        if(piece.k==array[i]){ sTable+=`selected`; };
                        sTable+=`>`;
                        sTable+=array[i].libelle;
                        sTable+=`</option>`;
                   };  
            sTable+=`
                  </select>
            </div>
            </div>
            <div id="div"> 
            <div class="form-group">
		          <input id="label"  placeholder="k" readonly>
                  <input type="number" id="k" value="${piece.k}" readonly>
            </div>
            </div>
            `;   
    }
    else if(piece.name=="Arrivée"){
    sTable+=` 
            <div id="div"> 
            <div class="form-group">
		          <input id="label"  placeholder="k" readonly>
                  <input type="number" id="k" value="${piece.k}" readonly>
            </div>
            </div>
            `;    
    }
    else if(piece.name=="Crépine"){
    sTable+=` 
            <div id="div"> 
            <div class="form-group">
		          <input id="label"  placeholder="k" readonly>
                  <input type="number" id="k" value="${piece.k}" min="0" step="any">
            </div>
            </div>
            `;    
    }
    else if(piece.name=="Débitmètre"){
    sTable+=` 
            <div id="div"> 
            <div class="form-group">
		          <input id="label"  placeholder="Langueur (m)" readonly>
                  <input type="number" id="l" value="${piece.l}" min="0" step="any">
            </div>
            </div>
            <div id="div"> 
            <div class="form-group">
		          <input id="label"  placeholder="k" readonly>
                  <input type="number" id="k" value="${piece.k}" min="0" step="any">
            </div>
            </div>
            `;        
    };
    sTable+=` 
            <div id="div">
            <div class="form-group">
		          <input id="label"  placeholder="Cote de départ (m)" readonly>
                  <input id="cote_depart" value="${piece.cote_depart}"  type="number" min="0" step="any">
            </div>
            </div>
            `;
}
else
{
    };
sTable+=`        
   </form>
   <div id="button" style="">
      <div class="form-group">`
          if(piece.etat==0)
          {
             sTable+=`<input class="annuler" onclick="annuler${piece.table}();" value="Annuler" readonly/>`
          }
          sTable+=`<input class="valider" onclick="al${piece.table}();" value="Valider" readonly/>
      </div>
   </div>
</div>
</div>
`
};
});   
$("#infosWithTable .suite").html(sTable);
$("#infosWithTable .suite").show();   
};
/* End function showData() */ 
        
        
/* Function load() */         
load = ()=>{
                $.ajax({
                         url:'ligne.php',
                         type:'post',
                         data:{'idTrajet':idTrajet},
                         cache: false,
                         success:function(dataResult)
                         {
                                         var dataResult = JSON.parse(dataResult);
                     
                                         ligne = {};
                                         ligne.etat=0;    
                                         ligne.nom=dataResult.nom;
                                         $('.head-title').find('#trajet').text(ligne.nom);
                    
                                         ligne.idTrajet=dataResult.idTrajet;
                    
                                         ligne.idProjet=dataResult.idProjet;
                    
                                         ligne.titre_projet=dataResult.titre_projet;
                                         $('.head-title').find('#projet').text(ligne.titre_projet);
                    
                                         ligne.debit=dataResult.debit;
                                         $('.content-data .pricing-wrapper').find('#debit').val(ligne.debit); 
                    
                                         ligne.rugosite=dataResult.rugosite;
                                         $('.content-data .pricing-wrapper').find('#rugosite').val(ligne.rugosite);
                    
                                         ligne.temperature=dataResult.temperature;
                                         $('.content-data .pricing-wrapper').find('#temperature').val(ligne.temperature);
                             
                                         ligne.sens=dataResult.sens;
                                         $('.head-title .first select').find("#"+ligne.sens).attr('selected','selected');
                             
                                         ligne.type=dataResult.type;
                                         if(ligne.type=='Gravitaire'){
                                         
                                         
                                             
                                         $("#refoulement").hide();
                                         $('#cote_arrivee').attr('readonly', true);
                                             
                                         }
                                         else if(ligne.type=='Refoulement'){
                                         
                                         ligne.hauteur=dataResult.hauteur; 
                                         $('.content-data .pricing-wrapper').find('#hauteur').val(ligne.hauteur);    
                                         ligne.puissance=dataResult.puissance; 
                                         $('.content-data .pricing-wrapper').find('#puissance').val(ligne.puissance);
                                             
                                         $("#refoulement").show();
                                         $('#cote_arrivee').attr('readonly', false);
                                         type();
                                         };
                                         div=
                                         `
                                         <option value="Gravitaire" >Gravitaire</option>
                                         <option value="Refoulement">Refoulement</option>           
                                         ` 
                                         /*$('.content-data .pricing-wrapper').find('#type').val(ligne.type);*/
                                         $('.head-title #left').find('#type').val(ligne.type);
                                          $('.head-title #left').find('#list').html(div);
                                         
                                         /*$('.content-data .pricing-wrapper').find('#bieres').html(div);aa();*/
                                         
                                         
                                         
                             
                                         ligne.cote_depart = dataResult.cote_depart;
                                         $('.content-data .pricing-wrapper').find('#cote_depart').val(ligne.cote_depart);
                    
                                         ligne.perte_charge =dataResult.perte_charge;
                                         $('.content-data .pricing-wrapper').find('#perte_charge').val(ligne.perte_charge);
                    
                                         ligne.cote_arrivee =dataResult.cote_arrivee;
                                         $('.content-data .pricing-wrapper').find('#cote_arrivee').val(ligne.cote_arrivee);    
                    
                    
                
                                         ligne.rugosite=$('.content-data .pricing-wrapper').find('#rugosite').val();
                                         ligne.temperature=$('.content-data .pricing-wrapper').find('#temperature').val();
                                         ligne.cote_depart=$('.content-data .pricing-wrapper').find('#cote_depart').val();        
                         }
                });
    
                var ByJson;   
                e=<?php echo $p ; ?> ;
                for(let f=0;f<e;f++)
                {
                    ByJson={'idTrajet':idTrajet,'id':f};
                    $.ajax(
                    {
                        url:'load.php',
                        type:'post',
                        data:ByJson,
                        cache: false,
                        success:function(dataResult)
                        {
                                var dataResult = JSON.parse(dataResult);
                     
                                piece = {};
                    
                                piece.name =dataResult.name_piece;
                                piece.id_piece=dataResult.id_piece;
                    
                                piece.categorie=dataResult.categorie;
                
                                piece.indice=dataResult.id;
                    
                                piece.table =f;
                                piece.etat =2;
                                
                                if(piece.categorie=="VANNES ET ROBINETS")
                                {
                                    piece.d = dataResult.d;
                                    piece.k = dataResult.k;
                                }
                                else if(piece.categorie=="ELEMENTS DROITS"){
                                    piece.d = dataResult.d;
                                    piece.k = dataResult.k; 
                                    piece.l = dataResult.l;    
                                }
                                else if(piece.categorie=="COUDES"){
                                     piece.d = dataResult.d;
                                     piece.k = dataResult.k;
                                     piece.angle = dataResult.angle;
                                     if(piece.name=="COUDE ARRONDI"){piece.rayon = dataResult.rayon;};
                                }
                                else if(piece.categorie=="CONES"){
                                     if(piece.name=="CONE CONVERGENT"){
                                        piece.d= dataResult.d; 
                                        piece._D= dataResult._D;
                                        piece.angle= dataResult.angle;
                                        piece.k = dataResult.k;
                                     }
                                     else if(piece.name=="CONE DIVERGENT"){
                                        piece.D1= dataResult.D1; 
                                        piece.D2= dataResult.D2;
                                        piece.angle= dataResult.angle;
                                        piece.k = dataResult.k;
                                     };
                                }
                                else if(piece.categorie=="CHANGEMENTS"){
                                    piece.D1= dataResult.D1; 
                                    piece.D2= dataResult.D2;
                                    piece.k = dataResult.k;
                                }
                                else if(piece.categorie=="TÉS"){
                                    piece._D= dataResult._D; 
                                    piece.d= dataResult.d;
                                    piece.k = dataResult.k;   
                                }
                                else if(piece.categorie=="Autres"){
                                    if((piece.name=="Départ")||(piece.name=="Arrivée")||(piece.name=="Crépine")){
                                         piece.d = dataResult.d;
                                         piece.k = dataResult.k; 
                                    }
                                    else if(piece.name=="Débitmètre"){
                                         piece.d = dataResult.d;
                                         piece.k = dataResult.k;
                                         piece.l = dataResult.l;
                                    };
                                }
                                else
                                {
                                    piece.val3 = 0;
                                };                                
                                piece.debit=dataResult.debit;
                                piece.cote_depart = dataResult.cote_depart;
                                piece.perte_charge =dataResult.perte_charge;
                                piece.cote_arrivee =dataResult.cote_arrivee;

                                trajet.push(piece);
                
                                showData();    
                                showTable();
                        }
             
                    });
                };
};
/* End function load() */ 
        
        

        
/* Functioncardes() */          
function cardes(){
   <?php for ( $k = 0 ; $k <= $total_pieces ; $k++ ){ ?>
       var categorie=$('#card<?php echo $k;?>').find('#xxxx').val();
       if((cas==categorie)||(cas=="all")){
          $('#card<?php echo $k;?>').show();    
       }
       else{
          $('#card<?php echo $k;?>').hide();    
       };  
    <?php ;}; ?>
};
function show(){
   <?php for ( $k = 0 ; $k <= $total_pieces ; $k++ ){ ?>
     $('#card<?php echo $k;?>').show();    
    <?php ;}; ?>
};
function listes(s){
   $("#edit").hide();
   $('.data_nav').find('li').removeClass("active");
   $('.data_nav').find(s).addClass("active");
   var container = $(document);
   var scrollTo = $('#infosWithTable');
   functions.MaincSrollFunction(container,scrollTo);
};
/* Function cardes() */  
        
/* Function equipements() */  
all_cardes= ()=>{
    event.preventDefault();
    if ( functions.Valider() >= 1) 
    {
        functions.alertFunction("Validez d'abbord l'équipement sélectionné !");                  
    }
    else
    { 
        cas="all";
        showData();
        showTable();
        cardes();
        listes('#li_all');
    };
};
        
vannes= ()=>{
    event.preventDefault();
    if ( functions.Valider() >= 1) 
    {
        functions.alertFunction("Validez d'abbord l'équipement sélectionné !");                  
    }
    else
    { 
        cas="VANNES ET ROBINETS";
        showData();
        showTable();
        cardes();
        listes('#li_vannes');
    };
};
        
droits= ()=>{
    event.preventDefault();
    if ( functions.Valider() >= 1) 
    {
        functions.alertFunction("Validez d'abbord l'équipement sélectionné !");                  
    }
    else
    { 
        cas="ELEMENTS DROITS";
        showData();
        showTable();
        cardes();
        listes('#li_droits');
    };
};

coudes= ()=>{
    event.preventDefault();
    if ( functions.Valider() >= 1) 
    {
        functions.alertFunction("Validez d'abbord l'équipement sélectionné !");                  
    }
    else
    { 
        cas="COUDES";
        showData();
        showTable();
        cardes();
        listes('#li_coudes');
    };
};
cones= ()=>{
    event.preventDefault();
    if ( functions.Valider() >= 1) 
    {
        functions.alertFunction("Validez d'abbord l'équipement sélectionné !");                  
    }
    else
    { 
        cas="CONES";
        showData();
        showTable();
        cardes();
        listes('#li_cones');
    };
};
changements= ()=>{
    event.preventDefault();
    if ( functions.Valider() >= 1) 
    {
        functions.alertFunction("Validez d'abbord l'équipement sélectionné !");                  
    }
    else
    { 
        cas="CHANGEMENTS";
        showData();
        showTable();
        cardes();
        listes('#li_changements');
    };
};
tes= ()=>{
    event.preventDefault();
    if ( functions.Valider() >= 1) 
    {
        functions.alertFunction("Validez d'abbord l'équipement sélectionné !");                  
    }
    else
    { 
        cas="TÉS";
        showData();
        showTable();
        cardes();
        listes('#li_tes');
    };
};
        
autres= ()=>{
    event.preventDefault();
    if ( functions.Valider() >= 1) 
    {
        functions.alertFunction("Validez d'abbord l'équipement sélectionné !");                  
    }
    else
    { 
        cas="Autres";
        showData();
        showTable();
        cardes();
        listes('#li_autres');
    };
};
/* End function equipements() */
    
        
/* Function save() */      
save = ()=>{
    if(ligne.etat==0)
    {
        save_trajet();
        save_pieces();
        functions.actualiser();
    }
    else if(ligne.etat==1)
    {
        functions.alertFunction("valider");
    };
};
/* End function save() */
        
        
/* Function save_pieces() */        
save_trajet = ()=>{
    $(".btn-download").css('pointer-events','none');
    $(".button").removeClass("save");
    ByJson={
        'idTrajet':ligne.idTrajet,
         'debit':ligne.debit,
         'rugosite':ligne.rugosite,
         'temperature':ligne.temperature,
         'CoteDepart':ligne.cote_depart,
         'type':ligne.type,
         'sens':ligne.sens,
         'PerteCharge':ligne.perte_charge,
         'CoteArrivee':ligne.cote_arrivee
    };
    if(ligne.type=="Refoulement"){
         ByJson.hauteur=ligne.hauteur;
         ByJson.puissance=ligne.puissance;
    };
    $.ajax({
                url:'trajet.php',
                type:'post',
                data:ByJson,
                cache: false,
                success:function(){}
    });     
};
/* End function save_trajet */ 
      
        
/* Function save_pieces() */        
save_pieces = ()=>{      
    var ByJson;     
    l=0;
    if((trajet.length == 0))
    {
    functions.alertFunction("aucun element selectionner");
    }
    else
    {    
    trajet.forEach(piece => {
             if(piece.etat!=0)
             {
             var nom=piece.name;
             var idPiece=piece.id_piece;
             var debit=piece.debit;
             var PerteCharge=piece.perte_charge;
             var CoteDepart=piece.cote_depart;
             var CoteArrivee=piece.cote_arrivee;
             var categorie=piece.categorie;
             var indice=piece.indice;
             var ByJson={};
             ByJson.name=nom;
             ByJson.categorie=categorie;
             ByJson.debit=debit;
             ByJson.CoteDepart=CoteDepart;
             ByJson.PerteCharge=PerteCharge;
             ByJson.CoteArrivee=CoteArrivee;
             if(piece.categorie=="VANNES ET ROBINETS")
             {
                var d=piece.d;
                var k=piece.k; 
                ByJson.val1=d;
                ByJson.val2=k;
             } 
             else if(piece.categorie=="ELEMENTS DROITS"){
                var d=piece.d;
                var l=piece.l; 
                var k=piece.k;
                ByJson.d=d;
                ByJson.k=k;
                ByJson.l=l;     
             }
             else if(piece.categorie=="COUDES"){
                var d=piece.d;
                var angle=piece.angle;
                var k=piece.k;
                ByJson.d=d;
                ByJson.k=k;
                ByJson.angle=angle;
                if(piece.name=="COUDE ARRONDI"){
                    var rayon=piece.rayon;
                    ByJson.rayon=rayon;
                };
             }
             else if(piece.categorie=="CONES"){
                 if(piece.name=="CONE CONVERGENT"){
                      var d=piece.d;
                      var _D=piece._D; 
                      var angle=piece.angle;
                      var k=piece.k;
                      ByJson.d=d; 
                      ByJson._D=_D;
                      ByJson.angle=angle;
                      ByJson.k=k;
                 }  
                 else if(piece.name=="CONE DIVERGENT"){
                      var D1=piece.D1;
                      var D2=piece.D2;
                      var angle=piece.angle;
                      var k=piece.k;
                      ByJson.D1=D1; 
                      ByJson.D2=D2;
                      ByJson.angle=angle;
                      ByJson.k=k;
                 };  
             }
             else if(piece.categorie=="CHANGEMENTS"){
                 var D1=piece.D1;
                 var D2=piece.D2;
                 var k=piece.k;
                 ByJson.D1=D1; 
                 ByJson.D2=D2;
                 ByJson.k=k;     
             }
             else if(piece.categorie=="TÉS"){
                 var _D=piece._D;
                 var d=piece.d;
                 var k=piece.k;
                 ByJson._D=_D; 
                 ByJson.d=d;
                 ByJson.k=k;   
             }
             else if(piece.categorie=="Autres"){
                  if((piece.name=="Départ")||(piece.name=="Arrivée")||(piece.name=="Crépine")){
                        var d=piece.d;
                        var k=piece.k;
                        ByJson.d=d;
                        ByJson.k=k;
                  }
                  else if(piece.name=="Débitmètre"){
                        var d=piece.d;
                        var l=piece.l;
                        var k=piece.k;
                        ByJson.d=d;
                        ByJson.l=l;
                        ByJson.k=k;
                  };
            }
             else
             {
                var val3=piece.val3;
                ByJson.val3=val3;
             };
        
             if(piece.etat==1)
             {
                ByJson.idTrajet=idTrajet;
                ByJson.idPiece=idPiece;
              
             
             $.ajax({
                url:'insert.php',
                type:'post',
                data:ByJson,
                cache: false,
                success:function(){}
             });
                 
             }
           
             else if(piece.etat==2)
             {
                 
             ByJson.id=indice;
              
             
             $.ajax({
                url:'update.php',
                type:'post',
                data:ByJson,
                cache: false,
                success:function(){}
             });
                 
             }; 
             }
             else if(piece.etat==0)
             {
                l=l+1;
             };
           
    });
    if(l==0)
    {
    trajet.splice(0, trajet.length);
    }
    else
    {
    functions.alertFunction("veller dabbord valider vos choix"); 
    };
    };
};
/* End function save_pieces() */
 
        
/* Function type() */
type = ()=>{
           
};
/* End function type() */
               
});
</script>
</head>
<body>
</body>    
</html>