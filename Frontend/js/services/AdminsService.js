

class AdminsService {
    constructor(baseUrl) {
        this.baseUrl = baseUrl;
    }

    async getAll(token) {
        const response = await fetch(`${this.baseUrl}/admins`, {
            headers: { 'Authorization': `Bearer ${token}` }
        });
        if (!response.ok) throw new Error('Failed to fetch admins');
        return await response.json();
    }

    async getById(id, token) {
        const response = await fetch(`${this.baseUrl}/admins/${id}`, {
            headers: { 'Authorization': `Bearer ${token}` }
        });
        if (!response.ok) throw new Error('Failed to fetch admin');
        return await response.json();
    }

    async create(adminData, token) {
        const response = await fetch(`${this.baseUrl}/admins`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            },
            body: JSON.stringify(adminData)
        });
        if (!response.ok) {
            const error = await response.json();
            throw new Error(error.error || 'Failed to create admin');
        }
        return await response.json();
    }

    async update(id, adminData, token) {
        const response = await fetch(`${this.baseUrl}/admins/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            },
            body: JSON.stringify(adminData)
        });
        if (!response.ok) {
            const error = await response.json();
            throw new Error(error.error || 'Failed to update admin');
        }
        return await response.json();
    }

    async delete(id, token) {
        const response = await fetch(`${this.baseUrl}/admins/${id}`, {
            method: 'DELETE',
            headers: { 'Authorization': `Bearer ${token}` }
        });
        if (!response.ok) throw new Error('Failed to delete admin');
        return await response.json();
    }
}

export const adminsService = new AdminsService('http://localhost:8000');
