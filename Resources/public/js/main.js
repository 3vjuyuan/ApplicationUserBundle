require.config({
    paths: {
        applicationuser: '../../applicationuser/js',
        applicationusercss: '../../applicationuser/css',

        'react': '../../applicationuser/js/vendor/react',
        'react-dom': '../../applicationuser/js/vendor/react-dom',
        'react-form': '../../applicationuser/js/vendor/react-jsonschema-form',

        'services/applicationuser/user-router': '../../applicationuser/js/services/user-router',




        // 'services/applicationuser/contact-manager': '../../sulucontact/js/services/contact-manager',
        // 'services/applicationuser/account-manager': '../../sulucontact/js/services/account-manager',
        // 'services/applicationuser/account-router': '../../sulucontact/js/services/account-router',
        // 'services/sulucontact/contact-router': '../../sulucontact/js/services/contact-router',
        // 'services/sulucontact/account-delete-dialog': '../../sulucontact/js/services/account-delete-dialog',
        //
        // 'extensions/sulu-buttons-contactbundle': '../../sulucontact/js/extensions/sulu-buttons',
        //
        // 'type/customer-selection': '../../sulucontact/js/validation/types/customer-selection',
        // 'type/contact-selection': '../../sulucontact/js/validation/types/contact-selection'

        // 'type/group-selection': '../../applicationuser/js/validation/types/group-selection'
    }
});

define(['config'], function (Config) {

    'use strict';

    return {
        name: "Application User Bundle",

        initialize: function (app) {
            var sandbox = app.sandbox;

            app.components.addSource('applicationuser', '/bundles/applicationuser/js/components');

            // Frontend users list view
            sandbox.mvc.routes.push({
                route: 'app-user/frontend-users',
                callback: function() {
                    return '<div data-aura-component="frontend/users/list@applicationuser"/>';

                }
            });

            sandbox.mvc.routes.push({
                route: 'app-user/frontend-users/add',
                callback: function() {
                    return '<div data-aura-component="frontend/users/edit@applicationuser"/>';
                }
            });

            // show form for editing a contact
            sandbox.mvc.routes.push({
                route: 'app-user/frontend-users/edit::id/:content',
                callback: function(id) {
                    return '<div data-aura-component="frontend/users/edit@applicationuser" data-aura-id="' + id + '"/>';
                }
            });

            // Frontend user groups list view
            sandbox.mvc.routes.push({
                route: 'app-user/frontend-groups',
                callback: function() {
                    return '<div data-aura-component="frontend/groups/list@applicationuser"/>';
                }
            });

            // Backend users list view
            sandbox.mvc.routes.push({
                route: 'app-user/backend-users',
                callback: function() {
                    return '<div data-aura-component="backend/users@applicationuser"/>';
                }
            });

            // Backend user groups list view
            sandbox.mvc.routes.push({
                route: 'app-user/backend-groups',
                callback: function() {
                    return '<div data-aura-component="backend/groups@applicationuser"/>';
                }
            });
        }
    };
});
