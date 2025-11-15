<div class="mt-6">
    <div class="border border-zinc-700 rounded p-4 max-w-md mb-4">
        <h1 class="text-xl font-bold">Login</h1>
        <form class="mt-8" method="post">
            <div class="flex flex-col gap-2 max-w-md">
                <label for="email" class="ml-1">E-mail</label>
                <input
                    type="email" required
                    name="email"
                    id="email"
                    placeholder="Your e-mail"
                    class="bg-zinc-800 border-2 border-zinc-900 rounded-md p-2 text-sm outline-none mb-4"
                    value="<?= htmlspecialchars($data['email'] ?? '') ?>"
                />

                <label for="password" class="ml-1">Password</label>
                <input
                    type="password" required
                    name="password"
                    id="password"
                    placeholder="Your Password"
                    class="bg-zinc-800 border-2 border-zinc-900 rounded-md p-2 text-sm outline-none"
                    value="<?= htmlspecialchars($data['password'] ?? '') ?>"
                />
            </div>
            <button
                type="submit"
                class="border border-zinc-900 bg-zinc-800 rounded-md px-4 py-1 mt-6 hover:bg-zinc-700 cursor-pointer">
                Login
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
    <a href="/sign-up" class="ml-1 hover:underline">Don't have an account? Sign up here</a>
</div>