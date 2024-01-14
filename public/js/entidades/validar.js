$(document).ready(function(){
    $("#nombre").change(function(){
        if($("#nombre").val()!=""){
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
                url:'/entidades/validar',
                data:{
                    '_token':$("#token").val(),
                    'nombre':$("#nombre").val()
                },
                dataType:'json',
                encode:true
            }).done(function(respuesta){
                if(respuesta.exito){
                    Toast.fire({
                        icon:'warning',
                        title:'Entidad ya registrada.'
                    });

                    $("#registrar").attr('disabled', true);
                    $("#nombre").val('');
                    $("#nombre").focus();
                }else{
                    $("#registrar").attr('disabled', false);
                }
            });
        }
    });
});