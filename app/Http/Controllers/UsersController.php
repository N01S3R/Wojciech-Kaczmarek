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
        $rank = Rank::all();
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',
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
            $request->profile_image->move(public_path('/uploads/users'),$file)
        ]);
        $users->save();

        return redirect('/users')->with('status', 'Poprawnie dodano avatar');
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
            'password' => 'required|min:6',
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'rank' => 'require',
        ]);
        $users = User::find($id);
        $users->name = $request->name;
        $users->password = Hash::make(trim($request->password));
        $users->email = ($request->email);
        $users->rank = $request->rank;
        
        if(Storage::exists($users->profile_image)){
         $request->profile_image->getClientOriginalName();
            Storage::delete($users->profile_image);
        }
        $users->profile_image = $file = $request->file('profile_image')->store('/'); 
        $request->profile_image->move(public_path('/uploads/users'),$file);

        $users->update($request->all());
        return redirect('/users')->with('status', 'Użytkownik zaktualizowany  Przed tym');
    }

    public function delete($id)
    {
        $users = User::findOrFail($id);
        if(Storage::exists($users->profile_image)){

            Storage::delete($users->profile_image);
        }
        $users->delete();
        return redirect()->back()->with('status', 'Użytkownik poprawnie usunięty' . $users->profile_image);
    }
}
