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
            url:'/titulacion/registrar',
            data:{
                'nombre':$("#nombre").val(),
                '_token':$("#token").val()
            },
            dataType:'json',
            encode: true
        }).done(function(respuesta){

            if(respuesta.exito){

                $("#nombre").val('');
                $("#nombre").focus();
                $("#registrar").attr('disabled', true);

                Toast.fire({
                    icon:'success',
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