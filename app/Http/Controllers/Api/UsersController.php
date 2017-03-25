<?php namespace App\Http\Controllers\Api;

use App\Transformers\UsersTransformer;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function me()
    {
        return $this->respondWithItem(Auth::user(), new UsersTransformer);
    }
}
