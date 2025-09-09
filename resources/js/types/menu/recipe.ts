export type RecipeType = "entrée" | "plat" | "dessert";
export type Difficulty = "facile" | "moyen" | "difficile";

export interface RecipeIngredient {
    id: number;
    recipe_id: number;
    label: string;
    quantity?: string | null; // ex: "200 g", "3 pcs"
    created_at?: string | Date;
    updated_at?: string | Date;
}

export interface RecipeStep {
    id: number;
    recipe_id: number;
    step_number: number;
    description: string;
    advice?: string | null;
    duration?: number | null; // durée en minutes
    created_at?: string | Date;
    updated_at?: string | Date;
}

export interface Recipe {
    id: number;
    user_id: number;
    title: string;
    description?: string | null;
    type: RecipeType;
    preparation_time?: number | null;
    difficulty: Difficulty;
    image?: string | null;
    steps?: RecipeStep[];
    ingredients?: RecipeIngredient[];
    created_at?: string | Date;
    updated_at?: string | Date;
}
