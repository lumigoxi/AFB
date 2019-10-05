<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
    with font-awesome or any other icon font library -->
    <li class="nav-header">CMS</li>
    <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="nav-icon fa fa-sitemap"></i>
        <p>
          Gestor de contenido
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ Route('landing.index') }}" class="nav-link">
            <i class="nav-icon fa fa-globe"></i>
            <p>Call to Action</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('mision-vision.index') }}" class="nav-link">
            <i class="nav-icon fas fa-bookmark"></i>
            <p>Misión y Visión</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ Route('cms-miembros.index') }}" class="nav-link">
            <i class="nav-icon fa fa-users"></i>
            <p>Miembros</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ Route('historias.index') }}" class="nav-link">
            <i class="nav-icon fa fa-history"></i>
            <p>Historias</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ Route('cms-mascotas.index') }}" class="nav-link">
            <i class="nav-icon fa fa-dog"></i>
            <p>Adoptcion</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ Route('actividades.index') }}" class="nav-link">
            <i class="nav-icon fa fa-calendar-alt"></i>
            <p>Actividades</p>
          </a>
        </li>
      </ul>
    </li>
    
    <li class="nav-header">TPS</li>
    <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="fa fa-th"></i>
        <p>
          Gestor Administrativo
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="{{ route('miembros.index') }}" class="nav-link">
            <i class="nav-icon far fa-calendar-alt"></i>
            <p>
              Miembros
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('rescates.index') }}" class="nav-link">
            <i class="nav-icon fa fa-ambulance "></i>
            <p>
              Rescates
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('Mascotas.index') }}" class="nav-link">
            <i class="nav-icon fas fa-dog"></i>
            <p>
              Mascotas
            </p>
          </a>
        </li>
      </ul>
    </li>
  </ul>
</nav>