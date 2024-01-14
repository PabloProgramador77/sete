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
            url:'/entidades/registrar',
            data:{
                '_token':$("#token").val(),
                'nombre':$("#nombre").val()
            },
            dataType:'json',
            encode:true
        }).done(function(respuesta){
            if(respuesta.exito){
                Toast.fire({
                    icon:'success',
                    title:'Entidad federativa registrada.'
                });

                $("#registrar").attr('disabled', true);
                $("#nombre").val('');
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