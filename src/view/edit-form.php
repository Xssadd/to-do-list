<h1>✏️ Редактировать задачу</h1>

<form method="post" class="task" action="/edit">
    <input type="hidden" name="id" value="<?= $task['id'] ?>">
    <label>
        Название:
        <input type="text" name="title" value="<?= htmlspecialchars($task['title']) ?>" >
    </label>
    <div class="error">
        <?php if(isset($errors['title'])): ?>
            <?= $errors['title'] ?>
        <?php endif; ?>
    </div>

    <br>

    <label>
        Описание:
        <textarea name="description"><?=  htmlspecialchars($task['description'] ?? '') ?></textarea>
    </label>

    <label>Статус:</label><br>
    <select name="status">
        <option value="pending" <?= $task['status'] === 'pending' ? 'selected' : '' ?>>В ожидании</option>
        <option value="done" <?= $task['status'] === 'done' ? 'selected' : '' ?>>Выполнено</option>
    </select><br><br>

    <button type="submit">Сохранить</button>
</form>

<a href="/">⬅️ Назад</a>