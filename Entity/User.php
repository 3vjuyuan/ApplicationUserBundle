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
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * @ExclusionPolicy("all")
 */
abstract class User
{
    /**
     * @var integer
     *
     *@Expose
     */
    protected $uid;

    /**
     * @var string
     *
     * @Expose
     */
    protected $username;

    /**
     * @var string
     *
     * @Expose
     */
    protected $password;

    /**
     * @var string
     *
     * @Expose
     */
    protected $salt;

    /**
     * @var string
     *
     * @Expose
     */
    protected $email;

    /**
     * @var string
     *
     * @Expose
     */
    protected $phone;

    /**
     * @var string
     *
     * @Expose
     */
    protected $confirmationKey;

    /**
     * @var string
     *
     * @Expose
     */
    protected $confirmationKeyExpiration;

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
    protected $disabled;

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
        $this->groups = new ArrayCollection();
    }

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
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getSalt(): string
    {
        return $this->salt;
    }

    /**
     * @param string $salt
     */
    public function setSalt(string $salt): void
    {
        $this->salt = $salt;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
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
     * @return string
     */
    public function getConfirmationKey(): string
    {
        return $this->confirmationKey;
    }

    /**
     * @param string $confirmationKey
     */
    public function setConfirmationKey(string $confirmationKey): void
    {
        $this->confirmationKey = $confirmationKey;
    }

    /**
     * @return string
     */
    public function getConfirmationKeyExpiration(): string
    {
        return $this->confirmationKeyExpiration;
    }

    /**
     * @param string $confirmationKeyExpiration
     */
    public function setConfirmationKeyExpiration(string $confirmationKeyExpiration): void
    {
        $this->confirmationKeyExpiration = $confirmationKeyExpiration;
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
     * @return bool
     */
    public function isDisabled(): bool
    {
        return $this->disabled;
    }

    /**
     * @param bool $disabled
     */
    public function setDisabled(bool $disabled): void
    {
        $this->disabled = $disabled;
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
    public function getLastLogin(): int
    {
        return $this->lastLogin;
    }

    /**
     * @param int $lastLogin
     */
    public function setLastLogin(int $lastLogin): void
    {
        $this->lastLogin = $lastLogin;
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
