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

namespace Savwy\SuluBundle\ApplicationUserBundle\FrontendUser;

use Doctrine\ORM\EntityManagerInterface;
use Savwy\SuluBundle\ApplicationUserBundle\Entity\UserGroup;

class GroupManager
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * UserManager constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param array $data
     * @return UserGroup
     */
    public function create(array $data)
    {
        $entity = $this->bind(new UserGroup(), $data);
        $this->entityManager->persist($entity);

        return $entity;
    }

    /**
     *
     * @param int $id
     *
     * @return UserGroup
     */
    public function read($id)
    {
        return $this->entityManager->find(UserGroup::class, $id);
    }

    /**
     * Returns house-item with given id.
     *
     * @param int[] $ids
     *
     * @return UserGroup[]
     */
    public function readList($ids)
    {
        return $this->entityManager->getRepository(UserGroup::class)->findBy(['id' => $ids]);
    }

    /**
     * @return array
     */
    public function readAll()
    {
        return $this->entityManager->getRepository(UserGroup::class)->findAll();
    }

    /**
     * Update the house with given id.
     *
     * @param int $id
     * @param array $data
     *
     * @return UserGroup
     */
    public function update($id, array $data)
    {
        $entity = $this->read($id);
        return $this->bind($entity, $data);
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $this->entityManager->remove($this->read($id));
    }

    /**
     * @param UserGroup $entity
     * @param array $data
     * @return UserGroup
     */
    protected function bind(UserGroup $entity, array $data)
    {
        $entity->setGroupName($data['groupName']);
        $entity->setParentId($data['parentId']);

        return $entity;
    }

    /**
     * @param array $data
     * @param $property
     * @param string $default
     * @return mixed|string
     */
    protected function getValue(array $data, $property, $default = '')
    {
        return array_key_exists($property, $data) ? $data[$property] : $default;
    }
}
