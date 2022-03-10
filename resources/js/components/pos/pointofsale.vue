<template>
    <div>
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">POS Dashboard</h1>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">POS</li>
                </ol>
            </div>

            <div class="row mb-3">
                <!-- Area Chart -->
                <div class="col-xl-5 col-lg-5">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Monthly Recap Report</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-area">
                                Yes
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-7 col-lg-7">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>
                        </div>

                        <!-- Category Wise Product -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="card-body">
                                    <input v-model="searchTerm" type="text" class="form-control" style="width: 650px; margin-bottom: 5px;" placeholder="Search Product">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="product in filterSearch" :key="product.id">
                                            <a href="#">
                                                <div class="card" style="width: 8.5rem; margin-bottom: 5px;">
                                                    <img class="card-img-top" :src="product.image" id="em_photo" alt="Card image cap">
                                                    <div class="card-body">
                                                        <h6 class="card-title">{{ product.product_name }}</h6>
                                                        <span v-if="product.product_quantity >= 1" class="badge badge-success">Available: {{ product.product_quantity }}</span>
                                                        <span v-else class="badge badge-danger">Stock Out</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>  <!-- End Category Wise Product -->

                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

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

<style type="text/css" scoped>
    #em_photo {
        height: 100px;
        width: 135px;
    }
</style>