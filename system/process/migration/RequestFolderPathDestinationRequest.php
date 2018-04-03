<?php 

namespace Modules\Package\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DestinationRequest extends FormRequest
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
			 'image' => 'required', 
			 'description' => 'required', 
			 'latitude' => 'required', 
			 'longitude' => 'required', 
			 'display_order' => 'required', 
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