<?php
    $books = [
      ['id' => 1, 'title' => 'Book 1', 'author' => 'John Doe', 'description' => 'desc1'],
      ['id' => 2, 'title' => 'Book 2', 'author' => 'John Doe', 'description' => 'desc2'],
      ['id' => 3, 'title' => 'Book 3', 'author' => 'John Doe', 'description' => 'desc3'],
      ['id' => 4, 'title' => 'Book 4', 'author' => 'John Doe', 'description' => 'desc4'],
      ['id' => 5, 'title' => 'Book 5', 'author' => 'John Doe', 'description' => 'desc5'],
      ['id' => 6, 'title' => 'Book 6', 'author' => 'John Doe', 'description' => 'desc6'],
    ];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book Wise</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-zinc-900 text-zinc-100">
    <header class="bg-zinc-800">
        <nav class="flex mx-auto max-w-screen-xl justify-between px-10 py-5">
            <span class="text-2xl font-bold tracking-wide">Book Wise</span>
            <ul class="flex gap-x-4 font-semibold">
                <li><a href="/">Explorar</a></li>
                <li><a href="/my-books.php" class="hover:underline">Meus Livros</a></li>
            </ul>
            <ul class="flex">
                <li><a href="/login.php" class="hover:underline">Fazer Login</a></li>
            </ul>
        </nav>
    </header>

    <main class="mx-auto max-w-screen-xl px-10 py-2 space-y-6">
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
                            <a href="/book.php?id=<?=$book['id']?>" class="font-semibold hover:underline">
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
    </main>
</body>
</html>