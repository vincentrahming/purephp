/**
 *   @name   Bean Stalk Framework Custom jQuery Library
 *   @date   September 11, 2014
 *   @author Vincent J. Rahming <vincent.rahming@gmail.com>    
 *   @desc   Create a customized set of jQuery functions for use
 *           within the application
 *
 *   @requires ../public/java/jquery.js
 *
 **/

$( document ).ready( function() {   
    
    $( '#menu' ).click( function() {
       
        $( '#menuslate' ).slideToggle(200);
        
    });
    
    $( ".datepicker" ).datepicker({
        showOn: "button",
        buttonImage: "http://www.ontheporch.net/polls/public/images/icon_planner.png",
        buttonImageOnly: true               
    });
    
    $( ".datedobpicker" ).datepicker({
        showOn: "button",
        buttonImage: "http://www.ontheporch.net/polls/public/images/icon_planner.png",
        buttonImageOnly: true,                
        changeMonth: true,
        changeYear: true
    });
    
    $( "#oneup" ).click( function(){
       
        var TicketAmount        =       $( "#TicketAmount" ).val();
        
        if ( TicketAmount < 15 ) {
            
            var NewAmount       =       ( Number( TicketAmount ) + 1 );
            $( "#TicketAmount" ).val( NewAmount );
            
        }
        
    });
    
    $( "#onedown" ).click( function(){
       
        var TicketAmount        =       $( "#TicketAmount" ).val();
        
        if ( TicketAmount > 1 ) {
            
            var NewAmount       =       ( Number( TicketAmount ) - 1 );
            $( "#TicketAmount" ).val( NewAmount );
            
        }
        
    });
    
});

/**
 * End of Application Javascript Library
 * ../public/java/bsfCustom.js
 */