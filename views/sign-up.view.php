<div class="mt-6">
    <div class="border border-zinc-700 rounded p-4 max-w-md mb-4">
        <h1 class="text-xl font-bold">Sign Up</h1>
        <form class="mt-8" method="post">
            <div class="flex flex-col gap-2 max-w-md">
                <label for="name" class="ml-1">Name</label>
                <input
                    type="text" required
                    name="name"
                    id="name"
                    placeholder="Your name"
                    class="bg-zinc-800 border-2 border-zinc-900 rounded-md p-2 text-sm outline-none mb-4 focus:border-sky-500"
                    value="<?= htmlspecialchars($data['name'] ?? '') ?>"
                />

                <label for="email" class="ml-1">E-mail</label>
                <input
                    type="email" required
                    name="email"
                    id="email"
                    placeholder="Your e-mail"
                    class="bg-zinc-800 border-2 border-zinc-900 rounded-md p-2 text-sm outline-none mb-4 focus:border-sky-500"
                    value="<?= htmlspecialchars($data['email'] ?? '') ?>"
                />

                <label for="password" class="ml-1">Password</label>
                <input
                    type="password" required
                    name="password"
                    id="password"
                    placeholder="Your Password"
                    class="bg-zinc-800 border-2 border-zinc-900 rounded-md p-2 text-sm outline-none mb-4 focus:border-sky-500"
                    value="<?= htmlspecialchars($data['password'] ?? '') ?>"
                />

                <label for="password_confirmation" class="ml-1">Confirm your Password</label>
                <input
                    type="password" required
                    name="password_confirmation"
                    id="password_confirmation"
                    placeholder="Your Password"
                    class="bg-zinc-800 border-2 border-zinc-900 rounded-md p-2 text-sm outline-none focus:border-sky-500"
                    value="<?= htmlspecialchars($data['password_confirmation'] ?? '') ?>"
                />
            </div>
            <button
                type="submit"
                class="border border-zinc-900 bg-zinc-800 rounded-md px-4 py-1 mt-6 hover:bg-zinc-700 cursor-pointer">
                Sign Up
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

            <!-- Success Message -->
            <?php if (!empty($_SESSION['success'])): ?>
                <div class="border-green-800 bg-green-900 text-green-400 px-4 py-1 rounded-md border-2 text-sm font-bold mt-4">
                    <?= $_SESSION['success'] ?>
                </div>
            <?php endif; ?>
        </form>
    </div>
    <a href="/login" class="ml-1 hover:underline">Already have an account? Login here</a>
</div>