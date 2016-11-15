<?php
/**
 * Created by PhpStorm.
 * User: bemben
 * Date: 07/11/2016
 * Time: 19:36
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_has_organization_role")
 */
class UserHasOrganizationRole
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $user;

    /**
     * @ORM\Column(type="string")
     */
    private $organizationRole;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getOrganizationRole()
    {
        return $this->organizationRole;
    }

    /**
     * @param mixed $organizationRole
     */
    public function setOrganizationRole($organizationRole)
    {
        $this->organizationRole = $organizationRole;
    }


}