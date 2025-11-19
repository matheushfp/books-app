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
    <?php foreach ($books as $book) {
        require('partials/_book.php');
    } ?>
</section>
