<?php



include __DIR__ . '/../layouts/header.php';
?>

<div class="max-w-md mx-auto mt-10">
    <div class="bg-white border border-gray-200 shadow-sm rounded-xl p-6">

        <h1 class="text-2xl font-bold text-center text-blue-600">Login</h1>
        <p class="text-sm text-gray-500 mt-1">
            Use the username and password given to you by the admin.
        </p>

        <?php if ($error !== ''): ?>
            <div role="alert"
                 class="mt-4 rounded-lg border border-red-200 bg-red-50 text-red-700 text-sm px-3 py-2">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= BASE_URL ?>auth/login" class="mt-5 space-y-4">

            <div>
                <label for="username" class="block text-sm font-medium mb-1">Username</label>
                <input id="username" name="username" type="text" required autofocus
                       value="<?= htmlspecialchars($username) ?>"
                       autocomplete="username"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium mb-1">Password</label>
                <div class="relative">
                    <input id="password" name="password" type="password" required
                           autocomplete="current-password"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 pe-16 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="button" id="toggle-pass"
                            class="absolute inset-y-0 end-0 px-3 text-xs text-gray-500 hover:text-gray-800">
                        Show
                    </button>
                </div>
            </div>

            <button type="submit"
                    class="w-full py-2 px-4 text-sm font-medium rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                Login
            </button>
        </form>

        <p class="text-xs text-gray-400 mt-5">
            Accounts are created by the admin. There is no public sign-up.
        </p>
    </div>
</div>

<script>
  const passInput = document.getElementById('password');
  const toggle = document.getElementById('toggle-pass');
  toggle.addEventListener('click', function () {
    const show = passInput.type === 'password';
    passInput.type = show ? 'text' : 'password';
    toggle.textContent = show ? 'Hide' : 'Show';
  });
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
