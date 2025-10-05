<?php
namespace App\Services;

use App\Repositories\Contracts\CustomerRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CustomerService
{
    protected CustomerRepositoryInterface $repo;

    public function __construct(CustomerRepositoryInterface $repo) { 
        $this->repo = $repo; 
    }

    public function create(array $data, int $userId)
    {
        $data['customer_code'] = $this->generateCode();
        $data['created_by'] = $userId;

        return DB::transaction(fn()=> $this->repo->create($data));
    }

    public function update(int $id, array $data, int $userId)
    {
        $data['updated_by'] = $userId;
        return DB::transaction(fn()=> $this->repo->update($id,$data));
    }

    public function delete(int $id)
    {
        return DB::transaction(fn()=> $this->repo->delete($id));
    }

    public function find(int $id)
    {
        return $this->repo->find($id);
    }

    /** 
     * DataTables JSON response 
     */
    public function getDataTableResponse(Request $request)
    {
        $columns = [
            'customer_code','name','address','phone','email','created_at','updated_at'
        ];

        $draw = intval($request->get('draw'));
        $start = intval($request->get('start',0));
        $length = intval($request->get('length',100));
        $searchValue = $request->input('search.value', null);

        $order = $request->input('order.0');
        $orderColumnIndex = $order['column'] ?? 1;
        $orderDir = $order['dir'] ?? 'asc';
        $orderColumn = $columns[$orderColumnIndex] ?? 'created_at';

        $query = $this->repo->dataTableQuery([]);

        // filter
        if ($searchValue) {
            $query->where(function($q) use ($searchValue) {
                $q->where('customer_code','like',"%{$searchValue}%")
                  ->orWhere('name','like',"%{$searchValue}%")
                  ->orWhere('email','like',"%{$searchValue}%")
                  ->orWhere('phone','like',"%{$searchValue}%");
            });
        }

        $recordsTotal = $this->repo->countAll();
        $recordsFiltered = $query->count();

        $rows = $query->orderBy($orderColumn,$orderDir)
                      ->skip($start)->take($length)->get();

        $data = $rows->map(function($r){
            return [
                'id'          => $r->id,
                'customer_code'=> $r->customer_code,
                'name'        => $r->name,
                'address'     => $r->address,
                'phone'       => $r->phone,
                'email'       => $r->email,
                'creator'     => $r->creator?->name,
                'created_at'  => $r->created_at->format('d.m.Y H:i'),
                'updater'     => $r->updater?->name,
                'updated_at'  => $r->updated_at?->format('d.m.Y H:i'),
                'action'      => view('customers.partials.actions',['customer'=>$r])->render(),
            ];
        });

        return response()->json([
            'draw'            => $draw,
            'recordsTotal'    => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data'            => $data,
        ]);
    }

    protected function generateCode(): string
    {
        $last = \App\Models\Customer::orderByDesc('id')->first();
        $num = $last ? intval(substr($last->customer_code,3)) + 1 : 1;
        return 'MTS' . str_pad($num, 4, '0', STR_PAD_LEFT);
    }
}

