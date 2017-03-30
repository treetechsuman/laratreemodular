<?php
namespace Modules\Form\Repositories;

interface FormRepository {

	function getAll();

	function getById($id);

	function getFormByIdAndClientId($form_id,$client_id);

	function create(array $attributes);

	function update($id,array $attributes);

	function delete($id);

	function storeField(array $attributes);

	function fieldsByFormId($form_id);

	function deleteField($field_id);

	function getOptionByFieldId($field_id);

	function getFieldById($field_id);

	function deleteOption($option_id);

	function getOptionById($option_id);

	function updateOption($id,array $attributes);

	function formSubmit(array $attributes);

	function getFormSumissionByFormId($form_id);
	
	function getValueByFieldIdAndSubmissionId($field_id,$submission_id);

	function formsByClientId($client_id);
}