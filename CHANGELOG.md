# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.0] - 2021-05-22

### Changed

The `RadioBrowser` class is now a wrapper for the new `RadioBrowserApi` class.
`RadioBrowserApi` is the general one, its methods return strings, `RadioBrowser` methods returns arrays.

### Added
- RadioBrowserApi class
- The read-only proprieties $server and $format.
- ::getStationsByClicks()
- ::getStationsByVotes()
- ::getStationsByRecentClicks()
- ::getStationsByLastChange()
- ::getStationOlderVersions()
- ::getBrokenStations()
- ::getServerStats()
- ::getServerMirrors()
- ::getServerConfig()
- ::getServerMetrics()
- ::addStation()
- added examples files

## [0.1.1] - 2021-01-28

### Fixed
- ::getStationsByExactTag($tag) and ::getStationsByTag($tag) no longer strip "#" from $tag before request.

