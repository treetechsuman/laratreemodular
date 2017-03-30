<?php 
namespace Modules\Product\Repositories;

interface UnitRepository {

	function getAllUnit();

	function getUnitById($id);

	function createUnit(array $attributes);

	function updateUnit($id, array $attributes);

	function deleteUnit($id);

}
