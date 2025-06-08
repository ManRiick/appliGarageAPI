<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    /**
     * Handle the incoming request.
     */
   public function index(Request $request)
    {
        // Get all users
        $users = User::all();

        // Return the users as a JSON response
        return response()->json($users);
    }
    public function getAllUsers()
    {
        // Get all users
        $users = User::all();

        // Return the users as a JSON response
        return response()->json($users);
    }

}