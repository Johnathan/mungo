import Dashboard from './components/pages/Dashboard.vue';

// Settings
import SettingsIndex from './components/pages/Settings/Index.vue';
import SettingsRolesAndPermissions from './components/pages/Settings/RolesAndPermissions.vue';

export default [
    {
        path: '/admin',
        component: { template: '<router-view></router-view>' },
        name: 'admin',
        children: [
            {
                path: 'dashboard',
                component: Dashboard,
                name: 'admin.dashboard'
            },
            {
                path: 'settings',
                component: SettingsIndex,
                name: 'admin.settings',
                children: [
                    {
                        path: 'roles-and-permissions',
                        component: SettingsRolesAndPermissions,
                        name: 'admin.settings.roles-and-permissions',
                    }
                ]
            }
        ]
    },
];