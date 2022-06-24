@extends('admin.layouts.layout')
@section('title', $config['title'])

@push('css')
  <link rel="stylesheet" href="https://unpkg.com/ag-grid-community/dist/styles/ag-grid.css" /> 
  <link rel="stylesheet" href="https://unpkg.com/ag-grid-community/dist/styles/ag-theme-alpine.css" /> 
  <link rel="stylesheet" href="/plugins/jstree/themes/default/style.min.css">
@endpush

@section('content')
  <div class="h-full ">
    <div id="listDefault" class="ag-theme-alpine h-full"></div>
  </div>
  @include('admin.components.modal')
@endsection

@push('js')
  <script src="/plugins/jstree/jstree.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/ag-grid-community@27.3.0/dist/ag-grid-community.min.noStyle.js"></script>
  <script>
    const config = @json($config);
    document.addEventListener('DOMContentLoaded', () => {
      class HeaderComponent {
        init(params) {
          this.params = params
          this.eGui = document.createElement('div');
          this.eGui.className = 'flex flex-wrap items-center w-full'
          this.eGui.innerHTML = `
          <span class="flex-grow flex-1 dark:text-white">${config.title}</span> 
          <button onclick="actionForm()" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" >
            <i class="fa-solid fa-plus"></i>
          </button>
        `
        }

        getGui() {
            return this.eGui;
        }

        destroy() {
            console.log('HeaderComponent:destroy')
        }
      }

      const columns = config.gridList.columns.map(column => {
        if (column.renderDoT) {
          const html = column.renderDoT
          column.cellRenderer = ({ data, rowIndex }) => doT.template(html)({ data, rowIndex })
          delete column.renderDoT
        }

        return column
      })

      const gridOptions = {
        rowData: config.gridList.rowData,
        defaultColDef: { sortable: true, filter: true },
        animateRows: true,
        defaultColDef: {
          flex: 1,
          minWidth: 100,
          resizable: true,
        },
        columnDefs: [{
          headerGroupComponent: HeaderComponent,
          children: columns,
        }],
        statusBar: {
          statusPanels: [
            { statusPanel: 'agTotalAndFilteredRowCountComponent', align: 'left' },
            { statusPanel: 'agTotalRowCountComponent', align: 'center' },
            { statusPanel: 'agFilteredRowCountComponent' },
            { statusPanel: 'agSelectedRowCountComponent' },
            { statusPanel: 'agAggregationComponent' },
          ],
        },
        getRowId: ({ data }) => data.id,
      }

      // global object
      window.gridOptions = gridOptions

      const listDefault = new agGrid.Grid(document.getElementById('listDefault'), gridOptions);

      if (config.form) {
        const formRenderEngine = new FormRenderEngine(config.form, {
          payloadComboBox: config.payloadComboBox,
        })

        // global object
        window.formRenderEngine = formRenderEngine
        document.querySelector('#componentModal main').append(formRenderEngine.get())

        // footer button attributes
        const btnFooterModal = [{
            label: 'Salvar',
            attrs: {
              type: 'button',
              class: 'text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800',
              onclick: 'onClickBtnFooterModalSave(event)',
            },
          },
          {
            label: 'Calcelar',
            attrs: {
              type: 'button',
              class: 'text-black bg-red-400 hover:bg-red-200 focus:ring-4 focus:ring-gray-300 rounded-lg border border-red-600 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600',
              onclick: 'onClickBtnFooterModalCancel(event)',
            },
          },
        ]
        for (const btnOpts of btnFooterModal) document.querySelector('#componentModal footer').append(formRenderEngine.renderBtn(btnOpts))
      } 
    })

    async function actionDisableEnable(action, id, rowIndex) {
      const [title, method] = [ ['desativar', 'DELETE'], ['ativar', 'PATCH'] ][action]

      const resp = await swal({
        title: `Deseja ${title} esse registro?`,
        icon: 'warning',
        buttons: {
          yes: {
            text: "Sim",
            value: true,
          },
          no: {
            text: "Não",
            value: false,
          },
        },
      })

      if (resp) {
        const resp = await fetch(`${config.baseUrl}/${id}`, {
            method,
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-Token": csrfToken
            },
        })

        if (await resp.text()) {
          const rowData = gridOptions.rowData[rowIndex]
          rowData.deleted_at = action ? null : new Date().toJSON()
          gridOptions.api.applyTransaction({ update: [rowData] })
        }
      }
    }

    function actionForm(rowIndex) {
      formRenderEngine.reset()
      let title = ''
      if (typeof rowIndex === 'undefined') {
        title = 'Novo: '

      } else {
        title = 'Editar: '

        const rowData = gridOptions.rowData[rowIndex]

        populateForm(formRenderEngine.form, rowData)
      }

      ComponentModal.setTitle(title + config.title).show()
    }  
    
    async function onClickBtnFooterModalSave(event) {
      const respConfirm = await swal({
        title: `Deseja Salvar?`,
        icon: 'warning',
        buttons: {
          yes: {
            text: "Sim",
            value: true,
          },
          no: {
            text: "Não",
            value: false,
          },
        },
      })

      if (respConfirm) {
        const body = new URLSearchParams(new FormData(formRenderEngine.form))

        const resp = await fetch(`${config.baseUrl}/save`, {
          method: 'put',
          headers: {
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-Token": csrfToken
          },
          body,
        })

        const rowData = JSON.parse(await resp.text())

        if (rowData.id) {
          let action = 'update'
          if (!body.get('id')) {
            action = 'add'
            gridOptions.rowData.push(rowData)
          }

          gridOptions.api.applyTransaction({
            [action]: [rowData]
          })

          ComponentModal.hide()
        } else if (rowData.message) {
          swal({
            icon: 'error',
            title: 'Erro ao salvar!',
            text: rowData.message,
          })
        }
      }
    }

    async function onClickBtnFooterModalCancel(event) {
      const resp = await swal({
        title: `Deseja cancelar e voltar para lista?`,
        icon: 'warning',
        buttons: {
          yes: {
            text: "Sim",
            value: true,
          },
          no: {
            text: "Não",
            value: false,
          },
        },
      })

      if (resp) {
        ComponentModal.hide()
      }
    } 

    /* ========================== */

    const sidebar = @json(sidebar());
    const mappingToJsTree = [];

    const mappingActions = [
      {
        key: 'create',
        label: 'Criar',
      },
      {
        key: 'read',
        label: 'Visualização',
      },
      {
        key: 'update',
        label: 'Atualizar',
      },
      {
        key: 'delete',
        label: 'Deletar',
      },
    ]

    for (const section of sidebar) {
      mappingToJsTree.push({
        id: section.id,
        parent: '#',
        text: section.name,
        icon: section.icon,
      })

      for (const page of section.page_menu) {
        mappingToJsTree.push({
          id: `${section.id}.${page.id}`,
          parent: section.id,
          text: page.name,
          icon: page.icon,
        })

        for (const action of mappingActions) { 
          mappingToJsTree.push({
            id: `${section.id}.${page.id}.${action.key}`,
            parent: `${section.id}.${page.id}`,
            text: action.label,
            icon: 'fa fa-lock',
          })
        }
      }  
    }

    function actionModalPermission(rowIndex) {
      const rowData = gridOptions.rowData[rowIndex]
      ComponentModal.setTitle(config.title).show() 

      console.log(config.baseUrl + "/getPermissionByProfile?id=" + rowData.id)

      $.ajax({
        url: `${config.baseUrl}/getPermissionByProfile/${rowData.id}`,
        method: 'GET',
        dataType: 'JSON', 
      });

      $('#componentModal main').data('rowData', rowData)

      $('#componentModal main').jstree({
        'plugins': ["checkbox"],
        'core': {
          'data': mappingToJsTree,
        }
      })      
    }

    async function onClickBtnFooterModalSavePermission(event) {
      const respConfirm = await swal({
        title: `Deseja Salvar?`,
        icon: 'warning',
        buttons: {
          yes: {
            text: "Sim",
            value: true,
          },
          no: {
            text: "Não",
            value: false,
          },
        },
      })

      if (respConfirm) {
        const jsTreeChecked = $('#componentModal main').jstree().get_checked().reduce((carry, item) => {
				let match = null

				if (match = item.match(/^((.*)\.(.*))\.(\w+)$/)) {
					if (!carry[match[1]]) {
						carry[match[1]] = {
							section_menu_id: match[2],
							page_menu_id: match[3], 
							create: 0,
							read: 0,
							update: 0,
							delete: 0,
						}
					}

					carry[match[1]][match[4]] = 1
				}

          return carry
        }, {})    
        
        const rowData = $('#componentModal main').data('rowData')

        const payload = {
          user_profile_id: rowData.id,
          permission: jsTreeChecked,
        }
        
        console.log(`${config.baseUrl}/save`)
        $.ajax({
          url: `${config.baseUrl}/save`,
          method: 'POST',
          dataType: 'JSON',
          data: payload,
        });
      }
    }

    // footer button attributes permission
    const btnFooterModal = [{

      label: 'Salvar',
      attrs: {
        type: 'button',
        class: 'text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800',
        onclick: 'onClickBtnFooterModalSavePermission(event)',
      },
      },
      {
        label: 'Calcelar',
        attrs: {
          type: 'button',
          class: 'text-black bg-red-400 hover:bg-red-200 focus:ring-4 focus:ring-gray-300 rounded-lg border border-red-600 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600',
          onclick: 'onClickBtnFooterModalCancel(event)',
        },
      },
    ]
    for (const btnOpts of btnFooterModal) document.querySelector('#componentModal footer').append(FormRenderEngine.renderBtn(btnOpts))
  </script> 
@endpush

