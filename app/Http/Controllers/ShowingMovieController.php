<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowingMovieController extends Controller
{
    public function testAction()
    {
        return User::all();
    }
}
