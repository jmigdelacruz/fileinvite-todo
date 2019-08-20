<template>
    <div class="todo__item">
        <div class="flex todo__item-group" v-show="state.edit === false">
            <input type="checkbox" class="todo__checkbox" v-model="data.finished" @click="updateTodo">
            <p class="todo__item--title " :class="data.finished ? 'line-through color-teal' : 'text-grey-darkest cursor-pointer hover:text-black hover:font-bold'" @click="startEdit">{{todo.text}}</p>
            <button class="todo__button todo__button--red" @click="remove(index)">Remove</button>
        </div>
        <div class="flex todo__item-group" v-show="state.edit === true">
            <input class="todo__input" v-model="data.text" @keyup.enter="updateTodo" placeholder="Update Todo">
            <button class="todo__button todo__button--teal" @click="updateTodo" :disabled="data.text.length === 0">Update</button>
            <button class="todo__button todo__button--red" @click="cancelEdit">Cancel</button>
        </div>
    </div>
</template>

<script>
  export default{
    props: ['todo', 'index'],
    data(){
      return{
        state: {
          edit: false,
        },
        data: {
            text: '',
            finished: false,
        }
      }
    },
    mounted() {
      const t = this;

      t.data.text = t.todo.text;
      t.data.finished = t.todo.finished;
    },
    methods: {
      updateTodo() {
        const t = this;

        t.$nextTick(() => {
            bus.$emit('update-todo', {data: t.data, index: t.index, id: t.todo.id});
        })

        t.state.edit = false;
      },
      remove() {
        const t = this;

        bus.$emit('remove-todo', {index: t.index, id: t.todo.id});
      },
      startEdit() {
        const t = this;

        if(t.data.finished === false) {
            t.state.edit = true;
        }
      },
      cancelEdit() {
        const t = this;

        t.state.edit = false;
        t.data.text = t.todo.text;
      }
    }
  }
</script>
