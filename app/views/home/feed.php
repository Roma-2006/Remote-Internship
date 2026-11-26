<?php
include __DIR__ . '/../layouts/header.php';


$posts = [
    [
        'id'          => 1,
        'company'     => 'TechNova',
        'title'       => 'Frontend Intern',
        'gig_type'    => 'fixed',
        'budget'      => 300,
        'description' => 'We need a React intern for 2 months to help build our dashboard and fix UI bugs.',
        'created_at'  => '2026-11-20',
        'proposals'   => 4,
    ],
    [
        'id'          => 2,
        'company'     => 'PixelWorks',
        'title'       => 'UI/UX Designer (Gig)',
        'gig_type'    => 'hourly',
        'budget'      => 15,
        'description' => 'Design mobile app screens in Figma. Experience with design systems is a plus.',
        'created_at'  => '2026-11-22',
        'proposals'   => 9,
    ],
    [
        'id'          => 3,
        'company'     => 'DataBridge',
        'title'       => 'Data Entry Specialist',
        'gig_type'    => 'hourly',
        'budget'      => 8,
        'description' => 'Clean and organize spreadsheets for a retail client. Attention to detail is a must.',
        'created_at'  => '2026-11-23',
        'proposals'   => 12,
    ],
    [
        'id'          => 4,
        'company'     => 'TechNova',
        'title'       => 'PHP Backend Intern',
        'gig_type'    => 'fixed',
        'budget'      => 450,
        'description' => 'Help us build REST endpoints in plain PHP and write simple MySQL queries.',
        'created_at'  => '2026-11-24',
        'proposals'   => 2,
    ],
    [
        'id'          => 5,
        'company'     => 'Writely',
        'title'       => 'Content Writer',
        'gig_type'    => 'fixed',
        'budget'      => 120,
        'description' => 'Write 10 blog articles about remote work. Native-level English is required.',
        'created_at'  => '2026-11-25',
        'proposals'   => 6,
    ],
];

/*  البحث */
$q    = trim($_GET['q'] ?? '');
$date = $_GET['date'] ?? '';

$posts = array_filter($posts, function ($p) use ($q, $date) {
    if ($q !== '' && stripos($p['title'], $q) === false
                  && stripos($p['company'], $q) === false) {
        return false;
    }
    if ($date !== '' && $p['created_at'] !== $date) {
        return false;
    }
    return true;
});

$loginUrl = '/auth/login';
?>

<h1 class="text-2xl font-bold mb-4">Remote internships &amp; gigs</h1>

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

            <!-- Actions  -->
            <div class="mt-auto pt-4 flex gap-3">

                <?php if ($role === 'candidate' || $role === null): ?>
                    <a href="<?= $role ? '/candidate/savePost/' . $post['id'] : $loginUrl ?>"
                       class="py-2 px-3 text-sm font-medium rounded-lg border border-gray-300 hover:bg-gray-100">
                        Save
                    </a>
                    <a href="<?= $role ? '/candidate/apply/' . $post['id'] : $loginUrl ?>"
                       class="py-2 px-3 text-sm font-medium rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                        Apply
                    </a>

                <?php elseif ($role === 'admin'): ?>
                    <a href="/admin/editPost/<?= (int) $post['id'] ?>"
                       class="py-2 px-3 text-sm font-medium rounded-lg border border-gray-300 hover:bg-gray-100">
                        Edit
                    </a>
                    <a href="/admin/deletePost/<?= (int) $post['id'] ?>"
                       onclick="return confirm('Delete this post?')"
                       class="py-2 px-3 text-sm font-medium rounded-lg bg-red-600 text-white hover:bg-red-700">
                        Delete
                    </a>
                <?php endif; ?>
                <?php  ?>

            </div>
        </div>
    </article>
<?php endforeach; ?>
</div>

<?php endif; ?>

<?php include __DIR__ . '/../layouts/footer.php'; ?>