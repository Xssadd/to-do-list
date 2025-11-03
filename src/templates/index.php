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
            <td>
                <a href="/edit/<?= $task['id'] ?>">✏️</a> |
                <a href="/delete/=<?= $task['id'] ?>" onclick="return confirm('Удалить задачу?')">🗑️</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>