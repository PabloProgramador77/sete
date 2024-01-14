$(document).ready(function(){
    $("#email").change(function(){
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

        if($("#email").val()!=""){
            $.ajax({
                type:'POST',
                url:'/usuario/email',
                data:{
                    '_token':$("#token").val(),
                    'email':$("#email").val()
                },
                dataType:'json',
                encode:true
            }).done(function(respuesta){
                if(respuesta.exito){
                    $("#registrar").attr('disabled', false);
                }else{
                    Toast.fire({
                        icon:'warning',
                        title:'Email en uso. Intenta con otro.'
                    });

                    $("#registrar").attr('disabled', true);
                    $("#email").val("");
                    $("#email").focus();
                }
            });
        }else{
            Toast.fire({
                icon:'warning',
                title:'Email invalido. Intenta de nuevo.'
            });

            $("#email").focus();
            $("#registrar").attr('disabled', true);
        }
    });
});