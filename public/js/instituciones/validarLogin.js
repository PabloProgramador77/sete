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

    $("#email").change(function(){

        if($("#email").val()!=''){

            $.ajax({

                type:'POST',
                url:'/institucion/emailLogin',
                data:{
                    'email':$("#email").val(),
                    '_token':$("#token").val()
                },
                dataType:'json',
                encode: true

            }).done(function(respuesta){

                if(respuesta.exito){

                    $("#registrar").attr('disabled', false);
                    $("#pass").focus();

                }else{

                    $("#email").val('');
                    $("#registrar").attr('disabled', true);

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