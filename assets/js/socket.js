

const CHAT_SERVER = 'http://172.234.246.119:3000';

const usuarioNombre = localStorage.getItem("uid");
const usuarioRol = localStorage.getItem("rol"); 

const socket = io(CHAT_SERVER, {
    transports: ['websocket', 'polling']
});

let chatConectado = false;

socket.on('connect', () => {
    socket.emit('user-connect', {
        nombre: usuarioNombre,
        rol: usuarioRol
    });
    chatConectado = true;
    console.log(`Usuario ${usuarioNombre} conectado como ${usuarioRol}`);
});

socket.on('disconnect', () => {
    console.log('Desconectado del servidor de chat');
    chatConectado = false;
});

// RECEPTOR DE MENSAJES
socket.on('rcbOrden_updSelect', function(data) {
    if (data.tipo === 'grupo') {
        console.log('Grupo:', data.grupo);
    }
    if ($('#'+data.campo+'_lst').length > 0) {
        $("#btn"+data.campo).children().eq(0).after('<a class="dropdown-item" href="#" onclick="seleccionarOpcion(\''+data.nombre+'\', \''+data.cid+'\', \''+data.campo+'\', \''+data.accion+'\')">'+data.nombre+'</a>');
            const miToast = new bootstrap.Toast($('#miToast')[0], {
            delay: 10000,
            autohide: true
        });
        $('#toast-body').html("Se creo un nuevo pais");
        $('#toast-title').html("Lista de paises actualizada");
        miToast.show();
        parpadearBorde('#btnmst_paises__id');

    }
});


//socket.emit('sndGrupo', mensaje);
