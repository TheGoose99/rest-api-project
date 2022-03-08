<template>
    <div>
        <div class="row">
            <div class="col-sm">
                <router-link to="/store-supplier" class="btn btn-primary"> Add Supplier </router-link>
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
                            <h6 class="m-0 font-weight-bold text-primary">Supplier List</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Photo</th>
                                        <th>Phone Number</th>
                                        <th>Shop Name</th>
                                        <th>E-mail</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="supplier in filterSearch" :key="supplier.id">
                                        <td> {{ supplier.name }} </td>
                                        <td><img :src="supplier.photo" alt="Error" id="em_photo"></td>
                                        <td> {{ supplier.phone }} </td>
                                        <td> {{ supplier.shopname }} </td>
                                        <td> {{ supplier.email }} </td>
                                        <td>
                                            <router-link :to="{name: 'edit-supplier', params:{id:supplier.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                                            <button @click="deleteSupplier(supplier.id)" class="btn btn-sm btn-danger">Delete</button>
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
        this.allSuppliers();
    },
    data() {
        return {
            suppliers: [],
            searchTerm: '',
        }
    },
    methods: {
        allSuppliers() {
            axios.get('/api/supplier/')
            .then(({data}) => (this.suppliers = data))
            .catch()
        },
        deleteSupplier(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.value) {
                axios.delete('/api/supplier/'+id)
                .then(() => {
                    this.suppliers = this.suppliers.filter(supplier => {
                        return supplier.id != id;
                    });
                })
                .catch(() => {
                    this.$router.push({ name: 'supplier' });
                })

                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
            })
        },
    },
    computed: {
        filterSearch() {
            return this.suppliers.filter(supplier => {
                return supplier.name.match(this.searchTerm)
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