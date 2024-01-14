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

        $.ajax({
            type:'POST',
            url:'/usuario/validarLogin',
            data:{
                '_token':$("#token").val(),
                'email':$("#email").val()
            },
            dataType:'json',
            encode: true
        }).done(function(respuesta){
            if(respuesta.exito){
                $("#registrar").attr('disabled', true);

                Toast.fire({
                    icon:'warning',
                    title:'Email no registrado.'
                });

                $("#email").val('');
                $("#email").focus();
            }else{
                $("#registrar").attr('disabled', false);
            }
        });
    });
});