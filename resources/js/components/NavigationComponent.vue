<template>
    <v-navigation-drawer
        v-model="drawer"
        fixed
        app
    >
        <v-list dense>
            <v-list-tile @click="navigate('home')">
                <v-list-tile-action>
                    <v-icon>home</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>Home</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>

            <v-subheader>Redmine Data</v-subheader>

            <v-list-tile @click="navigate('redmine-clients')">
                <v-list-tile-action>
                    <v-icon>assignment_ind</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>Clients</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>

            <v-list-tile @click="navigate('redmine-projects')">
                <v-list-tile-action>
                    <v-icon>assignment_ind</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>Projects</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
    export default {
        data () {
            return {
                items: [
                    { title: 'Teams', icon: 'chrome_reader_mode' },
                    { title: 'Players', icon: 'people' }
                ],
                right: null,
            }
        },
        props: {
            drawer: Boolean
        },
    }
</script>
