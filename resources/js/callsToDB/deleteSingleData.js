import axios from "axios";

export async function deleteSingleData(id) {
    try {
        const response = await axios.delete(`api/delete-single/${id}`);
        return response.data.data;
    } catch (error) {
        console.error('Failed to fetch data: ', error);
    }
}
