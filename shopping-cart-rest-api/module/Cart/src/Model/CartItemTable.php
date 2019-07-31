<?php
namespace Cart\Model;

use Zend\Db\TableGateway\TableGateway;

class CartItemTable
{
    private $TableGateway;

    public function __construct(TableGateway $TableGateway)
    {
        $this->TableGateway = $TableGateway;
    }

    public function fetchCartItems($columns  = null, $where  = null, $productColumns = array())
    {
        $select = $this->TableGateway->getSql()->select();
        if ($columns) {
            $select->columns($columns);
        }

        if (!empty($productColumns)) {
            $select->join(
                array("p" => "products"),
                "p.product_id = cart_items.product_id",
                $productColumns,
                "INNER"
            );
        }

        if ($where) {
            $select->where($where);
        }

        $CartItems = $this->TableGateway->selectWith($select);

        return $CartItems;
    }

    public function insertCartItem($data)
    {
        $this->TableGateway->insert($data);
    }

    public function updateCartItem($data, $where)
    {
        $update = $this->TableGateway->getSql()->update()->set($data)->where($where);
        $this->TableGateway->updateWith($update);
    }

    public function deleteCartItems($cart_id)
    {
        $this->TableGateway->delete(['cart_id' => $cart_id]);
    }
}