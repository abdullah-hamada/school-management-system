<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Grade;

class UserController extends Controller
{
    public function index()
  {
      $Users = User::all();
    return view('pages.Users.Users',compact('Users'));
  }
}
