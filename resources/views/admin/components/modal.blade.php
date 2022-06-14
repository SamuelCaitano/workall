<!-- component -->
<div class="max-w-2xl mx-auto float-right">
  <!-- Main modal -->
  <div id="componentModal" data-modal-show="false" aria-hidden="true" style="background-color: rgba(0, 0, 0, .5)"
    class="hidden overflow-x-hidden overflow-y-auto fixed h-modal md:h-full top-4 left-0 right-0 md:inset-0 z-50 justify-center items-center">
    <div class="relative w-full max-w-2xl px-4 h-full md:h-auto  mx-auto">
      <!-- Modal content -->
      <div class="bg-white rounded-lg shadow relative dark:bg-gray-700 mt-16">
        <!-- Modal header -->
        <div class="flex items-start justify-between p-3 border-b rounded-t dark:border-gray-600 dark:bg-gray-600">
          <header class="p-1 bg-transparent rounded-t flex ">
            <h5 class="text-gray-900 text-xl lg:text-2xl font-semibold dark:text-white ml-8" data-title></h5>
            <!-- Btn Close-->
            <button type="button" onclick="ComponentModal.hide()"
              class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
              data-modal-toggle="componentModal">
              <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                  clip-rule="evenodd"></path>
              </svg>
            </button>
          </header>
        </div>
        <!-- Modal body -->
        <div class="max-w-2xl mx-auto p-3 space-y-6">
          <main class="p-5 w-full h-full overflow-y-auto">
            <div class="relative">
              <input type="text" id="floating_outlined" class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
              <label for="floating_outlined" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-800 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Floating outlined</label>
          </div>
          </main>

          <!-- Modal footer -->
          <footer class="flex space-x-2 items-center p-1 pl-6 border-t border-gray-200 rounded-b dark:border-gray-600 w-full">
            {{-- <button type="submit" onclick="actionBtnFooterModalSave()"
              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Enviar</button>
            <button type="button" onclick="modal('componentModal', 'close')"
              class="text-gray-500 bg-red-600 hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-red-600 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">Cancelar</button> --}}
          </footer>
        </div>
      </div>
    </div>
  </div>
</div>

@push('js')
  <script>
    window.ComponentModal = new class ComponentModal {
      constructor() {
        this.elem = document.getElementById('componentModal')
      }

      setTitle(text) {
        this.elem.querySelector('header [data-title]').innerHTML = text

        return this
      }

      show() {
        this.elem.classList.remove('hidden')
      }

      hide() {
        this.elem.classList.add('hidden')
      }
    }
  </script>
@endpush
