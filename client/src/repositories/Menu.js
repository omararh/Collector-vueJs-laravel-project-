import httpClient from "@/services/httpClient";

export class MenuRepository {

    // get the menu     
    static get() {
        return httpClient.get('/menu');
    }

    //get item by ID
    static getByID(id) {
        return httpClient.get(`/menu/${id}`);
    }
}