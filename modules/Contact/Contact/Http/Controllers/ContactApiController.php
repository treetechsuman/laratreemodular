<?php

namespace Modules\Contact\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Contact\Repositories\ContactRepository;
use Modules\Contact\Entities\Contact;

class ContactApiController extends Controller
{
    private $contactRepo;

    public function __construct(ContactRepository $contactRepo)
    {
        $this->contactRepo = $contactRepo;
    }

    public function apiGetContact(){
      $contacts = $this->contactRepo->getAll();
      $result = $this->structureResponce($contacts);
      return response()->json($result);
    }
    function getContactByGroupId($group_id){
      $result = $this->contactRepo->getContactByGroupId($group_id);
      $result = $this->structureResponce($result);
      return response()->json(['result'=>$result],200);
    }
    function apiGetContactById($contact_id){
      $result = $this->contactRepo->getContactById($contact_id);
      //$result = $this->structureResponce($result);
      return response()->json($result);
    }

    public function structureResponce($contacts){
      $result = array();
      foreach ($contacts as $contact) {
        $response['name'] = $contact['first_name'] .' '. $contact['middle_name'] .' '. $contact['last_name'];
        $response['number'] = $contact['phone'];
        $response['email'] = $contact['email'];
        array_push($result,$response);
      }
      return $result;
    }


}
