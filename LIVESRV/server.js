const express = require('express');
const app = express();
const http = require('http');
const server = http.createServer(app);
const { Server } = require("socket.io");
const io = new Server(server, {
  cors: {
    origin: "*",
    methods: ["GET", "POST"]
  }
});

app.use(express.json());
app.use(express.static('public'));

// Configuración de grupos por rol
const grupos = {
  'ADMINISTRADOR': 'administradores',
  'operador': 'operador-group',
  'vendedor': 'vendedor-group',
  'usuario': 'general-group'
};

// Usuarios conectados
const usuariosConectados = new Map();

io.on('connection', (socket) => {
  console.log('Nueva conexión:', socket.id);

  // Manejar conexión de usuario
  socket.on('user-connect', (userData) => {
    const { nombre, rol } = userData;
    
    // Asociar datos al socket
    socket.usuarioNombre = nombre;
    socket.usuarioRol = rol;
    socket.grupo = grupos[rol] || 'general-group';
    
    // Unir al grupo correspondiente
    socket.join(socket.grupo);
    
    // Guardar usuario conectado
    usuariosConectados.set(socket.id, {
      nombre: nombre,
      rol: rol,
      grupo: socket.grupo
    });
    
    console.log(`Usuario conectado: ${nombre} (${rol}) - Grupo: ${socket.grupo}`);
  });

  
  socket.on('updSelect', (nombre, cid, campo, accion) => {
    if (!socket.usuarioNombre) return;    
    socket.broadcast.emit('rcbOrden_updSelect', {
      cid: cid,
      nombre: nombre,
      campo: campo,
      accion: accion,
      emisor: socket.usuarioNombre,
      rol: socket.usuarioRol,
      tipo: 'todos'
    });
    console.log(`Mensaje a todos de ${socket.usuarioNombre}: ${nombre}`);
  });
  
  
  socket.on('sndTodos', (mensaje) => {
    if (!socket.usuarioNombre) return;    
    socket.broadcast.emit('rcbOrden', {
      mensaje: mensaje,
      emisor: socket.usuarioNombre,
      rol: socket.usuarioRol,
      tipo: 'todos'
    });
    console.log(`Mensaje a todos de ${socket.usuarioNombre}: ${mensaje}`);
  });

  socket.on('sndGrupo', (mensaje) => {
    if (!socket.usuarioNombre || !socket.grupo) return;
    socket.to(socket.grupo).emit('rcbOrden', {
      mensaje: mensaje,
      emisor: socket.usuarioNombre,
      rol: socket.usuarioRol,
      grupo: socket.grupo,
      tipo: 'grupo'
    });
    console.log(`Mensaje al grupo ${socket.grupo} de ${socket.usuarioNombre}: ${mensaje}`);
  });

  // Manejar desconexión
  socket.on('disconnect', () => {
    if (socket.usuarioNombre) {
      console.log(`Usuario desconectado: ${socket.usuarioNombre}`);
      usuariosConectados.delete(socket.id);
    }
  });
});

server.listen(3000, () => {
  console.log('Servidor ejecutándose en puerto 3000');
});