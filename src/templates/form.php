<?php $isEdit = isset($task); ?>
<h1><?= $isEdit ? '✏️ Редактировать' : '➕ Добавить' ?> задачу</h1>

<form method="post">
    <label>Название:</label><br>
    <input type="text" name="title" value="<?= $isEdit ? htmlspecialchars($task['title']) : '' ?>" required><br><br>

    <label>Описание:</label><br>
    <textarea name="description"><?= $isEdit ? htmlspecialchars($task['description'] ?? '') : '' ?></textarea><br><br>

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