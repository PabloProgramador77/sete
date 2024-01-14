$(document).ready(function(){
    $("#registrar").on('click', function(e){
        e.preventDefault();

        function login(){
            window.location.href='/';
        }

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
            url:'/usuario/login',
            data:{
                '_token':$("#token").val(),
                'email':$("#email").val(),
                'pass':$("#pass").val()
            },
            dataType:'json',
            encode:true
        }).done(function(respuesta){
            if(respuesta.exito){
                $("#registrar").attr('disabled', true);

                Toast.fire({
                    icon:'success',
                    title:'Bienvenido. Espera un momento.'
                });

                setTimeout(login, 3000);
            }else{
                $("#registrar").attr('disabled', true);

                Toast.fire({
                    icon:'warning',
                    title:respuesta.mensaje
                });
            }
        })
    });
});