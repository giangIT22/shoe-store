<?php

namespace App\Services;

interface OrderServiceInterface
{
    public function storeOrder($params);
    public function getOrdersOfUser($userId);
    public function getOrderDetail($orderCode);
    public function getOrders();
    public function cancelOrder($orderCode, $status);
    public function getInvoiceMonthy();
    public function getInvoiceYearLy();
    public function search($params);
    public function returnedOrder($orderCode, $status);
}
