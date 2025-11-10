<form class="mt-6">
    <input
        type="text"
        name="search"
        placeholder="Search..."
        class="bg-zinc-800 border-2 border-zinc-900 rounded-md p-2 text-sm outline-none"
    />
    <button type="submit">Search</button>
</form>

<section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
<?php foreach ($books as $book): ?>
    <div class="p-2 rounded-md bg-zinc-800 border-2 border-zinc-900">
        <div class="flex">
            <img src="#" alt="Image" class="w-1/3" />
            <div class="space-y-1">
                <a href="/book?id=<?=$book['id']?>" class="font-semibold hover:underline">
                    <?=$book['title']?>
                </a>
                <p class="text-sm"><?=$book['author']?></p>
                <p class="text-xs">⭐⭐⭐⭐⭐ Rating</p>
            </div>
        </div>
        <p class="text-sm mt-2"><?=$book['description']?></p>
    </div>
<?php endforeach; ?>
</section>
