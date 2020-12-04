<div class="page__header">
    <div class="navbar bg-dark navbar-dark navbar-expand-sm d-none2 d-md-flex2">
        <div class="container">

            <div class="navbar-collapse collapse" id="navbarsExample03">
                <ul class="nav navbar-nav">
                    <?php if ($usuario->hasPrivilege("menu_admin")): ?>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Administrador</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?= site_url("admin/cursos") ?>">Cursos</a>
                                <a class="dropdown-item" href="<?= site_url("admin/usuarios") ?>">Usuarios</a>
                                <a class="dropdown-item" href="<?= site_url("admin/ramas") ?>">Ramas</a>
                                <a class="dropdown-item" href="<?= site_url("admin/preparaciones") ?>">Preparaciones</a>
                                <a class="dropdown-item" href="<?= site_url("admin/roles") ?>">Roles</a>
                                <a class="dropdown-item" href="<?= site_url("admin/permisos") ?>">Permisos</a>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if ($usuario->hasPrivilege("menu_profesor")): ?>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Profesores</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?= site_url("profesores/inicio") ?>">Dashboard / Inicio</a>
                                <a class="dropdown-item" href="<?= site_url("profesores/calendario") ?>">Calendario</a>
                                <a class="dropdown-item" href="<?= site_url("profesores/cursos") ?>">Cursos</a>
                                <a class="dropdown-item" href="<?= site_url("profesores/examenes") ?>">Exámenes</a>
                                <a class="dropdown-item" href="<?= site_url("") ?>">Calificación/Evaluación</a>
                                <a class="dropdown-item" href="<?= site_url("profesores/inicio") ?>">Mensajes</a>
                                <a class="dropdown-item" href="<?= site_url("profesores/recursos") ?>">Recursos</a>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if ($usuario->hasPrivilege("menu_alumno")): ?>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Alumnos</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?= site_url("alumnos/inicio") ?>">Dashboard / Inicio</a>
                                <a class="dropdown-item" href="<?= site_url("alumnos/calendario") ?>">Calendario</a>
                                <a class="dropdown-item" href="<?= site_url("alumnos/cursos") ?>">Cursos</a>
                                <a class="dropdown-item" href="<?= site_url("alumnos/cursos") ?>">Exámenes</a>
                                    <a class="dropdown-item ml-3" href="<?= site_url("alumnos/inicio") ?>">Realizados</a>
                                    <a class="dropdown-item ml-3" href="<?= site_url("alumnos/inicio") ?>">Pendientes</a>
                                    <a class="dropdown-item ml-3" href="<?= site_url("alumnos/inicio") ?>">En Curso</a>
                                <a class="dropdown-item" href="<?= site_url("") ?>">Calificación/Evaluación</a>
                                <a class="dropdown-item" href="<?= site_url("profesores/inicio") ?>">Mensajes</a>
                            </div>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Layouts</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="instructor-account-edit.html">Fluid</a>
                            <a class="dropdown-item active" href="fixed-instructor-account-edit.html">Fixed</a>
                        </div>
                    </li>
                </ul>
            </div>

            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarsExample03" type="button">
                <span class="material-icons">menu</span>
            </button>

        </div>
    </div>
</div>
