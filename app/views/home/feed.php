<?php
include __DIR__ . '/../layouts/header.php'; 


$loginUrl = BASE_URL . 'auth/login';
?>

<h1 class="text-2xl font-bold mb-4">Remote internships & gigs</h1>

<!-- Search -->
<form method="GET" class="flex flex-wrap gap-3 mb-6">
    <input type="text" name="q" value="<?= htmlspecialchars($q) ?>"
           placeholder="Search by title or company"
           class="flex-1 min-w-52 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
    <input type="date" name="date" value="<?= htmlspecialchars($date) ?>"
           class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
    <button type="submit"
            class="py-2 px-4 text-sm font-medium rounded-lg bg-blue-600 text-white hover:bg-blue-700">
        Search
    </button>
    <?php if ($q !== '' || $date !== ''): ?>
        <a href="?" class="py-2 px-4 text-sm font-medium rounded-lg border border-gray-300 hover:bg-gray-100">Clear</a>
    <?php endif; ?>
</form>

<?php if (empty($posts)): ?>

    <!-- Empty state -->
    <div class="text-center py-16 border border-dashed border-gray-300 rounded-xl bg-white">
        <p class="font-medium">No posts match your search.</p>
        <p class="text-sm text-gray-500 mt-1">Try a different keyword or clear the filters.</p>
    </div>

<?php else: ?>

<!-- Cards -->
<div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
<?php foreach ($posts as $post): ?>
    <article class="flex flex-col bg-white border border-gray-200 shadow-sm rounded-xl">
        <div class="p-4 flex flex-col grow">

            <!-- Company + date -->
            <div class="flex justify-between text-sm text-gray-500">
                <span><?= htmlspecialchars($post['company']) ?></span>
                <time datetime="<?= htmlspecialchars($post['created_at']) ?>">
                    <?= htmlspecialchars($post['created_at']) ?>
                </time>
            </div>

            <!-- Title -->
            <h3 class="mt-2 font-semibold text-gray-900">
                <?= htmlspecialchars($post['title']) ?>
            </h3>

            <!-- Gig type + budget -->
            <div class="mt-2 flex items-center gap-2 text-sm">
                <span class="px-2 py-0.5 rounded-full text-xs font-medium
                    <?= $post['gig_type'] === 'hourly' ? 'bg-amber-100 text-amber-800' : 'bg-green-100 text-green-800' ?>">
                    <?= $post['gig_type'] === 'hourly' ? 'Hourly' : 'Fixed' ?>
                </span>
                <span class="font-medium">
                    $<?= htmlspecialchars((string) $post['budget']) ?><?= $post['gig_type'] === 'hourly' ? '/hr' : '' ?>
                </span>
            </div>

            <!-- Description -->
            <p class="mt-2 text-gray-600 text-sm">
                <?= htmlspecialchars(mb_strimwidth($post['description'], 0, 120, '...')) ?>
            </p>

            <p class="mt-3 text-xs text-gray-500">
                <?= (int) $post['proposals'] ?> proposals
            </p>

            <!-- Actions -->
            <div class="mt-auto pt-4 flex gap-3">

                <?php if ($role === 'candidate'): ?>
                    <a href="<?= BASE_URL ?>candidate/savePost/<?= (int) $post['id'] ?>"
                       class="py-2 px-3 text-sm font-medium rounded-lg border border-gray-300 hover:bg-gray-100">
                        Save
                    </a>
                    <a href="<?= BASE_URL ?>candidate/apply/<?= (int) $post['id'] ?>"
                       class="py-2 px-3 text-sm font-medium rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                        Apply
                    </a>

                <?php elseif ($role === null): ?>
                    <a href="<?= BASE_URL ?>auth/login"
                       class="py-2 px-3 text-sm font-medium rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                        Login
                    </a>

                <?php elseif ($role === 'admin'): ?>
                    <a href="<?= BASE_URL ?>admin/editPost/<?= (int) $post['id'] ?>"
                       class="py-2 px-3 text-sm font-medium rounded-lg border border-gray-300 hover:bg-gray-100">
                        Edit
                    </a>
                    <a href="<?= BASE_URL ?>admin/deletePost/<?= (int) $post['id'] ?>"
                       onclick="return confirm('Delete this post?')"
                       class="py-2 px-3 text-sm font-medium rounded-lg bg-red-600 text-white hover:bg-red-700">
                        Delete
                    </a>
                <?php endif; ?>

            </div>
        </div>
    </article>
<?php endforeach; ?>
</div>

<?php endif; ?>

<?php include __DIR__ . '/../layouts/footer.php'; ?>