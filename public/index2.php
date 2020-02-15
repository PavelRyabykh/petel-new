<!doctype html>
<html lang="ru">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/style-old2.css">
    <script src="js/scripts.js"></script>
    <script src="js/ajax.js"></script>
</head>
<body>

<?php if (isset($successMessage)): ?>
<span class="successMessage"><?= $successMessage ?><</span>
<?php endif; ?>

<?php if (isset($errorMessages)): ?>
    <ul class="errors-list">
        <?php foreach ($errorMessages as $message): ?>
            <li><?= $message ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<header>
    <div class="wrap">
        <form method="POST" action="/">
            <input id="input-url" type="text" name="url">
            <input type="checkbox" name="notformat">

            <div class="wrap__colors">
            <?php foreach ($legacyColors as $color): ?>

                <div class="radio__input">
                    <input type="radio" id="radio__<?= $color ?>" class="color-radio" name="color" value="<?= $color ?>" onclick="clickToColorHandler('<?= $color ?>')" style="background: <?= $color ?>">
                    <label class="radio__label" for="radio__<?=$color ?>" style="background: <?= $color ?>"></label>
                </div>


            <?php endforeach; ?>
            </div>
            <input type="button" class="clear__button" value="CLEAR" onclick="clearColorsConfiguration()">
            <input type="submit" class="classical_button" value="Добавить">
        </form>

        <div class="buttons">
            <form method="POST" action="/delall">
                <input type="hidden" name="delall" value="on">
                <input type="submit" class="classical_button" value="Удалить все">
            </form>
            <a href="/logout"><input type="button" class="classical_button" value="Выход"></a>
        </div>

    </div>
</header>

<main>
    <section id="urls" class="wrap">
        <?php if (!empty($data)): ?>
            <?php foreach ($data as $url): ?>
                <div id="item-<?=$url['id'] ?>" class="item item-<?= $url['color'] ?>">
                    <div class="main-content">
                        <div class="copy" onclick="copyText('<?= $url['id'] ?>')">Cp</div>
                        <div class="color color-<?= $url['color'] ?>"></div>
                        <div class="link" id="text-<?= $url['id'] ?>"><?= $url['url'] ?></div>
                    </div>

                    <div class="buttons">
                        <input type="button" class="del" value="X" onclick="deleteUrl('<?= $url['id'] ?>')">
                        <input type="button" class="up" value="Up" onclick="upUrl('<?= $url['id'] ?>')">
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </section>
</main>
</body>
</html>