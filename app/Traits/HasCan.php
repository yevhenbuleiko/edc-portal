<?php

namespace App\Traits;


trait HasCan {
	public function getCanAttribute() {
		$currentUsr = request()->user();
		return [
			'view'   => $currentUsr->can('view', $this),
			'update' => $currentUsr->can('update', $this),
			'delete' => $currentUsr->can('delete', $this),
		];
	}
}