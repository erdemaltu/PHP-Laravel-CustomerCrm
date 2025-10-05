<?php

namespace App\Repositories\Contracts;

interface CustomerRepositoryInterface {
    public function find(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id): bool;
    public function dataTableQuery(array $params);
}