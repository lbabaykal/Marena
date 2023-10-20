<?php

namespace App\Http\Controllers;

use App\Models\Favorites;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{

    public function index()
    {
        return view('account.index');
    }

}
