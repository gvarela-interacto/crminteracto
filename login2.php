<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GH ABOGADOS</title>
    <link rel="stylesheet" href="assets/css/vertical-layout-light/login.css">
    <link rel="shortcut icon" type="image/png" href="assets/images/favicon.png">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    html, body {
      height: 100%;
      width: 100%;
      padding: 0px!important;
      margin: 0px!important; 
    }

    body {
      background: linear-gradient(90deg, #fff, #FFF);
      padding: 0px!important;
      margin: 0px!important;
    }

    .container-fluid {
      display: flex;
      height: 100vh;
      width: 100vw!important;
      padding: 0px!important;
      margin: 0px!important;
    }

    .left-panel {
      flex: 1;
      background: linear-gradient(135deg, #fb8c00, #f57c00);
      color: white;
      padding: 60px 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .left-panel h1 {
      font-size: 3rem;
      margin-bottom: 20px;
    }

    .left-panel p {
      font-size: 1.1rem;
      opacity: 0.9;
    }

    .right-panel {
      width: 500px;
      background-color: #fff;
      padding: 60px 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .right-panel h2 {
      font-size: 2rem;
      color: #333;
      margin-bottom: 30px;
    }

    .input-group {
      margin-bottom: 20px;
    }

    .input-group input {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid #ccc;
      border-radius: 0;
      font-size: 1rem;
      outline: none;
    }

    .options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
      font-size: 0.9rem;
    }

    .options a {
      text-decoration: none;
      color: #fb8c00;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #fb8c00;
      color: white;
      border: none;
      border-radius: 0;
      font-size: 1rem;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background-color: #ef6c00;
    }

    .footer-text {
      text-align: center;
      margin-top: 20px;
      font-size: 0.9rem;
    }

    .footer-text a {
      color: #fb8c00;
      text-decoration: none;
    }

    @media screen and (max-width: 768px) {
      .container-fluid {
        flex-direction: column;
      }

      .right-panel {
        width: 100%;
      }

      .left-panel {
        text-align: center;
      }
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="left-panel">
      <h1>¡Bienvenido de nuevo!</h1>
      <p>Puedes iniciar sesión con tu cuenta existente.</p>
    </div>
    <div class="right-panel">
        <div style="text-align:center; margin-bottom:20px">
            <img src="assets/images/logoapp.png" alt="logo">
        </div>
        <h4 style="margin-top:40px">Bienvenid@!</h4>
        <h6 class="fw-light">Inicia sesión para continuar.</h6>
        <form id="frmLogin" class="pt-2">
            <div class="form-group">
                <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="Nombre de usuario">
            </div>
            <div class="form-group" style="margin-top:6px">
                <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Contraseña">
            </div>
            <div class="mt-3">
                <button type="submit" class="btn w-100 btn-block btn-primary btn-lg font-weight-medium auth-form-btn">INGRESAR</button>
            </div>
            <div class="text-center mt-4 fw-light">
                power by <a href="https://interacto.co" class="text-primary"><img src="assets/images/powerby.png"></a>
            </div>
        </form>
    </div>
  </div>
</body>
</html>
