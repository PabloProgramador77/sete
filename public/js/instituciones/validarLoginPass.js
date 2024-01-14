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
        window.location.href='/institucion/entrar'
    }

    $("#registrar").on('click', function(e){

        e.preventDefault();

        if($("#pass").val()!=''){

            $.ajax({

                type:'POST',
                url:'/institucion/passLogin',
                data:{
                    'email':$("#email").val(),
                    'pass':$("#pass").val(),
                    '_token':$("#token").val()
                },
                dataType:'json',
                encode: true

            }).done(function(respuesta){

                if(respuesta.exito){

                    $("#pass").attr('disabled', true);

                    Toast.fire({
                        icon: 'success',
                        title: respuesta.mensaje
                    });

                    setTimeout(login, 3000);

                }else{

                    $("#pass").val('');

                    Toast.fire({
                        icon: 'warning',
                        title: respuesta.mensaje
                    });

                }

            });

        }else{

            $("#registrar").attr('disabled', true);
            
        }

    });

});