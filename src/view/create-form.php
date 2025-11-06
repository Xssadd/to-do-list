<h1>➕ Добавить задачу</h1>

<form method="post" class="task">
    <label>
        Название:
        <input type="text" name="title" value="" >
    </label>
    <div class="error">
        <?php if(isset($errors['title'])): ?>
            <?= $errors['title'] ?>
        <?php endif; ?>
    </div>

    <br>

    <label>
        Описание:
        <textarea name="description"></textarea>
    </label>

    <button type="submit">Добавить</button>
</form>

<a href="/">⬅️ Назад</a>