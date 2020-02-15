<header class="mb-3">
    <div class="container-lg">
        <form method="POST" class="row pt-2" action="/">
            <!--    Инпут добавления и чекбокс-->
            <div class="col-md-3 mb-2 padding-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <!--    Непосредственно чекбокс-->
                            <div class="custom-control custom-switch">
                                <input name="notformat" type="checkbox" class="custom-control-input" id="customSwitch1">
                                <label class="custom-control-label" for="customSwitch1"></label>
                            </div>
                        </div>
                    </div>
                    <input id="input-url" type="text" name="url" class="form-control"
                           aria-label="Text input with checkbox">
                </div>
            </div>

            <!--        Радио-кноки переключения/выбора цветов-->
            <div class="col-md-auto mb-2 padding-5">
                <div class="wrap__colors">
                    <?php foreach ($legacyColors as $color): ?>
                        <div class="radio__input">
                            <input type="radio" id="radio__<?= $color ?>" class="color-radio" name="color"
                                   value="<?= $color ?>" onclick="clickToColorHandler('<?= $color ?>')">
                            <label class="radio__label" for="radio__<?= $color ?>"
                                   style="background: <?= $color ?>"></label>
                        </div>
                    <?php endforeach ?>
                    <input type="button" class="clear__button" value="CLEAR" onclick="clearColorsConfiguration()">
                </div>
            </div>
            <div class="col-md-auto mb-2 padding-5">
                <!--            Кнопка добавления-->
                <button class="btn btn-primary">Добавить</button>
            </div>

            <div class="col-auto mb-2 ml-lg-auto pt-1 padding-5">
                <!--            Кнопки удаления/выхода-->
                <button id="delete-in-header" class="btn btn-danger btn-sm" onclick="deleteUrls()">Удалить все</button>
                <a href="/logout" class="btn btn-primary btn-sm">Выход</a>
            </div>
        </form>
    </div>
</header>

<main>
    <div id="urls" class="container-lg">
        <?php if (!empty($data)): ?>
            <?php foreach ($data as $url): ?>
                <div id="item-<?= $url['id'] ?>" class="row pl-1 link flex-nowrap mb-3 pb-2 item item-<?= $url['color'] ?>">
                    <div class="col-auto padding-2">
                        <button class="btn-primary" onclick="copyText('<?= $url['id'] ?>')">cp</button>
                    </div>
                    <div class="col-auto padding-2">
                        <div class="color padding-2 mt-1" style="background: <?= $url['color'] ?>"></div>
                    </div>
                    <div class="col-md-10 padding-2">
                        <div id="text-<?= $url['id'] ?>" class="content text-break">
                            <?= $url['url'] ?>
                        </div>
                    </div>
                    <div class="col-auto padding-2 ml-auto">
                        <button class="btn-danger" onclick="deleteUrl('<?= $url['id'] ?>')">x</button>
                        <button class="btn-primary" onclick="upUrl('<?= $url['id'] ?>')">up</button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</main>