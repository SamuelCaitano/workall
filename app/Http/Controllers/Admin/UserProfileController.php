<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Models\UserProfileModel;
use Illuminate\Http\Request;

class UserProfileController extends AdminController
{
  protected $model = UserProfileModel::class;

  function index()
  {
    return view('admin.pages.listDefault');
  }

  // listagem dos usuarios e atributos do form
  function list()
  {
    $list = $this->model::orderBy('name')->withTrashed()->get();
    $baseUrl = '/admin/userProfile';

    $inputTailwind = 'h-10 pl-2 mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md';

    return view('admin.pages.listDefault', [
      'config' => [
        'title' => 'Perfil de Usuário',
        'baseUrl' => $baseUrl,
        'gridList' => [
          'rowData' => $list,
          'columns' => [
            ['headerName' => 'ID', 'field' => 'id', 'flex' => '15'],
            ['headerName' => 'Nome', 'field' => 'name', 'flex' => '45'],
            ['headerName' => 'Nível', 'field' => 'level', 'flex' => '20'],
            $this->getBtnActionTmpl(),
          ],
        ],
        'form' => [
          'attrs' => [
            'name' => 'formUserProfile',
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
              'label' => 'Nome:',
              'attrs' => [
                'name' => 'name',
                'type' => 'text',
                'maxLength' => 255,
                'class' => $inputTailwind,
                'autocomplete' => 'none',
              ],
            ],
            [
              'label' => 'Nível:',
              'attrs' => [
                'name' => 'level',
                'type' => 'number',
                'min' => 1,
                'max' => 99,
                'class' => $inputTailwind,
                'autocomplete' => 'none',
              ],
            ],
          ],
        ],
      ],
    ]);
  }

  // funcao para salvar
  function save(Request $request)
  {
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
}
