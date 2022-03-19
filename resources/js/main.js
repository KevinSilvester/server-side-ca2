import axios from 'axios'
import Alpine from 'alpinejs'

window.Alpine = Alpine

const FILE_SIZE_LIMIT = 2097152 // 2mb

const api = axios.create({
   baseURL: '/api',
   headers: {
      'X-Requested-With': 'XMLHttpRequest',
      'X-CSRF-TOKEN': window.Laravel.csrf_token
   }
})

const urlToBase64 = async url =>
   new Promise(async (resolve, reject) => {
      {
         try {
            const { data: blob } = await axios.get(url, { responseType: 'blob' })
            const reader = new FileReader()
            reader.onload = () => resolve(reader.result)
            reader.onerror = () => {throw new Error('Reader Failed')}
            reader.readAsDataURL(blob)
         } catch (e) {
            console.error(e)
         }
      }
   }) 

Alpine.data('modal', () => ({
   openTaskModal: false,
   openTodoModal: false,
   openDropDown: false,
   title: '',
   task: {},
   todo: {},
   disabled: false,
   mode: '',
   errors: [],
   iconPreview: '',
   bannerPreview: '',
   imageToBase64(e, name) {
      const reader = new FileReader()
      reader.onload = () => {
         name === 'icon' && (this.iconPreview = reader.result)
         name === 'banner' && (this.bannerPreview = reader.result)
      }
      reader.onerror = () => {
         console.error('File Read Failed')
      }
      reader.readAsDataURL(e.target.files[0])
   },
   toggleDropDown() {
      if (this.openDropDown)
         return this.closeDropDown()
      this.openDropDown = true
   },
   closeDropDown(focusAfter) {
      if (!this.openDropDown) return
      this.openDropDown = false
      focusAfter && focusAfter.focus()
   },
   populateTodo(e) {
      this.todo = JSON.parse(e.dataset.todo)
   },
   toggleTask(e) {
      if (!this.openTaskModal) {
         if (e.target.dataset.task) {
            this.task = JSON.parse(e.target.dataset.task)
            this.openTaskModal = true
            this.disabled = false
            this.mode = 'updateTask'
            this.title = 'Update Task'
            this.errors = []
         } else {
            this.task = { name: '', progress: '' }
            this.openTaskModal = true
            this.disabled = true
            this.mode = 'addTask'
            this.title = 'Add Task'
            this.errors = []
         }
      } else {
         this.task = {}
         this.openTaskModal = false
         this.mode = ''
         this.title = ''
      }
   },
   async toggleTodo() {
      if (!this.openTodoModal) {
         if (!!Object.keys(this.todo).length) {
            this.openTodoModal = true
            this.mode = 'updateTodo'
            this.title = 'Update Todo'
            this.iconPreview = await urlToBase64(`${window.Laravel.asset_path}/${this.todo.icon}`)
            this.bannerPreview = await urlToBase64(`${window.Laravel.asset_path}/${this.todo.banner}`)
            this.errors = []
         } else {
            this.openTodoModal = true
            this.mode = 'addTodo'
            this.title = 'Add Todo'
            this.errors = []
         }
      } else {
         this.iconPreview = ''
         this.bannerPreview = ''
         this.openTodoModal = false
         this.errors = []
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
                  alert('Delete Task Failed!')
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
                  console.error(e)
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
                  console.error(e)
                  alert('Update Task Failed!')
               }
            }
         case 'deleteTodoList':
            return async () => {
               try {
                  await api.delete(`todo/${this.todo.todo_id}`)
                  window.location.href = '../../'
               } catch {
                  alert('Delete Todo List Failed!')
               }
            }
         case 'addTodo':
            return async event => {
               try {
                  const formData = new FormData(event.target)
                  if (formData.get('name').length < 1) {
                     const error = 'Name Too Short'
                     this.errors.includes(error) || this.errors.push(error)
                  }

                  if (formData.get('icon').size < 1) {
                     const error = 'No Icon Selected'
                     this.errors.includes(error) || this.errors.push(error)
                  }

                  if (formData.get('banner').size < 1) {
                     const error = 'No Banner Selected'
                     this.errors.includes(error) || this.errors.push(error)
                  }

                  if (formData.get('icon').size > FILE_SIZE_LIMIT || formData.get('banner').size > FILE_SIZE_LIMIT) {
                     const error = 'Images can\'t be larger than 2mb'
                     this.errors.includes(error) || this.errors.push(error)
                  }

                  if (!!this.errors.length) return

                  await api.post(`todo/create`, formData)
                  location.reload()
               } catch (e) {
                  console.error(e)
                  alert('Add Todo List Failed!')
               }
            }
         case 'updateTodo':
            return async event => {
               try {
                  const formData = new FormData(event.target)
                  if (formData.get('name').length < 1) {
                     const error = 'Name Too Short'
                     this.errors.includes(error) || this.errors.push(error)
                  }

                  if (formData.get('icon').size > FILE_SIZE_LIMIT || formData.get('banner').size > FILE_SIZE_LIMIT) {
                     const error = 'Images can\'t be larger than 2mb'
                     this.errors.includes(error) || this.errors.push(error)
                  }

                  if (!!this.errors.length) return

                  await api.post(`todo/${this.todo.todo_id}`, formData)
                  location.reload()
               } catch (e) {
                  console.error(e)
                  alert('Update Todo List Failed!')
               }
            }
         default:
            return
      }
   }
}))

Alpine.start()
