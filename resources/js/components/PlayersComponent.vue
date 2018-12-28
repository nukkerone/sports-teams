<template>

    <base-component title="Players">
        <v-toolbar class="mb-4">

            <v-toolbar-title>Players</v-toolbar-title>

            <v-spacer></v-spacer>

        </v-toolbar>

        <v-data-table
            :headers="headers"
            :items="players"
            :loading="loading"
            class="elevation-1"
        >
            <template slot="items" slot-scope="props">
                <td class="">{{ props.item.id }}</td>
                <td class="">{{ props.item['first_name'] }}</td>
                <td class="">{{ props.item['last_name'] }}</td>
                <td class="">{{ props.item.team ? props.item.team.name : '-' }}</td>
            </template>
        </v-data-table>
    </base-component>

</template>

<style>
    .v-content > div { height: calc(100% - 36px); }
</style>

<script>
    import axios from 'axios';

    export default {
        data () {
            return {
                headers: [
                    { text: 'ID', value: 'id' },
                    { text: 'First Name', value: 'first-name' },
                    { text: 'Last Name', value: 'last-name' },
                    { text: 'Team', value: 'team.name' },
                ],
                players: [

                ],
                drawer: true,
                loading: false,
            }
        },

        mounted() {
            this.loading = true;
            axios.get('/api/players').then((response) => {
                this.players = JSON.parse(JSON.stringify(response.data));
                this.loading = false;
            });
        },
    }
</script>
