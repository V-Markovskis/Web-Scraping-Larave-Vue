<script setup lang="ts">
import { ref, onMounted } from 'vue';

import DataTable from 'datatables.net-vue3';
import DataTablesLib from 'datatables.net';
import 'datatables.net-select';
import axios from "axios";

DataTable.use(DataTablesLib);

let dt;
const data = ref([]);
const table = ref();
const columns = [
    {
        data: 'title',
        title: 'Title',
    },
    {
        data: 'link',
        title: 'Link',
    },
    {
        data: 'points',
        title: 'Points',
    },
];


// Get a DataTables API reference
onMounted(async () => {
    dt = table.value.dt;
    await fetchData();
});

async function fetchData() {
    try {
        const response = await axios.get('/api/scrape-and-save');
        data.value = response.data.data;
        console.log('Data fetched:', data.value);
    } catch (error) {
        console.error('Failed to fetch data: ', error);
    }
}


// For each selected row find the data object in `data` array and remove it
function remove() {
    dt.rows({ selected: true }).every(function () {
        let idx = data.value.indexOf(this.data());
        data.value.splice(idx, 1);
    });
}
</script>

<template>
    <div>
        <h1>Simple table</h1>
        <h2>DataTables + Vue3 example</h2>
        <p>
            This example demonstrates the <code>datatables.net-vue3</code> package
            being used to display an interactive DataTable in a Vue application.
        </p>

        <button @click="remove">Delete selected rows</button>

        <DataTable
            class="display"
            :columns="columns"
            :data="data"
            :options="{ select: true }"
            ref="table"
        />
    </div>
</template>

<style>

</style>
