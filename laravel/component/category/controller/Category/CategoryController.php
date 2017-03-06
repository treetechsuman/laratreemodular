<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepository;
use Auth;
use Session;

class CategoryController extends Controller
{
	private $categoryRepo;

	public function __construct(CategoryRepository $categoryRepo){
		$this->categoryRepo = $categoryRepo;
	}
    public function index(){
        $categories = $this->categoryRepo->getAll();
        $categorytree = $this->categoryRepo->getCategoryTree();
    	return view('backend.category.index',compact('categories','categorytree'));
    }
    public function create(Request $request){
    	$input = $request->all();
    	$this->categoryRepo->create($input);      
        return redirect('admin/category');
    }

    public function delete($id){
        $this->categoryRepo->delete($id);
        return redirect('admin/category');
    }
    public function pushCategoryToSession($id){
        //session()->flash('category_id', $id);
        session()->put('category_id', $id);
        session()->flash('success', 'Category is Selected');
        return back();
    }

}
