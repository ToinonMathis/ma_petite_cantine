import {User} from "@/types/index";

export interface Post {
    id: number;
    title: string;
    content: string;
    image: string;
    image_url: string;
    user: User;
    comments: Comment[];
    likes: any[];
}

interface Comment {
    id: number;
    content: string;
    user: User;
}
