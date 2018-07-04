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

use Savwy\SuluBundle\ApplicationUserBundle\FrontendUser\GroupManager;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\FOSRestController;
use Sulu\Component\Rest\ListBuilder\Doctrine\FieldDescriptor\DoctrineFieldDescriptor;
use Sulu\Component\Rest\ListBuilder\ListRepresentation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FrontendGroupController extends FOSRestController
{
    const ENTITY_NAME = 'ApplicationUserBundle:FrontendGroup';

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
            'groupName' => new DoctrineFieldDescriptor(
                'groupName',
                'groupName',
                self::ENTITY_NAME,
                'group.groupName'
            ),
            'parentId' => new DoctrineFieldDescriptor(
                'parentId',
                'parentId',
                self::ENTITY_NAME,
                'group.parentId'
            )
        ];
    }

    /**
     * Returns all fields that can be used by list.
     *
     * @FOS\RestBundle\Controller\Annotations\Get("frontend/group/fields")
     *
     * @return Response
     */
    public function getFrontendGroupFieldsAction()
    {
        return $this->handleView($this->view(array_values($this->getFieldDescriptors())));
    }

    /**
     * Shows all group
     *
     * @param Request $request
     *
     * @Get("frontend/group")
     *
     * @return Response
     */
    public function getFrontendGroupListAction(Request $request)
    {
        $restHelper = $this->get('sulu_core.doctrine_rest_helper');
        $factory = $this->get('sulu_core.doctrine_list_builder_factory');

        $fieldDescriptors = $this->getFieldDescriptors();
        $listBuilder = $factory->create(self::ENTITY_NAME);
        $restHelper->initializeListBuilder($listBuilder, $fieldDescriptors);

        $ids = null;
        if (null !== $request->get('ids')) {
            $ids = array_filter(explode(',', $request->get('ids', '')));
            $listBuilder->in($fieldDescriptors['id'], $ids);
            $listBuilder->limit(count($ids));
        }

        $results = $unsortedResults = $listBuilder->execute();

        if (null !== $ids) {
            $results = [];
            foreach ($unsortedResults as $result) {
                $results[array_search($result['id'], $ids, false)] = $result;
            }
            ksort($results);
            $results = array_values($results);
        }

        $list = new ListRepresentation(
            $results,
            'group-items',
            'get_frontend_group_list',
            $request->query->all(),
            $listBuilder->getCurrentPage(),
            $listBuilder->getLimit(),
            $listBuilder->count()
        );

        $view = $this->view($list, 200);

        return $this->handleView($view);
    }

    /**
     * Returns a single group identified by id.
     *
     * @param int $id
     *
     * @return Response
     */
    public function getFrontendGroupAction($id)
    {
        $groupItem = $this->getManager()->read($id);

        return $this->handleView($this->view($groupItem));
    }

    /**
     * Create a new group and returns it.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function postFrontendGroupAction(Request $request)
    {
        $groupItem = $this->getManager()->create($request->request->all());
        $this->flush();

        return $this->handleView($this->view($groupItem));
    }

    /**
     * Update a group with given id and returns it.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function putFrontendGroupAction($id, Request $request)
    {
        $groupItem = $this->getManager()->update($id, $request->request->all());
        $this->flush();

        return $this->handleView($this->view($groupItem));
    }

    /**
     * Delete group
     *
     * @param int $id
     *
     * @return Response
     */
    public function deleteFrontendGroupAction($id)
    {
        $this->getManager()->delete($id);
        $this->flush();

        return $this->handleView($this->view());
    }

    /**
     * Returns service for group
     *
     * @return GroupManager
     */
    private function getManager()
    {
        return $this->get('frontend_user_group.manager');
    }

    /**
     * Flushes database.
     */
    private function flush()
    {
        $this->get('doctrine.orm.entity_manager')->flush();
    }
}
