<?php
use App\User;
use Illuminate\Support\Facades\Auth;

function admin(): User
{  
   return Auth::guard('admin')->user();
}
function user():User
{
   return Auth::guard('web')->user();
}