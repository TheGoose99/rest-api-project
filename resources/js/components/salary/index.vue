<template>
    <div>
        <div class="row">
            <div class="col-sm">
                <router-link to="/given-salary" class="btn btn-primary"> Add Salary </router-link>
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
                            <h6 class="m-0 font-weight-bold text-primary">All Salary Details</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Month Name</th>
                                        <th>Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="salary in filterSearch" :key="salary.id">
                                        <td> {{ salary.salary_month }} </td>
                                        <td>
                                            <router-link :to="{name: 'view-salary', params:{id:salary.salary_month}}" class="btn btn-sm btn-primary">View Salary</router-link>
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
        this.allSalary();
    },
    data() {
        return {
            salaries: [],
            searchTerm: '',
        }
    },
    methods: {
        allSalary() {
            axios.get('/api/salary/')
            .then(({data}) => (this.salaries = data))
            .catch()
        },
    },
    computed: {
        filterSearch() {
            return this.salaries.filter(salary => {
                return salary.salary_month.match(this.searchTerm)
            })
        }
    },
}
</script>

<style type="text/css">

</style>