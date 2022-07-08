<?php

namespace App\Events;

use App\Entity\Pret;
use App\Repository\LivreRepository;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class LivreDisponibleSubscriber implements EventSubscriberInterface {

    private $repoLivre;
    private $manager;

    public function __construct(LivreRepository $repoLivre, EntityManagerInterface $manager)
    {
        $this->repoLivre = $repoLivre;
        $this->manager = $manager;
    }

    public static function getSubscribedEvents()
    {
        return[
            KernelEvents::VIEW => ['setDisponibleForLivre', EventPriorities::PRE_WRITE]
        ];
    }

    public function setDisponibleForLivre(ViewEvent $event){
        // dd($event->getControllerResult());
        $pret = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();
        // dd($method);
        
        if ($pret instanceof Pret && $method === "POST") { 
            $livre = $this->repoLivre->find($pret->getLivre());
            if ($livre->getDisponible() === "NON") dd("Livre non-disponible");
        }
        
        if ($pret instanceof Pret && $method === "POST" ) {
            $livre = $this->repoLivre->find($pret->getLivre());
            
            if ($livre->getDisponible() === "OUI") {
                
                $livre->setDisponible("NON");
    
                $this->manager->persist($livre);
                $this->manager->flush();
            }
            
        }
    }
}