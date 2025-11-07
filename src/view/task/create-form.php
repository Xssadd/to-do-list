<?php $headerTitle = 'To-Do List - Add task' ?>
<?php require BASE_PATH . '/view/header.php'; ?>
<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <form method="POST" class="space-y-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input
                        type="text"
                        name="title"
                        value=""
                        placeholder="Input title here..."
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400"
                        required
                >
                <?php if(isset($errors['title'])): ?>
                    <p class="text-red-500 text-sm mt-2"><?= $errors['title'] ?></p>
                <?php endif; ?>

            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea
                        name="description"
                        rows="4"
                        placeholder="Describe task..."
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400"
                ></textarea>
            </div>


            <div class="flex items-center justify-between pt-4">
                <a href="/" class="text-gray-600 hover:underline">
                    ← Back to list
                </a>

                <button
                        type="submit"
                        class="cursor-pointer px-6 py-2 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-400 focus:ring-offset-1"
                >
                    Create task
                </button>
            </div>
        </form>
    </div>
</main>