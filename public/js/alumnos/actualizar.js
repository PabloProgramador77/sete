$(document).ready(function(){

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    $("#registrar").on('click', function(e){

        e.preventDefault();

        $.ajax({

            type:'POST',
            url:'/alumnos/actualizar',
            data:{
                'nombre':$("#nombre").val(),
                'apellido1':$("#apellido1").val(),
                'apellido2':$("#apellido2").val(),
                'curp':$("#curp").val(),
                'email':$("#email").val(),
                'carrera':$("#carrera").val(),
                'id':$("#id").val(),
                '_token':$("#token").val(),
                'inicio':$("#inicio").val(),
                'final':$("#final").val()
            },
            dataType:'json',
            encode:true
        }).done(function(respuesta){

            if(respuesta.exito){

                $("#registrar").attr('disabled', true);

                Toast.fire({
                    icon: 'success',
                    title: respuesta.mensaje
                });

            }else{

                $("#registrar").attr('disabled', true);

                Toast.fire({
                    icon:'warning',
                    title: respuesta.mensaje
                });

            }

        });

    });

});