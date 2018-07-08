<?php
/**
 * Created by PhpStorm.
 * User: ry76
 * Date: 07.07.18
 * Time: 17:48
 */

namespace Savwy\SuluBundle\ApplicationUserBundle\Manager;


use Savwy\SuluBundle\ApplicationUserBundle\Entity\User;

interface UserAndGroupManagerInterface
{
    public function loadBy();

    /**
     * Load all the available entities from repository
     *
     * @return array
     */
    public function loadAll(): array;

    /**
     * @param array $data
     * @param null $id
     * @return object
     */
    public function save(array $data, $id = null);
}
