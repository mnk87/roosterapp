<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;

class TestController extends Controller
{
    public function getAll()
    {
        return view('test', [
            'tests' => Test::all()
        ]);
    }
}
