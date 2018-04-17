<?php 

namespace Modules\Package\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			 'category_id' => 'required', 
			 'title' => 'required', 
			 'description' => 'required', 
			 'image' => 'required', 
			 'hightlight' => 'required', 
			 'destination' => 'required', 
			 'duration' => 'required', 
			 'group_size' => 'required', 
			 'season' => 'required', 
			 'note' => 'required', 
			 'inclusion' => 'required', 
			 'exclusion' => 'required', 
			 'view_count' => 'required', 
			 'status' => 'required', 
		];
	}

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}
	
}