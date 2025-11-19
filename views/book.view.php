<?php
    $avgRating = count($reviews) > 0
        ? array_reduce($reviews, fn($acc, $review) => $acc + $review->rating, 0) / count($reviews)
        : 0;

    $displayStars = str_repeat("⭐", floor($avgRating));
?>

<div class="p-2 rounded-md bg-zinc-800 border-2 border-zinc-900">
    <div class="flex">
        <img src="#" alt="Image" class="w-1/3" />
        <div class="space-y-1">
            <a href="/book?id=<?=$book->id?>" class="font-semibold hover:underline">
                <?=$book->title?>
            </a>
            <p class="text-sm"><?=$book->author?></p>
            <?php if ($displayStars > 0): ?>
                <p class="text-xs"><?=$displayStars . ' Rating (' . count($reviews) . ' reviews)' ?></p>
            <?php else: ?>
                <p class="text-xs">No Reviews yet</p>
            <?php endif; ?>
        </div>
    </div>
    <p class="text-sm mt-2"><?=$book->description?></p>
</div>

<h2 class="font-semibold text-xl">Reviews</h2>
<div class="grid grid-cols-4 gap-4">
    <div class="col-span-3 gap-4">
        <?php foreach ($reviews as $review): ?>
            <div class="border border-zinc-700 rounded p-4">
                <?=$review->reviewText?>
                <?= str_repeat("⭐", $review->rating)?>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (auth()): ?>
    <div class="border border-zinc-700 rounded p-4 max-w-md mb-4">
        <h3 class="text-lg font-bold">Review</h3>
        <form class="mt-3" method="post" action="create-review">
            <div class="flex flex-col gap-2 max-w-md">
                <label for="review_text" class="ml-1">Your Review</label>
                <textarea
                    required
                    name="review_text"
                    id="review_text"
                    placeholder="Write your impressions about this book..."
                    class="bg-zinc-800 border-2 border-zinc-900 rounded-md p-2 text-sm outline-none mb-4"
                ></textarea>

                <label for="rating" class="ml-1">Rating</label>
                <select
                    required
                    name="rating"
                    id="rating"
                    class="bg-zinc-800 border-2 border-zinc-900 rounded-md p-2 text-sm outline-none"
                >
                    <option value="" disabled selected>Your Rating</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <input type="hidden" name="book_id" value="<?=$book->id?>" />
            </div>
            <button
              type="submit"
              class="border border-zinc-900 bg-zinc-800 rounded-md px-4 py-1 mt-6 hover:bg-zinc-700 cursor-pointer">
                Send
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
    <?php endif; ?>
</div>