<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Component\CssSelector\Node\FunctionNode;

class CvthequeController extends Controller
{
    public function index()
    {
        return view('cvtheque');
    }
}
