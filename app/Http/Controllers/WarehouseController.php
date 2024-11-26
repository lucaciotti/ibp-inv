<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index(Request $req)
    {
        return view('ibp.warehouses.index');
    }

    public function indexUbic(Request $req, $id)
    {
        $warehouse = Warehouse::find($id);

        return view('ibp.warehouses.ubications', ['warehouse' => $warehouse]);
    }
}
