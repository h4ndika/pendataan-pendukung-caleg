<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

class LoginWebController extends Controller
{
    public function index()
    {
        $data = array
		(
			'title' => 'Login - '.config('app.name', 'Laravel')
		);
        return View::make('login', $data);
    }

    public function logout()
    {
        echo '<script>
        localStorage.clear();
        window.location = "'.url('').'"
        </script>';
    }
}
