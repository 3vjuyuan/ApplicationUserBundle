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

namespace Savwy\SuluBundle\ApplicationUserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * @ExclusionPolicy("all")
 */
abstract class User extends BaseUser
{
    /**
     * @var string
     *
     * @Expose
     */
    protected $phone;

    /**
     * @var integer
     *
     * @Expose
     */
    protected $creation;

    /**
     * @var boolean
     *
     * @Expose
     */
    protected $locked;

    /**
     * @var integer
     *
     * @Expose
     */
    protected $lockExpiration;

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
    protected $lastLogin;

    /**
     * @var array
     *
     * @Expose
     */
    protected $userConfig;

    /**
     * @var array
     *
     * @Expose
     */
    protected $secretSettings;

    /**
     * @var ArrayCollection
     */
    protected $groups;

    public function __construct()
    {
        parent::__construct();
        $this->groups = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getCreation(): int
    {
        return $this->creation;
    }

    /**
     * @param int $creation
     */
    public function setCreation(int $creation): void
    {
        $this->creation = $creation;
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
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return bool
     */
    public function isLocked(): bool
    {
        return $this->locked;
    }

    /**
     * @param bool $locked
     */
    public function setLocked(bool $locked): void
    {
        $this->locked = $locked;
    }

    /**
     * @return int
     */
    public function getLockExpiration(): int
    {
        return $this->lockExpiration;
    }

    /**
     * @param int $lockExpiration
     */
    public function setLockExpiration(int $lockExpiration): void
    {
        $this->lockExpiration = $lockExpiration;
    }

    /**
     * @return int
     */
    public function getLastLogin(): int
    {
        return $this->lastLogin;
    }

    /**
     * {@inheritdoc}
     */
    public function setLastLogin(\DateTime $time = null)
    {
        $this->lastLogin = $time ? $time->getTimestamp() : time();

        return $this;
    }

    /**
     * @return array
     */
    public function getUserConfig(): array
    {
        return $this->userConfig;
    }

    /**
     * @param array $userConfig
     */
    public function setUserConfig(array $userConfig): void
    {
        $this->userConfig = $userConfig;
    }

    /**
     * @return array
     */
    public function getSecretSettings(): array
    {
        return $this->secretSettings;
    }

    /**
     * @param array $secretSettings
     */
    public function setSecretSettings(array $secretSettings): void
    {
        $this->secretSettings = $secretSettings;
    }

}
