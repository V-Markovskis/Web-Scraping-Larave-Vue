<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Hello from Vue component</div>

                    <div class="card-body">
                        <div v-if="isLoading">
                            Loading...
                        </div>
                        <div v-else>
                            <div v-for="(article, index) in articles" :key="index">
                                <h2>{{ article.title }}</h2>
                                <h3>{{ article.link }}</h3>
                                <h3>{{ article.points }}</h3>
                                <h3>{{ article.date_created}}</h3>
                                <span>======================</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
    import axios from "axios";

    export default {
        data() {
            return {
                articles: [] as { title: string, link: string, points: string, date_created: string }[],
                isLoading: true
            };
        },
        mounted() {
            this.fetchData();
        },
        methods: {
            async fetchData() {
                try {
                    const response = await axios.get('/api/scrape-and-save');
                    this.articles = response.data.data;
                } catch (error) {
                    console.error('Failed to fetch data: ', error);
                } finally {
                    this.isLoading = false;
                }
            }
        }
    }
</script>
