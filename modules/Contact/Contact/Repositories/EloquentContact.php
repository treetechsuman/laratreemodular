<?php
namespace Modules\Contact\Repositories;

use Modules\Contact\Entities\Group;
use Modules\Contact\Entities\Contact;
use Modules\Auth\Entities\Verification;
use Session;
use Hash;
use DB;
use Illuminate\Support\Facades\Auth;


/**
*
*/
class EloquentContact implements ContactRepository
{
	private $group;
	private $contact;
	public function __construct(Group $group,Contact $contact)
	{
		$this->group = $group;
		$this->contact = $contact;

	}


	public function createGroup(array $attriutes){
		//return Auth::id();
		$attriutes['user_id'] = Auth::id();
		$attriutes['status'] = 'active';
		return $this->group->create($attriutes);
		//return true;
	}
	function uploadCSV(array $attributes){
		if(Input::hasFile('contacts')){
            $path = Input::file('contacts')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
                //print_r($data->toArray());
                foreach ($data as $key => $value) {
                    $insert[] = ['email' => $value->email,'name' => $value->name];

                }
     		}
        }
        return $insert;
	}

	public function getAll()
	{
		return $this->contact->all();
	}

		function getContactByGroupId($group_id){
			return $this->contact->where('group_id', $group_id)->get();
		}

		function getContactById($contact_id){
				return $this->contact->where('id', $contact_id)->first();

		}
		function changeGroupOfContacts($old_id,$new_id){
			$contacts = $this->contact->where('group_id',$old_id)->get();
			//$result = new Contact();
			if($contacts){
				foreach ($contacts as $contact) {
					$contactData= array();
					$contactData['group_id'] = $new_id;
					$this->contact->findorfail($contact['id'])->update($contactData);
				}
			}
			//return $this->contact->where('group_id',$new_id)->get();
			Group::where('id',$old_id)->delete();
			
			//return $contacts ;
		}

}
