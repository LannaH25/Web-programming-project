
import { favoritesService } from '../services/FavoritesService.js';

class FavoritesController {
    constructor(userId, token) {
        this.userId = userId;
        this.token = token;
    }

    async addFavorite(itemId) {
        try {
            const result = await favoritesService.addFavorite(this.userId, itemId, this.token);
            console.log('Favorite added:', result.data);
            return result.data;
        } catch (error) {
            console.error('Error adding favorite:', error.message);
            throw error;
        }
    }

    async removeFavorite(favoriteId) {
        try {
            const result = await favoritesService.removeFavorite(favoriteId, this.token);
            console.log(result.message);
            return result.message;
        } catch (error) {
            console.error('Error removing favorite:', error.message);
            throw error;
        }
    }

    async getFavorites() {
        try {
            const result = await favoritesService.getFavorites(this.userId, this.token);
            console.log('Favorites:', result.data);
            return result.data;
        } catch (error) {
            console.error('Error fetching favorites:', error.message);
            throw error;
        }
    }
}

export default FavoritesController;
