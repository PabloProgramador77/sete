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

        function index(){
            window.location.href='/entidades';
        }

        $.ajax({
            type:'POST',
            url:'/entidades/borrar',
            data:{
                '_token':$("#token").val(),
                'id':$("#id").val()
            },
            dataType:'json',
            encode:true
        }).done(function(respuesta){
            if(respuesta.exito){
                $("#registrar").attr('disabled', true);

                Toast.fire({
                    icon:'success',
                    title:'Entidad federativa eliminada. Espera un momento.'
                });

                setTimeout(index, 3000);
            }else{
                $("#registrar").attr('disabled', true);

                Toast.fire({
                    icon:'warning',
                    title:respuesta.mensaje
                });
            }
        });
    });
});