<!doctype html>
  <html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?=PATH?>css/style.css">
    <link rel="stylesheet" type="text/css" href="<?=PATH?>css/bootstrap.min.css">
    <title>Главная страница</title>
  </head>
  <body>

    <div class="modal fade" id="auth" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 99999;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Авторизация</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form method="post">
          <div class="modal-body" onsubmit="checkUser(this, event)">
            <input type="text" name="loginAuth" placeholder="Логин" required class="form-control"><br>
          <input type="password" name="passAuth" placeholder="Пароль" required class="form-control">
          <small id="errorAuth" style="color: red; font-weight: 500; display: none;">Неправильная пара логин-пароль!</small><br>
          </div>
          <div class="modal-footer">
            <button type="submit" name="auth" class="btn btn-outline-dark">Войти</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="reg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 99999;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Регистрация</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="post">
          <div class="modal-body">
            <input type="text" name="fio" placeholder="ФИО" required pattern="^^[А-Яа-яЁё\s]+$" class="form-control"><br>
            <input type="text" name="login" placeholder="Логин" required pattern="^[A-Za-z.]+$" class="form-control" onchange="checkLogin(this)">
            <small id="errorLogin" style="color: red; font-weight: 500; display: none">Логин уже занят!</small><br>
            <input type="email" name="email" placeholder="Email" required class="form-control"><br>
            <input type="password" name="pass1" placeholder="Пароль" required class="form-control"><br>
            <input type="password" name="pass2" placeholder="Повторите пароль" required class="form-control" onchange="checkPass(this)">
            <small id="errorPass" style="color: red; font-weight: 500; display: none">Пароли не совпадают!</small><br>
            <input type="checkbox" name="sogl" id="sogl" required><label for="sogl">Согласие на обработку персональных данных</label>
          </div>
          <div class="modal-footer">
            <button type="submit" name="reg" class="btn btn-outline-dark">Зарегестрироватся</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <section id="header">
    <div class="container">
      <div class="row">
        <header class="d-flex flex-wrap align-items-start justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
          <a href="#" class=""><img src="<?=PATH?>img/logo.jpg" id="logo"></a>
          <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="#" class="nav-link px-2 link-dark">Главная</a></li>
            <li><a href="#" class="nav-link px-2 link-dark">О нас</a></li>
            <li><a href="#" class="nav-link px-2 link-dark">Услуги</a></li>
            <li><a href="#" class="nav-link px-2 link-dark">Проекты</a></li>
            <li><a href="#" class="nav-link px-2 link-dark">Контакты</a></li>
          </ul>
          <div class="col-md-3 text-end">
            <?php if(isset($_SESSION['login']) && !empty($_SESSION['login'])): ?>
            <?php if($_SESSION['is_admin'] == 1): ?>
              <a href="/master" class="btn btn-outline-dark">Панель управления</a>
              <a href="/exit" class="btn btn-dark">Выйти</a>
            <?php else: ?>
              <a href="/profile" class="btn btn-outline-dark">Личный кабинет</a>
              <a href="/exit" class="btn btn-dark">Выйти</a>
            <?php endif; ?>
          <?php else: ?>
            <a href="#" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#auth">Войти</a>
            <a href="#" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#reg">Регистрация</a>
          <?php endif; ?>
        </div>
      </header>
    </div>

    <div class="row">
      <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="<?=PATH?>img/car1.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h2>Дизайн</h2>
              <h3>для вашего офиса</h3>
              <a href="#orders" class="btn btn-light">К заявкам</a><br>
            </div>
          </div>
          <div class="carousel-item">
            <img src="<?=PATH?>img/car2.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h2>Дизайн</h2>
              <h3>для вашего бизнеса</h3>
              <a href="#orders" class="btn btn-light">К заявкам</a><br>
            </div>
          </div>
          <div class="carousel-item">
            <img src="<?=PATH?>img/car3.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h2>Дизайн</h2>
              <h3>для вашего дома</h3>
              <a href="#orders" class="btn btn-light">К заявкам</a><br>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"  data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Предыдущий</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"  data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Следующий</span>
        </button>
      </div>
    </div>
  </div>
</section>

<section id="orders">
  <div class="container">
    <div class="row">
      <div class="col-10">
        <h2>Наши выполненные проекты</h2>
      </div>
      <div class="col-2">
        <h5><span class="badge bg-dark"><span id="countOrders"><?=$count[0]['count'] ?></span> выполненных заявок</span></h5>
      </div>
    </div><br>
    <div class="row">
      <?php foreach ($orders as $o):?>
        <div class="col-xl-3 col-md-6">
          <div class="card">
            <div class="img">
              <div class="timestamp"><?=$o['o_timestamp'] ?></div>
              <div class="img1" style="background-image: url(<?=PATH?>img/<?=$o['o_img1']?>)"></div>
              <div class="img2" style="background-image: url(<?=PATH?>img/<?=$o['o_img2']?>)"></div>
            </div>
            <div class="card-body">
              <p><b>Название: </b><?=$o['o_name'] ?></p>
              <p><b>Категория: </b><?=$o['c_name'] ?></p><hr>
              <a href="#" class="btn btn-outline-dark">Просмотреть</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section id="footer">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h5> DesignPro&copy; Все права защищены!</h5>
      </div>
    </div>
  </div>
</section>

<script src="<?=PATH?>js/bootstrap.min.js"></script>
<script src="<?=PATH?>js/jquery-3.4.1.min.js"></script>
<script src="<?=PATH?>js/main.js"></script>
</body>
</html>