<?php

namespace App\Controllers;

use App\Models\ProductsModel;
use App\Models\DatabaseConnectionModel;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

/**
 * Class ProductsController
 *
 * Controller for managing products.
 */
class ProductsController {
    /**
     * @var ProductsModel The products model instance.
     */
    private $productModel;

    /**
     * ProductsController constructor.
     *
     * @param DatabaseConnectionModel $databaseConnection The database connection instance.
     */
    public function __construct(DatabaseConnectionModel $databaseConnection) {
        $this->productModel = new ProductsModel($databaseConnection);
    }

    /**
     * List products based on filters and pagination.
     */
    public function listProducts() {
        try {
            $page = $_GET['page'] ?? 1;
            $perPage = 10;

            $filters = [
                'brand' => $_GET['brand'] ?? null,
                'resolution' => $_GET['resolution'] ?? null,
                'minPrice' => $_GET['minPrice'] ?? null,
                'maxPrice' => $_GET['maxPrice'] ?? null,
                'screenSize' => $_GET['screenSize'] ?? null,
            ];

            if (isset($_GET['reset'])) {
                $filters = [];
            }

            $products = $this->productModel->getFilteredPaginatedProducts($filters, $page, $perPage);
            $totalProducts = $this->productModel->getTotalFilteredProducts($filters);
            $totalPages = ceil($totalProducts / $perPage);
            $totalAllProducts = $this->productModel->getTotalProducts();

            $loader = new FilesystemLoader(__DIR__ . '/../views/');
            $twig = new Environment($loader);

            echo $twig->render('list.twig', [
                'products' => $products,
                'page' => $page,
                'totalPages' => $totalPages,
                'totalAllProducts' => $totalAllProducts,
                'filters' => $filters
            ]);

        } catch (\Exception $e) {
            echo "Hiba: " . $e->getMessage();
        }
    }
}
