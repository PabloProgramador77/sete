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
            url:'/expediciones/registrar',
            data:{
                '_token':$("#token").val(),
                'alumno':$("#alumno").val(),
                'examen':$("#examen").val(),
                'exencion':$("#exencion").val(),
                'servicio':$("#servicio").val(),
                'fundamento':$("#fundamento").val(),
                'titulacion':$("#titulacion").val(),
                'entidad':$("#entidad").val()
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

                $("#examen").val('');
                $("#exencion").val('');
                $("#alumno").val('default');

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