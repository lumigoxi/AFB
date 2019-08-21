<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css\utilidades.css">
    <title>Amigo Fiel</title>
  </head>
  <body> 


  <header id="header text-center ml-auto mr-auto">
    <nav class="navbar navbar-expand-lg navbar-light text-center">
      <a class="navbar-brand pt-0 pb-0" href="/"><img src="img\amigo-fiel-logo.jpg" alt="">AMIGO FIEL</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto  text-center">
          <li class="nav-item">
            <form action="{{ route('logout') }}" method="post">
              <button class="btn btn-danger" type="submit">Cerrar</button>
            </form>
          </li>
        </ul>
      </div>
    </nav>
  </header>


@yield('content')

  <footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col text-center">
          <span>Desarrollado por <a href="https://www.linkedin.com/in/miguel-xiap-3b6067169/" target="_blank">Miguel Xiap</a></span><br>
        </div>
      </div>
    </div>
  </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js\navbar.js"></script>
  </body>
</html>