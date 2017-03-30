<?php 
namespace Modules\Product\Repositories;

interface ProductRepository {

	function getAllProduct();

	function getProductById($id);

	function createProduct(array $attributes);

	function updateProduct($id, array $attributes);

	function deleteProduct($id);

	function getAllProductAttribute();

	function getProductAttributeById($id);

	function createProductAttribute(array $attributes);

	function updateProductAttribute($id, array $attributes);

	function deleteProductAttribute($id);

	function getAllProductAttributeValue();

	function getProductAttributeValueById($id);

	function createProductAttributeValue(array $attributes);

	function updateProductAttributeValue($id, array $attributes);

	function deleteProductAttributeValue($id);

	function getAllProductImage();

	function getProductImageById($id);

	function createProductImage(array $attributes);

	function updateProductImage($id, array $attributes);

	function deleteProductImage($id);

	function getCategoryTree();

	function getProductDetails($product_id);

	function getAttributeByProduct($product_id);

	function getValueByProduct($product_id);

}
