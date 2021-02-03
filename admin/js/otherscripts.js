$(document).ready(function(){

    $('#selectAllBoxes').click(function(event){
        if(this.checked){
            $('.checkBoxes').each(function(){
                this.checked = true;
            });
        }
        else{

            $('.checkBoxes').each(function(){
                this.checked = false;
            });
        }
    });

        
    setInterval(function(){
          $("#usersonline").load(window.location.href + " #usersonline" );
          document.getElementById("usersonline").style.color = 'black';
          
    }, 500);

    
    });

   


    
   