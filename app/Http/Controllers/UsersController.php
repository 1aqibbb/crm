<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {

        return $dataTable->render('users.index');
    }
    public function destroy($id)
    {

        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
