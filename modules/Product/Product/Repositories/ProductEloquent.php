<?php 
namespace Modules\Product\Repositories;

use Modules\Product\Entities\Product;
use Modules\Product\Entities\Product_attribute;
use Modules\Product\Entities\Product_attribute_value;
use Modules\Product\Entities\Product_image;
use DB;
use Session;
use Image;
class ProductEloquent implements ProductRepository{
	private $product;
	private $product_attribute;
	private $product_attribute_value;
	private $product_image;
	private $my_data;

	public function __construct(Product $product,Product_attribute $product_attribute,Product_attribute_value $product_attribute_value,Product_image $product_image){
		$this->product = $product;
		$this->product_attribute = $product_attribute;
		$this->product_attribute_value = $product_attribute_value;
		$this->product_image = $product_image;
	}
	public function getAllProduct(){
		return $this->product->all();
	}

	public function getProductById($id){
		return $this->product->findorfail($id);
	}

	public function createProduct(array $attributes){
		return $this->product->create($attributes);
	}

	public function updateProduct($id,array $attributes){
		return $this->product->findorfail($id)->update($attributes);
	}

	public function deleteProduct($id){
		return $this->product->findorfail($id)->delete();
	}

	public function getAllProductAttribute(){
		return $this->product_attribute->all();
	}

	public function getProductAttributeById($id){
		return $this->product_attribute->findorfail($id);
	}

	public function createProductAttribute(array $attributes){
		return $this->product_attribute->create($attributes);
	}

	public function updateProductAttribute($id,array $attributes){
		return $this->product_attribute->findorfail($id)->update($attributes);
	}

	public function deleteProductAttribute($id){
		return $this->product_attribute->findorfail($id)->delete();
	}

	public function getAllProductAttributeValue(){
		return $this->product_attribute_value->all();
	}

	public function getProductAttributeValueById($id){
		return $this->product_attribute_value->findorfail($id);
	}

	public function createProductAttributeValue(array $attributes){
		return $this->product_attribute_value->create($attributes);
	}

	public function updateProductAttributeValue($id,array $attributes){
		return $this->product_attribute_value->findorfail($id)->update($attributes);
	}

	public function deleteProductAttributeValue($id){
		return $this->product_attribute_value->findorfail($id)->delete();
	}

	public function getAllProductImage(){
		return $this->product_image->all();
	}

	public function getProductImageById($id){
		return $this->product_image->findorfail($id);
	}

	public function createProductImage(array $attributes){
		//return $this->product_image->create($attributes);
		foreach($attributes['image'] as $file){
			$path = $this->uploadImage($file);
			if($path){
				$data = array();
				$data['name']=$path;
				$data['caption']='merohospital';
				$data['product_id']=$attributes['product_id'];
				//$data['status']='active';
				//$data['user_id']=Auth::user()['id'];
				$this->product_image->create($data);
			}	
		
		}
		return true;
	}

	public function updateProductImage($id,array $attributes){
		return $this->product_image->findorfail($id)->update($attributes);
	}

	public function deleteProductImage($id){
		$image = $this->product_image->findorfail($id);
		//now delete file
		//return $image; 
		if(unlink($image['name'])){
			return $this->product_image->findorfail($id)->delete();
			return 'succes';
		}
		//return $this->product_image->findorfail($id)->delete();
	}

