import axios from "axios";

export async function deleteAllData() {
    try {
        const response = await axios.delete('/api/delete-all');
        return response.data.data;
    } catch (error) {
        console.error('Failed to fetch data: ', error);
    }
}
