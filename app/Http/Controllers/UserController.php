<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Request;

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
     * @var Request
     */
    private $request;


    /**
     * UserController constructor.
     * @param User $user
     * @param Request $request
     */
    public function __construct(User $user, Request $request)
    {
        $this->user = $user;
        $this->request = $request;
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function readAll()
    {
        $this->authorizeForUser($this->request->user(), 'readAll', User::class);
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
