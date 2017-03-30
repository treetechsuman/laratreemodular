<?php

namespace Modules\Client\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Client\Repositories\ClientRepository;

class ApiClientController extends Controller
{
    private $clientRepo;

    //protected $redirectTo = 'auth/home';

    public function __construct(ClientRepository $clientRepo)
    {
        $this->clientRepo = $clientRepo;
        //$this->middleware('auth');
        
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $clients =  $this->clientRepo->getAll();
        $cleintData = $this->preparedClient($clients);
        $response = [
            'clients' => $cleintData
        ];
        return response()->json($response,200);
        //return view('client::index',compact('clients'));
    }
    public function getClient(Request $request){
        if(!$this->clientRepo->authMe($request->all())){
            $response = [
                'error ' => 'We dont find this client'
            ];
            return response()->json($response,404);
        }
        $client = $this->clientRepo->getClient($request->all());
        $response = [
                        'client' => $client
                    ];
        return response()->json($response,200);
    }
    
    private function preparedClient($clients){
        $result = array();
        foreach($clients as $client){
            $temp = array();
            $temp['id']=$client['id'];
            $temp['name']=$client['name'];
            $temp['email']=$client['email'];
            $temp['password']=$client['password'];
            $temp['address']= $client['address'];
            $temp['slag']= $client['slag'];
            array_push($result, $temp);
        }
        return $result;
    }
    public function getClientBySlag($slag)
    {
        $clients =  $this->clientRepo->getClientBySlag($slag);
        $cleintData = $clients;
        $response = [
            'clients' => $cleintData
        ];
        return response()->json($response,200);
        //return view('client::index',compact('clients'));
    }
    
}
