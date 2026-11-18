<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\BookModel;

class HomeController extends Controller
{
    public function index()
    {
        $bookModel = new BookModel();
        $this->view('home/index', ['books' => $bookModel->latest(8)]);
    }
}