	private function uploadImage($file){
		if($file){
			//$extension = $attributes['image']->getClientOriginalExtension();
			$extension = $file->getClientOriginalExtension();
			$filename= 'product'.md5(microtime()).'.'.$extension;
			//$organization = $this->organization->where('id',Auth::user()['organization_id'])->select('id','name')->first();
			//$destinationPath= 'uploads/image/product/'.$organization['name'].'_'.$organization['id'].'/';
			$destinationPath= 'uploads/image/product/';
			//$attributes['image']->move($destinationPath,$filename);
			$file->move($destinationPath,$filename);
			Image::make($destinationPath.$filename)
                ->resize( 400, 500 )//note width x height		
                ->text('Suman',100,100,function($font) {
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

	public function getCategoryTree(){		
		//call the recursive function to print category listing
		$css_class='';
				if(Session::get('category_id')==0){
                  	 	$css_class='class="btn  btn-success btn-xs"';
                  	 }
                else{
						$css_class = 'class="btn  btn-default btn-xs"';
                }

		$this->my_data = '<ul><li><a href="product/pushcategory/0"' . $css_class . '">All</a></ul>';
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
				$css_class='';
				if(Session::get('category_id')==$result['id']){
                  	 	$css_class='class="btn  btn-success btn-xs"';
                  	 }
                else{
						$css_class = 'class="btn  btn-default btn-xs"';
                }

				$i = 0;
				if ($i == 0){
				 	$this->my_data.= '<ul>';
				}
				$this->my_data .= '<li><a href="' . 'product/pushcategory/' . $result['id'] . '"' . $css_class . '">' . $result['name'] . '</a>';
				$this->categoryTree($result['id']);
				$this->my_data .= '</li>';
				$i++;
				if ($i > 0){
					 $this->my_data .= '</ul>';
				}
			}
	}

	public function getProductByCategory($category_id){
		$products = DB::table('products')
			->where('category_id','=',$category_id)
			->select('products.*')
			->get();
		return $products;
	}
	public function getProductDetails($product_id){
		//make two dymantional array for parduct details
		$productdetails = array(
							'attributes'=>array(),
							'attributevalues'=>array(),
							'units'=>array(),
							'images'=>array()
							);
		//take product name and if from database						
		$products = DB::table('products')
				   	 ->where('products.id','=',$product_id)
				   	 ->select('products.*')
				   	 ->first();
		//add this id and name to array
		$productdetails['id']=$products['id'];
		$productdetails['name']=$products['name'];

		//find the units for this product		
			/*$units = DB::table('units')
				 ->join('category_units','category_units.unit_id','units.id')
				 ->where('category_units.category_id','=',$products['category_id'])
				 ->select('units.*','category_units.category_id')
				 ->get();
				 //$units = $units->toArray();
				 //
				 //$units = array_collapse($units);
				foreach($units as $unit){
					array_push($productdetails['units'], $unit);
				}*/

		//find the images for this product		
			$images = DB::table('product_images')
				 ->where('product_images.product_id','=',$product_id)
				 ->select('product_images.*')
				 ->get();
				foreach($images as $image){
					array_push($productdetails['images'], $image);
				}	
		
		//now take all attributes of this product
		$attributes = DB::table('product_attributes')
				   	 ->where('product_attributes.product_id','=',$product_id)
				   	 ->select('product_attributes.*')
				   	 ->get();
		//this foreach is to add attribute to productdetails array		
		foreach($attributes as $attribute){
			array_push($productdetails['attributes'], $attribute);
			//now take all value related to this attribute
			$attributevalues = DB::table('product_attribute_values')
				   	 ->where('product_attribute_values.product_attribute_id','=',$attribute['id'])
				   	 ->select('product_attribute_values.*')
				   	 ->get();
			//this for each is to add all value to productdetails array
			foreach($attributevalues as $attributevalue){
				array_push($productdetails['attributevalues'], $attributevalue);
			}	
		}
		return $productdetails;
	}
	public function getAttributeByProduct($product_id){
		$productattributes = DB::table('product_attributes')
			->where('product_id','=',$product_id)
			->select('product_attributes.*')
			->get();
		return $productattributes;
	}

	public function getValueByProduct($product_id){
		$productattributes = DB::table('product_attributes')
			->join('product_attribute_values','product_attribute_values.product_attribute_id','product_attributes.id')
			->where('product_id','=',$product_id)
			->select('product_attribute_values.*')
			->get();
		return $productattributes;
	}

	public function getProductInCart(array $cart){
		$product_in_carts = array();
		if(!empty($cart)){
		$product_in_carts = DB::table('products')
								->whereIn('products.id',$cart)
								->select('products.*')
								->get();
							}
		//return $product_in_carts;
		$cart_product_details = array();
		foreach ($product_in_carts as $product_in_cart) {
			$temp = $this->getProductDetails($product_in_cart['id']);
			array_push($cart_product_details, $temp);			
		}
		$product_in_cart = $cart_product_details;
		//return $product_in_carts;
		return $cart_product_details;
	}



	//frontend function----------------
	public function getFeaturedProduct(){
		$featuredProduct= DB::table('products')
			->join('product_images','product_images.product_id','=','products.id')
			->select(
				'products.id',
				'products.name as product_name',
				'product_images.name as image_name'
				)
			->get();
		return $featuredProduct;
	}

	public function getFrontProductByCategory($category_id){
		$products= DB::table('products')
			->join('product_images','product_images.product_id','=','products.id')
			->select(
				'products.id',
				'products.name as product_name',
				'product_images.name as image_name'
				)
			->get();
		return $products;
	}

	public function getFrontProductById($product_id){
		$product= DB::table('products')
			->join('product_images','product_images.product_id','=','products.id')
			->where('products.id','=',$product_id)
			->select(
				'products.id',
				'products.name as product_name',
				'product_images.name as image_name'
				)
			->first();
		return $product;
	}


}