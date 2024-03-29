import axios from 'axios';

const fetchRates = async (currency) => {
    try {
        const response = await axios.get(`http://127.0.0.1:8080/rates/${currency}`);
        return response.data.items;
    } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
        return [];
    }
};

export { fetchRates };
