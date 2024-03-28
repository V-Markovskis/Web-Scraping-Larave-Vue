import axios from "axios";

export async function fetchData() {
    try {
        const response = await axios.get('/api/scrape-and-save');
        return response.data.data;
    } catch (error) {
        console.error('Failed to fetch data: ', error);
    }
}
