<?php

namespace App\Http\Controllers\Needs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NeedsregisterControllers extends Controller
{
    public function needsregister()
    {
        return view('needs.needsregister');
    }
}
