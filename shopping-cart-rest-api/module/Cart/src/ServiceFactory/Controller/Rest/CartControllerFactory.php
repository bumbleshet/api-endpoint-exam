<?php
/**
ORDER PRECEDENCE FOR USING NAMESPACE
Controller->Model->Table->Service->Filter->Session
MODULES
Cart->CartItems->Products->Customers->JobOrder->JobItems->Shipping->Payment
 **/
namespace Cart\ServiceFactory\Controller\Rest;

use Cart\Controller\Rest\CartController;
use Cart\Model\CartItemTable;
use Cart\Model\CartTable;
use Product\Model\Product;
use Psr\Container\ContainerInterface;

class CartControllerFactory
{
    public function __invoke(ContainerInterface $Container)
    {
        $Container     = $Container->getServiceLocator();
        $CartTable     = $Container->get(CartTable::class);
        $CartItemTable = $Container->get(CartItemTable::class);

        $hostname      = $Container->get('Config')['hostname'];
        $Product       = $Container->get(Product::class);

        return new CartController(
            $CartTable,
            $CartItemTable,
            $hostname,
            $Product
        );
    }
}