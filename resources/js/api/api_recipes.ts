// src/api/api_recipes.ts
import { api } from './axios';
import type { RecipeCreate } from "@/types/menu/recipeCreate";

export const api_recipes = {
    getRecipes(): Promise<[]> {
        return api.get('/recipes').then(res => res.data);
    },

    async submitRecipe(recipe: RecipeCreate) {
        const formData = new FormData();

        // Infos principales
        formData.append('title', recipe.title);
        formData.append('description', recipe.description ?? '');
        formData.append('type', recipe.type);
        formData.append('preparation_time', recipe.preparation_time?.toString() ?? '0');
        formData.append('difficulty', recipe.difficulty);

        // Image
        if (recipe.image) {
            formData.append('image', recipe.image);
        }

        // Ingrédients
        recipe.ingredients.forEach((ingredient, index) => {
            formData.append(`ingredients[${index}][label]`, ingredient.label);
            formData.append(`ingredients[${index}][quantity]`, ingredient.quantity ?? '');
        });

        // Étapes
        recipe.steps.forEach((step, index) => {
            formData.append(`steps[${index}][step_number]`, step.step_number?.toString() ?? (index + 1).toString());
            formData.append(`steps[${index}][description]`, step.description);
            formData.append(`steps[${index}][advice]`, step.advice ?? '');
            formData.append(`steps[${index}][duration]`, step.duration?.toString() ?? '');
        });

        try {
            const response = await api.post('/recipes', formData, {
                headers: { 'Content-Type': 'multipart/form-data' }
            });
            console.log('Recette enregistrée', response.data);
            return response.data;
        } catch (error) {
            console.error('Erreur lors de l\'envoi', error);
            throw error;
        }
    }
};
