<?php

namespace App\Services;

use App\Repositories\GoodRepository;

final class GoodService
{
    public function __construct(private GoodRepository $repository) {}

    public function getAllProductsWithFields(): array
    {
        $goods = $this->repository->getAllProductsWithFields();

        return $this->groupAsProductsWithFields($goods);
    }

    private function groupAsProductsWithFields(array $data): array
    {
        return array_values(array_reduce($data, function($result, $item) {
            $key = 'good_id';

            $fields = [];

            if ($item['field_name'] || $item['field_value']) {
                $fields = [
                    'field_name' => $item['field_name'],
                    'field_value' => $item['field_value'],
                ];
            }

            if (!array_key_exists($item[$key], $result)) {
                $result[$item[$key]] = [
                    'good_name' => $item['good_name'],
                    'fields' => []
                ];
            }

            if (!empty($fields)) {
                $result[$item[$key]]['fields'][] = $fields;
            }

            return $result;
        }, []));
    }
}
