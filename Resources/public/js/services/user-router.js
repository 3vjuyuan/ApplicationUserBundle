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

define(['services/husky/mediator'], function(Mediator) {
    'use strict';

    var instance = null;

    /** @constructor **/
    function UserRouter() {}

    UserRouter.prototype = {
        /**
         * Navigates to the edit of an account
         * @param id The id of the account to edit
         */
        toEdit: function(side, id) {
            console.log(id);
            Mediator.emit('sulu.router.navigate', 'app-user/' + side + '-users/edit:' + id + '/details');
        },

        /**
         * Navigates to the add-page of a new account
         */
        toAdd: function(side) {
            Mediator.emit('sulu.router.navigate', 'app-user/' + side + '-users/add', true, true);
        },

        /**
         * Navigates to the accounts list
         */
        toList: function(side) {
            Mediator.emit('sulu.router.navigate', 'app-user/' + side + '-users');
        }
    };

    UserRouter.getInstance = function() {
        if (instance == null) {
            instance = new UserRouter();
        }

        return instance;
    };

    return UserRouter.getInstance();
});
