import MasterUser from "@src/views/admin/master/user/Index.vue"
import MasterKategoriBerita from "@src/views/admin/master/kategori-berita/Index.vue"

import { useEnvironmentStore } from "@/stores/environment"
import { createPinia, setActivePinia } from "pinia"

const pinia = createPinia()
setActivePinia(pinia)

const environmentStore = useEnvironmentStore();

const routes = [
    {
        path: 'master',
        children: [
            {
                path: 'kategori-berita',
                name: 'a-m-kategori-berita',
                component: MasterKategoriBerita,
                meta: {
                    specificRole: [environmentStore.data.roleSuperAdmin, environmentStore.data.roleAdmin],
                }
            },
            {
                path: 'user',
                name: 'a-m-user',
                component: MasterUser,
                meta: {
                    specificRole: [environmentStore.data.roleSuperAdmin, environmentStore.data.roleAdmin],
                }
            },
        ]
    }
]

export default routes
