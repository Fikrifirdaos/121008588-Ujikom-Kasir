<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $account = User::paginate(10);
        return view("account.index", compact("account"));
    }
    public function create()
    {
        return view("account.create");
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view("pages.user.edit", compact("user"));
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "username" => "required",
            "password" => "required",
            "role" => "required"
        ]);
        $user = User::create([
            "name" => $request->name,
            "username" => $request->username,
            "password" => bcrypt($request->password),
            "role" => $request->role
        ]);

        if ($request->role == "admin") {
            $user->assignRole("admin");
        }
        $user->assignRole("petugas");

        return redirect("/user")->with("success", "Berhasil membuat account baru");
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required",
            "username" => "required",
        ]);
        $user = User::find($id);
        
        
        $user->update([
            "name" => $request->name,
            "username" => $request->username,
        ]);
        $user->syncRoles([]);
        $user->assignRole($request->role);

        return back()->with("success", "Berhasil merubah akun");
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/user');
    }

   
}