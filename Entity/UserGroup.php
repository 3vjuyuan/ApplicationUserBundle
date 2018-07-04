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

namespace Savwy\SuluBundle\ApplicationUserBundle\Entity;

use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * @ExclusionPolicy("all")
 */
abstract class UserGroup
{
    /**
     * @var integer
     *
     * @Expose
     */
    protected $uid;

    /**
     * @var integer
     *
     * @Expose
     */
    protected $pid;

    /**
     * @var string
     *
     * @Expose
     */
    protected $name;

    /**
     * @var string
     *
     * @Expose
     */
    protected $description;

    /**
     * @var boolean
     *
     * @Expose
     */
    protected $deleted;

    /**
     * @var integer
     *
     * @Expose
     */
    protected $changeTime;

    /**
     * @var array
     */
    protected $groupConfig;

    /**
     * @return int
     */
    public function getUid(): int
    {
        return $this->uid;
    }

    /**
     * @param int $uid
     */
    public function setUid(int $uid): void
    {
        $this->uid = $uid;
    }

    /**
     * @return int
     */
    public function getPid(): int
    {
        return $this->pid;
    }

    /**
     * @param int $pid
     */
    public function setPid(int $pid): void
    {
        $this->pid = $pid;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * @param bool $deleted
     */
    public function setDeleted(bool $deleted): void
    {
        $this->deleted = $deleted;
    }

    /**
     * @return int
     */
    public function getChangeTime(): int
    {
        return $this->changeTime;
    }

    /**
     * @param int $changeTime
     */
    public function setChangeTime(int $changeTime): void
    {
        $this->changeTime = $changeTime;
    }

    /**
     * @return array
     */
    public function getGroupConfig(): array
    {
        return $this->groupConfig;
    }

    /**
     * @param array $groupConfig
     */
    public function setGroupConfig(array $groupConfig): void
    {
        $this->groupConfig = $groupConfig;
    }

    public function setPropertiesBeforePersist() {
        $this->changeTime = strtotime(gmdate('Y-m-d H:i:s'));
    }
}
