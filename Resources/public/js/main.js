require.config({
    paths: {
        // 'type/group-selection': '../../applicationuser/js/validation/types/group-selection'
    }
});

define(function () {

    'use strict';

    return {
        name: "Application User Bundle",

        initialize: function (app) {
            app.components.addSource('applicationuser', '/bundles/applicationuser/js/components');

            let sandbox = app.sandbox;

            // Frontend users list view
            sandbox.mvc.routes.push({
                route: 'app-user/fronted-users',
                callback: function() {
                    return '<div data-aura-component="frontend/users/list@applicationuser"/>';

                }
            });

            sandbox.mvc.routes.push({
                route: 'app-user/fronted-users/add',
                callback: function() {
                    return '<div data-aura-component="frontend/users/edit@applicationuser"/>';
                }
            });

            // show form for editing a contact
            sandbox.mvc.routes.push({
                route: 'app-user/fronted-users/edit::id/:content',
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
