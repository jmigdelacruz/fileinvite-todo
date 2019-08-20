<template>
        <div class="todo__box">
            <div class="todo__controls">
                <h1 class="text-grey-darkest">Juan's Todo List</h1>
                <div class="flex">
                    <input class="todo__input" v-model="newTodo" @keyup.enter="addTodo" placeholder="Add Todo">
                    <button class="todo__button todo__button--teal" @click="addTodo" :disabled="newTodo.length === 0">Add</button>
                </div>
            </div>
            <div class="todo__list">
                <todo-item v-for="(todo, index) in todos" :key="todo.id" :todo="todo" :index="index"></todo-item>
                <div v-if="todos.length === 0">
                    <p class="todo__empty">There are no todos</p>
                </div>
            </div>
        </div>
</template>

<script>
    import todoItem from './todo-item'
    export default{
        data(){
            return{
                todos: [],
                newTodo: '',
            }
        },
        created() {
          this.getTodos();
          this.initListeners();
        },
        methods: {
            initListeners() {
                const t = this;
                bus.$on('update-todo', function (details) {
                  t.updateTodo(details);
                })

                bus.$on('remove-todo', function (details) {
                  t.removeTodo(details);
                })
            },
            getTodos() {
              const t = this;
              axios.get('/api/todos')
                  .then(({data}) => {
                    t.todos = data;
                  });
            },
            createTodo(text) {
                const t = this;
                axios.post('/api/todos', {text: text, finished: false})
                    .then(({data}) => {
                        t.todos.unshift(data);
                    });
            },
            addTodo() {
                const t = this;
                if(t.newTodo.length > 0) {
                  t.createTodo(t.newTodo);
                  t.newTodo = '';
                }
            },
            updateTodo(details) {
                const t = this;
                axios.patch('/api/todos/'+ details.id, details.data)
                  .then(({data}) => {
                    t.todos.splice(details.index, 1, data)
                  })
                },
            removeTodo(details) {
                const t = this;
                axios.delete('/api/todos/'+ details.id)
                  .then(() => {
                    t.todos.splice(details.index, 1)
                  })
                },
        },
        components: {
          todoItem
        }
    }
</script>
