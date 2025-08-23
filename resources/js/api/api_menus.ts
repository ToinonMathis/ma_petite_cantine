// src/api/api_menus.ts
import { api } from './axios';
import {DayMenu} from "@/types/menu/dayMenu";

export const api_menus = {
    getMenus(): Promise<DayMenu> {
        return new Promise((resolve, reject) => {
            api.get('/menus')
                .then(res => resolve(res.data))
                .catch(err => reject(err));
        });
    },
}
