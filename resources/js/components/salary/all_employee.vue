<template>
    <div>
        <div class="row">
            <div class="col-sm">
                <router-link to="/salary" class="btn btn-primary"> All Salaries </router-link>
            </div>
        </div>

        <br>
            <input v-model="searchTerm" type="text" class="form-control" style="width: 300px;" placeholder="Search Here">
        <br>

            <div class="row">
                <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                    <div class="card">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Employee List</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Photo</th>
                                        <th>Phone Number</th>
                                        <th>Salary</th>
                                        <th>Joining Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="employee in filterSearch" :key="employee.id">
                                        <td> {{ employee.name }} </td>
                                        <td><img :src="employee.photo" alt="Error" id="em_photo"></td>
                                        <td> {{ employee.phone }} </td>
                                        <td> {{ employee.salary }} </td>
                                        <td>> {{ employee.joining_date }} </td>
                                        <td>
                                            <router-link :to="{name: 'pay-salary', params:{id:employee.id}}" class="btn btn-sm btn-primary">Pay Salary</router-link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer"></div>
                    </div>
                </div>
            </div>
            <!--Row-->

    </div>
</template>

<script type="text/javascript">
export default {
    // Daca este deja logat cu un token user-ul:
    created() {
        if(!User.loggedIn()) {
            this.$router.push({ name: '/' })
        }
        // When it is loaded to display the data:
        this.allEmployee();
    },
    data() {
        return {
            employees: [],
            searchTerm: '',
        }
    },
    methods: {
        allEmployee() {
            axios.get('/api/employee/')
            .then(({data}) => (this.employees = data))
            .catch()
        },
    },
    computed: {
        filterSearch() {
            return this.employees.filter(employee => {
                return employee.name.match(this.searchTerm)
            })
        }
    },
}
</script>

<style type="text/css">
    #em_photo {
        height: 40px;
        width: 40px;
    }
</style>