$(document).ready(function(){
    $("#registrar").on('click', function(e){
        e.preventDefault();

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

        $.ajax({
            type:'POST',
            url:'/alumnos/registrar',
            data:{
                '_token':$("#token").val(),
                'nombre':$("#nombre").val(),
                'apellido1':$("#apellido1").val(),
                'apellido2':$("#apellido2").val(),
                'curp':$("#curp").val(),
                'email':$("#email").val(),
                'carrera':$("#carrera").val(),
                'inicio':$("#inicio").val(),
                'final':$("#final").val()
            },
            dataType:'json',
            encode: true
        }).done(function(respuesta){
            if(respuesta.exito){
                $("#registrar").attr('disabled', true);

                Toast.fire({
                    icon:'success',
                    title: respuesta.mensaje
                });

                $("#nombre").val('');
                $("#apellido1").val('');
                $("#apellido2").val('');
                $("#curp").val('');
                $("#email").val('');
                $("#inicio").val('');
                $("#final").val('')

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