<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\CinemaSeat;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Symfony\Component\HttpFoundation\Request;

class SeatController extends Controller
{
    /**
     * @var CinemaSeat
     */
    private $cinemaSeat;

    /**
     * @var Request
     */
    private $request;

    /**
     * SeatController constructor.
     * @param CinemaSeat $cinemaSeat
     * @param Request $request
     */
    public function __construct(CinemaSeat $cinemaSeat, Request $request)
    {
        $this->cinemaSeat = $cinemaSeat;
        $this->request = $request;
    }


    /**
     * @param Cinema $cinema
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function freeSeats(Cinema $cinema)
    {
        return $this->cinemaSeat->with(['booking' => function(HasOne $b) {
            $b->where('seanceId', $this->request->get('seanceId'));
        }])->where('cinemaId', $cinema->id)->get();
    }
}
