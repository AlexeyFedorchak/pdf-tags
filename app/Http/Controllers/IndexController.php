<?php

/**
 * Class namespace
 */
namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Controller for main view
 *
 * Class IndexController
 * @package App\Http\Controllers
 */
class IndexController extends Controller
{
    /**
     * return main view
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('index');
    }
}
