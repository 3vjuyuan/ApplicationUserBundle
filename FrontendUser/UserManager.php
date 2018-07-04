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
use Savwy\SuluBundle\ApplicationUserBundle\Entity\FrontendUser;
use Sulu\Bundle\MediaBundle\Entity\Media;

class UserManager
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
     * @return FrontendUser
     */
    public function create(array $data)
    {
        $entity = $this->bind(new FrontendUser(), $data);
        $this->entityManager->persist($entity);

        return $entity;
    }

    /**
     *
     * @param int $id
     *
     * @return FrontendUser
     */
    public function read($id)
    {
        return $this->entityManager->find(FrontendUser::class, $id);
    }

    /**
     * Returns house-item with given id.
     *
     * @param int[] $ids
     *
     * @return FrontendUser[]
     */
    public function readList($ids)
    {
        return $this->entityManager->getRepository(FrontendUser::class)->findBy(['id' => $ids]);
    }

    /**
     * @return array
     */
    public function readAll()
    {
        return $this->entityManager->getRepository(FrontendUser::class)->findBy(['isDelete' => 0]);
    }

    /**
     * Update the house with given id.
     *
     * @param int $id
     * @param array $data
     *
     * @return FrontendUser
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
        $user = $this->read($id);
        $user->setIsDelete(true);
        $this->entityManager->persist($user);
    }

    /**
     * @param FrontendUser $entity
     * @param array $data
     * @return FrontendUser
     */
    protected function bind(FrontendUser $entity, array $data)
    {
        $entity->setUserName($data['userName']);
        $entity->setStatus($data['status']);
        $entity->setPassword($data['password']);
        $entity->setFullName($data['fullName']);
        $entity->setPhone($data['phone']);
        $entity->setEmail($data['email']);
        if ($entity->getId() == null) {
            $entity->setPropertiesBeforePersist();
        }
        $entity->setPropertiesBeforeUpdate();
        $entity->setUserInfo($this->getValue($data, 'userInfo'));
        $entity->setMediaDisplayOption($this->getMediaValue($data, 'displayOption', null));
        $entity->setMedias(
            array_map(
                function ($id) {
                    return $this->entityManager->getReference(Media::class, $id);
                },
                $this->getMediaValue($data, 'ids', [])
            )
        );
        $entity->setGroups(
            array_map(
                function ($id) {
                    return $this->entityManager->getReference(UserGroup::class, (int)$id);
                },
                $this->getValue($data, 'group')
            )
        );
        $entity->setIsDelete(false);
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

    /**
     * Returns media-property of given data array.
     * If the key not exists default value will be returned.
     *
     * @param array $data
     * @param string $mediaProperty
     * @param mixed $default
     * @param string $property
     *
     * @return mixed
     */
    protected function getMediaValue(array $data, $mediaProperty, $default = null, $property = 'media')
    {
        $media = $this->getValue($data, $property, null);
        if (!$media) {
            return $default;
        }
        return $this->getValue($media, $mediaProperty, $default);
    }
}
