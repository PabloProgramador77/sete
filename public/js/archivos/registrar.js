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

        $.ajax({
            type:'POST',
            url:'/archivos/registrar',
            data:{
                '_token':$("#token").val(),
                'folio':$("#folio").val(),
                'expedicion':$("#idExpedicion").val()
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

                $("#folio").val('');

                setTimeout(archivos, 3000);

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