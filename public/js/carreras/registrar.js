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
            url:'/carreras/registrar',
            data:{
                '_token':$("#token").val(),
                'nombre':$("#nombre").val(),
                'rvoe':$("#rvoe").val(),
                'clave':$("#clave").val(),
                'autoridad':$("#autoridad").val()
            },
            dataType:'json',
            encode: true

        }).done(function(respuesta){

            if(respuesta.exito){

                $("#nombre").val('');
                $("#rvoe").val('');
                $("#clave").val('');
                $("#autoridad").val('');
                $("#registrar").attr('disabled', true);

                Toast.fire({
                    icon: 'success',
                    title: respuesta.mensaje
                });

            }else{

                $("#registrar").attr('disabled', true);

                Toast.fire({
                    icon: 'warning',
                    title: respuesta.mensaje
                });

            }

        });

    });

});