<?php
namespace App\Repositories\Eloquent;

use App\Models\Customer;
use App\Repositories\Contracts\CustomerRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

class EloquentCustomerRepository implements CustomerRepositoryInterface
{
    public function find(int $id) { return Customer::with(['creator','updater'])->findOrFail($id); }

    public function create(array $data) { return Customer::create($data); }

    public function update(int $id, array $data) {
        $c = $this->find($id);
        $c->update($data);
        return $c;
    }

    public function delete(int $id): bool {
        return $this->find($id)->delete();
    }

    /**
     * Returns an Eloquent builder for DataTables server-side handling.
     * We return builder, controller/service will apply offset/limit/search/order.
     */
    public function dataTableQuery(array $params): Builder
    {
        $query = Customer::with(['creator','updater'])->select('customers.*');
        return $query;
    }

    public function countAll(): int {
        return Customer::count();
    }

}
