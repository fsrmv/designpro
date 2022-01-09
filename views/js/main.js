// Проверка логина без перезагрузки
function checkLogin(el) {
	let login = $(el).val();
	
	$.ajax({
		url: '/',
		type: 'POST',
		data: {checkLogin: login},
		success: function(res) {
			if (res == 'no') {
				$('small#errorLogin').slideDown(300);
				$('input[name="login"]').css('border', '1px solid red');
				$('button[name="reg"]').attr("disabled", 'disabled');
			} else {
				$('small#errorLogin').slideUp(300);
				$('input[name="login"]').css('border', '1px solid #ced4da');
				$('button[name="reg"]').removeAttr('disabled');
			}
		}
	})

}

	// Проверка паролей на совпадение
	function checkPass(el) {
		let pass1 = $('input[name="pass1"]').val();
		let pass2 = $(el).val();

		if (pass1 == pass2) {
			$('small#errorPass').slideUp(300);
			$('input[name="pass1"]').css('border', '1px solid #ced4da');
			$('input[name="pass2"]').css('border', '1px solid #ced4da');
			$('button[name="reg"]').removeAttr('disabled');
		} else {
			$('small#errorPass').slideDown(300);
			$('input[name="pass1"]').css('border', '1px solid red');
			$('input[name="pass2"]').css('border', '1px solid red');
			$('button[name="reg"]').attr("disabled", 'disabled');
		}
	}

	// Проверка пары логин-пароль
	function checkUser(el, e) {
		e.preventDefault();
		let info = $(el).serialize();

		$.ajax({
			url: '/',
			type: 'POST',
			data: info, 
			success:  function(res) {
				if (res == 'no') {
					$('small#errorAuth').slideDown(300);
					$('input[name="loginAuth"]').css('border', '1px solid red');
					$('input[name="passAuth"]').css('border', '1px solid red');
				} else {
					$('small#errorAuth').slideUp(300);
					$('input[name="loginAuth"]').css('border', '1px solid #ced4da');
					$('input[name="passAuth"]').css('border', '1px solid #ced4da');
					location.replace("/");
				}
			}
		})
	}

	// Счетчик
	function checkOrders() {
		let info = 'smth';
		$.ajax({
			url: '/',
			type: 'POST',
			data: {info: info},
			success: function(res) {
				$('span#countOrders').text(res);
			}
		})
	}
	setInterval(() => checkOrders(), 5000);

	// Появление формы для добавления заявки
	function openForm() {
		$('div#ordersForm').slideToggle(300);
	}

	// Изменение статуса
	function changeStatus(el, orderId) {
	let status = $(el).val();

	switch(status) {
		case 'Принято в работу':
		$('div#formPhoto'+orderId).slideUp(300);
		$('div#formComment'+orderId).slideDown(300);
		break;

		case 'Выполнено':
		$('div#formPhoto'+orderId).slideDown(300);
		$('div#formComment'+orderId).slideUp(300);
		break;
	}
}