<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    
    use AuthenticatesUsers;

    public function username()
    {
        return 'correo';
    }

    protected $redirectTo = '/dashboard'; // Usamos la ruta nombrada 'dashboard' definida en web.php

    //construct
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}