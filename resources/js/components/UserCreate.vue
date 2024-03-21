<template>
    <v-form v-model="formIsReady" @submit.prevent="onSubmit">

    <div class="grid grid-cols-1 gap-4 md:grid-cols-4 p-2 mb-6">
        <div>
            <v-text-field v-model="first_name" type="text" label="First Name" :rules="[rules.required]" autocomplete="off"></v-text-field>
        </div>
        <div>
            <v-text-field v-model="last_name" type="text" label="Last Name" :rules="[rules.required]" autocomplete="off"></v-text-field>
        </div>
        <div>
            <v-text-field v-model="email" type="email" label="Email" placeholder="example@gmail.com" :rules="[rules.required]" autocomplete="off"></v-text-field>
        </div>
        <div>
            <v-text-field
              v-model="ssn"
              :type="showSSN ? 'text' : 'password'"
              label="Social Security Number"
              placeholder="xxx-xx-xxxx"
              :rules="[rules.required, rules.ssn]"
              maxlength="11"
              autocomplete="off"
              @click:append="showSSN = !showSSN"
              :append-icon="showSSN ? 'mdi-eye' : 'mdi-eye-off'"
            ></v-text-field>
        </div>
    </div>
        <v-btn
          type="submit"
          class="text-white bg-orange mb-4 mx-2"
          :disabled="!formIsReady"
          :loading="loading"
        >
        Create
        </v-btn>
    </v-form>
</template>

<script>
export default {
    data: () => ({
        first_name: '',
        last_name: '',
        email: '',
        ssn: '',
        showSSN: false,
        rules: {
          required: value => !!value || 'Required',
          ssn: value => (value.length === 11) || 'Enter ssn including hyphens',
        },
        formIsReady: false,
        loading: false,
    }),
    methods: {
        onSubmit({ page, itemsPerPage }) {
            if (!this.formIsReady) return;

            this.loading = true;

            const params = {
                first_name: this.first_name,
                last_name: this.last_name,
                email: this.email,
                ssn: this.ssn
            };

            axios.post('http://localhost/users/create', params)
                .then((response) => {
                    // DEV NOTE: just putting it an alert to save time, but in reality I would render a nice status message
                    alert(response.data);
                    this.loading = false;
                })
                .catch((errorResponse) => {
                    // DEV NOTE: normally, I would render the error message to the user,
                    // but for this example, I'm just logging it to the console
                    console.log(errorResponse.response.data.message);
                    this.loading = false;
                });
        },
    },
}
</script>
