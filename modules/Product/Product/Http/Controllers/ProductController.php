<?php 

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Product\Repositories\ProductRepository;
use Modules\Product\Repositories\CategoryRepository;
use Session;


class ProductController extends Controller{
	private $productRepo;
	private $categoryRepo;

	public function __construct(
		ProductRepository $productRepo,
		CategoryRepository $categoryRepo
	){
		$this->productRepo = $productRepo;
		$this->categoryRepo = $categoryRepo;
	}

	public function index(){
		$productdetails = $this->productRepo->getProductDetails(Session::get('product_id'));
		$category_tree = $this->productRepo->getCategoryTree();
		$categories = $this->categoryRepo->getAllCategory();
		if(Session::get('category_id')){
            $products = $this->productRepo->getProductByCategory(Session::get('category_id'));
        }else{
             $products = $this->productRepo->getAllProduct();
        }
        if(Session::get('product_id')){
            $productattributes = $this->productRepo->getAttributeByProduct(Session::get('product_id'));
            $attributevalues = $this->productRepo->getValueByProduct(Session::get('product_id'));
        }else{
            $productattributes=array();
            $attributevalues=array();
        }   
		//$products = $this->productRepo->getAllProduct();
		return view('product::product.index',compact(
			'category_tree',
			'products',
			'categories',
			'productattributes',
            'attributevalues',
            'productdetails'
			));
	}

	public function create(){
		$categories = $this->categoryRepo->getAllCategory();
		return view('product::product.create',compact('categories'));
	}

	public function store(Request $request){
		$this->productRepo->createProduct($request->all());
		return redirect('admin/product/product');
	}

	public function show(){
		return view('product::product.show');
	}

	public function edit($id){
		$categories = $this->categoryRepo->getAllCategory();
		$product = $this->productRepo->getProductById($id);
		return view('product::product.edit',compact('product','categories'));
	}

	public function update($id ,Request $request){
		$this->productRepo->updateProduct($id,$request->all());
		return redirect('admin/product/product');
	}

	public function delete($id){
		$this->productRepo->deleteProduct($id);
		return redirect('admin/product/product');
	}

	public function pushCategoryToSession($id){
        //session()->flash('category_id', $id);
        session()->put('category_id', $id);
        session()->put('product_id', '');
        session()->put('product_attribute_id', '');
        session()->flash('success', 'Category is Selected');
        return back();
    }

    public function pushProductToSession($id){
        //session()->flash('category_id', $id);
        session()->put('product_id', $id);
        session()->flash('success', 'Product is Selected');
        return back();
    }

    public function pushAttributeToSession($id){
        //session()->flash('category_id', $id);
        session()->put('product_attribute_id', $id);
        session()->flash('success', 'Attribute is Selected');
        return redirect('admin/product');
    }

	public function storeAttribute(Request $request){
		$this->productRepo->createProductAttribute($request->all());
		return redirect('admin/product/product');
	}

	public function editAttribute($id){
		$productAttribute = $this->productRepo->getProductAttributeById($id);
		$products = $this->productRepo->getAllProduct($id);
		return view('product::product.edit_attributes',compact('products','productAttribute'));
	}

	public function updateAttribute($id,Request $request){
		$this->productRepo->updateProductAttribute($id,$request->all());
		return redirect('admin/product/product');
	}

	public function deleteAttribute($id){
		$this->productRepo->deleteProductAttribute($id);
		return redirect('admin/product/product');
	}

	public function storeAttributeValue(Request $request){
		//return $request->all();
		$this->productRepo->createProductAttributeValue($request->all());
		return redirect('admin/product/product');
	}

	public function deleteAttributeValue($id){
		//return $request->all();
		$this->productRepo->deleteProductAttributeValue($id);
		return redirect('admin/product/product');
	}

	public function createProductImage(Request $request){
        /*print_r($request->file('image'));
        return $request->all();*/
        if($this->productRepo->createProductImage($request->all())){
            session()->flash('success', 'Image is added For this Product');
            return redirect('admin/product/product');
        }
        session()->flash('error', 'Image is Not added For this Product');
        return redirect('admin/product/product');
    }

    public function deleteProductImage($id){
        if($this->productRepo->deleteProductImage($id)){
            session()->flash('success', 'Image is deleted For this Product');
            return redirect('admin/product/product');
        }
        session()->flash('error', 'Image is Not deleted For this Product');
        return redirect('admin/product/product');
    }

}