<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\BookModel;

class ShopController extends Controller
{
    public function index()
    {
        $bookModel = new BookModel();
        $this->view('shop/index', [
            'books' => $bookModel->all($_GET['keyword'] ?? ''),
        ]);
    }

    public function category()
    {
        $bookModel = new BookModel();
        $categories = $bookModel->categories();

        if (!isset($_GET['CategoryID']) || $_GET['CategoryID'] === '') {
            $this->view('shop/categories', ['categories' => $categories]);
            return;
        }

        $categoryID = (int) $_GET['CategoryID'];
        $this->view('shop/category', [
            'categoryName' => $bookModel->categoryName($categoryID),
            'books' => $bookModel->inCategory($categoryID),
            'categories' => $categories,
        ]);
    }

    public function details()
    {
        $bookModel = new BookModel();
        $isbn = $_GET['id'] ?? '';
        $this->view('shop/details', ['book' => $bookModel->find($isbn)]);
    }
}
