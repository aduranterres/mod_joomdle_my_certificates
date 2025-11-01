<?php

/**
 * @package     Joomdle
 * @subpackage  mod_joomdle_courses
 *
 * @copyright   Antonio Duran Terres
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Module\JoomdleMyCertificates\Site\Dispatcher;

use Joomla\CMS\Dispatcher\AbstractModuleDispatcher;
use Joomla\CMS\Helper\HelperFactoryAwareInterface;
use Joomla\CMS\Helper\HelperFactoryAwareTrait;
use Joomla\CMS\Helper\ModuleHelper;
use Joomdle\Component\Joomdle\Administrator\Helper\ContentHelper;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Dispatcher class for mod_joomdle_courses
 *
 * @since  4.4.0
 */
class Dispatcher extends AbstractModuleDispatcher // implements HelperFactoryAwareInterface
{
    /**
     * Returns the layout data.
     *
     * @return  array
     *
     * @since   4.4.0
     */
    protected function getLayoutData(): array
    {
        $data   = parent::getLayoutData();

        $params = $data['params'];

        $data['certificate_type'] = $params->get('certificate_type courses only', 'custom');
        $data['show_send_certificate'] = $params->get('show_send_certificate', 0);
        $user = Factory::getApplication()->getIdentity();
        $data['certificates'] = ContentHelper::getMyCertificates($user->username, $data['certificate_type']);

        $comp_params = ComponentHelper::getParams('com_joomdle');
        $data['moodle_url'] = $comp_params->get('MOODLE_URL');

        return $data;
    }
}
