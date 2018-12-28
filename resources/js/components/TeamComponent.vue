<template>

    <base-component :title="'Team'">
        <v-toolbar class="mb-4">

            <v-toolbar-title>Team: {{ this.$data._team ? this.$data._team.name : '-' }}</v-toolbar-title>

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
                                    <v-text-field v-model="editedItem.first_name" label="First Name"></v-text-field>
                                </v-flex>

                                <v-flex>
                                    <v-text-field v-model="editedItem.last_name" label="Last Name"></v-text-field>
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
            :items="players"
            :loading="loading"
            class="elevation-1"
        >
            <template slot="items" slot-scope="props">
                <td class="">{{ props.item.id }}</td>
                <td class="">{{ props.item['first_name'] }}</td>
                <td class="">{{ props.item['last_name'] }}</td>
                <td class="">{{ props.item.team ? props.item.team.name : '-' }}</td>
                <td class="justify-center layout px-0">
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
                    { text: 'First Name', value: 'first-name' },
                    { text: 'Last Name', value: 'last-name' },
                    { text: 'Team', value: 'team.name' },
                    { text: 'Actions', value: 'actions', sortable: false },
                ],
                players: [

                ],
                loading: false,
                drawer: true,
                _team: null,
                dialog: false,
                editedIndex: -1,
                editedItem: {
                    first_name: '',
                    last_name: '',
                },
                defaultItem: {
                    first_name: '',
                    last_name: '',
                }
            }
        },

        props: {
            team: null
        },

        mounted() {
            if (!this.team) {
                let teamId = this.$route.params.id;
                this.loading = true;
                axios.get('/api/teams/' + teamId).then((response) => {
                    this._team = response.data;
                    this.players = this._team.players;
                    this.loading = false;
                    console.log('Players ', this.players)
                });
            } else {
                this._team = this.team;
                this.players = this.team.players;
            }
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
                this.editedIndex = this.players.indexOf(item);
                this.editedItem = Object.assign({}, item);
                this.dialog = true
            },

            deleteItem (item) {
                const index = this.players.indexOf(item);
                this.loading = true;
                axios.delete('/api/teams/' + this._team.id + '/players/' + item.id).then((response) => {
                    this.loading = false;
                    this.players.splice(index, 1);
                });
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
                    axios.put('/api/teams/' + this._team.id + '/players/' + this.editedItem.id, this.editedItem).then((response) => {
                        Object.assign(this.players[this.editedIndex], response.data);
                        this.loading = false;
                        this.close()
                    });
                } else {
                    this.loading = true;
                    axios.post('/api/teams/' + this._team.id + '/players', this.editedItem).then((response) => {
                        let createdTeam = response.data;
                        this.players.push(createdTeam);
                        this.loading = false;
                        this.close()
                    });
                }
            }
        }
    }
</script>
