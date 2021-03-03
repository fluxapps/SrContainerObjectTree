<!-- Autogenerated from composer.json - All changes will be overridden if generated again! -->

# SrContainerObjectTree ILIAS Plugin

Add container objects tree view in repository objects

This is an OpenSource project by studer + raimann ag, CH-Burgdorf (https://studer-raimann.ch)

This project is licensed under the GPL-3.0-only license

## Requirements

* ILIAS 5.4.0 - 6.999
* PHP >=7.0

## Installation

Start at your ILIAS root directory

```bash
mkdir -p Customizing/global/plugins/Services/Repository/RepositoryObject
cd Customizing/global/plugins/Services/Repository/RepositoryObject
git clone https://github.com/fluxfw/SrContainerObjectTree.git SrContainerObjectTree
```

Update, activate and config the plugin in the ILIAS Plugin Administration

## Description

### Container objects

You can select repository container objects in the plugin repository object settings

Its tree will be displayed in the contents tab

The objects are sorted by title, independently the manually config

This plugin is an alternative view for the ILIAS core left sidebar view

### Config

TODO

### Custom event plugins

If you need to adapt some custom SrContainerObjectTree changes which can not be configured to your needs, SrContainerObjectTree will trigger some events, you can listen and react to this in an other custom plugin (plugin type is no matter)

First create or extend a `plugin.xml` in your custom plugin (You need to adapt `PLUGIN_ID` with your own plugin id) to tell ILIAS, your plugins wants to listen to SrContainerObjectTree events (You need also to increase your plugin version for take effect)

```xml
<?php xml version = "1.0" encoding = "UTF-8"?>
<plugin id="PLUGIN_ID">
	<events>
		<event id="Plugins/SrContainerObjectTree" type="listen" />
	</events>
</plugin>
```

In your plugin class implement or extend the `handleEvent` method

```php
...
require_once __DIR__ . "/../../SrContainerObjectTree/vendor/autoload.php";
...
class ilXPlugin extends ...
...
	/**
	 * @inheritDoc
	 */
	public function handleEvent(/*string*/ $a_component, /*string*/ $a_event, /*array*/ $a_parameter)/* : void*/ {
		switch ($a_component) {
			case IL_COMP_PLUGIN . "/" . ilSrContainerObjectTreePlugin::PLUGIN_NAME:
				switch ($a_event) {
					case ilSrContainerObjectTreePlugin::EVENT_...:
						...
						break;

					default:
						break;
				}
				break;

			default:
				break;
		}
	}
...
```

| Event | Parameters | Purpose |
|-------|------------|---------|
| `ilSrContainerObjectTreePlugin::EVENT_CHANGE_CHILD_BEFORE_OUTPUT` | `child => &array` | Change some child properties before it will be output (Please note `child` is a reference variable, if it should not works) |

## Adjustment suggestions

You can report bugs or suggestions at https://plugins.studer-raimann.ch/goto.php?target=uihk_srsu_PLCOT

There is no guarantee this can be fixed or implemented

## ILIAS Plugin SLA

We love and live the philosophy of Open Source Software! Most of our developments, which we develop on behalf of customers or on our own account, are publicly available free of charge to all interested parties at https://github.com/studer-raimann.

Do you use one of our plugins professionally? Secure the timely availability of this plugin for the upcoming ILIAS versions via SLA. Please inform yourself under https://studer-raimann.ch/produkte/ilias-plugins/plugin-sla.

Please note that we only guarantee support and release maintenance for institutions that sign a SLA.
