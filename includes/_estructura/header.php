<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start interHeader">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
        <div>
          <a class="navbar-brand brand-logo" href="index.php" style="font-size:20px; font-weight:bold; color:#FFF">
            INTERACTO
          </a>
          <a class="navbar-brand brand-logo-mini" href="index.php" style="font-size:20px; margin-left:-15px; font-weight:bold; color:#000">
            INTERACTO
          </a>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top interHeader" id="statusbar">
        <ul class="navbar-nav" style="padding-left:0px;">
          <li class="nav-item d-none d-lg-block" style="width:400px; margin-left:0px">
            <div class="input-group">
              <div class="input-group-addon input-group-prepend border-right">
                <span class="icon-search input-group-text calendar-icon" style="color:#999"></span>
              </div>
              <input type="text" class="form-control" id="inlineFormInputGroup" style="padding:10px 6px" placeholder="Buscar">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
            <h1 class="welcome-text">Bienvenido, <span class="text-black fw-bold"><?=$_SESSION["nombres"]." ".$_SESSION["apellidos"]?></span></h1>
          </li>
          <li class="nav-item dropdown" style="width:50px;">
            <a class="nav-link count-indicator" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
              <i class="icon-bell"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="notificationDropdown">
              <a class="dropdown-item py-3 border-bottom">
                <p class="mb-0 font-weight-medium float-left">Usted tiene 0 notificaciones nuevas </p>
                <span class="badge badge-pill badge-primary float-right">Ver Todas</span>
              </a>
              <!--
              <a class="dropdown-item preview-item py-3">
                <div class="preview-thumbnail">
                  <i class="mdi mdi-alert m-auto text-primary"></i>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject fw-normal text-dark mb-1">Application Error</h6>
                  <p class="fw-light small-text mb-0"> Just now </p>
                </div>
              </a>
              <a class="dropdown-item preview-item py-3">
                <div class="preview-thumbnail">
                  <i class="mdi mdi-settings m-auto text-primary"></i>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject fw-normal text-dark mb-1">Settings</h6>
                  <p class="fw-light small-text mb-0"> Private message </p>
                </div>
              </a>
              <a class="dropdown-item preview-item py-3">
                <div class="preview-thumbnail">
                  <i class="mdi mdi-airballoon m-auto text-primary"></i>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject fw-normal text-dark mb-1">New user registration</h6>
                  <p class="fw-light small-text mb-0"> 2 days ago </p>
                </div>
              </a>
              -->
            </div>
          </li>

          <li class="nav-item dropdown d-none d-lg-block user-dropdown" style="width:40px; padding:0px; margin:0px 0px 0px 0px;">
            <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false" style="margin-left:-14px">
              <img class="img-xs rounded-circle" src="assets/images/perfil/noface.jpg" alt="Profile image"> </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center">
                <img class="img-md rounded-circle" src="assets/images/perfil/noface.jpg" alt="Profile image">
                <p class="mb-1 mt-3 font-weight-semibold"><?=$_SESSION["nombres"]." ".$_SESSION["apellidos"]?></p>
                <p class="fw-light text-muted mb-0"><?=$_SESSION["correoelectronico"]?></p>
              </div>
              <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> Mi perfil</a>
              <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-message-text-outline text-primary me-2"></i> Mensajes <span class="badge badge-pill badge-danger">0</span></a>
              <a href="javascript:logout()" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Salir</a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>