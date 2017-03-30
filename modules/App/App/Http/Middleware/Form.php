<?php

namespace Modules\App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Modules\App\Repositories\JwtAuthRepository;

class Form
{
    private $jwtAuthRepo;
    public function __construct(JwtAuthRepository $jwtAuthRepo)
    {
        $this->jwtAuthRepo = $jwtAuthRepo;
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
        //check does app has form permission-----
        //this checkAppPermission take two parm (token and permission_id)
        $appFlag = $this->jwtAuthRepo->checkAppPermission($request->header('token'),1);
        if(!$appFlag){
          return response()->json(['error'=>'This app does not have permission to access Form Module'],401);
        }
        //now here check client has permission or not-----------------
        //checkClientPremission take client_id and permission_id
        $clientFlag= $this->jwtAuthRepo->checkClientPermission($request->header('clientid'),1);
        if(!$clientFlag){
          return response()->json(['error'=>'This Client does not have permission to access Form Module'],401);
        }
        return $next($request);
    }
}
