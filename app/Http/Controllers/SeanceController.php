<?php

namespace App\Http\Controllers;

use App\Models\MovieShowing;
use App\Http\Requests;
use App\Models\Seance;
use Illuminate\Http\Request;

class SeanceController extends Controller
{
    /**
     * @var MovieShowing
     */
    private $movieShowing;

    /**
     * @var Seance
     */
    private $seance;

    /**
     * SeanceController constructor.
     * @param Seance $seance
     * @param MovieShowing $movieShowing
     */
    public function __construct(Seance $seance, MovieShowing $movieShowing)
    {
        $this->movieShowing = $movieShowing;
        $this->seance = $seance;
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

    /**
     * @param Requests\CreateSeance $request
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Requests\CreateSeance $request)
    {
        $this->authorizeForUser($request->user(), 'create', Seance::class);

        /**
         * @var Seance $seance
         */
        $seance = $this->seance->newInstance();
        $seance->cost = $request->cost;
        $seance->movieShowingId = $request->movieShowingId;
        $seance->showingDate = $request->showingDate;
        $seance->save();
    }
}
