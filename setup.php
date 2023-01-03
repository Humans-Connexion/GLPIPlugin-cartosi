<?php

/**
 * -------------------------------------------------------------------------
 * Example plugin for GLPI
 * -------------------------------------------------------------------------
 *
 * LICENSE
 *
 * This file is part of Example.
 *
 * Example is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Example is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Example. If not, see <http://www.gnu.org/licenses/>.
 * -------------------------------------------------------------------------
 * @copyright Copyright (C) 2006-2022 by Example plugin team.
 * @license   GPLv2 https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://github.com/pluginsGLPI/example
 * -------------------------------------------------------------------------
 */

use Glpi\Plugin\Hooks;
use GlpiPlugin\Cartosi\Cartosi;

define('PLUGIN_EXAMPLE_VERSION', '0.0.1');

// Minimal GLPI version, inclusive
define('PLUGIN_EXAMPLE_MIN_GLPI', '10.0.0');
// Maximum GLPI version, exclusive
define('PLUGIN_EXAMPLE_MAX_GLPI', '10.0.99');

/**
 * Init hooks of the plugin.
 * REQUIRED
 *
 * @return void
 */
function plugin_init_cartosi() {
   global $PLUGIN_HOOKS,$CFG_GLPI;

   $PLUGIN_HOOKS['menu_toadd']['cartosi'] = ['plugins' => Cartosi::class,
                                             'tools'   => Cartosi::class];


   // Config page
   $PLUGIN_HOOKS['config_page']['cartosi'] = 'front/config.php';
   // CSRF compliance : All actions must be done via POST and forms closed by Html::closeForm();
   $PLUGIN_HOOKS[Hooks::CSRF_COMPLIANT]['cartosi'] = true;
}

/**
 * Get the name and the version of the plugin
 * REQUIRED
 *
 * @return array
 */
function plugin_version_cartosi() {
   return [
      'name'           => 'Synchronization Carto-SI',
      'version'        => PLUGIN_EXAMPLE_VERSION,
      'author'         => 'Paul Durieux',
      'license'        => '',
      'homepage'       => 'https://github.com/HayZun/cartosi',
      'requirements'   => [
         'glpi' => [
            'min' => PLUGIN_EXAMPLE_MIN_GLPI,
            'max' => PLUGIN_EXAMPLE_MAX_GLPI,
         ]
      ]
   ];
}

/**
 * Check configuration process
 *
 * @param boolean $verbose Whether to display message on failure. Defaults to false
 *
 * @return boolean
 */
function plugin_cartosi_check_config($verbose = false) {
   if (true) { // Your configuration check
      return true;
   }

   if ($verbose) {
      echo __('Installed / not configured', 'example');
   }
   return false;
}
