<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\User\UserService;
use App\Http\Services\Order\OrderService;

class DashboardController extends Controller
{
    protected $orders;
    protected $users;

    public function __construct(OrderService $orders, UserService $users)
    {
        $this->orders = $orders;
        $this->users = $users;
    }

    public function index(Request $request)
    {
        $name = $request->user()->attributesToArray()['name'];
        $orders = $this->orders->getOrderbyCustomer($request->user()->id);

        return view('admin.dashboard', [
            'title' => 'Dashboard',
            'name' => $name,
            'orders' => $orders,
        ]);
    }

    public function setting(Request $request)
    {
        $user = $request->user();

        return view('admin.users.setting', [
            'title' => 'Setting',
            'user' => $user,
        ]);
    }

    public function settingStore(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:filter|unique:users,email,' . $request->user()->id,
            'password' => 'nullable',
            're_password' => 'same:password',
        ]);

        $result = $this->users->settingStore($request, $request->user()->id);

        if ($result) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back();
        }
    }
}
