<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ballon;

class BallonController extends Controller
{
    public function index()
    {
        $ballons = Ballon::all();
        return view('emprunt.index', compact('ballons'));
    }
}
