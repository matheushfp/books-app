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
                <li><a href="/">Explore</a></li>
                <?php if (auth()): ?>
                    <li><a href="/my-books" class="hover:underline">My Books</a></li>
                <?php endif; ?>
            </ul>
            <ul class="flex">
                <?php if (!auth()): ?>
                    <li><a href="/login" class="hover:underline">Login</a></li>
                <?php else: ?>
                    <li class="flex flex-col">
                        <span class="font-semibold"><?= auth()->name ?? '' ?></span>
                        <a href="/logout" class="hover:underline text-xs -mb-2 flex items-center justify-center">Logout</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main class="mx-auto max-w-screen-xl px-10 py-2 space-y-6">
        <?php require "views/{$viewPath}.view.php"; ?>
    </main>
</body>
</html>