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

        function alumnos(){
            window.location.href='/alumnos';
        }

        $.ajax({
            type:'POST',
            url:'/antecedentes/actualizar',
            data:{
                '_token':$("#token").val(),
                'institucion':$("#institucion").val(),
                'cedula':$("#cedula").val(),
                'inicio':$("#inicio").val(),
                'final':$("#final").val(),
                'estudio':$("#estudio").val(),
                'entidad':$("#entidad").val(),
                'id':$("#id").val()
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

                $("#institucion").attr('disabled', true);
                $("#cedula").attr('disabled', true);
                $("#inicio").attr('disabled', true);
                $("#final").attr('disabled', true);
                $("#estudio").attr('disabled', true);
                $("#entidad").attr('disabled', true);

                setTimeout(alumnos, 3000);

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