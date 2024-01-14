$(document).ready(function(){
    $("#curp").change(function(){
        if($("#curp").val()!=""){
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
                url:'/alumnos/curp',
                data:{
                    '_token':$("#token").val(),
                    'curp':$("#curp").val()
                },
                dataType:'json',
                encode: true
            }).done(function(respuesta){
                if(respuesta.exito){
                    $("#registrar").attr('disabled', true);

                    Toast.fire({
                        icon:'warning',
                        title: respuesta.mensaje
                    });

                    $("#curp").val('');
                    $("#curp").focus();
                }else{
                    $("#registrar").attr('disabled', false);
                }
            });
        }
    });
});