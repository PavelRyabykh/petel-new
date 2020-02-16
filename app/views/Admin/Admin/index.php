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
            <b>Workspaces</b>
        </div>
        <ul class="list-group list-group-flush">
            <?php if(!empty($users)): ?>
                <?php foreach($users as $user): ?>
                    <li class="list-group-item ml-3 d-flex justify-content-between">
                        <a href="/admin/users/<?=$user['login'] ?>"><?= $user['login'] ?></a>
                        <button class="btn-sm btn-danger d-inline" onclick="deluser('<?= $user['id'] ?>')">Удалить</button>
                    </li>
                <?php endforeach ?>
            <?php endif ?>
        </ul>
        <a data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary mt-1 mb-1" href="/signup">Добавить</a>
        <a class="btn btn-dark mt-1 mb-1" href="/logout">Выйти из админки</a>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Добавить workspace</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/signup">
                    <div class="form-group">
                        <input type="text" name="login" placeholder="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="password" class="form-control">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Добавить">
                </form>
            </div>
        </div>
    </div>
</div>

