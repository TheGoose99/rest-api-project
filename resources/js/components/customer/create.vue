<template>
    <div>
        <div class="row">
            <div class="col-sm">
                <router-link to="/customer" class="btn btn-primary"> All Customer </router-link>
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
                                        <h1 class="h4 text-gray-900 mb-4">Add Customer</h1>
                                    </div>

                                    <form class="user" @submit.prevent="customerInsert" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="exampleFormControlTextareaDetails"><b>Customer Name</b></label>
                                                    <input type="text" class="form-control" id="exampleInputFirstName" v-model="form.name">
                                                    <small class="text-danger" v-if="errors.name"> {{ errors.name[0] }} </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlTextareaDetails"><b>Customer Email</b></label>
                                                    <input type="email" class="form-control" id="exampleInputemail" v-model="form.email">
                                                    <small class="text-danger" v-if="errors.email"> {{ errors.email[0] }} </small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="exampleFormControlTextareaDetails"><b>Customer Address</b></label>
                                                    <input type="text" class="form-control" id="exampleInputAddress" v-model="form.address">
                                                    <small class="text-danger" v-if="errors.address"> {{ errors.address[0] }} </small>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="exampleFormControlTextareaDetails"><b>Customer Phone</b></label>
                                                    <input type="text" class="form-control" id="exampleInputSalary" v-model="form.phone">
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
                                                <img :src="form.photo" alt="Error" style="height: 40px; width: 40px;">
                                            </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
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
            this.$router.push({ name: 'home' });
        }
    },
    data() {
        return {
            form: {
                name: null,
                email: null,
                phone: null,
                address: null,
                photo: null,
            },
            errors: {},
        }
    },
    methods: {
        customerInsert() {
            axios.post('/api/customer', this.form)
            .then(() => {
                this.$router.push({ name: 'customer' })
                Notification.success()
            })
            .catch(error =>this.errors = error.response.data.errors )
        },
        onFileSelected(event) {
            let file = event.target.files[0];

            if(file.size > 1048770) {
                Notification.image_validation();
            } else {
                let reader = new FileReader();

                reader.onload = event =>{
                    this.form.photo = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        },
    },
}
</script>

<style type="text/css">

</style>