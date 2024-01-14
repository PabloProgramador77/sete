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

    //Verificación de contraseña
    $("#passKey").change(function(){

        if($("#passKey").val()!='' && $("#confPassKey").val()!=''){

            if($("#passKey").val()!=$("#confPassKey").val()){

                $("#registrar").attr('disabled', true);

                Toast.fire({
                    icon:'warning',
                    title: 'Las contraseñas no coinciden.'
                });

                $("#passKey").val('');
                $("#confPassKey").val('');

            }else{

                $("#registrar").attr('disabled', false);

            }

        }

    });

    //Verificación de contraseña
    $("#confPassKey").change(function(){

        if($("#passKey").val()!="" && $("#confPassKey").val()!=""){

            if($("#passKey").val()!=$("#confPassKey").val()){

                $("#registrar").attr('disabled', true);

                Toast.fire({
                    icon:'warning',
                    title: 'Las contraseñas no coinciden.'
                });

                $("#passKey").val('');
                $("#confPassKey").val('');

            }else{

                $("#registrar").attr('disabled', false);
                
            }

        }

    });

});