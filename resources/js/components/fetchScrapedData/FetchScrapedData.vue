<script setup lang="ts">
import { ref, onMounted } from 'vue';

import DataTable from 'datatables.net-vue3';
import DataTablesLib from 'datatables.net';
import 'datatables.net-select';
import { getAllData } from "../../callsToDB/getAllData.js";
import { deleteAllData } from "../../callsToDB/deleteAllData.js";


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
        title: 'Date created',
    }
];


// Get a DataTables API reference
onMounted(async () => {
    dt = table.value.dt;
    await deleteAllData();
});


// For each selected row find the data object in `data` array and remove it
function remove() {
    dt.rows({ selected: true }).every(function () {
        let idx = data.value.indexOf(this.data());
        data.value.splice(idx, 1);
    });
}

async function scrapeData() {
    data.value = await getAllData();
}
</script>

<template>
    <div class="p-5 pt-0">
        <h1>Hacker News Web Scraper</h1>
        <h2>Press "Scrape data" to fill the table</h2>
        <p>
            This example demonstrates the <code>datatables.net-vue3</code> package
            being used to display an interactive DataTable in a Vue application.
        </p>

        <div class="d-flex gap-2 pb-5">
            <button @click="remove" class="btn btn-danger">Delete selected rows</button>
            <button @click="scrapeData"
                    :class="[{'btn-secondary': data.length > 0}, 'btn', 'btn-primary']"
                    :disabled="data.length > 0">Scrape data</button>

        </div>

        <DataTable
            class="table table-striped table-bordered display hover"
            :columns="columns"
            :data="data"
            :options="{ select: true }"
            ref="table"
        />
    </div>
</template>

<style>
 @import '../../../../node_modules/datatables.net-dt';
 @import './FetchScrapedData.css';
</style>
