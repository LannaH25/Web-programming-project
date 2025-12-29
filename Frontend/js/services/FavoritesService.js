

class FavoritesService {
    constructor(baseUrl) {
        this.baseUrl = baseUrl; 
    }

   
    async addFavorite(userId, itemId, token) {
        const response = await fetch(`${this.baseUrl}/favorites`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            },
            body: JSON.stringify({ user_id: userId, item_id: itemId })
        });

        if (!response.ok) {
            const error = await response.json();
            throw new Error(error.error || 'Failed to add favorite');
        }

        return await response.json();
    }

    
    async removeFavorite(favoriteId, token) {
        const response = await fetch(`${this.baseUrl}/favorites/${favoriteId}`, {
            method: 'DELETE',
            headers: {
                'Authorization': `Bearer ${token}`
            }
        });

        if (!response.ok) {
            const error = await response.json();
            throw new Error(error.error || 'Failed to remove favorite');
        }

        return await response.json();
    }


    async getFavorites(userId, token) {
        const response = await fetch(`${this.baseUrl}/favorites/${userId}`, {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        });

        if (!response.ok) {
            const error = await response.json();
            throw new Error(error.error || 'Failed to fetch favorites');
        }

        return await response.json();
    }
}


export const favoritesService = new FavoritesService('http://localhost:8000');
