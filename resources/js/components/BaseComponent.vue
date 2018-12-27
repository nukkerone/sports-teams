<template>
    <v-app id="inspire">
        <navigation-component v-bind:drawer="drawer"></navigation-component>

        <!--<toolbar-component v-on:toggle-sidebar="drawer = !drawer" :title="title"></toolbar-component>-->

        <v-content class="indigo">
            <v-container fluid>
                <slot></slot>
            </v-container>
        </v-content>
        <v-footer class="pa-3" color="grey lighten-3">
            <v-spacer></v-spacer>
            <div class="white--text">&copy; {{ new Date().getFullYear() }}</div>
        </v-footer>
    </v-app>


</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                drawer: true
            }
        }
    }
</script>
