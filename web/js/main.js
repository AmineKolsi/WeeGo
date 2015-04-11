$("document").ready(function() {

    $(".nompays").change(function() {
if($(this).val().length !=0)
{
        $.ajax({
            type: "get",
           
          'url': Routing.generate('best_trip_wee_go_ville', {
            nompays : $(this).val()
            }),
            beforeSend: function() {
                  $('  #ville  ').parent().append('<div class="loading"></div>');
               $(' #ville option  ').remove();
            },
            success: function(data)
            {
             $.each(data.ville,function(index,value){
                $(' #ville  ').append( $ ('<option>',{ value : value , text: value }));
                $(" .loading ").remove();
                 
                 
                 
             });
                    
              
                
                
            }
        });




    }
        else {
            $(" #ville ").val('');
           
        }


});

    


});
$('#titi').hide();

$('#search').show();

$("document").ready(function() {
    
            $("#valider_recherche").click(function () {      
            var idU = document.getElementById("nom").value;
                $.ajax({
                    type: "get",
           
          'url': Routing.generate('best_trip_wee_go_recherche', {
              
            nom : idU
            }),
                    success: function (data) {
                    
$('#titi').show();
                         $('#nom').val('');
 $('#ta').val(data.path);
                       //  document.getElementById("comment-numb").innerHTML=data.numtel;
                         //document.getElementById("date").innerHTML=data.statut;
                         //document.getElementById("autor").innerHTML=data.nom;
 //$('.adresse').val(data.adress);
   //                   document.getElementById("tel").innerHTML=data.numtel;
                        document.getElementById('todo').innerHTML = '<img src=/04-04-2015/WeeGo/web/'+data.path+'>';
                        document.getElementById("paragraphe").innerHTML=data.nom+" est un "+data.statut+" situé dans "+data.adresse+" pour plus d'informations :"+data.numtel+" ou "+data.siteweb;
    console.log("ok");
                  
                     
                        
                     

                    }
                });
            });





        });


