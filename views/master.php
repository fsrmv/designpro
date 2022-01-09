<!doctype html>
  <html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?=PATH?>css/style.css">
    <link rel="stylesheet" type="text/css" href="<?=PATH?>css/bootstrap.min.css">
    <title>Панель управления</title>
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

    <section id="myOrders">
      <div class="container">
        <div class="row">
          <div class="col-10">
            <h2>Управление категориями</h2>
          </div>
          <div class="col-2">
            <a href="#" class="btn btn-dark w-100" onclick="event.preventDefault();$('div#addCat').slideToggle(300);">Добавить категорию</a>
          </div>
        </div><br>
        <div id="addCat" style="display: none;">
          <div class="row">
            <div class="col-12">
              <form method="post">
                <input type="text" name="nameCat" placeholder="Название категории" required class="form-control"><br>
                <button type="submit" name="addCat" class="btn btn-outline-dark">Добавить категорию</button>
              </form>
            </div>
          </div><br><br>
        </div>
        <div class="row">
          <div class="col-12">
            <?php foreach($cats as $c): ?>
            <div class="row d-flex align-items-center">
              <div class="col-10"><?=$c['c_name']?></div>
              <div class="col-2">
                <a href="/?view=master&delCat=<?=$c['c_id']?>" onclick="return confirm('Вы действительно хотите удалить категорию?')" class="btn btn-outline-dark w-100">Удалить</a>
              </div>
            </div><br>
            <?php endforeach; ?>
          </div>
        </div><br><br>

        <div class="row">
          <div class="col-12">
            <h2>Все заявки</h2>
          </div>
        </div><br>

        <form method="post">
          <div class="row">
            <div class="col-10">
              <select name="status" class="form-select">
                <option disabled selected>Укажите статус</option>
                <option value="Новая">Новая</option>
                <option value="Принято в работу">Принято в работу</option>
                <option value="Выполнено">Выполнено</option>
              </select>
            </div>
            <div class="col-2">
              <button type="submit" class="btn btn-dark w-100" name="sort">Сортировать</button>
            </div>
          </div>
        </form><br><br>
        <?php if(!empty($myOrders)): ?>

        <div class="row">
          <?php foreach($myOrders as $o): ?>
          <div class="col-12 mb-3">
            <div class="card">
              <div class="row">
                <div class="col-3">
                  <div class="img_master" style="background: url(<?=PATH?>img/<?=$o['o_img1']?>) center center no-repeat; height: 250px;"><div class="timestamp"><?=$o['o_timestamp']?></div></div>
                </div>
                <div class="col-9">
                  <div class="card-body">
                    <h5 class="card-title">Название: <?=$o['o_name']?></h5>
                    <p><b>Категория: </b><?=$o['c_name']?></p>
                    <p><b>Описание: </b><?=$o['o_desc']?></p>
                    <?php if ($o['o_status'] == 'Новая'): ?>
                    <select class="form-select w-auto" onchange="changeStatus(this, <?=$o['o_id']?>)">
                      <option disabled selected>Новая</option>
                      <option value="Принято в работу">Принято в работу</option>
                      <option value="Выполнено">Выполнено</option>
                    </select><br>
                    <div id="formComment<?=$o['o_id']?>" style="display: none;">
                      <form method="post">
                        <div class="row">
                          <div class="col-9">
                            <input type="text" name="comment" placeholder="Комментарий" class="form-control" required>
                            <input type="hidden" name="idOrder" value="<?=$o['o_id']?>">
                          </div>
                          <div class="col-3">
                            <button type="submit" name="changeStatus" class="btn btn-outline-dark w-100">Сменить статус</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div id="formPhoto<?=$o['o_id']?>" style="display: none;">
                      <form method="post" enctype="multipart/form-data">
                        <div class="row">
                          <div class="col-9">
                            <input type="file" name="photo2" class="form-control" required>
                            <input type="hidden" name="idOrder" value="<?=$o['o_id']?>">
                          </div>
                          <div class="col-3">
                            <button type="submit" name="changeStatus" class="btn btn-outline-dark w-100">Сменить статус</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <?php else: ?>
                    <p><b>Статус: </b><?=status($o['o_status'])?></p>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
          <?php else: ?>
          <div align="center"><h2>Нет заявки с таким статусом</h2></div>
        </div>
        <?php endif; ?>
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