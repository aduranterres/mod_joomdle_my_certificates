<?php

/**
 * @package     Joomdle
 * @subpackage  mod_joomdle_certificates
 *
 * @copyright   Antonio Duran Terres
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Filter\OutputFilter;
use Joomla\CMS\Component\ComponentHelper;
use Joomdle\Component\Joomdle\Administrator\Helper\ContentHelper;

// no direct access
defined('_JEXEC') or die('Restricted access');

$itemid = ContentHelper::getMenuItem();

if ((!is_array($certificates)) || (count($certificates) == 0)) {
    echo '<span class="joomdle_nocourses_message">' . Text::_('COM_JOOMDLE_NO_CERTIFICATES_YET') . "</span>";
    return;
}
?>

<ul class="joomdlecertificates">
    <?php
    $type = $params->get('certificate_type');
    if (is_array($certificates)) {
        foreach ($certificates as $cert) {
    ?>
            <li>
                <?php
                $id = $cert['id'];

                switch ($type) {
                    case 'simple':
                        $redirect_url = $moodle_url . "/mod/simplecertificate/view.php?id=$id&certificate=1&action=review";
                        break;
                    case 'custom':
                        $redirect_url = $moodle_url . "/mod/customcert/view.php?id=$id&downloadown=1";
                        break;
                    case 'coursecertificate':
                        $redirect_url = $moodle_url . "/admin/tool/certificate/view.php?code=" . $cert['code'];
                        break;
                    default:
                        $redirect_url = $moodle_url . "/mod/certificate/view.php?id=$id&certificate=1&action=review";
                        break;
                }
                ?>
                <span>
                    <a target='_blank' href="<?php echo $redirect_url; ?>"><?php echo $cert['name']; ?></a>
                    <?php if ($show_send_certificate) : ?>
                        <a href="index.php?option=com_joomdle&view=sendcert&layout=edit&tmpl=component&type=<?php echo $certificate_type; ?>&cert_id=<?php echo $id; ?>" onclick="window.open(this.href,'win2','width=400,height=500,top=100,left=500,menubar=yes,resizable=yes'); return false;" title="Email"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                    <?php endif; ?>
                </span>
            </li>
    <?php
        }
    }
    ?>
</ul>
