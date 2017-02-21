exports.install = function( Vue, options ){

    let currentUser = {};
    let roles = [];
    let permissions = [];

    Vue.prototype.$currentUser = function(){};

    Vue.prototype.$currentUser.set = function( user ) {
        currentUser = user;

        // Add use user roles to roles array
        currentUser.roles.forEach( role => {
            roles.push( role.name );

            // Add role permissions to permissions array
            role.permissions.forEach( permission => {
                permissions.push( permission.name );
            });
        });

        // Add user permissions to permissions array
        currentUser.permissions.forEach( permission => {
            permissions.push( permission.name );
        });
    };

    Vue.prototype.$currentUser.hasPermissionTo = function( permission_name ) {
        return permissions.indexOf( permission_name ) >= 0;
    };

    Vue.prototype.$currentUser.hasRole = function( role_name ) {
        return roles.indexOf( role_name ) >= 0;
    };
};
