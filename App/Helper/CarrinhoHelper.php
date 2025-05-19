<?php

namespace App\Helper;

class CarrinhoHelper
{
    public function __construct()
    {
        if(!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }   
    }

    public function insert($id, $quantity = 1)
    {
        $qtt = ((int) $quantity > 0)? $quantity: 1;

        if(!isset($_SESSION['cart'][$id])){ 

            $_SESSION['cart'][$id] = $qtt; 

        }else{

            $_SESSION['cart'][$id] += $qtt; 
        }
    }

    public function delete($id)
    {
        if(isset($_SESSION['cart'][$id])){ 
            unset($_SESSION['cart'][$id]); 
        } 
    }

    public function update($id, $quantity)
    {
        if(isset($_SESSION['cart'][$id])){ 
            if($quantity > 0) {
                $_SESSION['cart'][$id] = $quantity;

            } else {
                self::delete($id);
            }
        }
    }

    public function getContent($listProduct)
    {
        $results = [];

        if($_SESSION['cart']) {

            $cart = $_SESSION['cart'];

            foreach($listProduct as $row) {

                $id = $row['id'];

                if(in_array($id, array_keys($cart))){

                    $results[] = [
                        'id'       => $row['id'],
                        'nome'     => $row['nome'],
                        'preco'    => $row['preco'],
                        'quantidade' => $cart[$id],
                        'subtotal' => $cart[$id] * $row['preco'],
                    ];
                }
            }
        }

        return $results;
    }

    public function getSubtotal($listProduct)
    {
        $total = 0;

        foreach(self::getContent($listProduct) as $row) {
            $total += $row['subtotal'];
        } 

        return $total;
    }

    public function getTotalItem()
    {
       return count($_SESSION['cart']) ;
    } 

}    

