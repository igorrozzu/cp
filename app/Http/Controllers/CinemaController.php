<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Http\Requests;
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

    /**
     * @param Requests\Cinema $request
     */
    public function create(Requests\Cinema $request)
    {
        /**
         * @var Cinema $cinema
         */
        $cinema = $this->cinema->newInstance();
        $cinema->address = $request->address;
        $cinema->manager = $request->manager;
        $cinema->name = $request->name;
        $cinema->phone = $request->phone;
        $cinema->save();
    }

    /**
     * @param Cinema $cinema
     * @param Requests\Cinema $request
     */
    public function update(Cinema $cinema, Requests\Cinema $request)
    {
        $cinema->address = $request->address;
        $cinema->manager = $request->manager;
        $cinema->name = $request->name;
        $cinema->phone = $request->phone;
        $cinema->save();
    }

    /**
     * @param Cinema $cinema
     * @return Cinema
     */
    public function getOne(Cinema $cinema)
    {
        return $cinema;
    }
}
