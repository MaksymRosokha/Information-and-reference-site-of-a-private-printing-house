<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ServiceController extends Controller
{

    public function showServicePage($serviceID)
    {
        if(!intval($serviceID)){
            abort(404);
        }
        $service = Service::query()->findOrFail($serviceID);

        return view('services.service', ['service' => $service]);
    }
}
