<?php
namespace App\Core;

abstract class Controller
{
    protected function view($view, $data = [])
    {
        extract($data);
        $viewFile = dirname(__DIR__) . '/Views/' . $view . '.php';
        if (!is_file($viewFile)) {
            throw new \RuntimeException('View not found: ' . $view);
        }
        require $viewFile;
    }

    protected function redirect($path)
    {
        header('Location: ' . BASE_URL . '/' . ltrim($path, '/'));
        exit;
    }

    protected function requireLogin()
    {
        if (!isset($_SESSION['Username'])) {
            $this->redirect('sign.php');
        }
    }
}
