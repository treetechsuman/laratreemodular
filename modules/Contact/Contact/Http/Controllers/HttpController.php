<?php
namespace Modules\Contact\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Illuminate\Routing\Controller;
//use Modules\Contact\Entities\Contact;
//use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class HttpController extends Controller
{
	public function httpGetRequest(){
		$client = new Client();
		$response = $client->post('http://dashboard.socialaves.com/api/auth/register',
               ['json' => [
                   "id" =>'123456',
                   "name" => 'arun',
                   "email" => 'dadekoroti@gmail.com',
                   "provider" => 'google',
               ]]); 
		//$response = $client->get('http://localhost:8000/api/contact');
		return response()->JSON(['result'=>$response->getBody()],200);
		//$response = $client->request('GET', 'test');
		// Send a request to https://foo.com/root
		//$response = $client->request('GET', '/root');
		
	}

}