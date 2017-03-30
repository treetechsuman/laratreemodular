<?php 
namespace Modules\Product\Repositories;

use Modules\Product\Entities\Category;
use DB;
use Image;

class CategoryEloquent implements CategoryRepository{
	private $category;
	private $my_data;

	public function __construct(Category $category){
		$this->category = $category;
	}
	public function getAllCategory(){
		$data = array();
		$categories =  $this->category->all();
		foreach($categories as $category){
			$category['parent']=$this->getParentNameById($category['parent_id']);
			array_push($data, $category);
		}
		return $data;
	}

	public function getCategoryById($id){
		return $this->category->findorfail($id);
	}

	public function createCategory(array $attributes){
		if(array_key_exists('image', $attributes)){
			$path = $this->uploadImage($attributes['image']);
			$attributes['image']=$path;
		}
		return $this->category->create($attributes);
	}

	public function updateCategory($id,array $attributes){
		if(array_key_exists('image', $attributes)){
			$category = $this->category->findorfail($id);
			//delete image
			if($category['image']!='' && file_exists($category['image'])){ 				
				unlink($category['image']);
			}
			$path = $this->uploadImage($attributes['image']);
			$attributes['image']=$path;
		}
		return $this->category->findorfail($id)->update($attributes);
	}

	public function deleteCategory($id){
		$category = $this->category->findorfail($id);
		//delete image 
		if($category['image']!='' && file_exists($category['image'])){
			unlink($category['image']);
		}
		return $this->category->findorfail($id)->delete();
	}

	public function getCategoryTree(){
		//call the recursive function to print category listing
		$this->categoryTree(0);
		return $this->my_data;
	}
	//Recursive php function
	public function categoryTree($catid){
		$results = DB::table('categories')
			->where('parent_id','=',$catid)
			->select('categories.*')
			->get();
		
			foreach ($results as $result) {
				$i = 0;
				if ($i == 0){
				 	$this->my_data.= '<ul>';
				}
				$this->my_data .= '<li>' . $result['name'] . '<a href="' . 'category/delete/' . $result['id'] . '" class="btn btn-danger btn-xs"><i class="fa fa-fw fa-trash-o"></i></a>';
				$this->categoryTree($result['id']);
				$this->my_data .= '</li>';
				$i++;
				if ($i > 0){
					 $this->my_data .= '</ul>';
				}
			}
	}

	//this function are use for front end------
	public function getParentCategory(){
		return $this->category->where('parent_id','=',0)->get();
	}

	public function getChildCategory($parent_id){
		return $this->category->where('parent_id','=',$parent_id)->get();
	}

	public function getFrontendCategoryTree(){
		//call the recursive function to print category listing
		$this->categoryFrontendTree(0);
		return $this->my_data;
	}
	//Recursive php function
	public function categoryFrontendTree($catid){
		$results = DB::table('categories')
			->where('parent_id','=',$catid)
			->select('categories.*')
			->get();
		
			foreach ($results as $result) {
				$i = 0;
				if ($i == 0){
				 	$this->my_data.= '<ul>';
				}
				$this->my_data .= '<li><h5><a href="' . '/category/' . $result['id'] . '" >'. $result['name'] .'</a></h5>';
				$this->categoryFrontendTree($result['id']);
				$this->my_data .= '</li>';
				$i++;
				if ($i > 0){
					 $this->my_data .= '</ul>';
				}
			}
	}

	private function uploadImage($file){
		if($file){
			$extension = $file->getClientOriginalExtension();
			$filename= 'category'.md5(microtime()).'.'.$extension;
			$destinationPath= 'uploads/image/category/';
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
	public function getParentNameById($parent_id){
		if($parent_id!=0){
			$category=$this->category->where('id',$parent_id)->first();
			return $category['name'];
		}else{
			return '';
		}
	}

}