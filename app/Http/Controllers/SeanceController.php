<?php

namespace App\Http\Controllers;

use App\Models\MovieShowing;
use App\Models\User;
use Illuminate\Http\Request;

class SeanceController extends Controller
{
    /**
     * @var MovieShowing
     */
    private $movieShowing;

    /**
     * MovieController constructor.
     */
    public function __construct(MovieShowing $movieShowing)
    {
        $this->movieShowing = $movieShowing;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function readAll(Request $request)
    {
        return $this->movieShowing
            ->with(['cinema', 'seances'])
            ->where('movieId', $request->get('movieId'))
            ->get();
    }
}
