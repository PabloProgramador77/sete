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

    function responsables(){
        window.location.href='/responsables';
    }

    $("#registrar").on('click', function(e){

        e.preventDefault();

        $.ajax({

            type:'POST',
            url:'/responsables/borrar',
            data:{
                '_token':$("#token").val(),
                'id':$("#id").val()
            },
            dataType:'json',
            encode: true

        }).done(function(respuesta){

            if(respuesta.exito){

                $("#registrar").attr('disabled', true);

                Toast.fire({
                    icon: 'success',
                    title: respuesta.mensaje
                });

                setTimeout(responsables, 3000);

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