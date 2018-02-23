<?php

namespace Tvtruc\Entities;
//use Doctrine\ORM\Annotation as ORM;
use Doctrine\ORM\Mapping AS ORM;
use Tvtruc\Entities\Serie;
/**
 * @ORM\Entity @ORM\Table(name="banners")
 **/
class Banner {
    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     * @ORM\GeneratedValue(strategy="auto")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", name="filename")
     * @var string
     */
    protected $fileName;

    /**
     * One Cart has One Customer.
     * @OneToOne(targetEntity="Customer", inversedBy="cart")
     * @JoinColumn(name="customer_id", referencedColumnName="id")
     */
    private $serie;

    // getters et setters
    // ensembles de fonctions/methodes publiques permettant de modifier/acceder aux propriétés private

    public function getBanner(){
        global $entityManager;
        $repository = $entityManager->getRepository('tvtruc\Entities\Banner');
        $banner = $repository->findOneBy(array(
            'keyType' => 'series',
            'subkey' => 'graphical',
            'keyValue' => $this->id
        ));
        return (is_null($banner)? '':$banner->fileName);
    }
    public function getId() {
        return($this->id);
    }
}