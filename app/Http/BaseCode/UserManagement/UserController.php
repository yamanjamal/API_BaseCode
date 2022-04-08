<?php

namespace App\Http\BaseCode\UserManagement;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ChangeRollRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Notifications\ActionNotification;
use Gate;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class UserController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users =User::with('roles')->where('id','!=',1)->get();
        return $this->sendResponse(UserResource::collection($users),'Users sent sussesfully');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function count()
    {
        $this->authorize('count', User::class);
        return User::count();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function info()
    {
        $user = User::with('roles.permissions')->where('id',auth()->user()->id)->get();
        return $this->sendResponse(UserResource::collection($users),'User info sent sussesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return $this->sendResponse(new UserResource($user),'User deleted sussesfully');
    }
}
