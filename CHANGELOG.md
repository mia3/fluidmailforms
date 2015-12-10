# Fluidcontent Change log

4.4.0 - 2015-11-21
------------------

[#316](https://github.com/FluidTYPO3/fluidcontent/pull/316) Feature to specify default (non-Flux) column values which will be added to `defValues` array when creating new instances of fluidcontent templates

- Content type selector switched to TCA manipulation feature from Flux
  - [Old content selector based on user function removed](https://github.com/FluidTYPO3/fluidcontent/commit/026a44898a747780feed7cfd2678b5902f33b34c
  - [New selector values generated from Forms instances](https://github.com/FluidTYPO3/fluidcontent/commit/a03af543cd8183488b973428a9224aece8de0d44)

- [SVG icon support for TYPO3 7.6](https://github.com/FluidTYPO3/fluidcontent/commit/d08c0f1b40b607a3c1653ddbb48953619ca45d18)

- :exclamation: Support of [TYPO3 6.2 dropped](https://github.com/FluidTYPO3/fluidcontent/commit/f1df9a4b7ee563335c8f1feeb7925e6f820a7f19)
	- As result, [legacy code removed](https://github.com/FluidTYPO3/fluidcontent/pull/313)
	- For TYPO3 6.2 based projects there is a [*legacy*](https://github.com/FluidTYPO3/fluidcontent/tree/legacy) branch

- Added support of [TYPO3 7 LTS](https://github.com/FluidTYPO3/fluidcontent/commit/f1df9a4b7ee563335c8f1feeb7925e6f820a7f19)

- [#305](https://github.com/FluidTYPO3/fluidcontent/pull/305) It is possible to add custom CEs, created with Fluidcontent, to existing TYPO3 tabs at "New CE" wizard

- [#295](https://github.com/FluidTYPO3/fluidcontent/pull/295) New CE wizard icons are compatible to TYPO3 7 LTS
	- [TYPO3 core deprecation and recommendation](https://docs.typo3.org/typo3cms/extensions/core/latest/Changelog/7.5/Deprecation-69057-DeprecateIconUtilityAndMoveMethodsIntoIconFactory.html)

- [#292](https://github.com/FluidTYPO3/fluidcontent/pull/292) Improved performance of multi-domain, multi-root installations

- [#293](https://github.com/FluidTYPO3/fluidcontent/pull/293) Fixed issue with double back-slash in template path


4.3.3 - 2015-10-24
------------------

- [TYPO3 7.5 is now officially supported](https://github.com/FluidTYPO3/fluidcontent/commit/99a3381a81dc89ff0b570a3f7b837157827ff1b1)

- [#290](https://github.com/FluidTYPO3/fluidcontent/pull/290) Bugfix for order of realpath/file_exists when processing icon file

- [#278](https://github.com/FluidTYPO3/fluidcontent/pull/278) In case no *Fluid Content type* is selected for content with CType `fluidcontent_content` an error message is shown in FE and BE
	- Template `Content/Error.html` is used for error message
	- Additionally rendering of preview is suppressed, when *Fluid Content type* is selected, but CType is not `fluidcontent_content`
	- Such situation may happen, when changing content type from *Fluid Content* to something different

- [#284](https://github.com/FluidTYPO3/fluidcontent/pull/284) Disabled *Fluid Content type* drop-down for all CTypes, except `fluidcontent_content`

4.3.2 - 2015-09-10
------------------

- Avoid `realpath()` on icons when Flux version is older, causing bad icon references
	- [Source commit with more info](https://github.com/FluidTYPO3/fluidcontent/commit/76a98ff5907c97bfac71e93d2dc7884807503258)

- Avoid `E_NOTICE` on missing array index
	- [Source commit with more info](https://github.com/FluidTYPO3/fluidcontent/commit/6436d1c6d70d32483df92cf6606c23823dda898a)

- [#263](https://github.com/FluidTYPO3/fluidcontent/pull/263) Default SVG icon for CE is shown in case no icon provided

- [#273](https://github.com/FluidTYPO3/fluidcontent/pull/273) Icon size definitions in EM can now be strings
	- Allows TYPO3 fancy definitions, like `24m` or `24c`

- Do not load BE-related cache in FE context
	- [Source commit with more info](https://github.com/FluidTYPO3/fluidcontent/commit/f87ce58b7edbc4a4af8a2074aa9cc985d9e312d1)

4.3.1 - 2015-08-08
------------------

- CE icon width and height can be defined in EM
	- [Source commit with more info](https://github.com/FluidTYPO3/fluidcontent/commit/4bc2f324ed6b6dda490cee9b5915397861589168)

- [#262](https://github.com/FluidTYPO3/fluidcontent/pull/262) Bugfix when running with Flux 7.2

- Support for coming Flux 7.3 (metadata only)

4.3.0 - 2015-08-08
------------------

- Support for TYPO3 7.4

- :exclamation: No more testing for PHP 5.4
	- Fluidcontent still supports TYPO3 6.2, which can be run on PHP 5.4, but it is advised to upgrade your PHP to 5.5 (which is also supported by 6.2) at least

- :exclamation: Default template `Index.html` removed
	- [Source commit with more info](https://github.com/FluidTYPO3/fluidcontent/commit/c05dbd237dedbf84c69583626ef7096caf9dcb99)

- [#258](https://github.com/FluidTYPO3/fluidcontent/issues/258) `{settings}` are enriched with content settings, when *EXT:fluidcontent_core* is used

- [#227](https://github.com/FluidTYPO3/fluidcontent/issues/227) [#248](https://github.com/FluidTYPO3/fluidcontent/issues/248) Fixed broken inclusion of template files from subfolders

- [#253](https://github.com/FluidTYPO3/fluidcontent/issues/253) Fixed missing icons in "new CE" Wizard

4.2.4 - 2015-07-01
------------------

- Bugfix release:
	- [#243](https://github.com/FluidTYPO3/fluidcontent/issues/243) Flexform not showing in BE

4.2.3 - 2015-06-26
------------------

- TCA overrides are cached due to usage of latest TYPO3 TCA overrides suggestions
	- [Source commit with more info](https://github.com/FluidTYPO3/fluidcontent/commit/b3b4da75f9a338d266e1c1f94b7b7c6719083fcb)
	- [TCA overrides](http://docs.typo3.org/typo3cms/TCAReference/ExtendingTca/StoringChanges/Index.html#storing-changes-extension-overrides)

- Removed TCA dependency on features from css_styled_content for cases, when fluidcontent_core used
	- [Source commit with more info](https://github.com/FluidTYPO3/fluidcontent/commit/e2a274a6c6eee875f83c28b30ef9777f46544ca3)

- Fixes for cache-related issues:
	- [#239](https://github.com/FluidTYPO3/fluidcontent/pull/239) Lifetime of 'pageTsConfig' cache decreased form ~2 months to 1 day
	- [#127](https://github.com/FluidTYPO3/fluidcontent/issues/127) 'pageTsConfig' cache is rebuilt only in BE context

4.2.2 - 2015-05-20
------------------

- Default template added, which is used in case Fluid Content type is not specified
  - [Technical deatils](https://github.com/FluidTYPO3/fluidcontent/commit/763fbb612e95038391d178e33295c2829623f738)

4.2.1 - 2015-03-19
------------------

- No important changes

4.2.0 - 2015-03-18
------------------

- :exclamation: Legacy TYPO3 support removed and dependencies updated
  - TYPO3 6.2 is minimum required
  - TYPO3 7.1 is supported
  - Flux 7.2 is minimum required
  - ClassAliasMap removed - switch to the proper vendor and namespace

- :exclamation: Legacy support for TS registration removed
  - `plugin.tx_fluidcontent.collections.` support removed
  - `plugin.tx_fed.fce.` support removed
  - [Source commit with more info](https://github.com/FluidTYPO3/fluidcontent/commit/0cd6448ebdcb3bdcc82103d5f22eb4d30b475767)

- [#213](https://github.com/FluidTYPO3/fluidcontent/pull/213) Possible to use *'templateRootPaths'* (plural) option from TYPO3 6.2 to overload template paths
  - `plugin.tx_yourext.view.templateRootPaths` syntax is supported
  - *'templateRootPath'* (singular) and *'overlays'* are deprecated
  - [FluidTYPO3/flux#758](https://github.com/FluidTYPO3/flux/pull/758) - source feature

- [#191](https://github.com/FluidTYPO3/fluidcontent/pull/191) Template icon can be autoloaded, based on name convention
  - Template *EXT:extensionKey/Resources/Private/Templates/$controller/$templateName.html* loads an icon from *EXT:extensionKey/Resources/Public/Icons/$controller/$templateName.(png|gif)*
  - Icon can be set manually via option attribute as before
  - [#208](https://github.com/FluidTYPO3/fluidcontent/pull/208) Icon appears at content type select
  - [FluidTYPO3/flux#687](https://github.com/FluidTYPO3/flux/pull/687) - source feature
