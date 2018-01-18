<?php

namespace Drupal\bt_image\Breadcrumb;

use Drupal\Core\Breadcrumb\Breadcrumb;
use Drupal\Core\Breadcrumb\BreadcrumbBuilderInterface;
use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Link;

/**
 * Class ImageBreadcrumbBuilder.
 */
class ImageBreadcrumbBuilder implements BreadcrumbBuilderInterface {

  /**
   * The site name.
   *
   * @var string
   */
  protected $siteName;

  /**
   * The routes that will change their breadcrumbs.
   *
   * @var array
   */
  private $routes = array(
    'page_manager.page_view_bt_add_image',
    'page_manager.page_view_bt_add_image_bt_add_image-panels_variant-0',
  );

  /**
   * Class constructor.
   */
  public function __construct(ConfigFactory $configFactory) {
    $this->account = $configFactory->get('system.site')->get('name');
  }

  /**
   * {@inheritdoc}
   */
  public function applies(RouteMatchInterface $attributes) {
    $match = $this->routes;
    if (in_array($attributes->getRouteName(), $match)) {
      return TRUE;
    }
    else {
      return FALSE;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $breadcrumb = new Breadcrumb();
    $breadcrumb->addCacheContexts(["url"]);

    $breadcrumb->addLink(Link::createFromRoute($this->siteName, 'page_manager.page_view_app_app-panels_variant-0'));
    $breadcrumb->addLink(Link::createFromRoute('Website', 'page_manager.page_view_app_website_app_website-panels_variant-0'));
    $breadcrumb->addLink(Link::createFromRoute('Multimedia', 'page_manager.page_view_app_website_media_app_website_media-panels_variant-0'));
    $breadcrumb->addLink(Link::createFromRoute('Add Multimedia Element', 'entity.media.add_page'));

    return $breadcrumb;
  }

}
