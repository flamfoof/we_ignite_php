<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">
    <nav id="sidebar">
        <ul class="navbar-nav theme-brand flex-row  text-center">
            <li class="nav-item theme-logo">
                <a href="<?= base_url("admin") ?>">
                    <img src="<?= base_url("assets_admin/images/logo_square.png") ?>" class="navbar-logo" alt="logo">
                </a>
            </li>
            <li class="nav-item theme-text">
                <a href="<?= base_url("admin") ?>" class="nav-link"> StarOnline v3 </a>
            </li>
        </ul>

        <ul class="list-unstyled menu-categories ps ps--active-y" id="accordionExample">
            <?php foreach ($links as $link): ?>
                <?php if ($link->hasChildren()): ?>
                    <li class="menu menu-heading">
                        <div class="heading">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>
                            <span><?= $link->_get("name") ?></span>
                        </div>
                    </li>
                <?php endif; ?>
                <?php foreach ($link->getChildren() as $menu): ?>
                    <?php if ($menu->_get("type") == 0): ?>
                        <li class="menu">
                            <?php if ($menu->hasChildren()): ?>
                                <a href="#<?= slug($menu->_get("name")) ?>" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                    <div class="">
                                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons"><?= $menu->_get("icon") ?></i>
                                        <span><?= $menu->_get("name") ?></span>
                                    </div>
                                </a>
                                <ul class="submenu recent-submenu mini-recent-submenu list-unstyled collapse" id="<?= slug($menu->_get("name")) ?>" data-parent="#accordionExample">
                                    <?php foreach ($menu->getChildren() as $submenu): ?>
                                        <li>
                                            <a href="<?= base_url($submenu->_get("url")) ?>"> <?= $submenu->_get("name") ?> </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <a href="<?= base_url($menu->_get("url")) ?>" aria-expanded="false" class="dropdown-toggle">
                                    <div class="">
                                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons"><?= $menu->_get("icon") ?></i>
                                        <span><?= $menu->_get("name") ?></span>
                                    </div>
                                </a>
                            <?php endif; ?>
                        </li>
                    <?php elseif($menu->_get("type") == 1): ?>
                    <?php else: ?>
                        <li class="menu menu-heading">
                            <?= $menu->_id() ?>
                            <div class="heading">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>
                                <span><?= $menu->_get("name") ?></span>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </ul>
    </nav>
</div>
<!--  END SIDEBAR  -->
