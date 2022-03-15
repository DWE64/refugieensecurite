const $ = require('jquery');

$(document).ready(function(){

    $('.switch2').click((e)=>{
        if(e.target.checked){
            console.log($(e.target).data('url'))
            $.ajax({
                url: $(e.target).data('url'),
                method: 'POST',
                success: function(data){
                    console.log('status changé avec succès');
                },
                error: function(jqXHR){
                }
            });
        }else{
            $.ajax({
                url: $(e.target).data('url'),
                method: 'POST',
                success: function(data){
                    console.log('status changé avec succès');
                },
                error: function(jqXHR){
                }
            });
        }
    });
});