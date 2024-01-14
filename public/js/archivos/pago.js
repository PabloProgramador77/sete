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

        function archivos(){
            window.location.href='/archivos';
        }

        Toast.fire({
            icon:'info',
            title:'Procesando pago, espera un momento'
        });

        $("#registrar").attr('disabled', true);

        $.ajax({
            type:'POST',
            url:'/archivos/pagar',
            data:{
                '_token':$("#token").val(),
                'id':$("#idArchivo").val(),
                'precio':$("#precio").val(),
                'tarjeta':$("#tarjeta").val(),
                'mes':$("#mes").val(),
                'ano':$("#ano").val(),
                'cvc':$("#cvc").val(),
                'descripcion':$("#descripcion").val()
            },
            dataType:'json',
            encode: true
        }).done(function(respuesta){

            if(respuesta.exito){

                $("#registrar").attr('disabled', true);

                Toast.fire({
                    icon:'success',
                    title: respuesta.mensaje
                });

                setTimeout(archivos, 2975);

            }else{
                
                Toast.fire({
                    icon:'warning',
                    title: respuesta.mensaje
                });

                $("#registrar").attr('disabled', false);

            }
        });
    });
});