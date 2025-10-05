<?php
namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CustomerService;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;

class CustomerController extends Controller
{
    protected CustomerService $service;

    public function __construct(CustomerService $service) {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->service->getDataTableResponse($request);
        }

        return view('customers.index');
    }

    public function create() { 
        return view('customers.create'); 
    }

    public function store(CustomerStoreRequest $request) {
        $this->service->create($request->validated(), auth()->id());
        return redirect()->route('customers.index')->with('success','Müşteri eklendi');
    }

    public function edit(int $id) {
        $customer = $this->service->find($id);
        return view('customers.edit', compact('customer'));
    }

    public function update(CustomerUpdateRequest $request, int $id) {
        $this->service->update($id, $request->validated(), auth()->id());
        return redirect()->route('customers.index')->with('success','Müşteri güncellendi');
    }

    public function destroy(int $id) {
        $this->service->delete($id);
        return redirect()->route('customers.index')->with('success','Müşteri silindi');
    }
}

