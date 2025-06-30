<?php
namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all(); // Retrieve all roles from the database
        // dd($roles); // Dump the variable to see its content

        return view('roles.index', compact('roles'));
    }
}
