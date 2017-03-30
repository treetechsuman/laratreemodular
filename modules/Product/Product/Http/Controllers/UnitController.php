<?php 

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Product\Repositories\UnitRepository;


class UnitController extends Controller{
	private $unitRepo;

	public function __construct(
		UnitRepository $unitRepo
	){
		$this->unitRepo = $unitRepo;
	}

	public function index(){
		$units = $this->unitRepo->getAllUnit();
		return view('product::unit.index',compact('units'));
	}

	public function create(){
		return view('product::unit.create');
	}

	public function store(Request $request){
		$this->unitRepo->createUnit($request->all());
		return redirect('admin/product/unit');
	}

	public function show(){
		return view('product::unit.show');
	}

	public function edit($id){
		$unit = $this->unitRepo->getUnitById($id);
		return view('product::unit.edit',compact('unit'));
	}

	public function update($id ,Request $request){
		$this->unitRepo->updateUnit($id,$request->all());
		return redirect('admin/product/unit');
	}

	public function delete($id){
		$this->unitRepo->deleteUnit($id);
		return redirect('admin/product/unit');
	}

}