<?php

namespace srag\Plugins\SrContainerObjectTree\Config\Form;

use ILIAS\UI\Component\Input\Field\Radio;
use ilSrContainerObjectTreePlugin;
use ilUtil;
use srag\CustomInputGUIs\SrContainerObjectTree\FormBuilder\AbstractFormBuilder;
use srag\CustomInputGUIs\SrContainerObjectTree\InputGUIWrapperUIInputComponent\InputGUIWrapperUIInputComponent;
use srag\CustomInputGUIs\SrContainerObjectTree\MultiSelectSearchNewInputGUI\MultiSelectSearchNewInputGUI;
use srag\Plugins\SrContainerObjectTree\Config\ConfigCtrl;
use srag\Plugins\SrContainerObjectTree\Tree\Repository;
use srag\Plugins\SrContainerObjectTree\Utils\SrContainerObjectTreeTrait;

/**
 * Class FormBuilder
 *
 * @package srag\Plugins\SrContainerObjectTree\Config\Form
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
class FormBuilder extends AbstractFormBuilder
{

    use SrContainerObjectTreeTrait;

    const KEY_ALLOWED_EMPTY_CONTAINER_OBJECT_TYPES = "allowed_empty_container_object_types";
    const KEY_LINK_CONTAINER_OBJECTS = "link_objects";
    const KEY_MAX_DEEP_METHOD = "max_deep_method";
    const KEY_MAX_DEEP_METHOD_START_HIDE_METADATA = self::KEY_MAX_DEEP_METHOD . "_start_hide";
    const KEY_MAX_DEEP_METHOD_START_SHOW_ARROW = self::KEY_MAX_DEEP_METHOD . "_start_show_arrow";
    const KEY_OBJECT_TYPES = "object_types";
    const KEY_ONLY_SHOW_CONTAINER_OBJECTS_IF_NOT_EMPTY = "only_show_container_objects_if_not_empty";
    const KEY_OPEN_LINKS_IN_NEW_TAB = "open_links_in_new_tab";
    const KEY_RECURSIVE_COUNT = "recursive_count";
    const KEY_USER_SETTINGS_PER_OBJECT = "user_settings_per_object";
    const MAX_DEEP_METHODS
        = [
            Repository::MAX_DEEP_METHOD_END   => "end",
            Repository::MAX_DEEP_METHOD_START => "start"
        ];
    const PLUGIN_CLASS_NAME = ilSrContainerObjectTreePlugin::class;


    /**
     * @inheritDoc
     *
     * @param ConfigCtrl $parent
     */
    public function __construct(ConfigCtrl $parent)
    {
        parent::__construct($parent);
    }


    /**
     * @inheritDoc
     */
    protected function getButtons() : array
    {
        $buttons = [
            ConfigCtrl::CMD_UPDATE_CONFIGURE => self::plugin()->translate("save", ConfigCtrl::LANG_MODULE)
        ];

        return $buttons;
    }


    /**
     * @inheritDoc
     */
    protected function getData() : array
    {
        $data = [
            self::KEY_OBJECT_TYPES                             => self::srContainerObjectTree()->config()->getValue(self::KEY_OBJECT_TYPES),
            self::KEY_MAX_DEEP_METHOD                          => self::srContainerObjectTree()->config()->getValue(self::KEY_MAX_DEEP_METHOD),
            self::KEY_MAX_DEEP_METHOD_START_HIDE_METADATA      => self::srContainerObjectTree()->config()->getValue(self::KEY_MAX_DEEP_METHOD_START_HIDE_METADATA),
            self::KEY_MAX_DEEP_METHOD_START_SHOW_ARROW         => self::srContainerObjectTree()->config()->getValue(self::KEY_MAX_DEEP_METHOD_START_SHOW_ARROW),
            self::KEY_LINK_CONTAINER_OBJECTS                   => self::srContainerObjectTree()->config()->getValue(self::KEY_LINK_CONTAINER_OBJECTS),
            self::KEY_OPEN_LINKS_IN_NEW_TAB                    => self::srContainerObjectTree()->config()->getValue(self::KEY_OPEN_LINKS_IN_NEW_TAB),
            self::KEY_ONLY_SHOW_CONTAINER_OBJECTS_IF_NOT_EMPTY => self::srContainerObjectTree()->config()->getValue(self::KEY_ONLY_SHOW_CONTAINER_OBJECTS_IF_NOT_EMPTY),
            self::KEY_ALLOWED_EMPTY_CONTAINER_OBJECT_TYPES     => self::srContainerObjectTree()->config()->getValue(self::KEY_ALLOWED_EMPTY_CONTAINER_OBJECT_TYPES),
            self::KEY_RECURSIVE_COUNT                          => self::srContainerObjectTree()->config()->getValue(self::KEY_RECURSIVE_COUNT),
            self::KEY_USER_SETTINGS_PER_OBJECT                 => self::srContainerObjectTree()->config()->getValue(self::KEY_USER_SETTINGS_PER_OBJECT)
        ];

        return $data;
    }


    /**
     * @inheritDoc
     */
    protected function getFields() : array
    {
        $fields = [
            self::KEY_OBJECT_TYPES                             => (new InputGUIWrapperUIInputComponent(new MultiSelectSearchNewInputGUI(self::plugin()
                ->translate(self::KEY_OBJECT_TYPES, ConfigCtrl::LANG_MODULE))))->withRequired(true),
            self::KEY_MAX_DEEP_METHOD                          => array_reduce(array_keys(self::MAX_DEEP_METHODS), function (Radio $radio, int $max_deep_method) : Radio {
                return $radio->withOption($max_deep_method, self::plugin()
                    ->translate(self::KEY_MAX_DEEP_METHOD . "_" . self::MAX_DEEP_METHODS[$max_deep_method], ConfigCtrl::LANG_MODULE));
            }, self::dic()->ui()->factory()->input()->field()->radio(self::plugin()->translate(self::KEY_MAX_DEEP_METHOD, ConfigCtrl::LANG_MODULE))),
            self::KEY_MAX_DEEP_METHOD_START_HIDE_METADATA      => self::dic()->ui()->factory()->input()->field()->checkbox(self::plugin()
                ->translate(self::KEY_MAX_DEEP_METHOD_START_HIDE_METADATA, ConfigCtrl::LANG_MODULE)),
            self::KEY_MAX_DEEP_METHOD_START_SHOW_ARROW         => self::dic()->ui()->factory()->input()->field()->checkbox(self::plugin()
                ->translate(self::KEY_MAX_DEEP_METHOD_START_SHOW_ARROW, ConfigCtrl::LANG_MODULE)),
            self::KEY_LINK_CONTAINER_OBJECTS                   => self::dic()->ui()->factory()->input()->field()->checkbox(self::plugin()
                ->translate(self::KEY_LINK_CONTAINER_OBJECTS, ConfigCtrl::LANG_MODULE)),
            self::KEY_OPEN_LINKS_IN_NEW_TAB                    => self::dic()->ui()->factory()->input()->field()->checkbox(self::plugin()
                ->translate(self::KEY_OPEN_LINKS_IN_NEW_TAB, ConfigCtrl::LANG_MODULE)),
            self::KEY_ONLY_SHOW_CONTAINER_OBJECTS_IF_NOT_EMPTY => self::dic()->ui()->factory()->input()->field()->checkbox(self::plugin()
                ->translate(self::KEY_ONLY_SHOW_CONTAINER_OBJECTS_IF_NOT_EMPTY, ConfigCtrl::LANG_MODULE)),
            self::KEY_ALLOWED_EMPTY_CONTAINER_OBJECT_TYPES     => (new InputGUIWrapperUIInputComponent(new MultiSelectSearchNewInputGUI(self::plugin()
                ->translate(self::KEY_ALLOWED_EMPTY_CONTAINER_OBJECT_TYPES, ConfigCtrl::LANG_MODULE)))),
            self::KEY_RECURSIVE_COUNT                          => self::dic()->ui()->factory()->input()->field()->checkbox(self::plugin()
                ->translate(self::KEY_RECURSIVE_COUNT, ConfigCtrl::LANG_MODULE)),
            self::KEY_USER_SETTINGS_PER_OBJECT                 => self::dic()->ui()->factory()->input()->field()->checkbox(self::plugin()
                ->translate(self::KEY_USER_SETTINGS_PER_OBJECT, ConfigCtrl::LANG_MODULE))
        ];

        $fields[self::KEY_OBJECT_TYPES]->getInput()->setOptions(self::srContainerObjectTree()->tree()->getObjectTypes(null, false));
        $fields[self::KEY_ALLOWED_EMPTY_CONTAINER_OBJECT_TYPES]->getInput()->setOptions(self::srContainerObjectTree()->tree()->getContainerObjectTypes(null, false));

        return $fields;
    }


    /**
     * @inheritDoc
     */
    protected function getTitle() : string
    {
        return self::plugin()->translate("configuration", ConfigCtrl::LANG_MODULE);
    }


    /**
     * @inheritDoc
     */
    protected function storeData(array $data)/* : void*/
    {
        self::srContainerObjectTree()->config()->setValue(self::KEY_OBJECT_TYPES, MultiSelectSearchNewInputGUI::cleanValues((array) $data[self::KEY_OBJECT_TYPES]));
        self::srContainerObjectTree()->config()->setValue(self::KEY_MAX_DEEP_METHOD, intval($data[self::KEY_MAX_DEEP_METHOD]));
        self::srContainerObjectTree()->config()->setValue(self::KEY_MAX_DEEP_METHOD_START_HIDE_METADATA, boolval($data[self::KEY_MAX_DEEP_METHOD_START_HIDE_METADATA]));
        self::srContainerObjectTree()->config()->setValue(self::KEY_MAX_DEEP_METHOD_START_SHOW_ARROW, boolval($data[self::KEY_MAX_DEEP_METHOD_START_SHOW_ARROW]));
        self::srContainerObjectTree()->config()->setValue(self::KEY_LINK_CONTAINER_OBJECTS, boolval($data[self::KEY_LINK_CONTAINER_OBJECTS]));
        self::srContainerObjectTree()->config()->setValue(self::KEY_OPEN_LINKS_IN_NEW_TAB, boolval($data[self::KEY_OPEN_LINKS_IN_NEW_TAB]));
        self::srContainerObjectTree()->config()->setValue(self::KEY_ONLY_SHOW_CONTAINER_OBJECTS_IF_NOT_EMPTY, boolval($data[self::KEY_ONLY_SHOW_CONTAINER_OBJECTS_IF_NOT_EMPTY]));
        self::srContainerObjectTree()
            ->config()
            ->setValue(self::KEY_ALLOWED_EMPTY_CONTAINER_OBJECT_TYPES, MultiSelectSearchNewInputGUI::cleanValues((array) $data[self::KEY_ALLOWED_EMPTY_CONTAINER_OBJECT_TYPES]));
        self::srContainerObjectTree()->config()->setValue(self::KEY_RECURSIVE_COUNT, boolval($data[self::KEY_RECURSIVE_COUNT]));

        $user_settings_per_object = boolval($data[self::KEY_USER_SETTINGS_PER_OBJECT]);
        if ($user_settings_per_object !== self::srContainerObjectTree()->config()->getValue(self::KEY_USER_SETTINGS_PER_OBJECT)) {
            self::srContainerObjectTree()->userSettings()->resetUserSettings();
            ilUtil::sendInfo(self::plugin()->translate(self::KEY_USER_SETTINGS_PER_OBJECT . "_reset", ConfigCtrl::LANG_MODULE,
                [self::plugin()->translate(self::KEY_USER_SETTINGS_PER_OBJECT, ConfigCtrl::LANG_MODULE)]), true);
        }
        self::srContainerObjectTree()->config()->setValue(self::KEY_USER_SETTINGS_PER_OBJECT, $user_settings_per_object);
    }
}
