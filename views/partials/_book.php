<div class="p-2 rounded-md bg-zinc-800 border-2 border-zinc-900">
    <div class="flex">
        <img src="#" alt="Image" class="w-1/3"/>
        <div class="space-y-1">
            <a href="/book?id=<?= $book->id ?>" class="font-semibold hover:underline">
                <?= $book->title ?>
            </a>
            <p class="text-sm"><?= $book->author ?></p>
            <?php if ($book->reviewsCount > 0): ?>
                <p class="text-xs">
                    <?=str_repeat("⭐", $book->avgRating) . ' (' . $book->reviewsCount . ' reviews)' ?>
                </p>
            <?php else: ?>
                <p class="text-xs">No Reviews yet</p>
            <?php endif; ?>
        </div>
    </div>
    <p class="text-sm mt-2"><?= $book->description ?></p>
</div>