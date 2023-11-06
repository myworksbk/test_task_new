<?php

namespace App\Repositories;

use PDO;

final class GoodRepository extends AbstractRepository
{
    public function getAllProductsWithFields(): array
    {
        $sql = "
            SELECT
                goods.id AS good_id,
                goods.name AS good_name,
                additional_fields.name AS field_name,
                additional_field_values.name AS field_value
            FROM goods
            LEFT JOIN additional_goods_field_values ON additional_goods_field_values.good_id = goods.id
            LEFT JOIN additional_fields ON additional_fields.id = additional_goods_field_values.additional_field_id
            LEFT JOIN additional_field_values ON additional_field_values.id = additional_goods_field_values.additional_field_value_id
        ";

        return $this->database->execute($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
