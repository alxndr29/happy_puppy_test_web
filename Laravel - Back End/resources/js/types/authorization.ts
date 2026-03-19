import { IRole } from "./user";

export interface ILoginPayload {
    username: string,
    password: string,
}

export interface IUserProfile {
    authorized: boolean,
    id: string,
    name: string,
    role: IRole | null
}

export interface IChangePasswordPayload {
    currentPassword: string,
    newPassword: string,
    newPasswordConfirmation: string,
}
