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

// ----------------------------------------------------------------------
// Original Author of file:
// Purpose of file:
// ----------------------------------------------------------------------

use GlpiPlugin\Example\Example;

/**
 * Plugin install process
 *
 * @return boolean
 */
function plugin_example_install() {
   global $DB;

   ProfileRight::addProfileRights(['example:read']);

   $default_charset = DBConnection::getDefaultCharset();
   $default_collation = DBConnection::getDefaultCollation();
   $default_key_sign = DBConnection::getDefaultPrimaryKeySignOption();

   if (!$DB->tableExists("glpi_plugin_example_examples")) {
      $query = "CREATE TABLE `glpi_plugin_example_examples` (
                  `id` int {$default_key_sign} NOT NULL auto_increment,
                  `description` TEXT NOT NULL,
                  `name` TEXT NOT NULL,
                  `domain` TEXT NOT NULL,
                  `leader` TEXT NOT NULL,
                  `check` date,
                PRIMARY KEY (`id`)
               ) ENGINE=InnoDB DEFAULT CHARSET={$default_charset} COLLATE={$default_collation} ROW_FORMAT=DYNAMIC;";

      $DB->query($query) or die("error creating glpi_plugin_example_toto ". $DB->error());
   }

   if (!$DB->tableExists("glpi_plugin_cartosi_credentials")) {
      // create tab glpi_plugin_cartosi_credentials
      $query = "CREATE TABLE `glpi_plugin_cartosi_credentials` (
                  `id` int {$default_key_sign} NOT NULL auto_increment,
                  `token` TEXT NOT NULL,
                  `tenant` INT NOT NULL,
                PRIMARY KEY (`id`)
               ) ENGINE=InnoDB DEFAULT CHARSET={$default_charset} COLLATE={$default_collation} ROW_FORMAT=DYNAMIC;";

      $DB->query($query) or die("error creating glpi_plugin_example_examples ". $DB->error());
   }

   if (!$DB->tableExists("glpi_plugin_cartosi_app")) {
      // create tab glpi_plugin_cartosi_credentials
      $query = "CREATE TABLE `glpi_plugin_cartosi_app` (
                  `id` int {$default_key_sign} NOT NULL auto_increment,
                  `description` TEXT NOT NULL,
                  `name` TEXT NOT NULL,
                  `domain` TEXT NOT NULL,
                  `leader` TEXT NOT NULL,
                  `check` date,
                PRIMARY KEY (`id`)
               ) ENGINE=InnoDB DEFAULT CHARSET={$default_charset} COLLATE={$default_collation} ROW_FORMAT=DYNAMIC;";

      $DB->query($query) or die("error glpi_plugin_cartosi_app ". $DB->error());
   }
   
   // To be called for each task the plugin manage
   // task in class
   CronTask::Register(Example::class, 'CartoSI', DAY_TIMESTAMP,
         array(
            'comment'   => '',
            'mode'      => Crontask::MODE_EXTERNAL
         ));
   return true;
}


/**
 * Plugin uninstall process
 *
 * @return boolean
 */
function plugin_example_uninstall() {
   global $DB;

   // Current version tables
   if ($DB->tableExists("glpi_plugin_example_examples")) {
      $query = "DROP TABLE `glpi_plugin_example_examples`";
      $DB->query($query) or die("error deleting glpi_plugin_example_example");
   }
   
   if ($DB->tableExists("glpi_plugin_cartosi_credentials")) {
      $query = "DROP TABLE `glpi_plugin_cartosi_credentials`";
      $DB->query($query) or die("error deleting glpi_plugin_cartosi_credentials");
   }
  
   if ($DB->tableExists("glpi_plugin_cartosi_app")) {
      $query = "DROP TABLE `glpi_plugin_cartosi_app`";
      $DB->query($query) or die("error deleting glpi_plugin_cartosi_app");
   }
   return true;
}

function plugin_example_display_central() {
   echo "<tr><th colspan='2'>";
   echo "<div style='text-align:center; font-size:2em'>";
   echo __("Plugin example displays on central page", "example");
   echo "</div>";
   echo "</th></tr>";
}