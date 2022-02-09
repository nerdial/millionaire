<template>
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <div class="card px-5 py-5" id="form1">
                    <div class="form-data" v-if="!submitted">
                        <div class="forms-inputs mb-4"><span>Name</span>
                            <input autocomplete="off" type="text" v-model="name"
                                   v-bind:class="{'form-control':true, 'is-invalid' : !validName(name) && nameBlurred}"
                                   v-on:blur="nameBlurred = true">
                            <div class="invalid-feedback">A valid name is required!</div>
                        </div>

                        <div class="forms-inputs mb-4"><span>Email</span> <input autocomplete="off" type="text"
                                                                                 v-model="email"
                                                                                 v-bind:class="{'form-control':true, 'is-invalid' : !validEmail(email) && emailBlurred}"
                                                                                 v-on:blur="emailBlurred = true">
                            <div class="invalid-feedback">A valid email is required!</div>
                        </div>
                        <div class="forms-inputs mb-4"><span>Password</span> <input autocomplete="off" type="password"
                                                                                    v-model="password"
                                                                                    v-bind:class="{'form-control':true, 'is-invalid' : !validPassword(password) && passwordBlurred}"
                                                                                    v-on:blur="passwordBlurred = true">
                            <div class="invalid-feedback">Password must be 8 character!</div>
                        </div>
                        <div class="mb-3">
                            <button v-on:click.stop.prevent="submit" class="btn btn-dark w-100">Login</button>
                        </div>
                    </div>
                    <div class="success-data" v-else>
                        <div class="text-center d-flex flex-column"><i class='bx bxs-badge-check'></i> <span
                            class="text-center fs-1">You have been registered <br> Successfully</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {

    data() {
        return {
            name: "",
            nameBlurred: false,
            email: "",
            emailBlurred: false,
            valid: false,
            submitted: false,
            password: "",
            passwordBlurred: false
        }
    },

    mounted() {
    },
    methods: {
        validate: function () {
            this.emailBlured = true;
            this.passwordBlured = true;
            if (this.validEmail(this.email) && this.validPassword(this.password)) {
                this.valid = true;
            }
        },
        validEmail: function (email) {
            let re = /(.+)@(.+){2,}\.(.+){2,}/;
            if (re.test(email.toLowerCase())) {
                return true;
            }
        },

        validPassword: function (password) {
            if (password.length > 7) {
                return true;
            }
        },

        validName: function (name) {
            if (name.length > 1) {
                return true;
            }
        },

        submit: function () {
            this.validate();
            if (this.valid) {

                axios.post('api/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password
                }).then(({data}) => {
                    localStorage.setItem('api_token', data.data.token)
                    this.submitted = true;
                })


            }
        }
    }
}
</script>
