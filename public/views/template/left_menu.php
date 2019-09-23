<div class="left-side sticky-left-side">
    <!--logo and iconic logo start-->
    <div class="logo">
        <a href="<?php echo ROOT; ?>"><img src="<?php echo ROOT; ?>resources/assets/images/logo.png" alt=""></a>
    </div>

    <div class="logo-icon text-center">
        <a href="<?php echo ROOT; ?>"><img src="<?php echo ROOT; ?>resources/assets/images/logo_icon.png" alt=""></a>
    </div>
    <!--logo and iconic logo end-->

    <div class="left-side-inner">
        <!-- visible to small devices only -->
        <div class="visible-xs hidden-sm hidden-md hidden-lg">
            <div class="media logged-user">
                <img alt="" src="<?php echo ROOT; ?>resources/assets/images/photos/user-avatar.png" class="media-object">
                <div class="media-body">
                    <h4><a href="#"> <?php echo $_SESSION['nombre']; ?></a></h4>
                    <span>"<?php echo $_SESSION['user_name']; ?>"</span>
                </div>
            </div>
            <h5 class="left-nav-title">Información de cuenta</h5>
            <ul class="nav nav-pills nav-stacked custom-nav">
              <li><a href="<?php echo ROOT_CONTROLLER; ?>user/perfil.php"><i class="fa fa-user"></i> <span> Mi cuenta</span></a></li>
              <li><a href="<?php echo ROOT_CONTROLLER; ?>login/index.php?logout"><i class="fa fa-sign-out"></i> <span>Salir</span></a></li>
            </ul>
        </div>
        <ul class="nav nav-pills nav-stacked custom-nav">
            <li class="<?php echo isset($menu_a['inicio']) ? $menu_a['inicio'] : ''; ?>"><a href="<?php echo ROOT; ?>"><i class="fa fa-home"></i> <span>
            Inicio</span></a></li>
            <?php if ($_SESSION['id_rol']==1): ?>
                <li class="menu-list <?php echo isset($menu_a['ueducativa'])? $menu_a['ueducativa'] : ''; ?>"><a href=""><i class="fa fa-book"></i> <span>Stock</span></a>
                    <ul class="sub-menu-list">
                        <li class="<?php echo isset($menu_a['padres_u']) ? $menu_a['padres_u']:''; ?>">
                        <a href="<?php echo ROOT_CONTROLLER; ?>stock/">Asignar Stock</a></li>
                    </ul>
                </li>



                <li class="menu-list <?php echo isset($menu_a['ueducativa'])? $menu_a['ueducativa'] : ''; ?>"><a href=""><i class="fa fa-book"></i> <span>Ventas</span></a>
                    <ul class="sub-menu-list">                   

                        <li class="<?php echo isset($menu_a['estudiantes_u']) ? $menu_a['estudiantes_u']:''; ?>">
                            <a href="<?php echo ROOT_CONTROLLER; ?>venta/">Ventas de Garrafas</a></li>                 
                            
                    </ul>
                </li>
                <li class="menu-list <?php echo isset($menu_a['configuracion']) ? $menu_a['configuracion']:''; ?>">
                    <a href=""><i class="fa fa-cog"></i> <span>Configuraciónes</span></a>
                    <ul class="sub-menu-list">
                        <!--i class="<?php echo isset($menu_a['roles_c']) ? $menu_a['roles_c']:''; ?>">
                            <a href="<?php echo ROOT_CONTROLLER; ?>user/roles_usuario.php">Roles usuarios</a>
                        </li-->
                        <li class="<?php echo isset($menu_a['faltas_c']) ? $menu_a['faltas_c']:''; ?>">
                            <a href="<?php echo ROOT_CONTROLLER; ?>precio/precios.php"> Precios</a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>
           
            <li><a href="<?php echo ROOT_CONTROLLER; ?>login/index.php?logout"><i class="fa fa-sign-in"></i> <span>Salir</span></a></li>
        </ul>
    </div>
</div>