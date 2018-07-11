/**
 * Copyright (c) 2014-present, San Wei Ju Yuan Tech Ltd. <https://www.3vjuyuan.com>
 * This file is part of ApplicationUserBundle
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 *
 * For more details:
 * https://www.3vjuyuan.com/licenses.html
 *
 * @author Team Delta <delta@3vjuyuan.com>
 */

define(['text!./list.html'], function (list) {

    var defaults = {
        templates: {
            list: list
        }
    };

    return {
        defaults: defaults,

        header: {
            title: 'application_user.user.frontend.headline',
            underline: false,

            toolbar: {
                buttons: {
                    add: {},
                    deleteSelected: {}
                }
            }
        },

        layout: {
            content: {
                width: 'max'
            }
        },

        initialize: function () {
            this.render();

            this.bindDomEvents();
            this.bindCustomEvents();
        },

        render: function () {
            this.$el.html(this.templates.list());

            this.sandbox.sulu.initListToolbarAndList.call(this,
                'application_user.frontend.user',
                '/admin/api/frontends/users/fields',
                {
                    el: this.$find('#list-toolbar-container'),
                    instanceName: 'frontendUser',
                    template: this.sandbox.sulu.buttons.get({
                        settings: {
                            options: {
                                dropdownItems: [
                                    {
                                        type: 'columnOptions'
                                    }
                                ]
                            }
                        }
                    })
                },
                {
                    el: this.sandbox.dom.find('#user-list'),
                    url: '/admin/api/frontend/users',
                    searchInstanceName: 'frontendUser',
                    searchFields: ['username'],
                    resultKey: 'frontend-users',
                    instanceName: 'frontendUser',
                    actionCallback: this.toEdit.bind(this),
                    viewOptions: {
                        table: {
                            actionIconColumn: 'username'
                        }
                    }
                }
            );
        },

        toEdit: function (id) {
            this.sandbox.emit('sulu.router.navigate', 'app-user/fronted-users/edit:' + id);
        },

        toAdd: function () {
            this.sandbox.emit('sulu.router.navigate', 'app-user/fronted-users/add');
        },

        deleteItems: function (ids) {
            for (var i = 0, length = ids.length; i < length; i++) {
                this.deleteItem(ids[i]);
            }
        },

        deleteItem: function (id) {
            this.sandbox.util.save('/admin/api/frontends/' + id + '/user', 'DELETE').then(function () {
                this.sandbox.emit('husky.datagrid.user.record.remove', id);
            }.bind(this));
        },

        bindDomEvents: function () {
        },

        bindCustomEvents: function () {
            this.sandbox.on('sulu.toolbar.add', this.toAdd.bind(this));

            this.sandbox.on('husky.datagrid.user.number.selections', function (number) {
                var postfix = number > 0 ? 'enable' : 'disable';
                this.sandbox.emit('sulu.header.toolbar.item.' + postfix, 'deleteSelected', false);
            }.bind(this));

            this.sandbox.on('sulu.toolbar.delete', function () {
                this.sandbox.emit('husky.datagrid.user.items.get-selected', this.deleteItems.bind(this));
            }.bind(this));
        }
    };
});

