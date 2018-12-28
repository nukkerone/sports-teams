<template>
    <v-navigation-drawer
        v-model="drawer"
        fixed
        app
    >
        <v-list dense>

            <v-list-tile @click="navigate('/teams')">
                <v-list-tile-action>
                    <v-icon>chrome_reader_mode</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>Teams</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>

            <v-list-tile @click="navigate('/players')">
                <v-list-tile-action>
                    <v-icon>people</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>Players</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
    export default {
        data () {
            return {};
        },
        props: {
            drawer: Boolean
        },
        methods: {
            navigate(to) {
                this.$router.push(to);
            }
        }
    }
</script>
