<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Enums\AddressType;
use Illuminate\Http\Request;
use App\Models\CustomerAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PasswordUpdateRequest;

class UserController extends Controller
{
    public function index(Request $request){
        /** @var \App\Models\User $user */
        $user = Auth::user();
        /** @var \App\Models\Customer $customer */
        $customer = $user->Customer;
        $shippingAddress = $customer->shippingAddress ?: new CustomerAddress(['type'=>AddressType::Shipping]);
        $billingAddress = $customer->billingAddress ?: new CustomerAddress(['type'=>AddressType::Billing]);
        // dd($customer, $shippingAddress->attributesToArray(),$billingAddress, $billingAddress->customer);
        $countries = Country::query()->orderBy('name')->get();
        return view('user.profile', compact('user','customer', 'shippingAddress', 'billingAddress', 'countries'));
    }
    public function pwdUpdate(PasswordUpdateRequest $request){
        $passwordData = $request->validated();
         /** @var \App\Models\User $user */
         $user = Auth::user();
         $user->password = Hash::make($passwordData['password']);
         $user->save();
         return back()->with('message', 'Password  changed successfully!');
    }
}
