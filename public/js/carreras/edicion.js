$(document).ready(function(){

    $("#nombre").change(function(){

        if($("#nombre").val()!=""){

            $("#registrar").attr('disabled', false);

        }

    });

    $("#autoridad").change(function(){

        $("#registrar").attr('disabled', false);

    });

});