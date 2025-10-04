import { api } from './axios';
import {DayMenu} from "@/types/menu/dayMenu";
import {Post} from "@/types/post";
import PostCreate from "@/pages/PostCreate.vue";

export const api_posts = {
    getPosts(): Promise<Post[]> {
        return new Promise((resolve, reject) => {
            api.get('/posts')
                .then(res => resolve(res.data))
                .catch(err => reject(err));
        });
    },
    post(post: PostCreate) {
        return new Promise((resolve, reject) => {
            api.post('post', post)
                .then(res => resolve(res.data))
                .catch(err => reject(err));
        });
    },
    like(postId: number) {
        const body = {
            id_post: postId,
        };
        return new Promise((resolve, reject) => {
            api.post('/post/like', body)
                .then(res => resolve(res.data))
                .catch(err => reject(err));
        })
    },
    unlike(postId: number) {
        const body = {
            id_post: postId,
        };
        return new Promise((resolve, reject) => {
            api.delete(`/post/${postId}/unlike`)
                .then(res => resolve(res.data))
                .catch(err => reject(err));
        })
    }
}
