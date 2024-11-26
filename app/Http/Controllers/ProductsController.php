<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $req)
    {
        return view('ibp.products');
    }

    public function treatments(Request $req)
    {
        return view('ibp.treatments');
    }
}
