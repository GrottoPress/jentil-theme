# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased] -

### Added
- Add `.security.txt`
- Add suport for PHP 7.3 and 7.4
- Set up JS module bundling with [rollup js](https://rollupjs.org)
- Set up [broser-sync](https://www.browsersync.io)
- Add `.gitattributes`
- Add `Procfile`
- Add `Dockerfile`

### Changed
- Rename theme back to `jentil-theme`
- Rename `LICENSE.md` to `LICENSE`
- Upgrade gulp to version 4
- Update scripts to use JS modules
- Replace `Theme::$theme` with `Theme::$meta` (theme info extracted from `style.css`)

## 0.4.0 - 2018-09-27

### Added
- Add `Theme::$theme` attribute that returns `WP_Theme` instance of this theme.
- Append enqueued assets URL with last modified time for cache busting.
- Add Gutenberg editor styles

### Changed
- Rename `language/` directory to `lang/`
- Rename `Language` setup to `Translations\Translation`
- Split up thumbnail setup into separate setups
- Prefix global constant names with `MY_THEME_`
- Dynamically prefix ids using our new `Theme::$theme` attribute

## 0.3.0 - 2018-08-24

### Added
- Set up [postcss](https://postcss.org)
- Example customizer panel, sections, settings.

### Changed
- Rename theme to `my-theme`
- Explicitly mark sample meta box as compatible with Gutenberg.
- Moved composing classes one level up for shorter namespaces

## 0.2.0 - 2018-06-11

### Changes
- Check for WordPress and PHP versions compatibility before running theme
- Jentil compatibility updates

## 0.1.0 - 2018-04-13

### Added
- Initial public release
