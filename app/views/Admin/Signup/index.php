<h2>Вид. Регистрация.</h2>
<div class="form-wrap">
    <?php if(isset($successMessage)): ?>
        <span class="successMessage"><?=$successMessage ?></span>
    <?php endif; ?>

    <?php if(isset($errorMessages)): ?>
    <ul class="errors-list">
        <?php foreach($errorMessages as $message): ?>
            <li><?=$message ?></li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>

    <form method="POST" action="/signup">
        <?= csrfToken() ?>
        <input type="text" name="login" placeholder="login"><br>
        <input type="password" name="password" placeholder="password"><br>
        <input type="submit"><br>
    </form>
</div>