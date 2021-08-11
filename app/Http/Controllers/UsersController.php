<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use ArrayAccess;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View as FacadesView;
use Illuminate\View\View;

class UsersController extends Controller
{
    public function index(): View
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create(): View
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        $users = new User;
        if (User::where('name', '=', $request->input('name'))->exists()) {
            return redirect()->back()->with('status', 'Login istnieje !');
        }
            $users->name = $request->input('name');
        if (User::where('email', '=', $request->input('email'))->exists()) {
            return redirect()->back()->with('status', 'E-mail istnieje !');
        }
            $users->email = $request->input('email');
        $users->password = $request->input('password');
        if ($request->hasfile('profile_image')) {
            $file = $request->file('profile_image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('uploads/users/', $filename);
            $users->profile_image = $filename;
        }
        $users->save();
        return redirect()->back()->with('status', 'Poprawnie dodano avatar');
    }

    public function edit($id): View
    {
        $users = User::find($id);
        return view('users.edit', compact('users'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $users = User::find($id);
        if (User::where('name', '=', $request->input('name'))->exists()) {
            return redirect()->back()->with('status', 'Login istnieje !');
        }
        $users->name = $request->input('name');
        if (User::where('email', '=', $request->input('email'))->exists()) {
            return redirect()->back()->with('status', 'E-mail istnieje !');
        }
        $users->email = $request->input('email');
        if ($request->hasfile('profile_image')) {
            $destination = 'uploads/users/' . $users->profile_image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('profile_image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('uploads/users/', $filename);
            $users->profile_image = $filename;
        }

        $users->update();
        return redirect()->back()->with('status', 'Użytkownik zaktualizowany');
    }

    public function destroy($id): array
    {
        $users = User::find($id);
        $destination = 'uploads/users/' . $users->profile_image;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $users->delete();
        return redirect()->back()->with('status', 'Użytkownik poprawnie usunięty');
    }
}
