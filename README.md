# Radio Browser
A library to fetch data from the [radio-browser.info](https://radio-browser.info) catalog of Internet radio stations.

```php
use \AdinanCenci\RadioBrowser\RadioBrowser;

$browser          = new RadioBrowser();
$tag              = 'metal';
$orderBy          = 'stationcount';
$descendingOrder  = true;

$stations         = $browser->getStationsByTag($tag, $orderBy, $descendingOrder);

echo $stations;
```

## Instantiating

The constructor takes two optional parameters:

**Server**: It defaults to "'https://de1.api.radio-browser.info/", if false is informed, the object will pick a random server, see [SERVERS] for more information.

**Format**: Defaults to "json"

### Servers

RadioBrowser::getServers() returns an array with available servers.

### Formats

Radio Browser serves data in the JSON, XML, CSV, M3U, PLS, XSPF and TTL formats.

## Radio Stations

### ::getStationsByUuid(string|array $uuids)

### ::getStationsByUrl(string $url)

### ::getStationsByName($name, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000)

### ::getStationsByExactName($name, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000)

### ::getStationsByCodec($codec, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000)

### ::getStationsByExactCodec($codec, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000)

### ::getStationsByCountry($country, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000)

### ::getStationsByExactCountry($country, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000)

### ::getStationsByState($state, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000)

### ::getStationsByExactState($state, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000)

### ::getStationsByLanguage($language, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000)

### ::getStationsByExactLanguage($language, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000)

### ::getStationsByTag($tag, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000)

Returns a list of stations described with `$tag`.

### ::getStationsByTag($tag, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000)

Returns a list of stations described with `$tag`. 

| Parameter | Type   | Default val. | Description                                                  |
| --------- | ------ | ------------ | ------------------------------------------------------------ |
| $tag      | string |              |                                                              |
| $order    | string | 'name'       | Possible values:<br />name, url, homepage, favicon, tags, country, state, language, votes, codec, bitrate, lastcheckok, lastchecktime, clicktimestamp, clickcount, clicktrend, random |
| $reverse  | bool   | false        | false = Ascending order<br />true = Descending order         |
| $offset   | int    | 0            |                                                              |
| $limit    | int    | 100000       |                                                              |





### ::getStationsByExactTag($tag, $order = 'name', $reverse = false, $hideBroken = false, $offset = 0, $limit = 100000)

### ::searchStation(array $customParameters)

### ::getStations()

## General Information

### ::getCountries()

### ::getCountryCodes()

### ::getCodecs()

### ::getStates()

### ::getLanguages()

### ::getTags()

## Servers

### ::getDnsRecords()

Returns DNS information on available servers.

### ::getServersIps()

Returns an array of IPs of available servers.

### ::getServers()

Returns an array of URLs of available servers.

### ::pickAServer()

Returns a random URL to an available server.


## License
MIT