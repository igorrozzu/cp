<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\CinemaSeat;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Symfony\Component\HttpFoundation\Request;

class CinemaController extends Controller
{
    /**
     *
     */
    const CINEMAS_PER_PAGE = 9;

    /**
     * @var Cinema
     */
    private $cinema;

    /**
     * @var Request
     */
    private $request;


    /**
     * CinemaController constructor.
     * @param Cinema $cinema
     * @param Request $request
     */
    public function __construct(Cinema $cinema, Request $request)
    {
        $this->cinema = $cinema;
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function readAll()
    {
        return $this->cinema->paginate(self::CINEMAS_PER_PAGE);
    }

    /**
     * @param Cinema $cinema
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function showingMovies(Cinema $cinema)
    {
        return $cinema->showingMovies()->get();
    }

    /**
     * @param Cinema $cinema
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function reviews(Cinema $cinema)
    {
        return $cinema->reviews()->with(['user' => function(HasOne $b) {
            $b->select(['id', 'login']);
        }])->get();
    }
}
