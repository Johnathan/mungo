import Dashboard from './components/pages/Dashboard.vue';

// Settings
import SettingsIndex from './components/pages/Settings/Index.vue';
import SettingsRolesAndPermissions from './components/pages/Settings/RolesAndPermissions.vue';

export default [
    {
        path: '/admin',
        component: { template: '<router-view></router-view>' },
        children: [
            {
                path: 'dashboard',
                component: Dashboard
            },
            {
                path: 'settings',
                component: SettingsIndex,
                children: [
                    {
                        path: 'roles-and-permissions',
                        component: SettingsRolesAndPermissions
                    }
                ]
            }
        ]
    },
];