<?php $isEdit = isset($task); ?>
<h1><?= $isEdit ? '✏️ Редактировать' : '➕ Добавить' ?> задачу</h1>

<form method="post" class="task">
    <label>
        Название:
        <input type="text" name="title" value="<?= $isEdit ? htmlspecialchars($task['title']) : '' ?>" required>
    </label>
    <div class="error">
        <?php if(isset($error['title'])): ?>
            <?= $error['title'] ?>
        <?php endif; ?>
    </div>

    <br>

    <label>
        Описание:
        <textarea name="description"><?= $isEdit ? htmlspecialchars($task['description'] ?? '') : '' ?></textarea>
    </label>

    <?php if ($isEdit): ?>
        <label>Статус:</label><br>
        <select name="status">
            <option value="pending" <?= $task['status'] === 'pending' ? 'selected' : '' ?>>В ожидании</option>
            <option value="done" <?= $task['status'] === 'done' ? 'selected' : '' ?>>Выполнено</option>
        </select><br><br>
    <?php endif; ?>

    <button type="submit"><?= $isEdit ? 'Сохранить' : 'Добавить' ?></button>
</form>

<a href="/">⬅️ Назад</a>