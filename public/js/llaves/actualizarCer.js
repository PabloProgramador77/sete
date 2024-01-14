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

    function responsables(){
        window.location.href='/responsables';
    }

    $("#registrar").on('click', function(e){

        e.preventDefault();

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        var formData=new FormData();
        formData.append('cer', $("#cer")[0].files[0]);
        formData.append('id', $("#id").val());

        $.ajax({

            type:'POST',
            url:'/llaves/actualizarCer',
            data:formData,
            dataType:'json',
            encode: true,
            processData: false,
            contentType: false,
            async: false
        }).done(function(respuesta){

            if(respuesta.exito){

                $("#cer").attr('disabled', true);
                $("#registrar").attr('disabled', true);

                Toast.fire({
                    icon:'success',
                    title: respuesta.mensaje
                });

                setTimeout(responsables, 3000);

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