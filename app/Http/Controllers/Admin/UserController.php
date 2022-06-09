<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\UserModel;
use App\Models\UserProfileModel;
use Illuminate\Http\Request;

class UserController extends AdminController
{
  protected $model = UserModel::class;

  // listagem dos usuarios e atributos do form
  function list()
  {
    $baseUrl = '/admin/user';

    $list = $this->model::query()
      ->with(['userProfile'])
      ->withTrashed()
      ->get();

    $inputTailwind = 'h-10 pl-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md';

    return view('admin.pages.listDefault', [
      'data' => $list,
      'config' => [
        'title' => 'Usuário',
        'baseUrl' => $baseUrl,
        'payloadComboBox' => [
          'userProfile' => UserProfileModel::query()->orderBy('name')->get(['id', 'name']),
        ],
        'gridList' => [
          'rowData' => $list,
          'columns' => [
            ['headerName' => 'ID', 'field' => 'id', 'flex' => '30', 'sort' => 'asc'],
            ['headerName' => 'Nome', 'field' => 'name', 'flex' => '20'],
            ['headerName' => 'Username', 'field' => 'username', 'flex' => '20'],
            ['headerName' => 'E-mail', 'field' => 'email', 'flex' => '20'],
            ['headerName' => 'Perfil', 'field' => 'user_profile.name', 'flex' => '20'],
            $this->getBtnActionTmpl(),
          ],
        ],
        'form' => [
          'attrs' => [
            'name' => 'formUser',
            'action' => "{$baseUrl}/save",
            'method' => 'POST',
          ],
          'fields' => [
            [
              'attrs' => [
                'name' => 'id',
                'type' => 'hidden'
              ],
            ],
            [
              'label' => 'Nome',
              'attrs' => [
                'name' => 'name',
                'type' => 'text',
                'maxLength' => 255,
                'class' => $inputTailwind,
                'autocomplete' => 'none',
              ],
            ],
            [
              'label' => 'Username',
              'attrs' => [
                'name' => 'username',
                'type' => 'text',
                'maxLength' => 64,
                'class' => $inputTailwind,
                'autocomplete' => 'none',
              ],
            ],
            [
              'label' => 'E-mail',
              'attrs' => [
                'name' => 'email',
                'type' => 'email',
                'maxLength' => 255,
                'class' => $inputTailwind,
                'autocomplete' => 'none',
              ],
            ],
            [
              'label' => 'Perfil',
              'attrs' => [
                'name' => 'user_profile_id',
                'type' => 'select',
                'maxLength' => 255,
                'class' => $inputTailwind,
                'autocomplete' => 'none',
              ],
              'populate' => [
                'target' => 'userProfile',
                'label' => 'name',
              ],
            ],
          ],
        ],
      ],
    ]);
  }

  // funcao para salvar
  function save(Request $request) {
		$dataModel = (object) parent::save($request)->toArray();
		$dataModel->user_profile = UserProfileModel::find($dataModel->user_profile_id);

		return $dataModel;
	}
}
