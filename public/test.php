
<?php
//Тут необходимо создать таблицы БД и установить права на запись в необходимые папки
$config = require '../config/config_db.php';
try {
    $db = new PDO($config['dsn'], $config['user'], $config['pass']);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($db) {
        print '<span style="color: green;">Подключение к базе данных проведено с успехом</span><br>';
    }
} catch (PDOException $e) {
    print '<span style="color: red;">Не удалось подключиться к базе данных:</span> ' . $e->getMessage() . '<br>';
    exit();
}

try {
    $res = $db->exec("CREATE TABLE users (
                id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                login VARCHAR(10) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                is_admin BOOL NOT NULL DEFAULT 0 
)");
    if($res !== false) {
        print '<span style="color: green;">Таблица пользователей создана успешно</span><br>';
        $res = $db->exec("INSERT INTO users (login, password, is_admin) VALUES ('admin', '". password_hash('prorok', PASSWORD_DEFAULT) ."', 1)");
        if($res === 1) {
            print '<span style="color: green;">Пользователь админ создан успешно</span><br>';
        } else {
            print '<span style="color: red;">Не удалось создать пользователя админа</span>';
        }
    }
} catch (PDOException $e) {
    print '<span style="color: red;">Таблица пользователей не создана, возможно, она уже существует:</span> ' . $e->getMessage() . '<br>';
}

print '<a href="/login">Авторизуйтесь</a>, чтобы добавить пользователей';