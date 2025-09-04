export type RecipeType = "entrée" | "plat" | "dessert";
export type Difficulty = "facile" | "moyen" | "difficile";

export interface Recipe {
    id: number;
    user_id: number;
    title: string;
    description?: string | null;
    type: RecipeType;
    preparation_time?: number | null;
    difficulty: Difficulty;
    image?: string | null;
    created_at?: string | null;  // ou Date si tu convertis
    updated_at?: string | null;  // ou Date si tu convertis
}
