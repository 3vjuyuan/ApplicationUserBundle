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

use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * @ExclusionPolicy("all")
 */
class BackendGroup extends UserGroup
{
    /**
     * @var integer
     *
     * @Expose
     */
    protected $rights;

    /**
     * @var string
     *
     * @Expose
     */
    protected $lockToLanguage;

    /**
     * @var string
     *
     * @Expose
     */
    protected $lockToWebspace;

    /**
     * @var string
     *
     * @Expose
     */
    protected $lockToIPRange;

    /**
     * @return int
     */
    public function getRights(): int
    {
        return $this->rights;
    }

    /**
     * @param int $rights
     */
    public function setRights(int $rights): void
    {
        $this->rights = $rights;
    }

    /**
     * @return string
     */
    public function getLockToLanguage(): string
    {
        return $this->lockToLanguage;
    }

    /**
     * @param string $lockToLanguage
     */
    public function setLockToLanguage(string $lockToLanguage): void
    {
        $this->lockToLanguage = $lockToLanguage;
    }

    /**
     * @return string
     */
    public function getLockToWebspace(): string
    {
        return $this->lockToWebspace;
    }

    /**
     * @param string $lockToWebspace
     */
    public function setLockToWebspace(string $lockToWebspace): void
    {
        $this->lockToWebspace = $lockToWebspace;
    }

    /**
     * @return string
     */
    public function getLockToIPRange(): string
    {
        return $this->lockToIPRange;
    }

    /**
     * @param string $lockToIPRange
     */
    public function setLockToIPRange(string $lockToIPRange): void
    {
        $this->lockToIPRange = $lockToIPRange;
    }
}
