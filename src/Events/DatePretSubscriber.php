<?php

namespace App\Events;

use App\Entity\Pret;
use App\Repository\PretRepository;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use App\Repository\LivreRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class DatePretSubscriber implements EventSubscriberInterface {
    
    public static function getSubscribedEvents()
    {
        return[
            KernelEvents::VIEW => ['setDatePretForPret', EventPriorities::PRE_WRITE]
        ];
    }

    public function setDatePretForPret(ViewEvent $event){
        $pret = $event->getControllerResult();
        // dd($event->getControllerResult());
        $method = $event->getRequest()->getMethod();

        if ($pret instanceof Pret && $method === "POST") {
            $pret->setDatePret(new \DateTime())
                ->setRendu("NON");
        }
    }

}