<?php

namespace srag\Plugins\SrCurriculum\ObjectSettings;

use ilSrCurriculumPlugin;
use srag\DIC\SrCurriculum\DICTrait;
use srag\Plugins\SrCurriculum\Utils\SrCurriculumTrait;

/**
 * Class Repository
 *
 * @package srag\Plugins\SrCurriculum\ObjectSettings
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
final class Repository
{

    use DICTrait;
    use SrCurriculumTrait;

    const PLUGIN_CLASS_NAME = ilSrCurriculumPlugin::class;
    /**
     * @var self|null
     */
    protected static $instance = null;


    /**
     * Repository constructor
     */
    private function __construct()
    {

    }


    /**
     * @return self
     */
    public static function getInstance() : self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }


    /**
     * @param ObjectSettings $object_settings
     *
     * @return ObjectSettings
     */
    public function cloneObjectSettings(ObjectSettings $object_settings) : ObjectSettings
    {
        return $object_settings->copy();
    }


    /**
     * @param ObjectSettings $object_settings
     */
    public function deleteObjectSettings(ObjectSettings $object_settings)/* : void*/
    {
        $object_settings->delete();
    }


    /**
     * @internal
     */
    public function dropTables()/* : void*/
    {
        self::dic()->database()->dropTable(ObjectSettings::TABLE_NAME, false);
    }


    /**
     * @return Factory
     */
    public function factory() : Factory
    {
        return Factory::getInstance();
    }


    /**
     * @param int $obj_id
     *
     * @return ObjectSettings|null
     */
    public function getObjectSettingsById(int $obj_id)/* : ?ObjectSettings*/
    {
        /**
         * @var ObjectSettings|null $object_settings
         */

        $object_settings = ObjectSettings::where([
            "obj_id" => $obj_id
        ])->first();

        return $object_settings;
    }


    /**
     * @internal
     */
    public function installTables()/* : void*/
    {
        ObjectSettings::updateDB();
    }


    /**
     * @param ObjectSettings $object_settings
     */
    public function storeObjectSettings(ObjectSettings $object_settings)/* : void*/
    {
        $object_settings->store();
    }
}
