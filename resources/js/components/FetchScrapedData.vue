<template>
    <div>
        <h1>{{ data }}</h1>
    </div>
</template>

<script lang="ts">
    import axios from "axios";
    import {onMounted, ref} from "vue";

    export default {
        setup() {
            const data = ref(null);

            const scrapedData = async () => {
                try {
                    const response = await axios.get('/api/scrape-and-save');
                    console.log('response data', response.data);
                    data.value = response.data;
                } catch (error) {
                    console.error('Failed to fetch: ', error);
                }
            };

            onMounted(scrapedData);

            return {
                data
            };
        }
    };
</script>

<style lang="css" scoped>

</style>
