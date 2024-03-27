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
    {
        data: 'date_created',
        title: 'Date_created',
    }
];


// Get a DataTables API reference
onMounted(async () => {
    dt = table.value.dt;
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

async function scrapeData() {
    await fetchData();
}
</script>

<template>
    <div>
        <h1>Hacker News Web Scraper</h1>
        <h2>Press "Scrape data" to fill the table</h2>
        <p>
            This example demonstrates the <code>datatables.net-vue3</code> package
            being used to display an interactive DataTable in a Vue application.
        </p>

        <button @click="remove">Delete selected rows</button>
        <button @click="scrapeData" :disabled="data.length > 0">Scrape data</button>

        <DataTable
            class="table table-striped table-bordered display"
            :columns="columns"
            :data="data"
            :options="{ select: true }"
            ref="table"
        />
    </div>
</template>

<style>

</style>
