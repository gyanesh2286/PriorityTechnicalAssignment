<template>
    <div>
        <h3 class="text-center">All task listing</h3><br/>
            <div style="display: flex;">
                <form @submit.prevent="fetchPrioritiesTask">
                    
                        <label>Enter hours available at hand now</label>
                        <input type="text"  v-model="taskHours.inputRemainingHours"  style="margin-left:20px;">
                        <button type="submit" class="btn btn-primary" style="float: right;margin-left:20px;">submit</button>
                </form>
            </div>
        <br>
<h3 v-if="arrTaskCanComplete.length>0"> Task which can complete on same day</h3>
<table class="table table-bordered" v-if="arrTaskCanComplete.length>0">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Estimate</th>
                <th>Due Date</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="objTask in arrTaskCanComplete" :key="objTask.id">
                <td>{{ objTask.id }}</td>
                <td>{{ objTask.title }}</td>
                <td>{{ objTask.description }}</td>
                <td>{{ objTask.status }}</td>
                <td>{{ objTask.priority }}</td>
                <td>{{ objTask.estimate }}</td>
                <td>{{ objTask.due_date }}</td>
                <td>
                    
                </td>
            </tr>
            </tbody>
        </table>
        <h3 v-if="arrInProgress">Task which can do in next day's</h3>
        <h3 v-else>All available task according to priority</h3>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Estimate</th>
                <th>Due Date</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="objTask in allTaskData" :key="objTask.id">
                <td>{{ objTask.id }}</td>
                <td>{{ objTask.title }}</td>
                <td>{{ objTask.description }}</td>
                <td>{{ objTask.status }}</td>
                <td>{{ objTask.priority }}</td>
                <td>{{ objTask.estimate }}</td>
                <td>{{ objTask.due_date }}</td>
                <td>
                    
                </td>
            </tr>
            </tbody>
        </table>

    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                allTaskData: [],
                taskHours: {},
                arrTaskCanComplete: [],
                arrInProgress:false,
            }
        },
        created() {
            this.axios
                .get('http://localhost:8000/api/tasklist')
                .then(response => {
                    this.allTaskData = response.data.data;
                });
        },
        methods: {
            fetchPrioritiesTask() {
                this.axios
                    .post('http://localhost:8000/api/fetchPrioritiesTask', this.taskHours)
                    .then(response => {
                    this.arrTaskCanComplete = response.data.arrTaskCanComplete;
                    if(Object.keys(response.data.arrTaskWouldBeInProgress).length>0){
                        this.arrInProgress=true;
                    }
                    this.allTaskData = response.data.arrTaskWouldBeInProgress;
                })
                .catch(err => console.log(err))
                .finally(() => this.loading = false)
            }
        }
    }
</script>