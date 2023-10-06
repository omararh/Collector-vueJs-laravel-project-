import httpClient from "@/services/httpClient";

const headers = {
    'Content-Type': 'application/json'
};


export class CommandRepository {


    // Store a command
    static async store(productIds, customerName, customerPhoneNumber, preparationTime, specificInstructions, totalPrice) {
        const body = {
            productIds,
            customerName,
            customerPhoneNumber,
            preparationTime,
            specificInstructions,
            totalPrice
        };

        try {
            const response = await httpClient.post('/commands/store', body, { headers });
            return response.data;
        } catch (error) {
            console.error(error);
        }
    }

    static async getCommandsByUser(phoneNumber) {

        try {
            const response = await httpClient.get(`/commands/${phoneNumber}`, { phoneNumber }, { headers });
            return response.data;
        } catch (error) {
            console.error(error);
        }
    }

    static async getActiveCommands() {
        try {
            const response = await httpClient.get('admin/commands/actives');
            return response.data.activeCommands;
        } catch (error) {
            console.error(error);
        }
    }

    static async getCommandsByDate(date) {
        try {
            return await httpClient.post('admin/commands/byDate', { date }, { headers });
        } catch (error) {
            console.error(error);
        }
    }
}