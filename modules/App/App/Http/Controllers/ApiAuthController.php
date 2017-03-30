<?php

namespace Modules\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Repositories\AppRepository;
use Modules\App\Repositories\JwtAuthRepository;
use Modules\Permission\Repositories\PermissionRepository;
use Session;


class ApiAuthController extends Controller
{
    private $appRepo;
    private $permissionRepo;
    private $jwtAuthRepo;
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function __construct(AppRepository $appRepo,PermissionRepository $permissionRepo, JwtAuthRepository $jwtAuthRepo)
    {
        $this->appRepo = $appRepo;
        $this->permissionRepo = $permissionRepo;
        $this->jwtAuthRepo = $jwtAuthRepo;
    }
    
    public function getToken(Request $request){
      $credentials['app_key'] = $request->input('app_key');
      $credentials['app_secret'] = $request->input('app_secret');
      $token =  $this->jwtAuthRepo->attempt($credentials);
      if(!$token){
        return response()->json(['error' => 'app is not registered'],404);
      }
      return response()->json(['token' => $token]);
    }
    public function getAppByToken(Request $request){
      $token = $request->header('token');
      $app = $this->jwtAuthRepo->getAppByToken($token);
      return response()->json(['result' => $app]);
    }



}
