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

    $("#pass").change(function(){

        if($("#pass").val()!='' && $("#passConf").val()!=''){

            if($("#pass").val()==$("#passConf").val()){
                
                $("#registrar").attr('disabled', false);

            }else{

                $("#passConf").val('');
                $("#registrar").attr('disabled', true);

                Toast.fire({
                    icon: 'warning',
                    title: 'La contraseña no coincide. Intenta de nuevo.'
                });

            }

        }else{

            $("#registrar").attr('disabled', true);
            
        }

    });

    $("#passConf").change(function(){

        if($("#pass").val()!='' && $("#passConf").val()!=''){

            if($("#pass").val()==$("#passConf").val()){
                
                $("#registrar").attr('disabled', false);

            }else{

                $("#passConf").val('');
                $("#registrar").attr('disabled', true);

                Toast.fire({
                    icon: 'warning',
                    title: 'La contraseña no coincide. Intenta de nuevo.'
                });

            }

        }else{

            $("#registrar").attr('disabled', true);
            
        }

    });

});