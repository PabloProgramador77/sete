$(document).ready(function(){

    $("#nombre").change(function(){

        if($("#nombre").val()!=""){

            $("#registrar").attr('disabled', false);

        }

    });

    $("#apellido1").change(function(){

        if($("#apellido1").val()!=""){

            $("#registrar").attr('disabled', false);

        }

    });

    $("#apellido2").change(function(){

        if($("#apellido2").val()!=""){

            $("#registrar").attr('disabled', false);

        }

    });

    $("#titulo").change(function(){

        if($("#titulo").val()!=""){

            $("#registrar").attr('disabled', false);

        }

    });

    $("#cargo").change(function(){

        $("#registrar").attr('disabled', false);

    });

});