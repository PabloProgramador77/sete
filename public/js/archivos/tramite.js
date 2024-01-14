$(document).ready(function(){
    $("#tramite").on('click', function(e){
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

        Toast.fire({
            icon:'info',
            title:'El trámite del título puede tardar un máximo de 72 hrs. En cuanto este listo recibirás una notificación vía correo electrónico.'
        });

    });
});