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
                    <div class="col">
                        <button type="button" class="btn btn-dark" @click="sortTask"><label v-if="order">Sort by Desc</label><label v-else>Sort by Asc</label></button>
                    </div>
                </div>

                <div class="card" style="margin-top: 30px" v-for="task in tasks" :key="task.id">
                    <div class="card-body">
                        <h5 class="card-title">{{ task.text }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">#{{ task.id }}  create at: {{ moment(task.created_at) }}</h6>
                        <button :disabled="isEdit" @click="displayUpdate(task)" style="margin-right: 5px" class="btn btn-secondary">Edit</button>
                        <button :disabled="isEdit" @click="deleteTask(task.id)" class="btn btn-danger">Delete</button>
                    </div>
                    <div class="card-footer text-muted">
                        <label v-if="task.status==0">Uncompleted</label>
                        <label v-else>Completed</label>
                    </div>
                </div>
            </div>

            <div class="card" style="margin-top: 30px">
                <div v-if="updateForm">
                    <div class="card-body">
                        <input type="text" v-model="updateText" class="card-title">
                        <h6 class="card-subtitle mb-2 text-muted">#{{ updateId }}</h6>
                        <button @click="updateTaskStatus" v-if="updateStatus==0" class="btn btn-success" style="margin-right: 5px">Completed</button>
                        <button @click="updateTaskStatus" v-else class="btn btn-warning" style="margin-right: 5px">Uncompleted</button>
                        <button @click="updateTaskText" class="btn btn-secondary" style="margin-right: 5px">Update</button>
                        <button @click="updateCancel" class="btn btn-danger" style="margin-right: 5px">Cancel</button>
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
            status: 0,
            isEdit: false,
            updateForm: false,
            updateId: '',
            updateText: '',
            updateStatus: '',
            order: true,
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
        displayUpdate(task) {
            this.isEdit = true;
            this.updateForm = true;
            this.updateId = task.id;
            this.updateText = task.text;
            this.updateStatus = task.status;
        },
        updateTaskText() {
            axios.put('/api/tasks/' + this.updateId, {
                text: this.updateText,
                status: this.updateStatus
            }).then((res) => {
                this.isEdit = false;
                this.updateForm = false;
                this.getTasks();
            });
        },
        updateTaskStatus() {
            axios.put('/api/tasks/' + this.updateId, {
                text: this.updateText,
                status: !this.updateStatus
            }).then((res) => {
                this.isEdit = false;
                this.updateForm = false;
                this.getTasks();
            });
        },
        updateCancel() {
            this.isEdit = false;
            this.updateForm = false;
        },
        deleteTask(id) {
            axios.delete('/api/tasks/' + id).then((res) => {
                this.getTasks();
            });
        },
        moment(date) {
            return moment(date).format('YYYY-MM-DD hh:mm:ss')
        },
        sortTask() {
            this.order = !this.order
            if (this.order) {
                this.tasks.sort(function (a, b) {
                    return a.id - b.id;
                });
            } else {
                this.tasks.sort(function (a, b) {
                    return b.id - a.id;
                });
            }
        },
    },
}
</script>