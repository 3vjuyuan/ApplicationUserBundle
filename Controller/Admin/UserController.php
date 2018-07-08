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
 * @author Team Delta <delta@3vjuyuan.com>
 */

namespace Savwy\SuluBundle\ApplicationUserBundle\Controller\Admin;

use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Savwy\SuluBundle\ApplicationUserBundle\Manager\UserAndGroupManagerInterface;
use Sulu\Component\Rest\ListBuilder\Doctrine\DoctrineListBuilder;
use Sulu\Component\Rest\ListBuilder\Doctrine\DoctrineListBuilderFactory;
use Sulu\Component\Rest\ListBuilder\Doctrine\FieldDescriptor\DoctrineFieldDescriptor;
use Sulu\Component\Rest\ListBuilder\ListRepresentation;
use Sulu\Component\Rest\RestController;
use Sulu\Component\Rest\RestHelperInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class UserController extends RestController implements ClassResourceInterface
{
    const ENTITY_KEY = 'app-user';
    
    const ENTITY_NAME = '';

    /**
     * @var UserAndGroupManagerInterface
     */
    protected $manager;

    /**
     * @var array
     */
    protected $fieldDescriptors;

    /**
     * @var RestHelperInterface
     */
    protected $restHelper;

    abstract protected function initialize();

    /**
     * @return RestHelperInterface
     */
    protected function getRestHelper(): RestHelperInterface
    {
        if(!$this->restHelper) {
            $this->restHelper = $this->get('sulu_core.doctrine_rest_helper');
        }

        return $this->restHelper;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function cgetAction(Request $request) {
        $list = $this->getList($request);
        return $this->handleView($this->view($list));
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function postAction(Request $request) {
        //@todo Validation with symfony or json schema
//            $this->checkArguments($request);
        $user = $this->getManager()->save(
            $request->request->all()
        );
        $view = $this->view($user, 200);

        return $this->handleView($view);
    }

    public function putAction($id, Request $request)
    {
        //@todo Validation with symfony or json schema
        $user = $this->getManager()->save(
            $request->request->all(),
            $id
        );
        $view = $this->view($user, 200);

        return $this->handleView($view);
    }

    /**
     * returns all fields that can be used by list.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function fieldsAction(Request $request)
    {
        return $this->handleView($this->view(array_values($this->getFieldDescriptors()), 200));
    }

    protected function getManager() {
        if(!$this->manager) {
            $this->initialize();
        }
        return $this->manager;
    }
    
    protected function getFieldDescriptors() {
        if (null === $this->fieldDescriptors) {
            $this->initialize();
        }

        return $this->fieldDescriptors;
    }

    /**
     * Load the user list
     * @todo Limit of webspace for admin user right
     *
     * @param Request $request
     * @param string $webspace
     * @return ListRepresentation
     */
    protected function getList(Request $request, string $webspace = '') {
        $restHelper = $this->getRestHelper();

        /** @var DoctrineListBuilderFactory $factory */
        $factory = $this->get('sulu_core.doctrine_list_builder_factory');
        /** @var DoctrineListBuilder $listBuilder */
        $listBuilder = $factory->create(static::ENTITY_NAME);
        $restHelper->initializeListBuilder($listBuilder, $this->getFieldDescriptors());

        $listResponse = $this->prepareListResponse($request, $listBuilder);

        return new ListRepresentation(
            $listResponse,
            static::ENTITY_KEY,
            'get_contacts',
            $request->query->all(),
            $listBuilder->getCurrentPage(),
            $listBuilder->getLimit(),
            $listBuilder->count()
        );
    }

    protected function prepareListResponse(Request $request, DoctrineListBuilder $listBuilder)
    {
        $idsParameter = $request->get('ids');
        $ids = array_filter(explode(',', $idsParameter));
        if (null !== $idsParameter && 0 === count($ids)) {
            return [];
        }

        if (null !== $idsParameter) {
            $listBuilder->in($this->fieldDescriptors['id'], $ids);
        }

        $listResponse = $listBuilder->execute();
        return $listResponse;
    }
}
