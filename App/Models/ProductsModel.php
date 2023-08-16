<?php
namespace App\Models;

/**
 * Class ProductsModel
 *
 * Represents the ProductsModel class that interacts with the database to retrieve product/monitor information.
 */
class ProductsModel {
    /**
     * @var DatabaseConnectionModel The database connection instance.
     */
    private $databaseConnection;

    /**
     * ProductsModel constructor.
     *
     * @param DatabaseConnectionModel $databaseConnection The database connection instance.
     */
    public function __construct(DatabaseConnectionModel $databaseConnection) {
        $this->databaseConnection = $databaseConnection;
    }
    
    /**
     * Magic method to dynamically get properties of the class.
     *
     * @param string $property The property to get.
     * @return mixed|null The value of the property, or null if the property does not exist.
     */
    public function __get(string $property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
        return null;
    }

    /**
     * Magic method to dynamically set properties of the class.
     *
     * @param string $property The property to set.
     * @param mixed $value The value to set.
     */
    public function __set(string $property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
    
    /**
     * Get the total number of products in the database.
     *
     * @return int The total number of products.
     */
    public function getTotalProducts(): int {
        $query = "SELECT COUNT(*) as total FROM monitors";
        $db = $this->databaseConnection->getConnection()->query($query);
        $result = $db->fetch(\PDO::FETCH_ASSOC);

        return (int)$result['total'];
    }

    /**
     * Get the total number of filtered products based on provided filters.
     *
     * @param array $filters The filters to apply.
     * @return int The total number of filtered products.
     */
    public function getTotalFilteredProducts(array $filters): int {
        $query = "SELECT COUNT(*) as total FROM monitors WHERE 1";

        if (!empty($filters['brand'])) {
            $query .= " AND brand = :brand";
        }

        if (!empty($filters['resolution'])) {
            $query .= " AND resolution = :resolution";
        }

        if (!empty($filters['maxPrice'])) {
            $query .= " AND base_price <= :maxPrice";
        }

        $db = $this->databaseConnection->getConnection()->prepare($query);

        if (!empty($filters['brand'])) {
            $db->bindValue(':brand', $filters['brand']);
        }

        if (!empty($filters['resolution'])) {
            $db->bindValue(':resolution', $filters['resolution']);
        }

        if (!empty($filters['maxPrice'])) {
            $db->bindValue(':maxPrice', $filters['maxPrice']);
        }

        $db->execute();
        $result = $db->fetch(\PDO::FETCH_ASSOC);

        return (int)$result['total'];
    }

    /**
     * Get filtered and paginated products based on provided filters and pagination parameters.
     *
     * @param array $filters The filters to apply.
     * @param int $page The page number.
     * @param int $perPage The number of products per page.
     * @return array The array of filtered and paginated products.
     */
    public function getFilteredPaginatedProducts(array $filters, int $page = 1, int $perPage = 10): array {
        $offset = ($page - 1) * $perPage;
        $query = "SELECT * FROM monitors WHERE 1";

        if (!empty($filters['brand'])) {
            $query .= " AND brand = :brand";
        }

        if (!empty($filters['resolution'])) {
            $query .= " AND resolution = :resolution";
        }

        if (!empty($filters['minPrice'])) {
            $query .= " AND base_price >= :minPrice";
        }

        if (!empty($filters['maxPrice'])) {
            $query .= " AND base_price <= :maxPrice";
        }

        if (!empty($filters['screenSize'])) {
            $query .= " AND screen_size = :screenSize";
        }

        $query .= " LIMIT $offset, $perPage";

        $db = $this->databaseConnection->getConnection()->prepare($query);

        if (!empty($filters['brand'])) {
            $db->bindValue(':brand', $filters['brand']);
        }

        if (!empty($filters['resolution'])) {
            $db->bindValue(':resolution', $filters['resolution']);
        }

        if (!empty($filters['minPrice'])) {
            $db->bindValue(':minPrice', $filters['minPrice']);
        }

        if (!empty($filters['maxPrice'])) {
            $db->bindValue(':maxPrice', $filters['maxPrice']);
        }

        if (!empty($filters['screenSize'])) {
            $db->bindValue(':screenSize', $filters['screenSize']);
        }

        $db->execute();

        $products = [];

        while ($row = $db->fetch(\PDO::FETCH_ASSOC)) {
            $products[] = $row;
        }

        return $products;
    }
}
