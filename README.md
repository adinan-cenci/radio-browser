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

| Parameter | Type         | Default                             | Description                                                  |
| --------- | ------------ | ----------------------------------- | ------------------------------------------------------------ |
| $server   | string\|bool | https://de1.api.radio-browser.info/ | A Radio Browser server, it defaults to "'https://de1.api.radio-browser.info/", if false is informed, the object will pick a random server, see the server section for more information. |
| $format   | string       | json                                | The format the data must be served, possible values: json, xml, csv, m3u, pls, xspf, ttl |

<br><br>

## Radio Stations

### Get stations by UUID

The `::getStationsByUuid($uuids)` returns stations by their unique identifiers.

| Parameter | Type          | Description                                                  |
| --------- | ------------- | ------------------------------------------------------------ |
| $uuids    | string\|array | A list of uuids, either an array, or an comma separated string. |

<br><br>

### Get stations by URL

The `::getStationsByUrl($url)`method returns stations by their web page.

<br><br>

## Get stations by ...

All the methods in this section share the following parameters:

| Parameter   | Type   | Default | Description                                                  |
| ----------- | ------ | ------- | ------------------------------------------------------------ |
| $order      | string | 'name'  | Possible values:<br />name, url, homepage, favicon, tags, country, state, language, votes, codec, bitrate, lastcheckok, lastchecktime, clicktimestamp, clickcount, clicktrend, random |
| $reverse    | bool   | false   | false = Ascending order.<br />true = Descending order.       |
| $hideBroken | bool   | false   | Do not list stations that failed the connection test.        |
| $offset     | int    | 0       |                                                              |
| $limit      | int    | 100000  |                                                              |

All of them will also return an array containing the matched stations:

```
[
    {
        "changeuuid":"960e57c8-0601-11e8-ae97-52543be04c81",
        "stationuuid":"960e57c5-0601-11e8-ae97-52543be04c81",
        "name":"SRF 1",
        "url":"http://stream.srg-ssr.ch/m/drs1/mp3_128",
        "url_resolved":"http://stream.srg-ssr.ch/m/drs1/mp3_128",
        "homepage":"http://ww.srf.ch/radio-srf-1",
        "favicon":"https://upload.wikimedia.org/wikipedia/commons/thumb/d/d3/Radio_SRF_1.svg/205px-Radio_SRF_1.svg.png",
        "tags":"srg ssr,public radio",
        "country":"Switzerland",
        "countrycode":"CH",
        "state":"",
        "language":"german",
        "votes":0,
        "lastchangetime":"2019-12-12 18:37:02",
        "codec":"MP3",
        "bitrate":128,
        "hls":0,
        "lastcheckok":1,
        "lastchecktime":"2020-01-09 18:16:35",
        "lastcheckoktime":"2020-01-09 18:16:35",
        "lastlocalchecktime":"2020-01-08 23:18:38",
        "clicktimestamp":"",
        "clickcount":0,
        "clicktrend":0
    }, 
    {
        "changeuuid":"e57c9608-0601-11e8-ae97-52543be04c81",
        "stationuuid":"7c5960e5-0601-11e8-ae97-52543be04c81",
        "name":"Radio Metal"
        ...
        ...
        ...
    }
    ...
    ...
    ...
]
```

<br><br>



### Get stations by name
The `::getStationsByName($name, $order, $reverse, $hideBroken, $offset, $limit)` method returns stations described with `$name`.

<br><br>

### Get stations by exact name
The `::getStationsByExactName($name, $order, $rev...)` method returns stations described with an exact match of `$name`.

<br><br>

### Get stations by codec
The `::getStationsByCodec($codec, $order, $rev...)` method returns stations described with `$codec`.

<br><br>

### Get stations by exact codec
The `::getStationsByExactCodec($codec, $order, $rev...)` method returns stations described with an exact match of `$codec`.

<br><br>

### Get stations by country
The `::getStationsByCountry($country, $order, $rev...)` method returns stations described with `$country`.

<br><br>

### Get station by exact country
The `::getStationsByExactCountry($country, $order, $rev...)` method returns stations described with an exact match of `$country`.

<br><br>

### Get stations by state
`::getStationsByState($state, $order, $reverse, $hideBroken, $offset, $limit)`.

<br><br>

### Get stations by exact state

`::getStationsByExactState($state, $order, $reverse, $hideBroken, $offset, $limit)`.

<br><br>

### Get stations by language
`::getStationsByLanguage($language, $order, $reverse, $hideBroken, $offset, $limit)`.

<br><br>

### Get stations by exact language
`::getStationsByExactLanguage($language, $order, $reverse, $hideBroken, $offset, $limit)`.

<br><br>

### Get stations by tag
The `::getStationsByTag($tag, $order, $rev...)` method returns a list of stations described with `$tag`.

<br><br>

### Get stations by exact tag
The `::getStationsByExactTag($tag, $order, $rev...)` method returns a list of stations described with an exact match of `$tag`.

<br><br>

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