<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\CartModel;
use App\Models\OrderModel;

class CartController extends Controller
{
    private $cart;
    private $order;

    public function __construct()
    {
        $this->cart = new CartModel();
        $this->order = new OrderModel();
    }

    public function index()
    {
        $this->requireLogin();

        if (isset($_GET['id'])) {
            $this->cart->add($_SESSION['Username'], $_GET['id']);
        }
        if (isset($_POST['update_amount'])) {
            $this->cart->updateAmount($_SESSION['Username'], $_POST['isbn'] ?? '', $_POST['amount'] ?? 1);
        }
        if (isset($_GET['del-cart-id'])) {
            $this->cart->remove($_SESSION['Username'], $_GET['del-cart-id']);
        }

        $createdOrderID = null;
        if (isset($_GET['type']) && $_GET['type'] === 'payment') {
            $method = $_GET['method'] ?? 'offline';
            $orderID = $this->order->create(
                $_SESSION['Username'],
                $this->cart->total($_SESSION['Username']),
                $method
            );
            if ($orderID) {
                if ($method === 'online') {
                    $this->redirect('online-payment.php?order-id=' . urlencode($orderID));
                }
                $_SESSION['OrderSuccess'] = $orderID;
                $this->redirect('cart.php');
            }
        }

        if (isset($_SESSION['OrderSuccess'])) {
            $createdOrderID = $_SESSION['OrderSuccess'];
            unset($_SESSION['OrderSuccess']);
        }

        $this->view('cart/index', [
            'carts' => $this->cart->items($_SESSION['Username']),
            'totalMoney' => $this->cart->total($_SESSION['Username']),
            'createdOrderID' => $createdOrderID,
        ]);
    }
}
