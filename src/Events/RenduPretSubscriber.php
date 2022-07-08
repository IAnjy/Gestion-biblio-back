<?php

namespace App\Events;

use App\Entity\Pret;
use App\Repository\LivreRepository;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Livre;
use Doctrine\ORM\EntityManagerInterface;
use SebastianBergmann\Type\NullType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class RenduPretSubscriber implements EventSubscriberInterface {

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
            KernelEvents::VIEW => ['setRenduForPret', EventPriorities::POST_WRITE]
        ];
    }

    public function setRenduForPret(ViewEvent $event){
        // dd($event->getControllerResult());
        $pret = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if ($pret instanceof Pret && $method === "PUT" && $pret->getRendu() === "OUI") {
            // dd("tafa");
            $livre = $this->repoLivre->find($pret->getLivre());
            $livre->setDisponible("OUI");

            $this->manager->persist($livre);
            $this->manager->flush();
            
        }
    }
}