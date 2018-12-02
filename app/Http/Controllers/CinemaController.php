<?php

namespace App\Http\Controllers;

use App\Models\Cinema;

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
     * CinemaController constructor.
     * @param Cinema $cinema
     */
    public function __construct(Cinema $cinema)
    {
        $this->cinema = $cinema;
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
        return $cinema->reviews()->with('userSecure')->get();
    }
}
