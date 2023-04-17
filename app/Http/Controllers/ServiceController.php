<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function showServicePage($serviceID)
    {
        if(!intval($serviceID)){
            abort(404);
        }
        $service = Service::query()->findOrFail($serviceID);

        return view('services.service', [
            'service' => $service,
            'products' => $service->products,
        ]);
    }

    public function search(Request $request){
        $request->validate([
            'serviceID' => ['required', 'int'],
        ]);
        $service = Service::query()->findOrFail($request['serviceID']);
        $products = Product::query()->where('name', 'LIKE', "%{$request['text']}%")
            ->where('service_id', '=', $request['serviceID'])->get();

        return view('services.service', [
            'service' => $service,
            'products' => $products,
        ]);
    }
}
