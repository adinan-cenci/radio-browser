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

### Just get all stations

The `::getStations()` method will return all stations.

<br><br>

## Get stations by ...

All the methods in this section share the following parameters:

| Parameter   | Type   | Default | Description                                                  |
| ----------- | ------ | ------- | ------------------------------------------------------------ |
| $order      | string | 'name'  | Possible values:<br />name, url, homepage, favicon, tags, country, state, language, votes, codec, bitrate, lastcheckok, lastchecktime, clicktimestamp, clickcount, clicktrend, random. |
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
`::getStationsByState($state, $order, $rev...)`.

<br><br>

### Get stations by exact state

`::getStationsByExactState($state, $order, $rev...)`.

<br><br>

### Get stations by language
`::getStationsByLanguage($language, $order, $rev...)`.

<br><br>

### Get stations by exact language
`::getStationsByExactLanguage($language, $order, $rev...)`.

<br><br>

### Get stations by tag
The `::getStationsByTag($tag, $order, $rev...)` method returns a list of stations described with `$tag`.

<br><br>

### Get stations by exact tag
The `::getStationsByExactTag($tag, $order, $rev...)` method returns a list of stations described with an exact match of `$tag`.

<br><br>

## Search station
The `::searchStation($searchTerms)` method allow us to fine grain our search.
It receives a single associative array with the following keys available, all of which are optional:

| Key           | Type          | Default | Description                                                  |
| ------------- | ------------- | ------- | ------------------------------------------------------------ |
| name          | string        | null    |                                                              |
| nameExact     | bool          | false   |                                                              |
| country       | string        | null    |                                                              |
| countryExact  | bool          | false   |                                                              |
| countrycode   | string        | null    |                                                              |
| state         | string        | null    |                                                              |
| stateExact    | bool          | false   |                                                              |
| language      | string        | null    |                                                              |
| languageExact | bool          | false   |                                                              |
| tag           | string        | null    |                                                              |
| tagExact      | bool          | false   |                                                              |
| tagList       | string\|array | null    | A list of tags, either an array or a comma separated string. |
| codec         | string        | null    |                                                              |
| bitrateMin    | int           | 0       |                                                              |
| bitrateMax    | int           | 1000000 |                                                              |
| order         | string        | name    | Possible values:<br />name, url, homepage, favicon, tags, country, state, language, votes, codec, bitrate, lastcheckok, lastchecktime, clicktimestamp, clickcount, clicktrend, random. |
| reverse       | bool          | false   | false = Ascending order.<br />true = Descending order.       |
| offset        | int           | 0       |                                                              |
| limit         | int           | 100000  |                                                              |

<br><br>

## Ranking

### Listeners

The `::clickStation($stationUuid)` method must be invoked every time a user starts playing a stream, this helps Radio Browser sort how popular each station is. **IMPORTANT**: Every call from the same IP address and for the same station only gets counted once per day.

### Voting

The `::voteStation($stationUuid)` method increases the vote count by one. **IMPORTANT**: it can only be called once every 10 minutes for the same radio stations, from the same IP.

<br><br>

## General Information

The methods bellow share the following parameters:

| Parameter   | Type   | Default | Description                                            |
| ----------- | ------ | ------- | ------------------------------------------------------ |
| $filter     | string |         | A string to be matched against.                        |
| $order      | string | name    | Possible values: name, stationcount.                   |
| $reverse    | bool   | false   | false = Ascending order.<br />true = Descending order. |
| $hideBroken | bool   | false   | Do not count stations that failed the connection test. |

### Get codecs
The `::getCodecs($filter, $order, $reverse, $hideBroken)` method returns a list of codecs and a count of stations using them.

<br><br>

### Get languages
The `::getLanguages($filter, $ord...)` method returns a list of languages and a count of stations in this language.

<br><br>

### Get tags
The `::getTags($filter, $ord...)` method returns a list of tags and a count of stations described with them.

<br><br>

### Get country codes

The `::getCountryCodes($filter, $ord...)` method returns a list of country codes and a count of stations described with them.

<br><br>

### Get countries

The `::getCountries($filter, $ord...)` method returns a list of countries and a count of stations described with them.

<br><br>

### Get states

The `::getStates($filter, $country, $order, $reverse, $hideBroken)` return a list of states and a count of stations described with them.

| Parameter   | Type   | Default | Description                                            |
| ----------- | ------ | ------- | ------------------------------------------------------ |
| $filter     | string |         | A string to be matched against.                        |
| $country    | string | null    | The country that the state belongs to.                 |
| $order      | string | name    | Possible values: name, stationcount.                   |
| $reverse    | bool   | false   | false = Ascending order.<br />true = Descending order. |
| $hideBroken | bool   | false   | Do not count stations that failed the connection test. |

<br><br>

## Servers

### Get DNS records
The The `::getDnsRecords()` static method returns DNS information on available servers.

<br><br>

### Get server IPs
The `::getServerIps()` static method returns an array of IPs of available servers.

<br><br>

### Get servers
The `::getServers()` static method returns an array of URLs of available servers.

<br><br>

### Pick a server
The `::pickAServer()` static method returns a random server's URL.

<br><br>


## License
MIT