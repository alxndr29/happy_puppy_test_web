import { defineStore } from 'pinia'

interface User {
  id: string
  name: string
  email: string
  role: string
  createdAt: string
  updatedAt: string
}

interface AuthState {
  user: User | null
  token: string | null
  isAuthenticated: boolean
}

export const useAuthStore = defineStore('auth', {
  state: (): AuthState => ({
    token: null as string | null,
    user: null as User | null,
    isAuthenticated: false
  }),

  actions: {
    setAuth(token: string, user: User) {
      this.token = token
      this.user = user
      this.isAuthenticated = true
    },
    removeAuth() {
      this.token = null
      this.user = null
      this.isAuthenticated = false
    },
  },

  persist: true,
})
