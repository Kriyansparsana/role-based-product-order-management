<?php

namespace App\Http\Controllers;

use App\Models\c;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Session;
use Spatie\Permission\Models\Role;
use Validator;
use function Laravel\Prompts\select;
use function PHPUnit\Framework\returnArgument;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("register");
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:6",
            "role_select" => "required|in:user,admin"
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->role_select == "admin") {
            return back()->with("restrict", "You cannot register from here.");
        }

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "role" => $request->role_select,
        ]);


        Auth::login($user);

        return redirect()->route("login")->with("success", "You have registered successfully, please login from here");

    }


    public function loginForm()
    {
        return view("login");
    }

    public function userLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email",
            "password" => "required|min:6",
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (!Auth::attempt(["email" => $request->email, "password" => $request->password])) {
            return back()->with("error", "The credentials not matched with this email");
        }

        if (Auth::user()->role == "user") {
            $request->session()->regenerate();
            $user = Auth::user();
            $user->assignRole('user');
            $role = Role::findByName('user');
            $role->givePermissionTo('create-order');
            return redirect()->route("user.dashboard")->with("success", "You have logged In successfully");
        } else {
            $user = Auth::user();
            $user->assignRole('admin');
            $role = Role::findByName('admin');
            $role->givePermissionTo('create-products');
            $role->givePermissionTo('edit-products');
            $role->givePermissionTo('delete-products');
            $role->givePermissionTo('view-order');

            return redirect()->route("admin.dashboard")->with("success", "You have logged In successfully");
        }
    }

    public function dashboard()
    {
        return view("user-dashboard");
    }

    public function admindashboard()
    {
        return view("admin-dashboard");
    }


    public function logout()
    {
        Auth::logout();
        Session::flush();

        return redirect()->route("login");
    }
}
