<h1 class="text-2xl font-semibold mb-4">➕ Добавить задачу</h1>

<form method="POST" class="space-y-5">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Название</label>
        <input
                type="text"
                name="title"
                value=""
                placeholder="Введите название..."
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400"
                required
        >
        <?php if(isset($errors['title'])): ?>
            <div class="mt-2 text-red-800">
                <?= $errors['title'] ?>
            </div>
        <?php endif; ?>

    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Описание</label>
        <textarea
                name="description"
                rows="4"
                placeholder="Кратко опишите задачу..."
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-400"
        ></textarea>
    </div>


    <div class="flex items-center justify-between pt-4">
        <a href="/" class="text-gray-600 hover:underline">
            ← Назад к списку
        </a>

        <button
                type="submit"
                class="cursor-pointer px-6 py-2 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-400 focus:ring-offset-1"
        >
            Создать задачу
        </button>
    </div>
</form>