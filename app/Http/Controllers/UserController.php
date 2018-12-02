<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function testAction()
    {
        //return $r->get('page');
        return User::paginate(15);
    }
}
