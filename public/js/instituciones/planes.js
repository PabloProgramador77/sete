$(document).ready(function(){

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 9000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    $("#plan").change(function(){

        switch ($("#plan").val()) {
            case 'Basico':
                Toast.fire({
                    icon:'info',
                    title:'Plan Básico incluye pago de $349.00 MXN por archivo antes de la descarga.'
                });
                break;
            
            case 'Premium':
                Toast.fire({
                    icon:'info',
                    title:'Plan Premium incluye anualidad de $7,149.00 MXN sin limite de XML por cada año.'
                });
                break;
            
            case 'Ilimitado':
                Toast.fire({
                    icon:'info',
                    title:'Plan Ilimitado incluye pago unico de $72,440.00 MXN sin limite de XML de por vida.'
                })
                break;
        }

    });

});