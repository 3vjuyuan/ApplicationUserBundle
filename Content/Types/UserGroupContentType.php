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

namespace Savwy\SuluBundle\ApplicationUserBundle\Content\Types;

use Savwy\SuluBundle\ApplicationUserBundle\FrontendUser\GroupManager;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;
use Sulu\Component\Content\Compat\PropertyInterface;
use Sulu\Component\Content\SimpleContentType;

/**
 * ContentType for House.
 */
class UserGroupContentType extends SimpleContentType
{
    /**
     * @var string
     */
    private $template;

    /**
     * @var GroupManager
     */
    private $groupManager;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * HouseContentType constructor.
     * @param $template
     */
    public function __construct($template, GroupManager $groupManager, SerializerInterface $serializer)
    {
        parent::__construct('group', []);

        $this->template = $template;
        $this->groupManager = $groupManager;
        $this->serializer = $serializer;
    }

    /**
     * {@inheritdoc}
     */
    public function getContentData(PropertyInterface $property)
    {
        $value = $property->getValue();
        if ($value === null || !is_array($value) || count($value) === 0) {
            return [];
        }
        $entities = $this->groupManager->readList($value);
        $result = [];
        foreach ($entities as $entity) {
            $result[array_search($entity->getId(), $value, false)] = $this->serializer->serialize(
                $entity,
                'array',
                SerializationContext::create()->setSerializeNull(true)
            );
        }
        ksort($result);
        return array_values($result);
    }

    /**
     * {@inheritdoc}
     */
    public function getTemplate()
    {
        return $this->template;
    }

}
