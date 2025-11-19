<div class="mt-6">
    <h1 class="text-xl font-bold">My Books</h1>
    <div class="grid grid-cols-4 gap-4 mt-4">
        <div class="flex flex-col col-span-3 gap-4">
            <?php foreach ($books as $book) {
                require('partials/_book.php');
            } ?>
        </div>

        <div>
            <div class="border border-zinc-700 rounded">
                <h1 class="border-b border-zinc-700 text-zinc-400 font-bold px-4 py-2">Register a new book</h1>
                <form class="p-4 space-y-4" method="POST" action="/create-book">
                    <div class="flex flex-col">
                        <label for="title" class="text-stone-400 mb-1">Title</label>
                        <input
                            type="text"
                            name="title"
                            id="title"
                            placeholder="Title"
                            class="border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-2 py-1 w-full"
                            value="<?= htmlspecialchars($data['title'] ?? '') ?>"
                        />
                    </div>

                    <div class="flex flex-col">
                        <label for="author" class="text-stone-400 mb-1">Author</label>
                        <input
                            type="text"
                            name="author"
                            id="author"
                            placeholder="Author"
                            class="border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-2 py-1 w-full"
                            value="<?= htmlspecialchars($data['author'] ?? '') ?>"
                        />
                    </div>

                    <div class="flex flex-col">
                        <label for="description" class="text-stone-400 mb-1">Description</label>
                        <textarea
                            name="description"
                            id="description"
                            placeholder="Description"
                            class="border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-2 py-1 w-full"
                        ><?= htmlspecialchars($data['description'] ?? '') ?></textarea>
                    </div>

                    <div class="flex flex-col">
                        <label for="year" class="text-stone-400 mb-1">Release Year</label>
                        <input
                            type="number"
                            name="year"
                            id="year"
                            min="1450"
                            max="<?=date('Y')?>"
                            placeholder="Year"
                            inputmode="numeric"
                            class="border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-none px-2 py-1 w-full"
                            value="<?= htmlspecialchars($data['year'] ?? '') ?>"
                        />
                    </div>

                    <button
                        type="submit"
                        class="border-stone-800 bg-stone-900 text-stone-400 px-4 py-1 rounded-md border-2 hover:bg-stone-700"
                    >
                        Save
                    </button>

                    <!-- Error Messages -->
                    <?php if (!empty($_SESSION['errors'])): ?>
                        <div class="border-red-800 bg-red-900 text-red-400 px-4 py-1 rounded-md border-2 text-sm font-bold mt-4">
                            <ul>
                                <?php foreach ($_SESSION['errors'] as $error): ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>
