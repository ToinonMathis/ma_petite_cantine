// src/api/api_recipes.ts
import { api } from './axios';
import {DayMenu} from "@/types/menu/dayMenu";

export const api_recipes = {
    getRecipes(): Promise<[]> {
        return new Promise((resolve, reject) => {
            api.get('/recipes')
                .then(res => resolve(res.data))
                .catch(err => reject(err));
        });
    },
}
