<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Pagination\LengthAwarePaginator;

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
     * MovieController constructor.
     */
    public function __construct(Movie $movie)
    {
        $this->movie = $movie;
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
