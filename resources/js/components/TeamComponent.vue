<template>

    <base-component :title="'Team'">
        <v-data-table
            :headers="headers"
            :items="players"
            class="elevation-1"
        >
            <template slot="items" slot-scope="props">
                <td class="text-xs-right">{{ props.item.id }}</td>
                <td class="text-xs-right">{{ props.item['first-name'] }}</td>
                <td class="text-xs-right">{{ props.item['last-name'] }}</td>
            </template>
        </v-data-table>
    </base-component>

</template>

<style>
    .v-content > div { height: calc(100% - 36px); }
</style>

<script>
    export default {
        data () {
            return {
                headers: [
                    { text: 'ID', value: 'id' },
                    { text: 'First Name', value: 'first-name' },
                    { text: 'Last Name', value: 'last-name' },
                ],
                players: [

                ],
                drawer: true,
            }
        },
        props: {
            team: null
        }
    }
</script>
