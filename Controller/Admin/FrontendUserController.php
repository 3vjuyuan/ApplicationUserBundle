<?php
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
 * @author Team Weave <weave@3vjuyuan.com>
 */

namespace Savwy\SuluBundle\ApplicationUserBundle\Controller\Admin;

//use Savwy\SuluBundle\ApplicationUserBundle\FrontendUser\UserManager;
//use FOS\RestBundle\Controller\Annotations\Get;
//use Sulu\Component\Rest\ListBuilder\ListRepresentation;
//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;

use Savwy\SuluBundle\ApplicationUserBundle\Entity\FrontendUser;
use Sulu\Component\Rest\ListBuilder\Doctrine\FieldDescriptor\DoctrineFieldDescriptor;

class FrontendUserController extends UserController
{
    const ENTITY_KEY = 'frontend-users';

    const ENTITY_NAME = FrontendUser::class;

    const MANAGER_NAME = 'savwy_application_user.frontend_user_manager';

    protected function initialize()
    {
        $this->manager = $this->get(static::MANAGER_NAME);
        
        $this->fieldDescriptors = [
            'id' => new DoctrineFieldDescriptor(
                'id',
                'id',
                self::ENTITY_NAME,
                'public.id',
                [],
                true
            ),
            'username' => new DoctrineFieldDescriptor(
                'username',
                'username',
                self::ENTITY_NAME,
                'application_user.fields.user.username'
            )
        ];
    }
}