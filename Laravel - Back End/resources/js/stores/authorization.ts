import api from '@services/api';
import { ILoginPayload, IUserProfile, IChangePasswordPayload } from '@src/types/authorization';
import { defineStore } from 'pinia'
import { reactive } from 'vue';

export const useAuthorizationStore = defineStore('authorization', () => {
    const data = reactive({
        authorized: false,
        id: '',
        name: '',
        role: null,
    }) as IUserProfile;

    function setToken(token: string) {
        localStorage.setItem('lp_token', token)
    }

    function setProfileData(payload: IUserProfile | null) {
        data.authorized = payload ? true : false;
        data.id = payload?.id ?? '';
        data.name = payload?.name ?? '';
        data.role = payload?.role ?? null;
    }

    async function logout() {
        const res = await api().post('api/auth/logout')
        setToken('')
        localStorage.clear()
        setProfileData(null);
        return res;
    }

    async function getProfile(setToAuthorizationState = false) {
        try {
            const response = await api().get('api/auth/me');

            if (setToAuthorizationState) {
                setProfileData(response.data.data)
            }
            return response;
        } catch (error) {
            if (setToAuthorizationState) {
                setProfileData(null)
            }
            throw error;
        }
    }
    async function login(payload: ILoginPayload) {
        const response = await api().post('api/auth/login', payload);
        setToken(response.data.data.token.accessToken)
        return response;
    }

    async function changePassword(payload: IChangePasswordPayload) {
        const response = await api().put('api/auth/change-password', payload);
        return response;
    }

    return { data, setToken, logout, getProfile, login, changePassword };

});
