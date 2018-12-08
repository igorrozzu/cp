<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieShowing;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests;

class MovieController extends Controller
{
    /**
     *
     */
    const MOVIES_PER_PAGE = 9;

    /**
     * @var Movie
     */
    private $movie;

    /**
     * @var MovieShowing
     */
    private $movieShowing;

    /**
     * MovieController constructor.
     * @param MovieShowing $movieShowing
     * @param Movie $movie
     */
    public function __construct(MovieShowing $movieShowing, Movie $movie)
    {
        $this->movie = $movie;
        $this->movieShowing = $movieShowing;
    }

    /**
     * @return mixed
     */
    public function readAll()
    {
        /**
         * @var LengthAwarePaginator $paginator
         */
        $paginator = $this->movie->paginate(self::MOVIES_PER_PAGE);

        return $this->formatResponse($paginator);
    }

    /**
     * @return mixed
     */
    public function readAllShown()
    {
        /**
         * @var LengthAwarePaginator $paginator
         */
        $paginator = $this->movie->has('showingMovies')->paginate(self::MOVIES_PER_PAGE);

        return $this->formatResponse($paginator);
    }

    /**
     * @param Requests\Movie $request
     */
    public function create(Requests\Movie $request)
    {
        /**
         * @var Movie $movie
         */
        $movie = $this->movie->newInstance();
        $movie->duration = $request->duration;
        $movie->rating = $request->rating;
        $movie->name = $request->name;
        $movie->slogan = $request->slogan;
        $movie->description = $request->description;
        $movie->save();
    }

    /**
     * @param Movie $movie
     * @param Requests\Movie $request
     */
    public function update(Movie $movie, Requests\Movie $request)
    {
        $movie->duration = $request->duration;
        $movie->rating = $request->rating;
        $movie->name = $request->name;
        $movie->slogan = $request->slogan;
        $movie->description = $request->description;
        $movie->save();
    }

    /**
     * @param Movie $movie
     * @return Movie
     */
    public function getOne(Movie $movie)
    {
        return $movie;
    }

    /**
     * @param Movie $movie
     * @param Requests\ShownMovie $request
     */
    public function createShownMovie(Movie $movie, Requests\ShownMovie $request)
    {
        $movieShowing = $this->movieShowing->newInstance();
        $movieShowing->movieId = $movie->id;
        $movieShowing->cinemaId = $request->cinemaId;
        $movieShowing->showingFrom = (new Carbon($request->showingFrom))->format('m-d-Y');
        $movieShowing->showingTo = (new Carbon($request->showingTo))->format('m-d-Y');
        $movieShowing->save();
    }

    /**
     * @param LengthAwarePaginator $paginate
     * @return array
     */
    private function formatResponse(LengthAwarePaginator $paginate)
    {
        return [
            'data' => $paginate->items(),
            'meta' => [
                'limit' => $paginate->perPage(),
                'page' => $paginate->currentPage(),
                'count' => $paginate->total(),
                'pageCount' => $paginate->lastPage(),
            ]
        ];
    }
}
