<h1>📋 To-Do List</h1>

<a href="/add">➕ Добавить задачу</a>
<hr>

<table>
    <tr>
        <th>Задача</th>
        <th>Описание</th>
        <th>Статус</th>
        <th>Действия</th>
    </tr>
    <?php foreach ($tasks as $task): ?>
        <tr>
            <td><?= htmlspecialchars($task['title']) ?></td>
            <td><?= htmlspecialchars($task['description'] ?? '') ?></td>
            <td><?= $task['status'] === 'pending' ? 'В ожидании' : 'Выполнено'?></td>
            <td style="display: flex;">
                <a href="/edit/<?= $task['id'] ?>">
                    <button>Редактировать</button>
                </a>
                <form method="POST" action="/delete">
                    <input type="hidden" name="id" value="<?= $task['id'] ?>">
                    <button type="submit" onclick="return confirm('Удалить задачу?')">Удалить</button>
                </form>

            </td>
        </tr>
    <?php endforeach; ?>
</table>