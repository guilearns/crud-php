<?php 

function renderizarNavbar() {
  echo '
    <nav class="navbar navbar-dark bg-dark">

      <div class="container px-5">
          <a class="nav-link text-white" href="./index.php">
              <div class="btn btn-outline-light border-0 text-center">
                  
                  <div class="row material-symbols-rounded">Home</div>
                  <div class="row">Página Inicial</div>
                  
              </div>
          </a>

          <a class="nav-link text-white" aria-current="page" href="./criar_usuario.php">
              <div class="btn btn-outline-light border-0 text-center">
                  
                      <div class="row material-symbols-rounded">Person_add</div>
                      <div class="row">Criar Usuário</div>
                  
              </div>
          </a>

          <div class="nav-link text-white">
              <div class="btn btn-outline-light border-0 text-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                  <div class="row material-symbols-rounded">Menu</div>
                  <div class="row">Menu</div>
              </div>
          </div>

        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">

          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Menu</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>

          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="https://www.linkedin.com/in/guilherme-siqueira-97358113a/">Linkedin</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="https://guilearns.blogspot.com/">Blog</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Outros Projetos
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                  <li><a class="dropdown-item" href="https://github.com/guilearns/php_gmail">Layout Gmail em PHP + mysqli</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="https://github.com/guilearns/PyGaming">Sistema de colisão em Python (PyGame)</a></li>
                </ul>
              </li>
            </ul>
          </div>

        </div>

      </div>

    </nav>
  ';
}

?>