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

class UsersController extends Controller
{
    public function index(): View
    {

        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create(): View
    {

        $rank = Rank::all();
        return view('users.create', compact('ranks'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'rank' => 'require',
        ]);
        $users = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'profile_image' => $file = $request->file('profile_image')->store('/'),
            'rank' => $request->rank,
            $request->profile_image->move(public_path('/users/avatar'), $file)
        ]);
        $users->save();

        return redirect('/peoples')->with('status', 'Poprawnie dodano avatar');
    }

    public function edit($id): View
    {
        $users = User::find($id);
        return view('users.edit', compact('users'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',

            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'rank' => 'require',
        ]);
        $users = User::find($id);
        $users->name = $request->name;
        $users->password = Hash::make(trim($request->password));
        $users->email = $request->email;
        $users->rank = $request->rank;

        if ($request->hasFile('profile_image')) {
            unlink('users/avatar/' . $users->profile_image);
            $users->profile_image = $request->file('profile_image')->store('/');
            $request->profile_image->move(public_path('/users/avatar'), $users->profile_image);
        }
        $users->save();
        return redirect('/peoples')->with('status', 'Użytkownik zaktualizowany');
    }

    public function delete($id)
    {
        $users = User::findOrFail($id);
        if ($users->profile_image) {
            unlink('users/avatar/' . $users->profile_image);
        }
        $users->delete();
        return redirect('/peoples')->with('status', 'Użytkownik poprawnie usunięty');
    }
}
