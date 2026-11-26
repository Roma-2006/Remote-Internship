<?php
class HomeController extends Controller
{
    //data base
    public function index()
    {
        
        $posts = [
            ['id' => 1, 'company' => 'TechNova',   'title' => 'Frontend Intern',       'gig_type' => 'fixed',  'budget' => 300, 'description' => 'We need a React intern for 2 months to help build our dashboard and fix UI bugs.', 'created_at' => '2026-11-20', 'proposals' => 4],
            ['id' => 2, 'company' => 'PixelWorks', 'title' => 'UI/UX Designer (Gig)',  'gig_type' => 'hourly', 'budget' => 15,  'description' => 'Design mobile app screens in Figma. Experience with design systems is a plus.', 'created_at' => '2026-11-22', 'proposals' => 9],
            ['id' => 3, 'company' => 'DataBridge', 'title' => 'Data Entry Specialist', 'gig_type' => 'hourly', 'budget' => 8,   'description' => 'Clean and organize spreadsheets for a retail client. Attention to detail is a must.', 'created_at' => '2026-11-23', 'proposals' => 12],
            ['id' => 4, 'company' => 'TechNova',   'title' => 'PHP Backend Intern',    'gig_type' => 'fixed',  'budget' => 450, 'description' => 'Help us build REST endpoints in plain PHP and write simple MySQL queries.', 'created_at' => '2026-11-24', 'proposals' => 2],
            ['id' => 5, 'company' => 'Writely',    'title' => 'Content Writer',        'gig_type' => 'fixed',  'budget' => 120, 'description' => 'Write 10 blog articles about remote work. Native-level English is required.', 'created_at' => '2026-11-25', 'proposals' => 6],
        ];

        $q    = trim($_GET['q'] ?? '');
        $date = $_GET['date'] ?? '';

        $posts = array_filter($posts, function ($p) use ($q, $date) {
            if ($q !== '' && stripos($p['title'], $q) === false && stripos($p['company'], $q) === false) {
                return false;
            }
            if ($date !== '' && $p['created_at'] !== $date) {
                return false;
            }
            return true;
        });

        $this->view('home/feed', compact('posts', 'q', 'date'));
    }
}