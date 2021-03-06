<?php
namespace Entity;
use Doctrine\ORM\EntityRepository;
/**
 * MemberRepository
 */

class MemberRepository extends EntityRepository{
  
  public function findLikeBy($fields, $offset = 0, $limit = 20) {
    $limit = (int)$limit;
    $offset = (int)$offset;
    $querystr = 'SELECT m FROM Entity\Member m WHERE ';
    $i = 0;
    foreach($fields as $field => $value) {
      $querystr .= '(m.'.$field.' LIKE :'.$field.')';
      if ($i++ != count($fields)-1) $querystr .= ' AND ';
    }
    $query = $this->_em->createQuery($querystr);
    foreach($fields as $field => $value) {
      $query->setParameter($field, '%'.$value.'%');
    }
    $query->setFirstResult($offset);
    $query->setMaxResults($limit);

    return $query->getResult();
  }

}
