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

define([
    'services/applicationuser/user-router',
    'text!./form.html',
    'text!./form.json',
    'react',
    'react-dom',
    'react-form'
], function(userRouter, form, userFormSchemaConfig, React, ReactDOM, JSONSchemaForm) {

    'use strict';

    return {
        defaults: {
            templates: {
                form: form,
                userFormSchema: userFormSchemaConfig
            },
            translations: {
                title: 'application_user.user.frontend.headline',
                userForm_username_title: 'application_user.user.form.username.title',
                userForm_password_title: 'application_user.user.form.password.title',
                userForm_email_title: 'application_user.user.form.email.title',
                userForm_phone_title: 'application_user.user.form.phone.title',
            }
        },

        header: {
            title: 'application_user.user.frontend.headline',
            toolbar: {
                buttons: {
                    save: {
                        parent: 'saveWithOptions'
                    }
                }
            }
        },

        layout: {
            content: {
                width: 'fixed',
                leftSpace: true,
                rightSpace: true
            }
        },

        initialize: function() {
            this.bindCustomEvents();
            this.render();
        },

        bindCustomEvents: function() {
            this.sandbox.on('sulu.header.back', userRouter.toList.bind(this, 'frontend'));
            // this.sandbox.on('sulu.toolbar.delete', this.deleteContact.bind(this));
            // this.sandbox.on('sulu.tab.dirty', this.enableSave.bind(this));
            // this.sandbox.on('sulu.router.navigate', this.disableSave.bind(this));
            // this.sandbox.on('sulu.toolbar.save', this.save.bind(this));
            // this.sandbox.on('sulu.tab.saving', this.loadingSave.bind(this));
            // this.sandbox.on('sulu.tab.data-changed', this.changeData.bind(this));
        },

        render: function() {
            this.$el.html(this.templates.form({translations: this.translations}));
            var formElement = this.$el.find('#user-form')[0],
                reactForm = JSONSchemaForm.default,
                schema = JSON.parse(this.templates.userFormSchema({translations: this.translations}));
            const e = React.createElement;

            ReactDOM.render(e(reactForm, {schema: schema}), formElement);
        },
    };
});
