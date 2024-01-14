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
            url:'/estudios/registrar',
            data:{
                '_token':$("#token").val(),
                'nombre':$("#nombre").val()
            },
            dataType:'json',
            encode:true
        }).done(function(respuesta){
            if(respuesta.exito){
                $("#registrar").attr('disabled', true);

                Toast.fire({
                    icon:'success',
                    title:'Estudio registrado.'
                });

                $("#nombre").val('');
                $("#nombre").focus();
            }else{
                $("#registrar").attr('disabled', true);

                Toast.fire({
                    icon:'warning',
                    title: respuesta.mensaje
                });
            }
        });
    });
});