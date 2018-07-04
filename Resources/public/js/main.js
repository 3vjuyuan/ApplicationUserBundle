require.config({
    paths: {
        applicationuser: '../../applicationuser/js'
        // 'type/group-selection': '../../applicationuser/js/validation/types/group-selection'
    }
});

define(function () {

    'use strict';

    return {
        name: "Application User Bundle",

        initialize: function (app) {
            app.components.addSource('applicationuser', '/bundles/applicationuser/js/components');

            // Frontend users list view
            app.sandbox.mvc.routes.push({
                route: 'appUser/frontedUser',
                callback: function() {
                    return '<div data-aura-component="frontend/users@applicationuser"/>';

                }
            });

            // Frontend user groups list view
            app.sandbox.mvc.routes.push({
                route: 'appUser/frontendGroup',
                callback: function() {
                    return '<div data-aura-component="frontend/groups@applicationuser"/>';
                }
            });

            // Backend users list view
            app.sandbox.mvc.routes.push({
                route: 'appUser/backendUser',
                callback: function() {
                    return '<div data-aura-component="backend/users@applicationuser"/>';
                }
            });

            // Backend user groups list view
            app.sandbox.mvc.routes.push({
                route: 'appUser/backendGroup',
                callback: function() {
                    return '<div data-aura-component="backend/groups@applicationuser"/>';
                }
            });
        }

        // initialize: function (app) {
        //
        //     app.components.addSource('frontenduser', '/bundles/applicationuser/js/components');
        //
        //     app.sandbox.mvc.routes.push({
        //         route: 'frontend/user',
        //         callback: function () {
        //             return '<div data-aura-component="user/list@frontenduser" data-aura-name="sulu" />';
        //         }
        //     });
        //
        //     app.sandbox.mvc.routes.push({
        //         route: 'frontend/user/add',
        //         callback: function () {
        //             return '<div data-aura-component="user/form@frontenduser"/>';
        //         }
        //     });
        //
        //     app.sandbox.mvc.routes.push({
        //         route: 'frontend/user/edit::id',
        //         callback: function (id) {
        //             return '<div data-aura-component="user/form@frontenduser" data-aura-id="' + id + '"/>';
        //         }
        //     });
        //
        //     app.sandbox.mvc.routes.push({
        //         route: 'frontend/supplier',
        //         callback: function () {
        //             return '<div data-aura-component="supplier/list@frontenduser" data-aura-name="sulu" />';
        //         }
        //     });
        //
        //     app.sandbox.mvc.routes.push({
        //         route: 'frontend/supplier/add',
        //         callback: function () {
        //             return '<div data-aura-component="supplier/form@frontenduser"/>';
        //         }
        //     });
        //
        //     app.sandbox.mvc.routes.push({
        //         route: 'frontend/supplier/edit::id',
        //         callback: function (id) {
        //             return '<div data-aura-component="supplier/form@frontenduser" data-aura-id="' + id + '"/>';
        //         }
        //     });
        //
        //     app.sandbox.mvc.routes.push({
        //         route: 'frontend/group',
        //         callback: function () {
        //             return '<div data-aura-component="group/list@frontenduser" data-aura-name="sulu" />';
        //         }
        //     });
        //
        //     app.sandbox.mvc.routes.push({
        //         route: 'frontend/group/add',
        //         callback: function () {
        //             return '<div data-aura-component="group/form@frontenduser"/>';
        //         }
        //     });
        //
        //     app.sandbox.mvc.routes.push({
        //         route: 'frontend/group/edit::id',
        //         callback: function (id) {
        //             return '<div data-aura-component="group/form@frontenduser" data-aura-id="' + id + '"/>';
        //         }
        //     });
        // }
    };
});
