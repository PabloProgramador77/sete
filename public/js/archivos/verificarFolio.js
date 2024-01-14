$(document).ready(function(){
    $("#folio").change( function(){

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
            url:'/archivos/folio',
            data:{
                '_token':$("#token").val(),
                'folio':$("#folio").val()
            },
            dataType:'json',
            encode: true
        }).done(function(respuesta){
            if(respuesta.exito){
                $("#registrar").attr('disabled', true);

                Toast.fire({
                    icon:'warning',
                    title: respuesta.mensaje
                });

                $("#folio").val('');

            }else{

                $("#registrar").attr('disabled', false);

            }
        });
    });
});