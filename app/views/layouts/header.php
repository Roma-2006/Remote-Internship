<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
  
}


$role = $_SESSION['role'] ?? null;
$name = $_SESSION['first_name'] ?? '';



$linkClass = "text-sm text-gray-600 hover:text-blue-600 focus:outline-none focus:text-blue-700";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Remote Internship</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900">

<header class="w-full py-3 bg-white border-b border-gray-200">
  <nav class="max-w-7xl w-full mx-auto px-4 flex flex-wrap items-center justify-between">

    <!-- Brand -->
    <a href="<?= BASE_URL ?>" class="text-xl font-semibold text-gray-900">WorkNest</a>

    <!-- Right side-->
    <div class="sm:order-3 flex items-center gap-x-3">
      <?php if ($role): ?>
        <span class="hidden sm:inline text-sm text-gray-700">Hello, <?= htmlspecialchars($name) ?></span>
        <a href="<?= BASE_URL ?>auth/logout"
           class="py-2 px-3 text-sm font-medium rounded-lg border border-gray-300 hover:bg-gray-100">
           Logout
        </a>
      <?php else: ?>
        <a href="<?= BASE_URL ?>auth/login"
           class="py-2 px-3 text-sm font-medium rounded-lg bg-blue-600 text-white hover:bg-blue-700">
           Login
        </a>
      <?php endif; ?>

      <!--(mobile only) -->
      <button type="button" id="menu-toggle" aria-label="Toggle navigation"
              class="sm:hidden size-9 flex justify-center items-center rounded-lg border border-gray-300 hover:bg-gray-100">
        <svg class="size-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round">
          <line x1="3" x2="21" y1="6" y2="6"/><line x1="3" x2="21" y1="12" y2="12"/><line x1="3" x2="21" y1="18" y2="18"/>
        </svg>
      </button>
    </div>

    <!-- Links -->
    <div id="menu" class="hidden basis-full sm:order-2 sm:flex sm:basis-auto sm:grow-0">
      <div class="flex flex-col gap-5 mt-5 sm:flex-row sm:items-center sm:mt-0 sm:ps-5">

    

        <?php if ($role === 'admin'): ?>
            <a href="<?= BASE_URL ?>admin/dashboard" class="<?= $linkClass ?>">Dashboard</a>
            <a href="<?= BASE_URL ?>admin/users" class="<?= $linkClass ?>">Users</a>

        <?php elseif ($role === 'company'): ?>
            <a href="<?= BASE_URL ?>company/myPosts" class="<?= $linkClass ?>">My Posts</a>
            <a href="<?= BASE_URL ?>company/createPost" class="<?= $linkClass ?>">Create Post</a>
            <a href="<?= BASE_URL ?>company/profile" class="<?= $linkClass ?>">Profile</a>

        <?php elseif ($role === 'candidate'): ?>
            <a href="<?= BASE_URL ?>candidate/savedPosts" class="<?= $linkClass ?>">Saved Posts</a>
            <a href="<?= BASE_URL ?>candidate/profile" class="<?= $linkClass ?>">Profile</a>
        <?php endif; ?>

      </div>
    </div>

  </nav>
</header>

<script>
  document.getElementById('menu-toggle').addEventListener('click', function () {
    document.getElementById('menu').classList.toggle('hidden');
  });
</script>

<main class="max-w-7xl mx-auto px-4 py-6">
<?php ?>