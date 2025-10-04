import {User} from "@/types/index";

export interface Post {
    id: number;
    title: string;
    content: string;
    image: string;
    image_url: string;
    user: User;
    comments: Comment[];
    user_has_liked: boolean;
}

export interface CreatePost {
    title: string;
    content: string;
    image: File | null;
}

interface Comment {
    id: number;
    content: string;
    user: User;
}
