<?php 
namespace Modules\User\Repositories;

use Modules\User\Entities\UserDetail;
use Image;

class UserDetailEloquent implements UserDetailRepository{
	private $userdetail;

	public function __construct(UserDetail $userdetail){
		$this->userdetail = $userdetail;
	}
	public function getAllUserDetail(){
		return $this->userdetail->all();
	}

	public function getUserDetailById($id){
		return $this->userdetail->findorfail($id);
	}
	public function getUserDetailByUserId($id){
		return $this->userdetail->where('user_id',$id)->first();
	}

	public function createUserDetail(array $attributes){
		if(array_key_exists('image', $attributes)){
			$path = $this->uploadImage($attributes['image']);
			$attributes['image']=$path;
		}
		return $this->userdetail->create($attributes);
	}

	public function updateUserDetail($id,array $attributes){
		if(array_key_exists('image', $attributes)){
			$userdetail = $this->userdetail->findorfail($id);
			//delete image
			if($userdetail['image']!='' && file_exists($userdetail['image'])){ 				
				unlink($userdetail['image']);
			}
			$path = $this->uploadImage($attributes['image']);
			$attributes['image']=$path;
		}
		return $this->userdetail->findorfail($id)->update($attributes);
	}

	public function deleteUserDetail($id){
		$userdetail = $this->userdetail->findorfail($id);
		//delete image 
		if($userdetail['image']!='' && file_exists($userdetail['image'])){
			unlink($userdetail['image']);
		}
		return $this->userdetail->findorfail($id)->delete();
	}

	private function uploadImage($file){
		if($file){
			$extension = $file->getClientOriginalExtension();
			$filename= 'userdetail'.md5(microtime()).'.'.$extension;
			$destinationPath= 'uploads/image/userdetail/';
			$file->move($destinationPath,$filename);
			Image::make($destinationPath.$filename)
                ->resize( 200, 200 )//note width x height		
                ->text('water',100,100,function($font) {
								    //$font->file('foo/bar.ttf');
								    $font->size(200);
								    $font->color(array(255, 255, 255, 0.5));
								    $font->align('center');
								    $font->valign('top');
								    $font->angle(45);
								})
                ->save($destinationPath.$filename);    	
    	}
    	return $destinationPath.$filename;

	}

}