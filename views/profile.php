<!doctype html>
  <html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?=PATH?>css/style.css">
    <link rel="stylesheet" type="text/css" href="<?=PATH?>css/bootstrap.min.css">
    <title>Личный кабинет</title>
  </head>
  <body>

    <section id="header">
      <div class="container">
        <div class="row">
          <header class="d-flex flex-wrap align-items-start justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <a href="/" class=""><img src="<?=PATH?>img/logo.jpg" id="logo"></a>
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

      <div class="row profile">
        <div class="col-12">
          <h1 align="center" style="margin-top: 250px;">Добро пожаловать, <?=$_SESSION['fio']?>!</h1>
          <h3 align="center"><?php 
          if ($_SESSION['login'] != 'admin') {
            echo 'Вы - Пользователь';
          } else {
            echo 'Вы - Администратор';
          }
        ?></h3>
      </div>
    </div>
  </div>
</section>

<section id="my_orders" name="my_orders"><br>
  <div class="container">
    <div class="row">
      <div class="col-10">
        <h2>Мои заявки</h2>
      </div>
      <div class="col-2">
        <a href="#" class="btn btn-dark" onclick="openForm()">Создать заявку</a>
      </div>
      <div id="ordersForm" style="display: none;">
        <div class="row">
          <div class="col-12">
            <form method="post" enctype="multipart/form-data"><br>
              <input type="text" name="name" placeholder="Название заявки" required class="form-control"><br>
              <textarea name="desc" cols="30" rows="2" placeholder="Описание работы" required class="form-control"></textarea><br>
              <select name="cats" class="form-select">
                <option disabled selected>Выберите категорию</option>
                <?php foreach ($cats as $c) : ?>
                  <option value="<?=$c['c_id']?>"><?=$c['c_name']?></option>
                <?php endforeach; ?>
              </select><br>
              <input type="file" name="photo" accept=".png, .jpg, .jpeg, .bmp" required class="form-control"><br>
              <input type="submit" id="add_order" name="add_order" class="btn btn-outline-dark" value="Добавить">
            </form><br>
          </div>
        </div>
      </div><br><br><br>

      <?php if (!empty($myOrders)): ?>
        <form method="post">
          <div class="row">
            <div class="col-10">
              <select name="status" class="form-select">
                <option disabled selected>Выберите статус заявки</option>
                <option value="Новая">Новая</option>
                <option value="Обработка данных">Принято в работу</option>
                <option value="Услуга оказана">Выполнено</option>
              </select>
            </div>
            <div class="col-2">
              <button type="submit" name="sort" class="btn btn-outline-dark w-70">Сортировать</button>
            </div>
          </div>
        </form><br><br>
        <div class="row">
          <?php foreach($myOrders as $o): ?>
            <div class="col-4">
              <div class="card">
                <div class="img" style="background: url(<?=PATH?>img/<?=$o['o_img1']?>) center center no-repeat; height: 250px">
                  <div class="timestamp"><?=$o['o_timestamp']?></div>
                </div>
                <div class="card-body">
                  <h5>Название: <?=$o['o_name']?></h5><hr>
                  <p><b>Описание: </b><?=$o['o_desc']?></p>
                  <p><b>Статус: </b><?=status($o['o_status'])?></p>
                  <a href="/?view=profile&del=<?=$o['o_id']?>" class="btn btn-outline-dark" onclick="return confirm('Вы действительно хотите удалить заявку?');">Удалить</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <h2 align="center">У вас нет созданных заявок</h2>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section><br>

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