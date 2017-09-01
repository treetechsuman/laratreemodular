<?php

namespace Modules\User\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Modules\User\Repositories\RolePermissionRepository;
use Modules\User\Repositories\UserRepository;
use Auth;
use Session;

class SuperAdminMiddleware
{
    private $userRepo;
    private $rolePermissionRepo;

    public function __construct(
                                UserRepository $userRepo,
                                RolePermissionRepository $rolePermissionRepo
    ){
        $this->userRepo = $userRepo;
        $this->rolePermissionRepo = $rolePermissionRepo;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $role = $this->rolePermissionRepo->getRoleByName('SuperAdmin');
        if(!$this->userRepo->checkUserHasRole(Auth::user()['id'],$role['id'])){
            Session::flash('error','You do not have Permission');
            return back();
        }
        //dd($role);
        return $next($request);
    }
}
