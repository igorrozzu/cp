<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\MovieShowing;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * @var MovieShowing
     */
    private $movieShowing;

    /**
     * @var Booking
     */
    private $booking;

    /**
     * @var Request
     */
    private $request;

    /**
     * BookingController constructor.
     * @param Request $request
     * @param MovieShowing $movieShowing
     * @param Booking $booking
     */
    public function __construct(Request $request, MovieShowing $movieShowing, Booking $booking)
    {
        $this->movieShowing = $movieShowing;
        $this->booking = $booking;
        $this->request = $request;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function readAll()
    {
        return $this->movieShowing
            ->with(['cinema', 'seances'])
            ->where('movieId', $this->request->get('movieId'))
            ->get();
    }

    /**
     *
     */
    public function bookSeat()
    {
        /**
         * @var Booking $booking
         */
        $booking = $this->booking->newInstance()
        $booking->save();
    }
}
