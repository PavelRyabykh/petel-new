<div class="container mt-5">
    <div class="card mr-auto ml-auto" style="width: 18rem;">
        <?php if(isset($successMessage)): ?>
            <div class="alert alert-success">
                <span class="successMessage"><?=$successMessage ?></span>
            </div>
        <?php endif; ?>

        <?php if(isset($errorMessages)): ?>
            <div class="alert alert-danger">
                <?php foreach($errorMessages as $message): ?>
                    <?=$message ?><br>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="card-header">
            <b>Фильтры</b> для <?=$user ?>
        </div>

        <ul class="list-group list-group-flush">
            <?php if(!empty($filters)): ?>
                <?php foreach($filters as $filter): ?>
                    <li class="list-group-item ml-3 d-flex justify-content-between">
                        <div class="admin__filter" style="background: <?= $filter['color'] ?>"><span
                                class="text__in__filter__admin"><?=$filter['short_name'] ?></span></div>
                        <?=$filter['filter'] ?>
                        <button class="btn-sm btn-danger d-inline" onclick="delfilter('<?= $filter['id'] ?>', '<?=$user ?>')">Удалить</button>
                    </li>
                <?php endforeach ?>
            <?php endif ?>
        </ul>
        <a data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary mt-1 mb-1" href="/signup">Добавить фильтр</a>
        <a class="btn btn-dark mt-1 mb-1" href="/logout">Выйти из админки</a>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Добавить фильтр</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/addfilter">
                    <div class="form-group">
                        <input type="text" name="filter" placeholder="Имя фильтра" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" name="color" placeholder="Цвет. Например, #55BF95, blue" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="text" name="short_name" placeholder="Две или одна буква в кружок" class="form-control">
                        <input type="hidden" name="user" value="<?=$user ?>"
                    </div>
                    <input type="submit" class="btn btn-primary" value="Добавить">
                </form>
            </div>
        </div>
    </div>
</div>
