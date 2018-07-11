<?php
/*
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
 * @author Team Weave<weave@3vjuyuan.com>
 */

namespace Savwy\SuluBundle\ApplicationUserBundle\Admin;

use Sulu\Bundle\AdminBundle\Admin\Admin;
use Sulu\Bundle\AdminBundle\Navigation\Navigation;
use Sulu\Bundle\AdminBundle\Navigation\NavigationItem;

class ApplicationUserAdmin extends Admin
{
    /**
     * ApplicationUserAdmin constructor.
     * @param string $title
     */
    public function __construct($title)
    {
        $rootNavigationItem = new NavigationItem($title);
        $section = new NavigationItem('navigation.modules');

        $applicationUsersMenu = new NavigationItem('navigation.applicationUser');
        $applicationUsersMenu->setPosition(20);
        $applicationUsersMenu->setIcon('users');
        $section->addChild($applicationUsersMenu);

        $user = new NavigationItem('navigation.applicationUser.frontendUser');
        $user->setAction('app-user/fronted-users');
        $applicationUsersMenu->addChild($user);

        $frontendGroup = new NavigationItem('navigation.applicationUser.frontendGroup');
        $frontendGroup->setAction('app-user/fronted-groups');
        $applicationUsersMenu->addChild($frontendGroup);

        $supplier = new NavigationItem('navigation.applicationUser.backendUser');
        $supplier->setAction('app-user/backend-users');
        $applicationUsersMenu->addChild($supplier);

        $backendGroup = new NavigationItem('navigation.applicationUser.backendGroup');
        $backendGroup->setAction('app-user/backend-groups');
        $applicationUsersMenu->addChild($frontendGroup);

        $rootNavigationItem->addChild($section);

        $this->setNavigation(new Navigation($rootNavigationItem));
    }

    /**
     * {@inheritdoc}
     */
    public function getJsBundleName()
    {
        return 'applicationuser';
    }

}
