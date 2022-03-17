import axios from 'axios'
import Alpine from 'alpinejs'

window.Alpine = Alpine
window.axios = axios

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

Alpine.data('modal', () => ({
   open: false,
   toggle(e) {
      if (!this.open) {
         if (e.target.dataset.task) {
            this.data = JSON.parse(e.target.dataset.task)
            this.open = true
         }
         else {
            this.data = { name: '', progress: '' }
            this.open = true
         }
      }
      else {
         this.data = {}
         this.open = false
      }
   },
   data: {}
}))


Alpine.start()



