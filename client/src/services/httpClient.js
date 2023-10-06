import axios from 'axios';
import UrlParser from '@/utils/UrlParser';

class HttpClient {
    constructor() {
        if (!HttpClient.instance) {
            this.axiosInstance = axios.create({
                baseURL: UrlParser().getBaseUrlApi(),
            });

            HttpClient.instance = this;
        }

        return HttpClient.instance;
    }

    get(url) {
        return this.axiosInstance.get(url);
    }

    post(url, data, options) {
        return this.axiosInstance.post(url, data, options);
    }
}

const httpClient = new HttpClient();

export default httpClient;