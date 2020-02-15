<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <?php if(isset($errorMessages)): ?>
                <div class="alert alert-danger">
                    <?php foreach($errorMessages as $message): ?>
                        <?=$message ?>
                    <?php endforeach; ?>
                </div>

            <?php endif; ?>

            <form method="POST" action="/login">
                <div class="form-group">
                    <label for="exampleInputEmail1">Имя</label>
                    <input type="text" name="login" placeholder="login" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Пароль</label>
                    <input type="password" name="password" placeholder="password" class="form-control">
                </div>
                <input type="submit" class="btn btn-primary" value="Вход">
            </form>
        </div>
    </div>


</div>