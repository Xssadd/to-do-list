<?php $headerTitle = 'To-Do List - Edit Task'; ?>
<?php require BASE_PATH . '/view/header.php'; ?>
<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <form method="POST" action="/edit" class="space-y-5">
            <input type="hidden" name="id" value="<?= $task['id'] ?>">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input
                        type="text"
                        name="title"
                        value="<?= htmlspecialchars($task['title']) ?>"
                        placeholder="Input title here..."
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400"
                        required
                >
            </div>
            <?php if(isset($errors['title'])): ?>
                <p class="text-red-500 text-sm mt-2"><?= $errors['title'] ?></p>
            <?php endif; ?>

            <!-- Описание -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea
                        name="description"
                        rows="4"
                        placeholder="Describe task..."
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400"
                ><?=  htmlspecialchars($task['description'] ?? '') ?></textarea>
            </div>

            <!-- Статус -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    <option value="pending" <?= $task['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="done" <?= $task['status'] === 'done' ? 'selected' : '' ?>>Done</option>
                </select>
            </div>

            <div class="flex items-center justify-between pt-4">
                <a href="/" class="text-gray-600 hover:underline">
                    ← Back to list
                </a>

                <button type="submit" class="cursor-pointer px-6 py-2 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-400 focus:ring-offset-1">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</main>