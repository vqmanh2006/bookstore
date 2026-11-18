<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\OrderModel;

class OrderController extends Controller
{
    private $order;

    public function __construct()
    {
        $this->order = new OrderModel();
    }

    public function index()
    {
        $this->requireLogin();

        if (isset($_POST['cancel_order'])) {
            $this->order->cancel($_POST['order_id'] ?? '', $_SESSION['Username']);
            $this->redirect('my-orders.php');
        }

        $this->view('orders/index', [
            'orders' => $this->order->forUser($_SESSION['Username']),
        ]);
    }

    public function edit()
    {
        $this->requireLogin();
        $orderID = $_GET['order-id'] ?? $_POST['order_id'] ?? '';
        $order = $this->order->findForUser($orderID, $_SESSION['Username']);
        if (!$order || $order['Status'] != 0) {
            $this->redirect('my-orders.php');
        }

        if (isset($_POST['save_order'])) {
            $this->order->updateDetails($orderID, $_SESSION['Username'], $_POST['amount'] ?? []);
            $this->redirect('my-orders.php');
        }

        $this->view('orders/edit', [
            'order' => $order,
            'details' => $this->order->details($orderID),
        ]);
    }

    public function payment()
    {
        $this->requireLogin();
        $orderID = $_GET['order-id'] ?? $_POST['order-id'] ?? '';
        $order = $orderID ? $this->order->findForUser($orderID, $_SESSION['Username']) : null;
        $paymentCompleted = false;

        if ($order && isset($_POST['confirm_payment']) && $order['Status'] == 0) {
            $this->order->markPaid($orderID, $_SESSION['Username']);
            $order = $this->order->findForUser($orderID, $_SESSION['Username']);
            $paymentCompleted = true;
        }

        $this->view('orders/payment', [
            'order' => $order,
            'orderID' => $orderID,
            'paymentCompleted' => $paymentCompleted,
        ]);
    }
}
