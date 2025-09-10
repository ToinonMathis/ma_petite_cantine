import type { RecipeType, Difficulty } from './recipe';

export interface RecipeIngredientCreate {
    label: string;
    quantity?: string | null;
}

export interface RecipeStepCreate {
    step_number: number;
    description: string;
    advice?: string | null;
    duration?: number | null;
}

export interface RecipeCreate {
    title: string;
    description?: string | null;
    type: RecipeType;
    preparation_time?: number | null;
    difficulty: Difficulty;
    image?: File | null;
    ingredients: RecipeIngredientCreate[];
    steps: RecipeStepCreate[];
}
