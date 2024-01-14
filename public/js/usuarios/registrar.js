$(document).ready(function(){
    $("#registrar").on('click', function(e){
        e.preventDefault();
        
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
            url:'/usuario/registrar',
            data:{
                '_token':$("#token").val(),
                'nombre':$("#nombre").val(),
                'categoria':$("#categoria").val(),
                'telefono':$("#telefono").val(),
                'email':$("#email").val(),
                'pass':$("#pass").val()
            },
            dataType:'json',
            encode:true
        }).done(function(respuesta){
            if(respuesta.exito){
                Toast.fire({
                    icon:'success',
                    title:'Usuario registrado correctamente.'
                });

                $("#nombre").val('');
                $("#categoria").val('default');
                $("#telefono").val('');
                $("#email").val('');
                $("#pass").val('');
                $("#passConf").val('');

                $("#registrar").attr('disabled', true);
            }else{
                Toast.fire({
                    icon:'warning',
                    title: respuesta.mensaje
                });

                $("#registrar").attr('disabled', true);
            }
        });
    });
});