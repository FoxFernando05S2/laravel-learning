<?php 

declare(strict_types=1);

namespace Src\User\Infrastructure\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Src\User\Application\UseCase\GetUsers;

class UserController extends Controller
{
    public function __construct(
        private GetUsers $getUsersAll,
    ){

    }

    public function index()
    {
       $getUsers = $this->getUsersAll->execute();
       return new JsonResponse($getUsers);
    }
}