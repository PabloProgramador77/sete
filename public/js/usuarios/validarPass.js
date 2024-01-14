$(document).ready(function(){
    $("#passConf").change(function(){
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

        if($("#passConf").val()!="" && $("#pass").val()!=""){
            if($("#passConf").val()!=$("#pass").val()){
                Toast.fire({
                    icon:'warning',
                    title:'Las contraseñas no coinciden. Intenta de nuevo.'
                });

                $("#registrar").attr('disabled', true);
                $("#pass").val("");
                $("#passConf").val("");
                $("#pass").focus();
            }else{
                $("#registrar").attr('disabled', false);
            }
        }
    })
});