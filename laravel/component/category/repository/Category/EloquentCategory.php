<?php 
namespace App\Repositories\Category;

use App\Model\category;
use App\User;
use Auth;
use DB;
class EloquentCategory implements CategoryRepository{
	/**
	 * var $model
	 */
	private $category;

	private $user;
	private $my_data;

	public function __construct(Category $category,User $user){
		$this->category = $category;
		$this->user = $user;
	}

	public function getAll(){
		return $this->category->all();		
		
	}
	public function getCategoryTree(){
		//return $this->category->all();		
		
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

	public function getById($id){
		return $this->category->findorfail($id);
	}

	public function create(array $attribute){
		//create category
		if($attribute['parent_id']==0){
			$attribute['parent_id']=0;
		}
		return $this->category->create($attribute);	
	}

	public function update($id,array $attribute){
		return $this->category->find($id)->update($attribute);
	}

	public function delete($id){
		return $this->category->find($id)->delete($id);
	}	
}