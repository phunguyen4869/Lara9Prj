<?php

namespace App\Http\Controllers\Admin\Users;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        return view('admin.users.register', [
            'title' => 'Register',
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            //check email and password is valid
            'name' => 'required',
            'email' => 'required|email:filter|unique:users,email',
            'password' => 'required',
            're_password' => 'required|same:password',
            'phone' => 'required|numeric',
        ]);

        if (!empty($request->github_id)) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'payment_method' => 'cod',
                'github_id' => $request->github_id,
                'password' => bcrypt($request->password),
            ]);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'payment_method' => 'cod',
                'password' => bcrypt($request->password),
            ]);
        }

        $user->assignRole('member');

        event(new Registered($user));

        return redirect()->route('login');
    }
}
