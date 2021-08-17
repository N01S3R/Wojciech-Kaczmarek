<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rank;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function index(): View
    {

        $users = User::all();
        return view('users.index', compact('users'));
    }
}
