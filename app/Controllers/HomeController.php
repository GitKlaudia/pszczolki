<?php
require_once __DIR__ . '/../Core/Controller.php';
require_once __DIR__ . '/../Models/Movie.php';
require_once __DIR__ . '/../Models/Show.php';

class HomeController extends Controller
{
    public function index(): void
    {
        $movieModel = new Movie();
        $showModel  = new Show();

        $this->render('home', [
            'filmy'   => $movieModel->all(),
            'seriale' => $showModel->all()
        ]);
    }
}

