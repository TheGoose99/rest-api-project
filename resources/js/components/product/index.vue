<template>
    <div>
        <div class="row">
            <div class="col-sm">
                <router-link to="/store-product" class="btn btn-primary"> Add Product </router-link>
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
                            <h6 class="m-0 font-weight-bold text-primary">Products List</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Photo</th>
                                        <th>Category</th>
                                        <th>Buying Price</th>
                                        <th>Selling Price</th>
                                        <th>Root</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="product in filterSearch" :key="product.id">
                                        <td> {{ product.product_name }} </td>
                                        <td> {{ product.product_code }} </td>
                                        <td><img :src="product.image" alt="Error" id="em_photo"></td>
                                        <td> {{ product.category_name }} </td>
                                        <td> {{ product.buying_price }} </td>
                                        <td> {{ product.selling_price }} </td>
                                        <td> {{ product.root }} </td>
                                        <td>
                                            <router-link :to="{name: 'edit-product', params:{id:product.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                                            <button @click="deleteProduct(product.id)" class="btn btn-sm btn-danger">Delete</button>
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
        this.allProducts();
    },
    data() {
        return {
            products: [],
            searchTerm: '',
        }
    },
    methods: {
        allProducts() {
            axios.get('/api/product/')
            .then(({data}) => (this.products = data))
            .catch()
        },
        deleteProduct(id) {
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
                axios.delete('/api/product/'+id)
                .then(() => {
                    this.products = this.products.filter(product => {
                        return product.id != id;
                    });
                })
                .catch(() => {
                    this.$router.push({ name: 'product' });
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
            return this.products.filter(product => {
                return product.product_name.match(this.searchTerm)
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