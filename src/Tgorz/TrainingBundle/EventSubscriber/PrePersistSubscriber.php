<?php

namespace Tgorz\TrainingBundle\EventSubscriber;

use Doctrine\ORM\Events;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\EventDispatcher\EventSubscriberInterface; 

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PrePersistSuscrier
 *
 * @author Tomek
 */
class PrePersistSubscriber implements EventSubscriberInterface {

    public static function getSubscribedEvents() {
        return [
            Events::prePersist,
        ];
    }

    public function prePersist(LifecycleEventArgs $args) {
        die('test');
    }
}
