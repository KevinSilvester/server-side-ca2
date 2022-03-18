import axios from 'axios'
import Alpine from 'alpinejs'

window.Alpine = Alpine
window.axios = axios

const api = window.axios.create({
   baseURL: '/api',
   headers: {
      'X-Requested-With': 'XMLHttpRequest',
      'X-CSRF-TOKEN': window.Laravel.csrf_token
   }
})

Alpine.data('modal', () => ({
   open: false,
   title: '',
   task: {},
   todo: {},
   disabled: false,
   mode: '',
   errors: [],
   populateTodo(e) {
      this.todo = JSON.parse(e.dataset.todo)
   },
   toggleTask(e) {
      if (!this.open) {
         if (e.target.dataset.task) {
            this.task = JSON.parse(e.target.dataset.task)
            this.open = true
            this.disabled = false
            this.mode = 'updateTask'
            this.title = 'Update Task'
            this.errors = []
         } else {
            this.task = { name: '', progress: '' }
            this.open = true
            this.disabled = true
            this.mode = 'addTask'
            this.title = 'Add Task'
            this.errors = []
         }
      } else {
         this.task = {}
         this.open = false
         this.mode = ''
         this.title = ''
      }
   },
   actions(type) {
      switch (type) {
         case 'deleteTask':
            return async () => {
               try {
                  await api.delete(`task/${this.task.task_id}`)
                  location.reload()
               } catch {
                  alert('Delete Failed!')
               }
            }
         case 'addTask':
            return async event => {
               try {
                  const formData = new FormData(event.target)
                  if (formData.get('name').length < 1) {
                     const error = 'Name Too Short'
                     this.errors.includes(error) || this.errors.push(error)
                     return
                  }
                  await api.post(`task/create?todo=${this.todo.todo_id}`, formData)
                  location.reload()
               } catch (e) {
                  console.log(e)
                  alert('Add Task Failed!')
               }
            }
         case 'updateTask':
            return async event => {
               try {
                  const formData = new FormData(event.target)
                  if (formData.get('name').length < 1) {
                     const error = 'Name Too Short'
                     this.errors.includes(error) || this.errors.push(error)
                     return
                  }
                  await api.post(`task/${this.task.task_id}`, formData)
                  location.reload()
               } catch (e) {
                  console.log(e)
                  alert('Update Task Failed!')
               }
            }
         default:
            return
      }
   }
}))


Alpine.start()



