<?php 
namespace App\Repositories\Category;

interface CategoryRepository {
	function getAll() ;

	function getById($id) ;

	function create(array $attributes);

	function update($id, array $attributes);

	function delete($id);

	function getCategoryTree();

}