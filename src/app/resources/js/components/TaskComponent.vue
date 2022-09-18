<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" v-model="text" placeholder="Enter your task">
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-primary" @click="addTask">Add</button>
                    </div>
                </div>

                <div class="card" style="margin-top: 30px" v-for="task in tasks" :key="task.id">
                    <div class="card-body">
                        <h5 class="card-title">{{ task.text }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">#{{ task.id }}  create at: {{ moment(task.created_at) }}</h6>
                        <button @click="displayUpdate(book)" style="margin-right: 5px" class="btn btn-secondary" >Edit</button>
                        <button @click="deleteBook(book.id)" class="btn btn-danger" >Delete</button>
                    </div>
                    <div class="card-footer text-muted">
                        <label v-if="task.status==0">Uncompleted</label>
                        <label v-else>Completed</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
import moment from 'moment';

export default {
    data() {
        return {
            tasks: {},
            text: '',
        }
    },
    created() {
        this.getTasks();
    },
    methods: {
        getTasks() {
            axios.get('/api/tasks').then(res => {
                this.tasks = res.data;
            });
        },
        addTask() {
            axios.post('/api/tasks', {
                text: this.text,
            }).then((res) => {
                this.text = '',
                this.getTasks();
            });
        },
        moment(date) {
            return moment(date).format('YYYY-MM-DD hh:mm:ss')
        }
    },
}
</script>