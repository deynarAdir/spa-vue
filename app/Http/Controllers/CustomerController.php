<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\CreateCustomerRequest;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function all(){
    	$customers = Customer::orderBy('id','desc')->paginate(5);
    	return response()->json([
    		'customers' => $customers,
            'pagination' => [
                'total' => $customers->total(),
                'current_page' => $customers->currentPage(),
                'per_page' => $customers->perPage(),
                'last_page' => $customers->lastPage(),
                'from' => $customers->firstItem(),
                'to' => $customers->lastItem()

            ]
    	],200);
    }

    public function show($id){
    	$customer = Customer::findOrFail($id);
    	return response()->json([
    		'customer' => $customer
    	],200);
    }

    public function new(CreateCustomerRequest $request){
    	// return "hola";
    	$customer = new Customer;
    	$customer->name = $request->name;
    	$customer->phone = $request->phone;
    	$customer->email = $request->email;
    	$customer->website = $request->website;
    	$customer->save();
    	return response()->json([
    		'customer' => $customer
    	],200);
    }
    public function hola(){
    	return 'hola';
    }

    public function search(Request $request){
        $column = $request->column;
        $word = $request->word;
        $customers = Customer::where($column,'like','%'.$word.'%')->orderBy('id','desc')->paginate(5);
        return response()->json([
            'customers' => $customers,
            'pagination' => [
                'total' => $customers->total(),
                'current_page' => $customers->currentPage(),
                'per_page' => $customers->perPage(),
                'last_page' => $customers->lastPage(),
                'from' => $customers->firstItem(),
                'to' => $customers->lastItem()
            ]
        ],200);
    }
}
