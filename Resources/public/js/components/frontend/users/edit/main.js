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

define(['text!./form.html', 'services/applicationuser/user-router'], function(form, userRouter) {

    return {
        defaults: {
            templates: {
                form: form
            },
            translations: {
                title: 'application_user.user.frontend.headline',
                content: 'application_user.user.frontend.edit.content'
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
            this.sandbox.on('sulu.header.back', function () {Mediator.emit('sulu.router.navigate', 'app-user/fronted-users');});
            // this.sandbox.on('sulu.toolbar.delete', this.deleteContact.bind(this));
            // this.sandbox.on('sulu.tab.dirty', this.enableSave.bind(this));
            // this.sandbox.on('sulu.router.navigate', this.disableSave.bind(this));
            // this.sandbox.on('sulu.toolbar.save', this.save.bind(this));
            // this.sandbox.on('sulu.tab.saving', this.loadingSave.bind(this));
            // this.sandbox.on('sulu.tab.data-changed', this.changeData.bind(this));
        },

        render: function() {
            this.$el.html(this.templates.form({translations: this.translations}));
            // var formElement = this.$el.find('#user-form')[0],
            //     reactForm = JSONSchemaForm.default;
            // const e = React.createElement;
            //
            // const schema = {
            //     title: "Todo",
            //     type: "object",
            //     required: ["title"],
            //     properties: {
            //         title: {type: "string", title: "Title", default: "A new task"},
            //         done: {type: "boolean", title: "Done?", default: false}
            //     }
            // };
            //
            // class LikeButton extends React.Component {
            //     constructor(props) {
            //         super(props);
            //         this.state = { liked: false };
            //     }
            //
            //     render() {
            //         if (this.state.liked) {
            //             return 'You liked this.';
            //         }
            //
            //         return e(
            //             'button',
            //             { onClick: () => this.setState({ liked: true }) },
            //             'Like'
            //         );
            //     }
            // }
            //
            // ReactDOM.render(e(reactForm, {schema: schema}), formElement);
        },
    };
});
