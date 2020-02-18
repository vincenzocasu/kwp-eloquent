# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [v0.3.0] - 2020-02-17
### Added
- Added CHANGELOG.md file
- Added BaseModel and BaseMeta classes.
- Laravel 5.5-5.6 automatic trait initilization shim for database connection.
- Applied PSR-12 styles and standards.
- Include DocBlocks EVERYWHERE that I can think of.

### Changed
- Minimum PHP version.
- Defined Laravel version to match oldest LTS.
- Refactor existing classes to use BaseModel and BaseMeta as needed.
- Fall back to WP-Core's `is_serialized` if available, or use shim for non-wp envs.
- Moved files from `WPEloquent/` to `src/` folder.

## [v0.2.1] - 2017-09-07
Last Release Pre-Fork
