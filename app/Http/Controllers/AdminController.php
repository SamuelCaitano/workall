<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
  function disable($id) {
    return $this->model::where('id', $id)->delete();
  }

  function enable($id) {
    return $this->model::where('id', $id)->restore();
  }

	function save(Request $request) {
		$model = null;

		if ($request->get('id')) {
			$model = $this->model::find($request->get('id'));
		} else {
			$model = new $this->model;
		}

		if ($model) {
			$model->fill($request->all())->save();
		}

		return $model;
	}

  public function getBtnActionTmpl() {
		return [
			'headerName' => 'Ações',
			'maxWidth' => 160,
			'renderDoT' => '
				{{? it.data.deleted_at }}
					<div class="flex items-center justify-center h-10">
						<button class="flex items-center justify-center w-6 h-6 rounded mx-1 bg-blue-600 text-white hover:bg-gray-400" onClick="actionDisableEnable(1, \'{{=it.data.id}}\', {{=it.rowIndex}})"><i class="fa-solid fa-trash-arrow-up"></i></button>
					</div>
				{{??}}
					<div class="flex items-center justify-center h-10">
						<button class="flex items-center justify-center w-6 h-6 rounded mx-1 bg-red-600 text-white hover:bg-gray-400" onClick="actionDisableEnable(0, \'{{=it.data.id}}\', {{=it.rowIndex}})"><i class="fa-solid fa-trash-can"></i></button>
						<button class="flex items-center justify-center w-6 h-6 rounded mx-1 bg-green-400 text-white hover:bg-gray-400" type="button" onclick="actionForm({{=it.rowIndex}})"><i class="fa-solid fa-pencil"></i></button>
					</div>
				{{?}}
			',
		];
	}  
}