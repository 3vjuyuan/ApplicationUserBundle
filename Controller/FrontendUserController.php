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

namespace Savwy\SuluBundle\ApplicationUserBundle\Controller;

use Savwy\SuluBundle\ApplicationUserBundle\FrontendUser\UserManager;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\FOSRestController;
use Sulu\Component\Rest\ListBuilder\Doctrine\FieldDescriptor\DoctrineFieldDescriptor;
use Sulu\Component\Rest\ListBuilder\ListRepresentation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FrontendUserController extends FOSRestController
{
    const ENTITY_NAME = 'ApplicationUserBundle:FrontendUser';

    /**
     * Returns array of existing field-descriptors.
     *
     * @return array
     */
    private function getFieldDescriptors()
    {
        return [
            'id' => new DoctrineFieldDescriptor(
                'id',
                'id',
                self::ENTITY_NAME,
                'public.id',
                [],
                true
            ),
            'userName' => new DoctrineFieldDescriptor(
                'userName',
                'userName',
                self::ENTITY_NAME,
                'user.userName'
            ),
            'fullName' => new DoctrineFieldDescriptor(
                'fullName',
                'fullName',
                self::ENTITY_NAME,
                'user.fullName'
            ),
            'phone' => new DoctrineFieldDescriptor(
                'phone',
                'phone',
                self::ENTITY_NAME,
                'user.phone'
            ),
            'email' => new DoctrineFieldDescriptor(
                'email',
                'email',
                self::ENTITY_NAME,
                'user.email'
            ),
            'createTime' => new DoctrineFieldDescriptor(
                'createTime',
                'createTime',
                self::ENTITY_NAME,
                'user.createTime'
            ),
            'updateTime' => new DoctrineFieldDescriptor(
                'updateTime',
                'updateTime',
                self::ENTITY_NAME,
                'user.updateTime'
            )
        ];
    }

    /**
     * Returns all fields that can be used by list.
     *
     * @FOS\RestBundle\Controller\Annotations\Get("frontend/user/fields")
     *
     * @return Response
     */
    public function getFrontendUserFieldsAction()
    {
        return $this->handleView($this->view(array_values($this->getFieldDescriptors())));
    }

    /**
     * Shows all user
     *
     * @param Request $request
     *
     * @Get("frontend/user")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getFrontendUserListAction(Request $request)
    {
        $restHelper = $this->get('sulu_core.doctrine_rest_helper');
        $factory = $this->get('sulu_core.doctrine_list_builder_factory');

        $fieldDescriptors = $this->getFieldDescriptors();
        $listBuilder = $factory->create(self::ENTITY_NAME);
        $restHelper->initializeListBuilder($listBuilder, $fieldDescriptors);
        $del = new DoctrineFieldDescriptor(
            'isDelete',
            'isDelete',
            self::ENTITY_NAME
        );
        $listBuilder->where($del, 0);
        $results = $listBuilder->execute();

        date_default_timezone_set('Etc/GMT-8');

        foreach ($results as $item) {
            $item['createTime'] = date("Y-m-d H:i:s", $item['createTime']);
            $item['updateTime'] = date("Y-m-d H:i:s", $item['updateTime']);
            $itemData[] = $item;
        }

        $list = new ListRepresentation(
            !empty($results) ? $itemData : $results,
            'user-items',
            'get_frontend_user_list',
            $request->query->all(),
            $listBuilder->getCurrentPage(),
            $listBuilder->getLimit(),
            $listBuilder->count()
        );

        $view = $this->view($list, 200);

        return $this->handleView($view);
    }

    /**
     * Returns a single user identified by id.
     *
     * @param int $id
     *
     * @return Response
     */
    public function getFrontendUserAction($id)
    {
        $userItem = $this->getManager()->read($id);

        $view = ($userItem == null || $userItem->isDelete() == 1) ? $this->view([], 404) : $this->view($userItem);

        return $this->handleView($view);
    }

    /**
     * Create a new user and returns it.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function postFrontendUserAction(Request $request)
    {
        $userItem = $this->getManager()->create($request->request->all());
        $this->flush();

        return $this->handleView($this->view($userItem));
    }

    /**
     * Update a user with given id and returns it.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function putFrontendUserAction($id, Request $request)
    {
        $userItem = $this->getManager()->update($id, $request->request->all());
        $this->flush();

        return $this->handleView($this->view($userItem));
    }

    /**
     * Delete user
     *
     * @param int $id
     *
     * @return Response
     */
    public function deleteFrontendUserAction($id)
    {
        $this->getManager()->delete($id);
        $this->flush();

        return $this->handleView($this->view());
    }

    /**
     * Returns service for user
     *
     * @return UserManager
     */
    private function getManager()
    {
        return $this->get('frontend_user.manager');
    }

    /**
     * Flushes database.
     */
    private function flush()
    {
        $this->get('doctrine.orm.entity_manager')->flush();
    }
}
