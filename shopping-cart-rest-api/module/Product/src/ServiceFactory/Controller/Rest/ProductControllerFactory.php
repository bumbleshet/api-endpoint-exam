<?php
namespace Product\ServiceFactory\Controller\Rest;

use Product\Controller\Rest\ProductController;
use Product\Model\Product;
use Product\Model\ProductTable;
use Product\Service\ProductService;
use Product\Filter\ProductFilter;
use Psr\Container\ContainerInterface;

class ProductControllerFactory
{
    public function __invoke(ContainerInterface $Container)
    {
        $Container      =  $Container->getServiceLocator();
        $ProductTable   =  $Container->get(ProductTable::class);
        $Product        =  $Container->get(Product::class);
        $ProductFilter  =  $Container->get(ProductFilter::class);
        $config         =  $Container->get('Config');

        return new ProductController(
            $ProductTable,
            $Product,
            $ProductFilter,
            $config['hostname']
        );
    }
}