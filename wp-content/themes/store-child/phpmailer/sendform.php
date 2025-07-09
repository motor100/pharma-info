<?php

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST["name"]) &&
   isset($_POST["phone"]) && 
   isset($_FILES["file"]) && 
   isset($_POST["checkbox-read"]) &&
   isset($_POST["checkbox-agree"])) {

    $name = htmlspecialchars($_POST["name"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $email = htmlspecialchars($_POST["email"]);
    $file = $_FILES["file"];
    $checkbox_read = $_POST["checkbox-read"];
    $checkbox_agree = $_POST["checkbox-agree"];

    require 'PHPMailer.php';
    require 'SMTP.php';
    require 'config.php';

    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';

    // Настройки SMTP
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPDebug = 0;

    $mail->Host = $Host;
    $mail->Username = $Username; // Для Яндекс почты должно быть одинаковым
    $mail->Password = $Password;

    $mail->Port = 465;

    // От кого
    $mail->From = $Username; // Для Яндекс почты должно быть одинаковым
    $mail->FromName = $Username; // Для Яндекс почты должно быть одинаковым

    // Кому
    $mail->addAddress($To);

    // Тема письма
    $mail->Subject = 'Сообщение с сайта Информационный';

    $mail->isHTML(true);
    
    if (strlen($name) >= 3 &&
      strlen($name) <= 50 &&
      strlen($phone) == 18 && 
      $file['tmp_name'] != '' &&
      $checkbox_read == "on" &&
	  $checkbox_agree == "on") {
	  	
		// Название <input type="file">
		$input_name = 'file';
		 
		// Разрешенные расширения файлов.
		$allow = array('jpeg','jpg','png','pdf');
		 
		// Запрещенные расширения файлов.
		$deny = array(
			'phtml', 'php', 'php3', 'php4', 'php5', 'php6', 'php7', 'phps', 'cgi', 'pl', 'asp', 
			'aspx', 'shtml', 'shtm', 'htaccess', 'htpasswd', 'ini', 'log', 'sh', 'js', 'html', 
			'htm', 'css', 'sql', 'spl', 'scgi', 'fcgi', 'exe'
		);

		$success = '';
		 
		// Директория куда будут загружаться файлы.
		$path = mb_substr(__DIR__, 0, -28) . 'uploads/personal-order/';

		if ($file["size"] > 2097152) {
			echo "Файл более 2МБ.";
			exit();
		}
		
		if ($file) {
			
			// Проверим на ошибки загрузки.
			if (!empty($file['error']) || empty($file['tmp_name'])) {
				echo 'Не удалось загрузить файл.';
				exit();
			} elseif ($file['tmp_name'] == 'none' || !is_uploaded_file($file['tmp_name'])) {
				echo 'Не удалось загрузить файл.';
				exit();
			} else {
				// Оставляем в имени файла только буквы, цифры и некоторые символы.
				$pattern = "[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";
				$filename = mb_eregi_replace($pattern, '-', $file['name']);
				$filename = mb_ereg_replace('[-]+', '-', $filename);
				$parts = pathinfo($filename);

				if (empty($filename) || empty($parts['extension'])) {
					echo 'Недопустимый тип файла';
					exit();
				} elseif (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) {
					echo 'Недопустимый тип файла';
					exit();
				} elseif (!empty($deny) && in_array(strtolower($parts['extension']), $deny)) {
					echo 'Недопустимый тип файла';
					exit();
				} else {
					// Перемещаем файл в директорию.
					if (move_uploaded_file($file['tmp_name'], $path . $filename)) {
						// Далее можно сохранить название файла в БД и т.п.
						$success = 'Файл ' . $filename . ' успешно загружен.';
					} else {
						echo 'Не удалось загрузить файл.';
						exit();
					}
				}

			}
		
		} else {
			echo 'Файл не загружен.';
			exit();
		}

		if ($success) {
			// Тело письма
	        $mail->Body = "Имя: $name<br> Телефон: $phone<br>";
	        $mail->AltBody = "Имя: $name\r\n Телефон: $phone\r\n";
	        $mail->addAttachment($path . $filename, $filename);

	        $mail->send();
	    } else {
	    	echo 'Не удалось отправить сообщение.';
	    	exit();
	    }

	}

	$mail->smtpClose();

} else {
    header("Location: /");
    exit();
}

?>