<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests;
use Illuminate\Pagination\LengthAwarePaginator;

class UserController extends Controller
{
    /**
     *
     */
    const USERS_PER_PAGE = 9;

    /**
     * @var User
     */
    private $user;

    /**
     * UserController constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function readAll()
    {
        /**
         * @var LengthAwarePaginator $paginator
         */
        $paginator =  $this->user->paginate(self::USERS_PER_PAGE);

        return $this->formatResponse($paginator);
    }

    /**
     * @param Requests\User $request
     */
    public function register(Requests\User $request)
    {
        /**
         * @var User $user
         */
        $user =  $this->user->newInstance();
        $user->login = $request->login;
        $user->email = $request->email;
        $user->password = bcrypt($request->password, ['rounds' => env('BCRYPT_ROUNDS')]);
        $user->creditCard = $request->creditCard;
        $user->phoneNumber = $request->phoneNumber;
        $user->save();
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
