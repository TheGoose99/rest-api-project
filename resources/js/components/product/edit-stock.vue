<template>
    <div>
        <div class="row">
            <div class="col-sm">
                <router-link to="/restock" class="btn btn-primary"> Go Back </router-link>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Stock Update</h1>
                                    </div>

                                    <form class="user" @submit.prevent="stockUpdate" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label for="exampleFormControlSelect1">Product Quantity</label>
                                                    <input type="text" class="form-control" id="exampleInputFirstName" v-model="form.product_quantity">
                                                    <small class="text-danger" v-if="errors.product_quantity"> {{ errors.product_quantity[0] }} </small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
export default {
    // Daca este deja logat cu un token user-ul:
    created() {
        if(!User.loggedIn()) {
            this.$router.push({ name: '/' });
        }
    },
    data() {
        return {
            form: {
                product_quantity: ''
            },
            errors: {},
        }
    },
    created() {
        let id = this.$route.params.id

        axios.get('/api/product/'+id)
        .then(({data}) => (this.form = data))
        .catch(error =>this.errors = error.response.data.errors)
    },
    methods: {
        stockUpdate() {
            let id = this.$route.params.id;
            axios.patch('/api/stock/update/'+id, this.form)
            .then(() => {
                this.$router.push({ name: 'stock' })
                Notification.success()
            })
            .catch(error =>this.errors = error.response.data.errors)
        },
    },
}
</script>

<style type="text/css">
    #em_photo {
        height: 240px;
        width: 200px;
    }
</style>