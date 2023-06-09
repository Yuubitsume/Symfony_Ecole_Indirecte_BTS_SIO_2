<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{

    public const PAGINATOR_PER_PAGE = 2;

    public function getUserPaginator(int $offset): Paginator
       {
           $query = $this->createQueryBuilder('user')
                ->orderBy('user.id', 'ASC')
                ->setMaxResults(self::PAGINATOR_PER_PAGE)
                ->setFirstResult($offset)
                ->getQuery()
            ;

            return new Paginator($query);
        }

        public function getUserByClasse(int $offset)
        {
            $query = $this->createQueryBuilder('user')
                 ->orderBy('user.classe_id', 'ASC')
                 ->setFirstResult($offset)
                 ->getQuery()
             ;
 
             return new Paginator($query);
         }

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function add(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);

        $this->add($user, true);
    }


   public function findOneBySomeField($value): ?User
   {
       return $this->createQueryBuilder('user')
           ->orderBy('ASC')
           ->getQuery()
       ;
   }
}
