import httpClient from "@/services/httpClient";


export class UserRepository {


    static async logIn(email, password) {
        const body = {
            email,
            password
        };
        const headers = {
            'Content-Type': 'application/json'
        };

        try {
            const response = await httpClient.post('/logIn', body, { headers });
            if (!response.data) {
                throw new Error("email ou mot de passe incorrecte !");
            }

            const token = response.data.authorisation.token;
            localStorage.setItem('jwtToken', token);
            localStorage.setItem('custumerName', response.data.user.name);
            localStorage.setItem('custumerPhoneNumber', response.data.user.phoneNumber);
            return true;
        } catch (error) {
            console.error(error);
        }
    }

    static async logOut() {
        try {
            await httpClient.post('/logOut');
        } catch (error) {
            console.error(error);
        }
    }

    static async signIn(name, phoneNumber, email, password, confirmPassword) {
        const body = {
            name,
            phoneNumber,
            email,
            password,
            confirmPassword
        }
        const headers = {
            'Content-Type': 'application/json'
        };

        try {
            const response = await httpClient.post('/signIn', body, headers);
            return response.data;
        } catch (error) {
            console.error(error);
            return error.response.data;
        }
    }

    static async isConnected() {
        try {
            const response = await httpClient.get('/verifyToken');
            return response.data.status === 'success';
        } catch (error) {
            if (error.response && error.response.status === 401) {
                return false;
            }
            console.error(error);
        }
    }

    static async isAdmin() {
        try {
            const response = await httpClient.get('/verifyIfAdmin');
            return response.data.status === 'success';
        } catch (error) {
            console.error(error);
        }
    }
}