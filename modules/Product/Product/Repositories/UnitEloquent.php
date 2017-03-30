<?php 
namespace Modules\Product\Repositories;

use Modules\Product\Entities\Unit;

class UnitEloquent implements UnitRepository{
	private $unit;

	public function __construct(Unit $unit){
		$this->unit = $unit;
	}
	public function getAllUnit(){
		return $this->unit->all();
	}

	public function getUnitById($id){
		return $this->unit->findorfail($id);
	}

	public function createUnit(array $attributes){
		return $this->unit->create($attributes);
	}

	public function updateUnit($id,array $attributes){
		return $this->unit->findorfail($id)->update($attributes);
	}

	public function deleteUnit($id){
		return $this->unit->findorfail($id)->delete();
	}

}