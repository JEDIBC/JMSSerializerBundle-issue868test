<?php
declare(strict_types = 1);
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Class Article
 *
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="article")
 *
 * @JMS\XmlRoot("article")
 */
class Article
{
    /**
     * @var string
     *
     * @ORM\Id()
     * @ORM\Column(name="id", type="string", length=10, nullable=false)
     *
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false)
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     *
     * @JMS\Type("string")
     * @JMS\XmlElement(cdata=false)
     */
    protected $description;

    /**
     * @param string $id
     * @param string $description
     */
    public function __construct(string $id, string $description)
    {
        $this->id          = $id;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}
