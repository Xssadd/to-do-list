<?php $headerTitle = 'To-Do List' ?>
<?php require BASE_PATH . '/view/header.php'; ?>
<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="pb-2">
            <a href="<?= \App\Core\Router::url('task.create') ?>">
                <button class="cursor-pointer px-6 py-2 bg-green-600 text-white rounded-md shadow hover:bg-green-700 focus:ring-2 focus:ring-green-400 focus:ring-offset-1">
                    ➕ Add Task
                </button>
            </a>
        </div>


        <div class="bg-white shadow-sm border rounded-lg overflow-x-auto">
            <table class="min-w-full table-auto divide-y divide-gray-200">

                <thead class="bg-gray-50">
                <tr class="text-left text-sm text-gray-600">
                    <th class="sticky top-0 px-4 py-3 bg-gray-50">#</th>
                    <th class="sticky top-0 px-4 py-3 bg-gray-50">Title</th>
                    <th class="sticky top-0 px-4 py-3 bg-gray-50">Description</th>
                    <th class="sticky top-0 px-4 py-3 bg-gray-50">Status</th>
                    <th class="sticky top-0 px-4 py-3 bg-gray-50 text-right">Action</th>
                </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-100">
                <?php foreach ($tasks as $task): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm">1</td>
                        <td class="px-4 py-3 text-sm font-medium"><?= htmlspecialchars($task['title']) ?></td>
                        <td class="px-4 py-3 text-sm"><?= htmlspecialchars($task['description'] ?? '') ?></td>
                        <td class="px-4 py-3 text-sm">
                            <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full <?= $task['status'] === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800'?>">
                                <?= ucfirst($task['status']) ?>
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-right">
                            <div class="inline-flex gap-2">
                                <a href="<?= \App\Core\Router::url('task.edit', ['id' => $task['id']]) ?>">
                                    <button class="cursor-pointer px-3 py-1 text-sm border rounded-md hover:bg-gray-300">Edit</button>
                                </a>
                                <form method="POST" action="<?= \App\Core\Router::url('task.delete') ?>">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="id" value="<?= $task['id'] ?>">
                                    <button type="submit" class="cursor-pointer px-3 py-1 text-sm border rounded-md text-red-600 hover:bg-red-100"  onclick="return confirm('Удалить задачу?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if(empty($tasks)): ?>
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-sm text-gray-400">
                            No data found
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>