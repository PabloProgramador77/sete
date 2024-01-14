$(document).ready(function(){

    $("#examen").change(function(){

        if($("#examen").val()!=''){

            $("#registrar").attr('disabled', false);

        }

    });

    $("#exencion").change(function(){

        if($("#exencion").val()!=''){

            $("#registrar").attr('disabled', false);

        }

    });

    $("#servicio").change(function(){

        $("#registrar").attr('disabled', false);

    });

    $("#fundamento").change(function(){

        $("#registrar").attr('disabled', false);

    });

    $("#titulacion").change(function(){

        $("#registrar").attr('disabled', false);

    });

    $("#entidad").change(function(){

        $("#registrar").attr('disabled', false);

    });

});