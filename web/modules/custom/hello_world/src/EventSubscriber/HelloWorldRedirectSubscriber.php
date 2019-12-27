<?php

namespace Drupal\hello_world\EventSubscriber;

use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\Routing\CurrentRouteMatch;
use Drupal\Core\Routing\LocalRedirectResponse;
use Drupal\Core\Url;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Subscribes to to Kernel Request event and redirects to the homepage
 * when the user has the "non-grata" role.
 *
 * Class HelloWorldRedirectSubscriber
 *
 * @package Drupal\hello_world\EventSubscriber
 */
class HelloWorldRedirectSubscriber implements EventSubscriberInterface {

  /**
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * HelloWorldRedirectSubscriber constructor.
   *
   * @param \Drupal\Core\Session\AccountProxyInterface $currentUser
   */
  public function __construct(AccountProxyInterface $currentUser) {
    $this->currentUser = $currentUser;
  }

  /**
   * @return mixed
   */
  public function getSubscribedEvents() {
    $events['kernel.request'][] = ['onRequest', 0];
    return $events;
  }

  /**
   * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
   */
  public function onRequest(GetResponseEvent $event) {
//    $request =  $event->getRequest();
//    $path = $request->getPathInfo();
    $route_name = $this->currentRouteMatch->getRouteName();

    if ($route_name !== 'hello_world.hello') {
      return;
    }

    $roles = $this->currentUser->getRoles();
    if (in_array('non_grata', $roles)) {
      $url = Url::fromUri('internal:/');
      $event->setResponse(new LocalRedirectResponse($url->toString()));
    }
  }
}
