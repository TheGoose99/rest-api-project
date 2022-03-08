<template>
    <div>
        <div class="row">
            <div class="col-sm">
                <router-link to="/supplier" class="btn btn-primary"> All Suppliers </router-link>
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
                                        <h1 class="h4 text-gray-900 mb-4">Supplier Update</h1>
                                    </div>

                                    <form class="user" @submit.prevent="supplierUpdate" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputFirstName"
                                                    placeholder="Enter Your Full Name" v-model="form.name">
                                                    <small class="text-danger" v-if="errors.name"> {{ errors.name[0] }} </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <input type="email" class="form-control" id="exampleInputemail"
                                                    placeholder="Enter Your Email" v-model="form.email">
                                                    <small class="text-danger" v-if="errors.email"> {{ errors.email[0] }} </small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputAddress"
                                                    placeholder="Enter Your Address" v-model="form.address">
                                                    <small class="text-danger" v-if="errors.address"> {{ errors.address[0] }} </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputSalary"
                                                    placeholder="Enter Your Shop Name" v-model="form.shopname">
                                                    <small class="text-danger" v-if="errors.shopname"> {{ errors.shopname[0] }} </small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="exampleInputphone"
                                                    placeholder="Enter Your Phone Number" v-model="form.phone">
                                                    <small class="text-danger" v-if="errors.phone"> {{ errors.phone[0] }} </small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="file" class="custom-file-input" id="customFile" @change="onFileSelected">
                                                    <small class="text-danger" v-if="errors.photo"> {{ errors.photo[0] }} </small>
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <img :src="url" id="em_photo" v-if="url">
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
                name: '',
                email: '',
                phone: '',
                shopname: '',
                address: '',
                photo: '',
                newphoto: '',
            },
            errors: {},
            url: null,
        }
    },
    created() {
        let id = this.$route.params.id

        axios.get('/api/supplier/'+id)
        .then(({data}) => (this.form = data))
        .catch(error =>this.errors = error.response.data.errors)
    },
    methods: {
        onFileSelected(event) {
            let file = event.target.files[0];
            if(file.size > 1048770) {
                Notification.image_validation()
            } else {
                let reader = new FileReader();
                reader.onload = event =>{
                    this.form.newphoto = event.target.result
                };
                reader.readAsDataURL(file);
                this.url = URL.createObjectURL(file);
            }
        },
        supplierUpdate() {
            let id = this.$route.params.id;
            axios.patch('/api/supplier/'+id, this.form)
            .then(() => {
                this.$router.push({ name: 'supplier' })
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