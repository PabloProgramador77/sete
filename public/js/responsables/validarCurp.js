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

    $("#curp").change(function(){

        if($("#curp").val()!=""){

            $.ajax({

                type:'POST',
                url:'/responsables/curp',
                data:{
                    '_token':$("#token").val(),
                    'curp':$("#curp").val()
                },
                dataType:'json',
                encode: true

            }).done(function(respuesta){

                if(respuesta.exito){

                    $("#registrar").attr('disabled', true);
                    $("#curp").val('');

                    Toast.fire({
                        icon:'warning',
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