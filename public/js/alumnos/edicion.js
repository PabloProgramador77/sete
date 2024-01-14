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

    $("#email").change(function(){

        if($("#email").val()!=""){

            $("#registrar").attr('disabled', false);

        }

    });

    $("#carrera").change(function(){

        $("#registrar").attr('disabled', false);

    });

    $("#inicio").change(function(){

        if($("#inicio").val()!=""){

            $("#registrar").attr('disabled', false);

        }

    });

    $("#final").change(function(){

        if($("#final").val()!=""){

            $("#registrar").attr('disabled', false);
            
        }

    });

});