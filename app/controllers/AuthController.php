<?php
class AuthController extends Controller
{
    //data base
    private array $users = [
        'admin'      => ['password' => 'admin123',   'role' => 'admin',     'first_name' => 'Admin'],
        'company'   => ['password' => 'company123', 'role' => 'company',   'first_name' => 'TechNova'],
        'candidate' => ['password' => 'cand123',    'role' => 'candidate', 'first_name' => 'Sara'],
    ];

   
    private array $redirects = [
        'admin'     => '',
        'company'   => '',
        'candidate' => '',
    ];

protected function redirect(string $path): void
{
    header('Location: ' . BASE_URL . ltrim($path, '/'));
    exit;
}
    public function login()
    {
        if (!empty($_SESSION['role'])) {
            $this->redirect($this->redirects[$_SESSION['role']] ?? '');
        }

        $error    = '';
        $username = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = strtolower(trim($_POST['username'] ?? ''));
            $password = $_POST['password'] ?? '';

            if ($username === '' || $password === '') {
                $error = 'Please enter your username and password.';
            } elseif (!isset($this->users[$username]) || $this->users[$username]['password'] !== $password) {
                $error = 'Incorrect username or password.';
            } else {
                session_regenerate_id(true);
                $u = $this->users[$username];
                $_SESSION['username']   = $username;
                $_SESSION['role']       = $u['role'];
                $_SESSION['first_name'] = $u['first_name'];
                $this->redirect($this->redirects[$u['role']]);
            }
        }

        $this->view('auth/login', compact('error', 'username'));
    }

    
    public function logout()
    {
        $_SESSION = [];
        session_destroy();
        $this->redirect('auth/login');
    }
}
