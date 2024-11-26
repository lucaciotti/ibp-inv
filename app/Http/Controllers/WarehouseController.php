<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index(Request $req)
    {
        return view('mcslide.warehouses.index');
    }

    public function indexUbic(Request $req, $id)
    {
        $warehouse = Warehouse::find($id);

        return view('mcslide.warehouses.ubications', ['warehouse' => $warehouse]);
    }
}
