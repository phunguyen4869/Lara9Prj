<?php

namespace App\Http\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UserService
{
    public function get()
    {
        return User::with('roles')->orderBy('id', 'asc')->paginate(10);
    }

    public function getById($id)
    {
        return User::with('roles')->find($id);
    }

    public function getByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function getPaymentMethod()
    {
        return User::select('id', 'name', 'payment_method', 'credit_card_number', 'expiration_date', 'cvv_code', 'credit_card_name', 'atm_card_number', 'bank_name', 'atm_card_name')->get();
    }

    public function getPaymentMethodById($id)
    {
        return User::select('credit_card_number', 'expiration_date', 'cvv_code', 'credit_card_name', 'atm_card_number', 'bank_name', 'atm_card_name')->where('id', $id)->get();
    }

    public function insert($request)
    {
        //dd($request->input());
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'payment_method' => $request->payment_method,
                'password' => bcrypt($request->password),
            ]);

            Session::flash('success', 'Thêm User thành công');
        } catch (\Exception $error) {
            Session::flash('error', 'Thêm User lỗi');
            Log::error($error->getMessage());
            return  false;
        }

        return  true;
    }

    public function update($request, $userID)
    {
        try {
            $user = User::find($userID);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->password = bcrypt($request->password);
            $user->save();

            Session::flash('success', 'Cập nhật User thành công');
        } catch (\Exception $error) {
            Session::flash('error', 'Cập nhật User lỗi');
            Log::error($error->getMessage());
            return  false;
        }

        return  true;
    }

    public function settingStore($request, $userID)
    {
        try {
            DB::beginTransaction();

            $user = User::find($userID);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->payment_method = $request->payment_method;
            $user->credit_card_number = $request->credit_card_number;
            $user->expiration_date = $request->expiration_date;
            $user->cvv_code = $request->cvv_code;
            $user->credit_card_name = $request->credit_card_name;
            $user->atm_card_number = $request->atm_card_number;
            $user->bank_name = $request->bank_name;
            $user->atm_card_name = $request->atm_card_name;
            $user->save();

            DB::commit();

            Session::flash('success', 'Cập nhật thông tin thành công');

        } catch (\Exception $error) {
            Session::flash('error', 'Cập nhật thông tin lỗi');

            Log::error($error->getMessage());

            DB::rollBack();

            return  false;
        }

        return  true;
    }

    public function destroy($request)
    {
        try {
            if ($request->id == 1) {
                return  false;
            } else {
                User::destroy($request->id);
            }
        } catch (\Exception $error) {
            Log::error($error->getMessage());
            return  false;
        }

        return  true;
    }

    public function updatePaymentMethod($request, $user)
    {
        try {
            $user->fill($request->input())->save();

            Session::flash('success', 'Sửa payment method thành công');

        } catch (\Exception $error) {
            Session::flash('error', 'Sửa payment method không thành công');

            Log::error($error->getMessage());

            return  false;
        }

        return true;
    }

    public function destroyPaymentMethod($id)
    {
        $user = User::find($id);
        try {
            $user->fill([
                'payment_method' => 'cod',
                'credit_card_number' => null,
                'expiration_date' => null,
                'cvv_code' => null,
                'credit_card_name' => null,
                'atm_card_number' => null,
                'bank_name' => null,
                'atm_card_name' => null
            ])->save();
        } catch (\Exception $error) {
            Log::error($error->getMessage());
            return  false;
        }
        return true;
    }
}
