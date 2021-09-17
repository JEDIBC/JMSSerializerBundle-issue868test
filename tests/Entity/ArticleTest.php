<?php
declare(strict_types = 1);
namespace App\Tests\Entity;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class ArticleTest
 *
 * @package App\Tests\Entity
 *
 * @covers  \App\Entity\Article
 * @group   unit
 */
class ArticleTest extends WebTestCase
{
    /**
     * @var EntityManagerInterface
     */
    protected $doctrine;

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @test
     */
    public function testDeserialization(): void
    {
        // Test DB Article
        $dbArticle = $this->doctrine->find(Article::class, 'foo');

        static::assertInstanceOf(Article::class, $dbArticle);
        static::assertEquals('bar', $dbArticle->getDescription());

        // Cleanup
        $this->doctrine->clear();
        unset($dbArticle);

        // Test deserialized Article
        $deserializedArticle = $this->serializer->deserialize(file_get_contents(__DIR__ . '/article.xml'), Article::class, 'xml');

        static::assertInstanceOf(Article::class, $deserializedArticle);
        static::assertEquals('Better description than bar', $deserializedArticle->getDescription());

        // Retest DB Article
        $dbArticle = $this->doctrine->find(Article::class, 'foo');

        static::assertInstanceOf(Article::class, $dbArticle);
        static::assertEquals('bar', $dbArticle->getDescription());
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->doctrine = $this->getContainer()->get(EntityManagerInterface::class);
        $this->serializer = $this->getContainer()->get(SerializerInterface::class);

        $this->doctrine->getConnection()->executeQuery('DELETE FROM article');
        $this->doctrine->getConnection()->insert('article', ['id' => 'foo', 'description' => 'bar']);
    }
}
