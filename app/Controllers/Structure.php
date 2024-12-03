<?php

namespace App\Controllers;

class Structure
{

    public function UserSidebarMenu($active_page)
    {
        return '
            <ul class="menu-inner py-1">
                <!-- Dashboards -->
                <li class="menu-item active open">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-home-smile"></i>
                        <div class="text-truncate" data-i18n="Dashboards">Dashboard</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item ' . ($active_page == 'Dashboard-user' ? 'active' : '') . '">
                        <a href="Dashboard-user.php" class="menu-link">
                            <div class="text-truncate" data-i18n="Inicio">Inicio</div>
                        </a>
                        </li>
                    </ul>
                </li>
                    <!-- Contacts -->
                <li class="menu-item active open">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-contact"></i>
                        <div class="text-truncate" data-i18n="Layouts">Contactos</div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item ' . ($active_page == 'contacts' ? 'active' : '') . '">
                        <a href="contacts.php" class="menu-link">
                            <div class="text-truncate" data-i18n="Without menu">Mis Contactos</div>
                        </a>
                        </li>
                        <li class="menu-item ' . ($active_page == 'created-contact' ? 'active' : '') . '">
                        <a href="created-contact.php" class="menu-link">
                            <div class="text-truncate" data-i18n="Without navbar">Nuevo Contacto</div>
                        </a>
                        </li>
                        <li class="menu-item ' . ($active_page == 'update-contact' ? 'active' : '') . '">
                        <a href="update-contact.php" class="menu-link">
                            <div class="text-truncate" data-i18n="Fluid">Editar Contactos</div>
                        </a>
                        </li>
                    </ul>
                </li>
            </ul> ';
    }
    public function AdminSidebarMenu()
    {
        return '
            <ul class="menu-inner py-1">
                <!-- Dashboards -->
                <li class="menu-item active open">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-home-smile"></i>
                        <div class="text-truncate" data-i18n="Dashboards">Dashboard</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item active">
                        <a href="index.html" class="menu-link">
                            <div class="text-truncate" data-i18n="Inicio">Inicio</div>
                        </a>
                        </li>
                    </ul>
                </li>
                    <!-- Contacts -->
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-contact"></i>
                        <div class="text-truncate" data-i18n="Layouts">Contactos</div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item">
                        <a href="contacts.php" class="menu-link">
                            <div class="text-truncate" data-i18n="Without menu">Mis Contactos</div>
                        </a>
                        </li>
                        <li class="menu-item">
                        <a href="created-contact.php" class="menu-link">
                            <div class="text-truncate" data-i18n="Without navbar">Nuevo Contacto</div>
                        </a>
                        </li>
                        <li class="menu-item">
                        <a href="update-contacts.php" class="menu-link">
                            <div class="text-truncate" data-i18n="Fluid">Editar Contactos</div>
                        </a>
                        </li>
                    </ul>
                </li>
            </ul> ';
    }


    public function MenuUser()
    {
        return '
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a
                  class="nav-link dropdown-toggle hide-arrow p-0"
                  href="javascript:void(0);"
                  data-bs-toggle="dropdown">
                  <div class="avatar avatar-online">
                    <img src="../../../assets/img/avatars/Hugo-dev-jn.png" alt class="w-px-40 h-auto rounded-circle" />
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar avatar-online">
                           <img src="../../../assets/img/avatars/Hugo-dev-jn.png" alt class="w-px-40 h-auto rounded-circle" />
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <h6 class="mb-0">John Doe</h6>
                          <small class="text-muted">Admin</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider my-1"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">
                      <i class="bx bx-user bx-md me-3"></i><span>My Profile</span>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider my-1"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="../../Views/Home/sing_off.php">
                      <i class="bx bx-power-off bx-md me-3"></i><span>Log Out</span>
                    </a>
                  </li>
                </ul>
              </li>
        
        
        ';
    }

    
}
