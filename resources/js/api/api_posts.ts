import { api } from './axios';
import {DayMenu} from "@/types/menu/dayMenu";
import {Post} from "@/types/post";

export const api_posts = {
    getPosts(): Promise<Post[]> {
        return new Promise((resolve, reject) => {
            api.get('/posts')
                .then(res => resolve(res.data))
                .catch(err => reject(err));
        });
    },
}
