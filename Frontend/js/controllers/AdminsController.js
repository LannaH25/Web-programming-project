
import { adminsService } from '../services/AdminsService.js';

class AdminsController {
    constructor(token) {
        this.token = token;
    }

    async getAllAdmins() {
        try {
            const admins = await adminsService.getAll(this.token);
            console.log('Admins:', admins);
            return admins;
        } catch (error) {
            console.error(error.message);
            throw error;
        }
    }

    async getAdminById(id) {
        try {
            const admin = await adminsService.getById(id, this.token);
            console.log('Admin:', admin);
            return admin;
        } catch (error) {
            console.error(error.message);
            throw error;
        }
    }

    async createAdmin(data) {
        try {
            const newAdmin = await adminsService.create(data, this.token);
            console.log('Admin created:', newAdmin);
            return newAdmin;
        } catch (error) {
            console.error(error.message);
            throw error;
        }
    }

    async updateAdmin(id, data) {
        try {
            const updatedAdmin = await adminsService.update(id, data, this.token);
            console.log('Admin updated:', updatedAdmin);
            return updatedAdmin;
        } catch (error) {
            console.error(error.message);
            throw error;
        }
    }

    async deleteAdmin(id) {
        try {
            const result = await adminsService.delete(id, this.token);
            console.log('Admin deleted:', result);
            return result;
        } catch (error) {
            console.error(error.message);
            throw error;
        }
    }
}

export default AdminsController;
