<?php 
namespace Modules\Product\Repositories;

interface CategoryRepository {

	function getAllCategory();

	function getCategoryById($id);

	function createCategory(array $attributes);

	function updateCategory($id, array $attributes);

	function deleteCategory($id);

	function getCategoryTree();

}
