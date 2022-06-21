@extends('admin.layouts.layout')
@section('title', $config['title'])

@push('css')
  <!-- Include the JS for AG Grid -->
  <script src="https://unpkg.com/ag-grid-community/dist/ag-grid-community.min.noStyle.js"></script>
  <!-- Include the core CSS, this is needed by the grid -->
  <link rel="stylesheet" href="https://unpkg.com/ag-grid-community/dist/styles/ag-grid.css" />
  <!-- Include the theme CSS, only need to import the theme you are going to use -->
  <link rel="stylesheet" href="https://unpkg.com/ag-grid-community/dist/styles/ag-theme-alpine.css" />
  {{-- Flowbite  --}}
  <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.7/dist/flowbite.min.css" />
@endpush

@section('content')
  <div class="h-full">
    <div id="listDefault" class="ag-theme-alpine h-full"></div>
  </div>
  @include('admin.components.modal')
@endsection

@push('js')
<script src="/plugins/jquery-3.6.0.min.js"></script>
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
						<span class="flex-grow flex-1">${config.title}</span>
            <!-- Modal toggle --> 
						<button onclick="actionModal()" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" >
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
          column.cellRenderer = ({
            data,
            rowIndex
          }) => doT.template(html)({
            data,
            rowIndex
          })
          delete column.renderDoT
        }

        return column
      })

      const gridOptions = {
        rowData: config.gridList.rowData,
        defaultColDef: {
          sortable: true,
          filter: true
        },
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
          statusPanels: [{
              statusPanel: 'agTotalAndFilteredRowCountComponent',
              align: 'left'
            },
            {
              statusPanel: 'agTotalRowCountComponent',
              align: 'center'
            },
            {
              statusPanel: 'agFilteredRowCountComponent'
            },
            {
              statusPanel: 'agSelectedRowCountComponent'
            },
            {
              statusPanel: 'agAggregationComponent'
            },
          ],
        },
        getRowId: ({
          data
        }) => data.id,
      }

      window.gridOptions = gridOptions

      const listDefault = new agGrid.Grid(document.getElementById('listDefault'), gridOptions);
      const formRenderEngine = new FormRenderEngine(config.form, {
        payloadComboBox: config.payloadComboBox,
      })
      window.formRenderEngine = formRenderEngine

      document.querySelector('#componentModal main').append(formRenderEngine.get())

      // define os atributos dos botoes do footer
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

      for (const btnOpts of btnFooterModal) document.querySelector('#componentModal footer').append(formRenderEngine
        .renderBtn(btnOpts))
    })

    async function actionDisableEnable(action, id, rowIndex) {
      const [title, method] = [
        ['desativar', 'DELETE'],
        ['ativar', 'PATCH']
      ][action]

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
          gridOptions.api.applyTransaction({
            update: [rowData]
          })
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

    function actionModal() {
      document.querySelector('#componentModal main').append(formRenderEngine.get())
      ComponentModal.show() 
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
  </script> 
  <script src="../path/to/flowbite/dist/flowbite.js" defer></script>
  <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js" defer></script>
@endpush
