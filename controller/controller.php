<?php 

	session_start();

	require 'model/model.php';

	if (empty($_GET['view'])) {
	    $view = 'main';
    } else {
	    $view = $_GET['view'];
    } // Редирект

	if (isset($_GET['exit'])) {
		logOut();
	} // Выход из аккаунта

	switch ($view) {
		case 'main':
		if (isset($_POST['checkLogin'])) {
			$res = checkLogin();
			echo $res;
			die();
		} // Проверка логина на уникальность

		if (isset($_POST['loginAuth'])) {
			$res = checkUser();
			echo $res;
			die();
		} // Проверка на соответствие пары логин-пароль

		if (isset($_POST['reg'])) { reg();} // Регистрация

		$orders = set("SELECT * FROM orders INNER JOIN cats ON cats.c_id = orders.o_cat WHERE o_status = 'Выполнено' ORDER BY o_timestamp DESC LIMIT 4");
		$count = set("SELECT COUNT(o_id) AS 'count' FROM orders WHERE o_status = 'Выполнено'"); // Запросы на завершенные заявки и счетчик

		if (isset($_POST['info'])) {
			$res = checkOrders();
			echo $res;
			die();
		} // Счетчик

		break;

		case 'profile':

		if (!isset($_SESSION['fio'])) {
		    header("Location: /");
	    } // Проверка на авторизацию

		if (isset($_POST['add_order'])) {
			$addOrder = addOrder();
			print_r($addOrder);
		} // Добавление заявки

		$cats = set("SELECT * FROM cats"); // Запрос на категории

		$myOrders = set("SELECT * FROM orders INNER JOIN cats ON cats.c_id = orders.o_cat WHERE o_user = '{$_SESSION['id']}' ORDER BY o_timestamp ASC"); // Запрос на заявки авторизированного пользователя

		if (isset($_GET['del'])) {
			deleteOrder();
		} // Удаление заявки

		if (isset($_POST['sort'])) {
		    $myOrders = set("SELECT * FROM orders INNER JOIN cats ON cats.c_id = orders.o_cat WHERE o_user = '{$_SESSION['id']}' AND o_status = '{$_POST['status']}' ORDER BY o_timestamp ASC");
      	} // Сортировка 

		break;

		case 'master':
	
	    if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
		    header("Location: /");
	    } // Проверка на админа

	    $myOrders = set("SELECT * FROM orders INNER JOIN cats ON cats.c_id = orders.o_cat ORDER BY o_timestamp ASC"); // Запрос на все заявки

	    if (isset($_POST['sort'])) {
		    $myOrders = set("SELECT * FROM orders INNER JOIN cats ON cats.c_id = orders.o_cat WHERE o_status = '{$_POST['status']}' ORDER BY o_timestamp ASC");
	    } // Сортировка

	    $cats = set("SELECT * FROM cats"); // Запрос на категории

	    if (isset($_GET['delCat'])) {
		    delCat();
	    } // Удаление категории

	    if (isset($_POST['addCat'])) {
		    addCat();
	    } // Добавление категории

	    if (isset($_POST['changeStatus'])) {
		    changeStatus();
	    } // Изменение статуса заявки

	    break;
		
		default:
		header("Location: /"); // Редирект на главную страницу по дефолту
		break;
	}


	require 'views/index.php';
 ?>