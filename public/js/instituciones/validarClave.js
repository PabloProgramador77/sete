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

    $("#clave").change(function(){

        if($("#clave").val()!=''){

            $.ajax({

                type:'POST',
                url:'/institucion/clave',
                data:{
                    'clave':$("#clave").val(),
                    '_token':$("#token").val()
                },
                dataType:'json',
                encode: true

            }).done(function(respuesta){

                if(respuesta.exito){

                    $("#clave").val('');
                    $("#registrar").attr('disabled', true);

                    Toast.fire({
                        icon: 'warning',
                        title: respuesta.mensaje
                    });

                }else{

                    $("#registrar").attr('disabled', false);

                }

            });

        }else{

            $("#registrar").attr('disabled', true);
            
        }

    });

});