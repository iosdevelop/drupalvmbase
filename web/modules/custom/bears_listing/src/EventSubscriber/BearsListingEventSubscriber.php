<?php

namespace Drupal\bears_listing\EventSubscriber;

use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\Routing\CurrentRouteMatch;
use Drupal\Core\Routing\LocalRedirectResponse;
use Drupal\Core\Url;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class BearsListingEventSubscriber
 *
 * @package Drupal\bears_listing\EventSubscriber
 */
class BearsListingEventSubscriber implements EventSubscriberInterface {

  /**
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentuser;

  /**
   * BearsListingEventSubscriber constructor.
   *
   * @param \Drupal\Core\Session\AccountProxyInterface $currentUser
   */
  public function __construct(AccountProxyInterface $currentUser) {
    $this->currentuser = $currentUser;
  }

  /**
   * @return array|mixed
   */
  public static function getSubscribedEvents() {
    //$events['kernel.request'][] = ['onRequest', 0];
    return $events;
  }

  /**
   * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
   */
  public function onRequest(GetResponseEvent $event) {
    $route_name = $this->currentRouteMatch->getRouteName();
    if ($route_name !== 'bears_listing.bears_growl') {
      return;
    }
    $roles = $this->currentuser->getRoles();

    if (in_array('non_grata', $roles)){
      $url = Url::fromUri('internal:/');
      $event->setResponse(new LocalRedirectResponse($url->toString()));
    }
  }
}
