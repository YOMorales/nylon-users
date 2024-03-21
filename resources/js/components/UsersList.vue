<template>
    <v-data-table-server :items-per-page="usersPerPage" :items-per-page-options="usersPerPageOptions"
        :headers="headers" :items-length="totalUsers" :items="users" :loading="loading"
        @update:options="loadUsers">

        <template v-slot:item.actions="{ item }">
            <a :href="`/admin/users/disable/${item.id}`" class="pa-2 bg-orange-darken-4 text-white text-decoration-none rounded">
                Disable User
            </a>
        </template>
    </v-data-table-server>
</template>

<script>
export default {
    data: () => ({
        headers: [
            { title: 'First Name', key: 'first_name', align: 'start', sortable: true, width: '20%' },
            { title: 'Last Name', key: 'last_name', align: 'start', sortable: true, width: '20%' },
            { title: 'Email', key: 'email', align: 'start', sortable: true, width: '20%' },
            { title: 'SSN Last Four', key: 'ssn_last_four', align: 'start', sortable: true, width: '20%' },
            { title: '', key: 'actions', align: 'start', sortable: false, width: '20%' },
        ],
        usersPerPage: 2,
        usersPerPageOptions: [
            { value: 1, title: '1' },
            { value: 2, title: '2' },
            { value: 5, title: '5' },
        ],
        users: [],
        loading: true,
        totalUsers: 0,
    }),
    methods: {
        loadUsers({ page, itemsPerPage, sortBy }) {
            this.loading = true;

            const params = {
                page,
                itemsPerPage
            };

            if (sortBy.length) {
                params.sortKey = sortBy[0].key;
                params.sortOrder = sortBy[0].order;
            }

            axios.get('http://localhost/admin/users/get', { params })
                .then((response) => {
                    this.users = response.data.data;
                    this.totalUsers = response.data.total;
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
