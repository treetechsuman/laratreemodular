<?php 

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Product\Repositories\CategoryRepository;


class CategoryController extends Controller{
	private $categoryRepo;

	public function __construct(
		CategoryRepository $categoryRepo
	){
		$this->categoryRepo = $categoryRepo;
	}

	public function index(){
		$category_tree = $this->categoryRepo->getCategoryTree();
		$categorys = $this->categoryRepo->getAllCategory();
		return view('product::category.index',compact('categorys','category_tree'));
	}

	public function create(){
		$category_tree = $this->categoryRepo->getCategoryTree();
		$categories = $this->categoryRepo->getAllCategory();
		return view('product::category.create',compact('categories','category_tree'));
	}

	public function store(Request $request){
		$this->categoryRepo->createCategory($request->all());
		return redirect('admin/product/category');
	}

	public function show(){
		return view('product::category.show');
	}

	public function edit($id){
		$category_tree = $this->categoryRepo->getCategoryTree();
		$categories = $this->categoryRepo->getAllCategory();
		//return $categories;
		$category = $this->categoryRepo->getCategoryById($id);
		return view('product::category.edit',compact('category','categories','category_tree'));
	}

	public function update($id ,Request $request){
		$this->categoryRepo->updateCategory($id,$request->all());
		return redirect('admin/product/category');
	}

	public function delete($id){
		$this->categoryRepo->deleteCategory($id);
		return redirect('admin/product/category');
	}

}