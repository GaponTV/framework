<?php
session_start();
require_once "init.php";
$app->header();

$app->includeComponent(
    "fw:component",
    "default",
    [
        "message" => "123"
    ]
);
?>


<pre>
    -------- 18.03.2022 --------
    1) создан класс Page для работы с содержимым html страницы
    2) итд
    -------- 10.03.2022 --------
    1) создан конфиг и класс для работы с ними
    2) создана функции авто регистрации классов
</pre>
<?php $app->footer(); ?>