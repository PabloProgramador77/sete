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

    $("#registrar").on('click', function(e){
        
        e.preventDefault();

        if($("#nombre").val()!="" && $("#apellido1").val()!=""){

            $.ajax({
    
                type:'POST',
                url:'/responsables/registrar',
                data:{
                    '_token':$("#token").val(),
                    'nombre':$("#nombre").val(),
                    'apellido1':$("#apellido1").val(),
                    'apellido2':$("#apellido2").val(),
                    'curp':$("#curp").val(),
                    'cargo':$("#cargo").val(),
                    'titulo':$("#titulo").val()
                },
                dataType:'json',
                encode: true
    
            }).done(function(respuesta){
    
                if(respuesta.exito){
    
                    $("#nombre").val('');
                    $("#apellido1").val('');
                    $("#apellido2").val('');
                    $("#curp").val('');
                    $("#titulo").val('');
                    $("#registrar").attr('disabled', true);
    
                    Toast.fire({
                        icon: 'success',
                        title: respuesta.mensaje
                    });
    
                }else{
    
                    $("#registrar").attr('disabled', true);
    
                    Toast.fire({
                        icon: 'warning',
                        title: respuesta.mensaje
                    });
    
                }
    
            });
    
        }else{
    
            $("#registrar").attr('disabled', true);
    
        }

    });

});