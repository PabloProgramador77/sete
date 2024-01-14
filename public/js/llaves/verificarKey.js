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

    $("#key").change(function(){

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        var formData=new FormData();
        formData.append('key', $("#key")[0].files[0]);
        formData.append('responsable', $("#id").val());

        $.ajax({

            type:'POST',
            url:'/llaves/key',
            data: formData,
            dataType:'json',
            encode: true,
            processData: false,
            contentType: false,
            async: false

        }).done(function(respuesta){

            if(respuesta.exito){

                $("#registrar").attr('disabled', true);

                Toast.fire({

                    icon:'warning',
                    title: respuesta.mensaje

                });

                $("#key").val('');

            }else{

                $("#registrar").attr('disabled', false);

            }

        });

    });

});