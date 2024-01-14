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

    function login(){
        window.location.href='/login';
    }

    $("#registrar").on('click', function(e){

        e.preventDefault();

        $.ajax({

            type:'POST',
            url:'/institucion/registrar',
            data:{
                'nombre':$("#nombre").val(),
                'clave':$("#clave").val(),
                'email':$("#email").val(),
                'pass':$("#pass").val(),
                '_token':$("#token").val()
            },
            dataType:'json',
            encode: true
        }).done(function(respuesta){

            if(respuesta.exito){

                $("#nombre").attr('disabled', true);
                $("#clave").attr('disabled', true);
                $("#email").attr('disabled', true);
                $("#pass").attr('disabled', true);
                $("#passConf").attr('disabled', true);
                $("#registrar").attr('disabled', true);

                Toast.fire({
                    icon:'success',
                    title: respuesta.mensaje
                });

                setTimeout(login, 3000);

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