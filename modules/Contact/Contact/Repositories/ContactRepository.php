<?php
namespace Modules\Contact\Repositories;

interface ContactRepository {
	function createGroup(array $attributes);
	function uploadCSV(array $attributes);
	function getAll();
	function getContactByGroupId($group_id);
	function getContactById($contact_id);
	function changeGroupOfContacts($old_id,$new_id);
}
