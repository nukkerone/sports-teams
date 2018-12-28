<template>

    <base-component title="Teams">
        <v-toolbar class="mb-4">

            <v-toolbar-title>Teams</v-toolbar-title>

            <v-spacer></v-spacer>

            <v-dialog v-model="dialog" max-width="500px">
                <v-btn slot="activator" color="primary" dark class="mb-2">New Item</v-btn>
                <v-card>
                    <v-card-title>
                        <span class="headline">{{ formTitle }}</span>
                    </v-card-title>

                    <v-card-text>
                        <v-container grid-list-md>
                            <v-layout wrap>
                                <v-flex>
                                    <v-text-field v-model="editedItem.name" label="Name"></v-text-field>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" flat @click="close">Cancel</v-btn>
                        <v-btn color="blue darken-1" flat @click="save">Save</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-toolbar>

        <v-data-table
            :headers="headers"
            :items="teams"
            :loading="loading"
            class="elevation-1"
        >
            <template slot="items" slot-scope="props">
                <td class="">{{ props.item.id }}</td>
                <td class="">{{ props.item.name }}</td>
                <td class="justify-center layout px-0">
                    <v-icon
                        small
                        class="mr-2"
                        @click="viewItem(props.item)"
                    >
                        people
                    </v-icon>
                    <v-icon
                        small
                        class="mr-2"
                        @click="editItem(props.item)"
                    >
                        edit
                    </v-icon>
                    <v-icon
                        small
                        @click="deleteItem(props.item)"
                    >
                        delete
                    </v-icon>
                </td>
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
                    { text: 'Name', value: 'name' },
                    { text: 'Actions', value: 'actions', sortable: false },
                ],
                teams: [

                ],
                drawer: true,
                loading: false,
                dialog: false,
                editedIndex: -1,
                editedItem: {
                    name: '',
                },
                defaultItem: {
                    name: '',
                }
            }
        },
        mounted() {
            this.loading = true;
            axios.get('/api/teams').then((response) => {
                this.teams = JSON.parse(JSON.stringify(response.data));
                this.loading = false;
            });
        },

        computed: {
            formTitle () {
                return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
            }
        },

        watch: {
            dialog (val) {
                val || this.close()
            }
        },

        methods: {
            editItem (item) {
                this.editedIndex = this.teams.indexOf(item);
                this.editedItem = Object.assign({}, item);
                this.dialog = true
            },

            deleteItem (item) {
                const index = this.teams.indexOf(item);
                this.loading = true;
                axios.delete('/api/teams/' + item.id).then((response) => {
                    this.loading = false;
                    this.teams.splice(index, 1);
                });
            },

            viewItem (item) {
                this.$router.push('teams/' + item.id + '/players');
            },

            close () {
                this.dialog = false;
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem);
                    this.editedIndex = -1
                }, 300)
            },

            save () {
                if (this.editedIndex > -1) {
                    this.loading = true;
                    axios.put('/api/teams/' + this.editedItem.id, this.editedItem).then((response) => {
                        Object.assign(this.teams[this.editedIndex], response.data);
                        this.loading = false;
                        this.close()
                    });
                } else {
                    this.loading = true;
                    axios.post('/api/teams', this.editedItem).then((response) => {
                        let createdTeam = response.data;
                        this.teams.push(createdTeam);
                        this.loading = false;
                        this.close()
                    });
                }
            }
        }

    }
</script>
