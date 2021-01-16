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

`::getStationsByUuid(string|array $uuids)

`::getStationsByUrl(string $url)

## Get stations by ...

All the methods in this section share the following parameters:

| Parameter   | Type   | Default val. | Description                                                  |
| ----------- | ------ | ------------ | ------------------------------------------------------------ |
| $order      | string | 'name'       | Possible values:<br />name, url, homepage, favicon, tags, country, state, language, votes, codec, bitrate, lastcheckok, lastchecktime, clicktimestamp, clickcount, clicktrend, random |
| $reverse    | bool   | false        | false = Ascending order.<br />true = Descending order.       |
| $hideBroken | bool   | false        | Do not list stations that failed the connection test.        |
| $offset     | int    | 0            |                                                              |
| $limit      | int    | 100000       |                                                              |



### Get stations by name

The `::getStationsByName($name, $order, $reverse, $hideBroken, $offset, $limit)` method returns stations described with `$name`.



### Get stations by exact name

The `::getStationsByExactName($name, $order, $rev...)` method returns stations described with an exact match of `$name`.



### Get stations by codec

The `::getStationsByCodec($codec, $order, $rev...)` method returns stations described with `$codec`.



### Get stations by exact codec

The `::getStationsByExactCodec($codec, $order, $rev...)` method returns stations described with an exact match of `$codec`.



### Get stations by country

The `::getStationsByCountry($country, $order, $rev...)` method returns stations described with `$country`.



### Get station by exact country

The `::getStationsByExactCountry($country, $order, $rev...)` method returns stations described with an exact match of `$country`.



### Get stations by state

`::getStationsByState($state, $order, $reverse, $hideBroken, $offset, $limit)`.



### Get stations by exact state

`::getStationsByExactState($state, $order, $reverse, $hideBroken, $offset, $limit)`.



### Get stations by language

`::getStationsByLanguage($language, $order, $reverse, $hideBroken, $offset, $limit)`.



### Get stations by exact language

`::getStationsByExactLanguage($language, $order, $reverse, $hideBroken, $offset, $limit)`.



### Get stations by tag

The `::getStationsByTag($tag, $order, $rev...)` method returns a list of stations described with `$tag`.



### Get stations by exact tag

The `::getStationsByExactTag($tag, $order, $rev...)` method returns a list of stations described with an exact match of `$tag`.



## Search station

`::searchStation(array $customParameters)`

### ::getStations()


## General Information

### Get countries
`::getCountries()`

### Get country codes
`::getCountryCodes()`

### Get codecs
`::getCodecs()`

### Get states
`::getStates()`

### Get languages
`::getLanguages()`

### Get tags
`::getTags()`

## Servers

### Get DNS records
The The `::getDnsRecords()` method returns DNS information on available servers.

### Get server IPs
The `::getServerIps()` method returns an array of IPs of available servers.

### Get servers
The `::getServers()` method returns an array of URLs of available servers.

### Pick a server
The `::pickAServer()` static method returns a random server's URL.


## License
MIT